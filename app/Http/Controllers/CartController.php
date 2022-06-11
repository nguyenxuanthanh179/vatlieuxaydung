<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Exception;
use session;

class CartController extends GeneralController
{
    /**
     * Danh sách sản phẩm trong giỏ hàng
     */
    public function cart()
    {
        $cart = Cart::content();
        $totalPrice = Cart::total(0,",",""); // lấy tổng giá của sản phẩm

        return view('frontend.cart.cart ', [
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Thêm sản phẩm vào giỏ hàng
     * @param Request $request
     * @param $id
     */
    public function addToCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'numeric|alpha_num|digits_between:1,2|min:1'
        ],[
            'quantity.numeric' => 'Số lượng sản phẩm phải là một số',
            'quantity.alpha_num' => 'Số lượng sản phẩm phải là một số',
            'quantity.digits_between' => 'Số lượng đặt quá giới hạn cho phép, hãy liên hệ để đặt số lượng lớn',
            'quantity.min' => 'Số lượng sản phẩm phải là một số >= 1',
        ]);

        $product = Product::findOrFail($id);
        $qty = 1;
        if ($request->has('quantity')) {
            $qty = $request->input('quantity');
        }
        $cartInfo = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $product->sale,
            'options' => [
                'image' => $product->image
            ]
        ];

        // gọi đến thư viện thêm sản phẩm vào giỏ hàng
        Cart::add($cartInfo);

        session(['totalItem' => Cart::count()]);

