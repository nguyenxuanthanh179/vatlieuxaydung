<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerController extends GeneralController
{
    public function index()
    {
        $customer = Customer::all();

        return view('backend.customer.index', [
            'customer' => $customer,
        ]);
    }
    public function destroy($id)
    {
        $isDelete = Customer::destroy($id);

        if ($isDelete) { // xóa thành công
            $statusCode = 200;
            $isSuccess = true;
        } else {
            $statusCode = 400;
            $isSuccess = false;
        }
        // Trả về dữ liệu json và trạng thái kèm theo thành công là 200
        return response()->json([
            'isSuccess' => $isSuccess
        ], $statusCode);
    }
    //=========== trang đăng ký - đăng nhập =============
    public function myAccount()
    {
        $orders = Order::all();
        $order_status = OrderStatus::all();
        $customer = User::all();
        return view('frontend.account.my-account',[
            'customer' => $customer,
            'orders' => $orders,
            'order_status' => $order_status
        ]);
    }
    public function postRegister( Request $request){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:customers,email|min:10|max:50',
            'password' => 'required|min:6',
            'phone' => 'required|numeric|unique:customers,phone|digits:10|regex:/(0)[0-9]/',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên của bạn',
            'name.min' => 'Họ tên phải lớn hơn 3 và nhỏ hơn 50 ký tự',
            'name.max' => 'Họ tên phải lớn hơn 3 và nhỏ hơn 50 ký tự',

            'email.required' => 'Bạn cần phải nhập vào email',
            'email.unique' => 'Email đã được đăng ký',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.min' => 'Email phải có độ dài từ 10 đến 50 ký tự',
            'email.max' => 'Email phải có độ dài từ 10 đến 50 ký tự',

            'password.required' => 'Bạn cần phải nhập vào mật khẩu',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên',

            'address.required' => 'Bạn cần phải nhập vào địa chỉ',
            'address.regex' => 'Địa chỉ của bạn không hợp lệ',

            'phone.required' => 'Số điện thoại của bạn không được bỏ trống',
            'phone.unique' => 'Số điện thoại đã được đăng ký',
            'phone.digits' => 'Số điện thoại phải có độ dài 10 số',
            'phone.numeric' => 'Số điện thoại phải là một số ',
            'phone.regex' => 'Số điện thoại không hợp lệ ',
        ]);

        $customer = Customer::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'phone' => request('phone'),
            'address' => request('address'),
            'role_id' => '4',
        ]);

        Auth::guard('customer')->login($customer, 'remember');
        return redirect()->route('shop.index');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email-login' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|min:10|max:100',
            'password-login' => 'required|min:6',
        ],[
            'email-login.required' => 'Bạn cần phải nhập vào email',
            'email-login.email' => 'Email không đúng định dạng',
            'email-login.regex' => 'Email của bạn không hợp lệ',
            'email-login.min' => 'Email phải có độ dài từ 10 đến 100 ký tự',
            'email-login.max' => 'Email phải có độ dài từ 10 đến 100 ký tự',

            'password-login.required' => 'Bạn cần phải nhập vào mật khẩu',
            'password-login.min' => 'Mật khẩu phải từ 6 ký tự trở lên',
        ]); // validate false => tạo ra biến $errors để toàn thông tin bị lỗi cho từng trường

        $customer = [
            'email' => request('email-login'),
            'password' => request('password-login'),
        ];

        //kiểm tra trường remember có được chọn hay không
        if (Auth::guard('customer')->attempt($customer, $request->has('remember'))) {
            return redirect()->route('shop.myAccount');
        } else {
            return redirect()->back()->with('msg', 'Email hoặc Password không chính xác');
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('shop.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'email' => [
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                'min:10',
                'max:100',
                Rule::unique('customers')->ignore($id)
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('customers')->ignore($id)
            ],
            'birthday' => 'required|before:today',
            'avatar' => 'image'
        ],[

        ]);

        $customer = Customer::findorFail($id);
        $customer->name = $request->input('name'); // họ tên
        $customer->email = $request->input('email'); // email
        $customer->phone = $request->input('phone'); // email
        $customer->address = $request->input('address'); // address

        if ($request->hasFile('avatar')) {
            // get file
            $file = $request->file('avatar');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'upload/customer/';
            // upload file
            $request->file('avatar')->move($path_upload,$filename);

            $customer->avatar = $path_upload.$filename;
        }
        $customer->birthday = $request->input('birthday');
        $customer->gender = $request->input('gender');

        $customer->save();

        // chuyen dieu huong trang
        return redirect()->back()->with('msg', 'Cập nhật tài khoản thành công');
    }
    public function reset(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'min:6',
        ],[
            'new_password.min' => 'Mật khẩu phải từ 6 ký tự trở lên',
        ]);
        $customer = Customer::findorFail($id);
        // kiểm tra xem có nhập mật khẩu mới không ,, nếu có thì mới cập nhật
        if ($request->input('new_password')) {
            $customer->password = bcrypt($request->input('new_password')); // mật khẩu mới
        }
        $customer->save();

        // chuyen dieu huong trang
        return redirect()->back()->with('msg', 'Đổi mật khẩu thành công');
    }
    public function orderDetails($id)
    {
        $order = Order::find($id);
        return view('frontend.account.my-order', [
            'order' => $order,
        ]);
    }

}
