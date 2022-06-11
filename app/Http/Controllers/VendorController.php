<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vendor::all();

        return view('backend.vendor.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('backend.vendor.create',[
            'users'=>$users
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
        //step 1: validate dữ liệu
        $request->validate([
            'name' => 'required|min:3|max:50|unique:vendors,name',
            'image' => 'required|image',
            'user_id' => 'required',
            'website' => 'required|url',
            'facebook' => 'required|url',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:vendors,email|max:255',
            'hotline' => 'required|numeric|digits_between:8,11',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên nhà cung cấp',
            'name.unique' => 'Tên nhà cung cấp đã tồn tại',
            'name.min' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 50 kí tự',
            'name.max' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 50 kí tự',

            'image.required' => 'Bạn cần phải chọn hình ảnh',
            'image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',

            'user_id.required' => 'Bạn cần phải chọn tác giả',

            'website.required' => 'Bạn cần phải nhập vào link webiste',
            'website.url' => 'link webiste không đúng định dạng',

            'facebook.required' => 'Bạn cần phải nhập vào link facebook',
            'facebook.url' => 'link facebook không đúng định dạng',

            'email.required' => 'Bạn cần phải nhập vào email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.max' => 'Email của bạn không được dài hơn 255 ký tự',

            'hotline.required' => 'Bạn cần phải nhập vào hotline',
            'hotline.numeric' => 'Hotline phải là một số ',
            'hotline.digits_between' => 'Hotline phải có độ dài từ 8 đến 11 số ',

            'address.required' => 'Bạn cần phải nhập vào địa chỉ',
            'address.regex' => 'Địa chỉ của bạn không hợp lệ',
        ]);
        //step 2: khởi tạo Model và gán giá trị từ form cho những thuộc tính của dối tượng ( cột trong CSDL )

        $vendor = new Vendor();
        $vendor->name = $request->input('name');
        $vendor->slug = Str::slug($request->input('name')); //slug
        $vendor->email= $request->input('email');
        $vendor->hotline = $request->input('hotline');
        if ($request->hasFile('image')) { // kiểm tra xem có image có đc chọn ko
            // get file
            $file = $request->file('image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/vendor/'; // uploads/brands
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $vendor->image = $path_upload.$filename;
        }

        $vendor->website = $request->input('website');
        $vendor->facebook = $request->input('facebook');
        $vendor->address = $request->input('address');
        $vendor->user_id = $request->input('user_id');

        //trạng thái

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');
        }
        //trạng thái
        $vendor->is_active = $is_active;
        //lưu
        $vendor->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.vendor.index');
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
        $users = User::all();
        $vendor = vendor::findorFail($id);
        return view('backend.vendor.edit', [
            'data' => $vendor,
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
            'name' => 'required|min:10|max:100',
            'new_image' => 'image',
            'user_id' => 'required',
            'website' => [
                'required',
                'url',
                Rule::unique('vendors')->ignore($id)
            ],
            'facebook' => [
                'required',
                'url',
                Rule::unique('vendors')->ignore($id)
            ],
            'email' => [
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                'min:10',
                'max:50',
                Rule::unique('vendors')->ignore($id)
            ],
            'hotline' => [
                'required',
                'numeric',
                'digits_between:8,11',
                Rule::unique('vendors')->ignore($id)
            ],
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên nhà cung cấp',
            'name.min' => 'Tên nhà cung cấp phải có dộ dài từ 10 đến 100 ký tự',
            'name.max' => 'Tên nhà cung cấp phải có dộ dài từ 10 đến 100 ký tự',

            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',

            'user_id.required' => 'Bạn cần phải chọn tác giả',

            'website.required' => 'Bạn cần phải nhập vào link webiste',
            'website.url' => 'link webiste không đúng định dạng',
            'website.unique' => 'link webiste đã tồn tại',

            'facebook.required' => 'Bạn cần phải nhập vào link facebook',
            'facebook.url' => 'link facebook không đúng định dạng',
            'facebook.unique' => 'link facebook đã tồn tại',

            'email.required' => 'Bạn cần phải nhập vào email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.min' => 'Email phải có dộ dài từ 10 đến 50 ký tự',
            'email.max' => 'Email phải có dộ dài từ 10 đến 50 ký tự',

            'hotline.required' => 'Bạn cần phải nhập vào số hotline',
            'hotline.unique' => 'Số hotline đã tồn tại',
            'hotline.numeric' => 'Số Hotline phải là một số',
            'hotline.digits_between' => 'Số Hotline phải có dộ dài từ 8 đến 11 số',

            'address.required' => 'Bạn cần phải nhập vào địa chỉ',
            'address.regex' => 'Địa chỉ của bạn không hợp lệ',
        ]);


        $vendor = vendor::findorFail($id);
        $vendor->name = $request->input('name');
        $vendor->slug = Str::slug($request->input('name')); //slug
        $vendor->email= $request->input('email');
        $vendor->hotline = $request->input('hotline');

        if ($request->hasFile('new_image')) { // kiểm tra xem có image có đc chọn ko
            //xóa file cũ
            @unlink(public_path($vendor->image)); // hàm unlink của php không phải của laravel, chúng ta thêm @ đằng trước để tránh bị lỗi
            //get new_image
            $file = $request->file('new_image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/vendor/'; // uploads/brands
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $vendor->image = $path_upload.$filename;
        }
        $vendor->website = $request->input('website');
        $vendor->facebook = $request->input('facebook');
        $vendor->user_id = $request->input('user_id');
        $vendor->address = $request->input('address');


        //trạng thái

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        //trạng thái
        $vendor->is_active = $is_active;

        //lưu
        $vendor->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.vendor.index');
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
        $isDelete = Vendor::destroy($id);

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
}
