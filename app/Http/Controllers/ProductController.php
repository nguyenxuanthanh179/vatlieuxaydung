<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();

        return view('backend.product.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $vendors = Vendor::all();
        $users = User::all();
        return view('backend.product.create' ,[
            'categories' => $categories,
            'vendors' => $vendors,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50|unique:products,name',
            'image' => 'required|image',
            'stock' => 'required|numeric|alpha_num',
            'price' => 'required|alpha_num|numeric',
            'sale' => 'required|alpha_num|numeric',
            'sku' => 'required|unique:products,sku',
            'summary' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'vendor_id' => 'required',
            'user_id' => 'required',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.min' => 'Tên sản phẩm phải có độ dài từ 3 đến 50 kí tự',
            'name.max' => 'Tên sản phẩm phải có độ dài từ 3 đến 50 kí tự',

            'image.required' => 'Bạn cần phải tải hình ảnh sản phẩm',
            'image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'stock.required' => 'Bạn cần phải nhập vào số lượng sản phẩm',
            'stock.numeric' => 'Số lượng sản phẩm phải là một số',
            'stock.alpha_num' => 'Số lượng sản phẩm phải là một số',

            'price.required' => 'Bạn cần phải nhập vào giá gốc bán sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là một số',
            'price.alpha_num' => 'Giá sản phẩm phải là một số',

            'sale.required' => 'Bạn cần phải nhập vào giá sale bán sản phẩm',
            'sale.numeric' => 'Giá sản phẩm phải là một số',
            'sale.alpha_num' => 'Giá sản phẩm phải là một số',

            'sku.required' => 'Bạn cần phải nhập vào mã sản phẩm',
            'sku.unique' => 'Mã sản phẩm đã tồn tại',

            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'category_id.required' => 'Bạn cần phải chọn danh mục sản phẩm',
            'vendor_id.required' => 'Bạn cần phải chọn nhà cung cấp',
            'summary.required' => 'Bạn cần phải nhập vào mô tả ngắn',
            'description.required' => 'Bạn cần phải nhập vào mô tả chi tiết',
        ]);

        $product = new Product(); // khởi tạo model
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));

        // Upload file
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // đặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); // $file->getClientOriginalName() == tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'upload/product/';
            // Thực hiện upload file
            $file->move($path_upload,$filename); // upload lên thư mục public/uploads/product

            $product->image = $path_upload.$filename;
        }

        $product->stock = $request->input('stock'); // số lượng
        $product->price = $request->input('price');
        $product->sale = $request->input('sale');
        $product->category_id = $request->input('category_id');
        $product->vendor_id = $request->input('vendor_id');
        $product->sku = $request->input('sku');

        $is_active = 0;// mặc định gán không hiển
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong ?
            $is_active = $request->input('is_active');
        }

        $product->is_active = $is_active;

        // Sản phẩm Hot
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $product->is_hot=$is_hot;
        $product->summary = $request->input('summary');
        $product->description = $request->input('description');
        $product->user_id = $request->input('user_id');

        $product->save();

        // chuyển hướng đến trang
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $vendors = Vendor::all();
        $users = User::all();
        return view('backend.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'vendors' => $vendors,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('products')->ignore($id)
            ],
            'new_image' => 'image',
            'stock' => 'required|numeric|alpha_num',
            'price' => 'required|alpha_num|numeric',
            'sale' => 'required|alpha_num|numeric',
            'sku' => [
                'required',
                Rule::unique('products')->ignore($id)
            ],
            'summary' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'vendor_id' => 'required',
            'user_id' => 'required',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.min' => 'Tên sản phẩm phải có độ dài từ 3 đến 50 ký tự',
            'name.max' => 'Tên sản phẩm phải có độ dài từ 3 đến 50 ký tự',

            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',

            'stock.required' => 'Bạn cần phải nhập vào số lượng sản phẩm',
            'stock.numeric' => 'Số lượng sản phẩm phải là một số',
            'stock.alpha_num' => 'Số lượng sản phẩm phải là một số',

            'price.required' => 'Bạn cần phải nhập vào giá gốc bán sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là một số',
            'price.alpha_num' => 'Giá sản phẩm phải là một số',

            'sale.required' => 'Bạn cần phải nhập vào giá sale bán sản phẩm',
            'sale.numeric' => 'Giá sản phẩm phải là một số',
            'sale.alpha_num' => 'Giá sản phẩm phải là một số',

            'sku.required' => 'Bạn cần phải nhập vào mã sản phẩm',
            'sku.unique' => 'Mã sản phẩm đã tồn tại',

            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'category_id.required' => 'Bạn cần phải chọn danh mục sản phẩm',
            'vendor_id.required' => 'Bạn cần phải chọn nhà cung cấp',
            'summary.required' => 'Bạn cần phải nhập vào mô tả ngắn',
            'description.required' => 'Bạn cần phải nhập vào mô tả chi tiết',
        ]);

        $product = Product::findorFail($id);; // khởi tạo model
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));

        // Thay đổi ảnh
        if ($request->hasFile('new_image')) {
            // xóa file cũ
            @unlink(public_path($product->image));
            // get file mới
            $file = $request->file('new_image');
            // get tên
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'upload/product/';
            // upload file
            $request->file('new_image')->move($path_upload,$filename);

            $product->image = $path_upload.$filename;
        }

        $product->stock = $request->input('stock'); // số lượng
        $product->price = $request->input('price');
        $product->sale = $request->input('sale');
        $product->category_id = $request->input('category_id');
        $product->vendor_id = $request->input('vendor_id');
        $product->sku = $request->input('sku');
        $product->user_id = $request->input('user_id');

        // Trạng thái
        $is_active = 0;
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }

        $product->is_active = $is_active;

        // Sản phẩm Hot
        $is_hot = 0 ;
        if ($request->has('is_hot')){
            $is_hot = $request->input('is_hot');
        }
        $product->is_hot=$is_hot;
        $product->summary = $request->input('summary');
        $product->description = $request->input('description');

        $product->save();

        // chuyển hướng đến trang
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // gọi tới hàm destroy của laravel để xóa 1 object
        // DELETE FROM ten_bang WHERE id = 33 -> execute command
        $isDelete = Product::destroy($id); // return 1 | 0, true  false

        if ($isDelete) { // xóa thành công
            $statusCode = 200;
            $isSuccess = true;
        } else {
            $statusCode = 400;
            $isSuccess = false;
        }

        // Trả về dữ liệu json và trạng thái kèm theo thành công là 200
        return response()->json(['isSuccess' => $isSuccess], $statusCode);
    }
    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $slug = str_slug($keyword);
        $products = Product::where([
            ['slug', 'like' , '%' .$slug . '%']
        ])->get();

        return view('backend.product.search',[
            'products'=>$products,
        ]);
    }
}