        // chuyển về trang danh sách
        return redirect()->route('shop.cart');
    }

    // Hủy đơn hàng
    public function destroy(Request $request)
    {
        // remove session
        Cart::destroy();
        session(['totalItem' => Cart::count()]);

        return redirect('/');
    }
    public function updateCart(Request $request){

        $rowId = $request->rowId_cart;
        $qty = $request->input('cart_quantity');
        Cart::update($rowId,$qty);
        session(['totalItem' => Cart::count()]);
        return redirect()->route('shop.cart');
    }

    /**
     * Đặt hàng
     */
    public function order()
    {
        $totalCount = Cart::count();
        $totalPrice = Cart::total(0,",",""); // lấy tổng giá của sản phẩm
        $cart = Cart::content();
        return view('frontend.cart.order', [
            'totalCount' => $totalCount,
            'totalPrice' => $totalPrice,
            'cart' => $cart
        ]);
    }

    /**
     * Xử lý lưu đơn đặt hàng
     */
    public function postOrder(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:3|max:50',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|min:10|max:50',
            'phone' => 'required|numeric|digits:10|regex:/(0)[0-9]/',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
        ],[
            'fullname.required' => 'Bạn cần phải nhập vào tên của bạn',
            'fullname.min' => 'Họ tên phải lớn hơn 3 và nhỏ hơn 50 ký tự',
            'fullname.max' => 'Họ tên phải lớn hơn 3 và nhỏ hơn 50 ký tự',

            'email.required' => 'Bạn cần phải nhập vào email',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.min' => 'Email phải có độ dài từ 10 đến 50 ký tự',
            'email.max' => 'Email phải có độ dài từ 10 đến 50 ký tự',

            'address.required' => 'Bạn cần phải nhập vào địa chỉ',
            'address.regex' => 'Địa chỉ của bạn không hợp lệ',

            'phone.required' => 'Số điện thoại của bạn không được bỏ trống',
            'phone.digits' => 'Số điện thoại phải có độ dài 10 số',
            'phone.numeric' => 'Số điện thoại phải là một số ',
            'phone.regex' => 'Số điện thoại không hợp lệ ',

        ]);
        $cart = Cart::content();
        foreach ($cart as $item)
        $totalCount = Cart::count();
        $totalPrice = Cart::total(0,",",""); // lấy tổng giá của sản phẩm
        // Kiểm tra tồn tại giỏ hàng cũ
        foreach($cart as $item){
            $products = Product::where(['id'=> $item->id])->get();
            foreach($products as $product){
                $product->pro_pay += 1;
                $product->stock -=  $item->qty;
                $product->save();
            }
        }
        try {

            // Lưu vào bảng đơn đặt hàng - orders
            $order = new Order();
            $order->fullname = $request->input('fullname');
            $order->phone = $request->input('phone');
            $order->email = $request->input('email');
            $order->address = $request->input('address');
            $order->address2 = $request->input('address2');
            $order->note = $request->input('note');
            $order->total = $totalPrice;
            $order->order_date =  Carbon::now()->toDateString();
            $order->order_status_id = 1; // 1 = mới
            if (Auth::guard('customer')->check()){
                $customer_id = Auth::guard('customer')->user()->id;
                $order->customer_id = $customer_id;
            }else
                $order->customer_id = 0; //khách vãng lai


            // Lưu vào bảng chỉ tiết đơn đặt hàng
            if ($order->save()) {
                $maDonHang = 'DH-'.$order->id.'-'.date('d').date('m').date('Y'); // Tạo mã đơn hàng
                $order->code = $maDonHang;
                $order->save();

                if (count($cart) >0) {
                    foreach ($cart as $key => $item) {
                        $_detail = new OrderDetail();
                        $_detail->name = $item->name;
                        $_detail->image = $item->options->image;
                        $_detail->price = $item->price;
                        $_detail->qty = $item->qty;
                        $_detail->order_id = $order->id;
                        $_detail->product_id = $item->id;
                        $_detail->order_date = Carbon::now()->toDateString();
                        $_detail->save();
                    }
                }
                // =========================== thống kê ===========================
                $orders = Order::all();
                $order_details = OrderDetail::all();
                $date = $order->order_date;
                $quantity = OrderDetail::where(['order_date'=>$date])->sum('qty');
                $statistic = Statistic::where(['order_date'=>$date])->get();
                if ($statistic->count()>0){
                    $statistic = Statistic::where(['order_date'=>$date])->first();
                    $total_order = Order::where(['order_date'=>$date])->count();
                    $sales = Order::where(['order_date'=>$date])->sum('total');
                    $statistic->total_order =  $total_order;
                    $statistic->sales =  $sales;
                    $statistic->quantity = $quantity;
                    foreach ($order_details as $order_detail){
                        $statistic->profit =  $sales - $order_detail->price *  $order_detail->qty;
                    }
                    $statistic->save();
                }else {
                    $statistic = new Statistic();
                    $statistic->order_date = $date;
                    $total_order = Order::where(['order_date'=>$date])->count();
                    $sales = Order::where(['order_date'=>$date])->sum('total');
                    $statistic->total_order = $total_order;
                    $statistic->sales = $sales;
                    $statistic->quantity = $quantity;
                    foreach ($order_details as  $order_detail){
                        $statistic->profit = $sales - $order_detail->price *  $order_detail->qty;
                    }
                    $statistic->save();
                }

                // =========================== thống kê ======================================

                // Xóa thông tin giỏ hàng Hiện tại sau khi đặt hàng thành công
                Cart::destroy();

                session(['totalItem' => 0]);

                return redirect()->route('shop.cart.completedOrder')->with('msg', 'Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn : #'.$order->code);
            }

        } catch (Exception $e) {
            return redirect()->route('shop.cart.completedOrder')->with('msg', 'Đã xảy ra lỗi, vui lòng thử lại');
        }

    }

    /**
     * Xóa sản phảm khỏi giỏ hàng
     * @param $id Product Id
     */
    public function removeToCart($rowId)
    {
        // xóa sản phẩm trong giỏ
        Cart::remove($rowId);

        $cart = Cart::content();
        $totalPrice = Cart::total(0,",",""); // lấy tổng giá của sản phẩm
        session(['totalItem' => Cart::count()]);

        return view('frontend.components.cart', [
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ
     */
    public function updateToCart(Request $request)
    {
        // check nhập số lượng không đúng định dạng
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric|alpha_num|digits_between:1,2|min:1'
        ]);

        // check số lượng lỗi
        if ($validator->fails()) {
            return false;
        }

        $rowId = $request->input('rowId');
        $qty = (int) $request->input('qty');

        // cập nhật lại số lương
        Cart::update($rowId, $qty);

        $cart = Cart::content();
        $totalPrice = Cart::total(0,",",""); // lấy tổng giá của sản phẩm


        return view('frontend.components.cart', [
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Form Hiển thị hoàn tất đơn đặt hàng
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function completedOrder()
    {
        return view('frontend.cart.completed');
    }
}
