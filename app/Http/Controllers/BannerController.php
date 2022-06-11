<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\str;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Banner::all();
        return view('backend.banner.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('backend.banner.create',[
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //step 1: validate dữ liệu
        $request->validate([
            'title' => 'required|min:3|max:100|unique:banners,title',
            'image' => 'required|image',
            'user_id' => 'required',
            'type' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.min' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 kí tự',
            'title.max' => 'Tên tiêu đề phải có độ dài từ 20 đến 100 kí tự',
            'image.required' => 'Hình ảnh không được bỏ trống',
            'image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'type.required' => 'Bạn cần phải chọn loại quảng cáo',
            'description.required' => 'Bạn cần phải nhập vào mô tả',
        ]);
        //step 2: khởi tạo Model và gán giá trị từ form cho những thuộc tính của dối tượng ( cột trong CSDL )

        $banner = new Banner();
        $banner->title = $request->input('title');
        $banner->slug = Str::slug($request->input('title')); //slug
        $banner->user_id = $request->input('user_id');

        if ($request->hasFile('image')) { // kiểm tra xem có image có đc chọn ko
            // get file
            $file = $request->file('image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/banner/'; // uploads/brands
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $banner->image = $path_upload.$filename;
        }

        //loại
        $banner->type = $request->input('type');
        //trạng thái

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        //trạng thái
        $banner->is_active = $is_active;


        //mô tả
        $banner->description = $request->input('description');

        //lưu
        $banner->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.banner.index');
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
        $banner = Banner::findorFail($id);
        $users = User::all();
        return view('backend.banner.edit', [
            'data' => $banner,
            'users'=>$users
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
            'title' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('banners')->ignore($id)
            ],
            'user_id' => 'required',
            'new_image' => 'image',
            'type' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Bạn cần phải nhập vào tên tiêu đề',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.min' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 kí tự',
            'title.max' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 kí tự',
            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'description.required' => 'Bạn cần phải nhập vào mô tả chi tiết',
        ]);

        $banner = Banner::findorFail($id);
        $banner->title = $request->input('title');
        $banner->slug = Str::slug($request->input('title')); //slug
        $banner->user_id = $request->input('user_id');
        if ($request->hasFile('new_image')) { // kiểm tra xem có image có đc chọn ko
           //xóa file cũ
            @unlink(public_path($banner->image)); // hàm unlink của php không phải của laravel, chúng ta thêm @ đằng trước để tránh bị lỗi
            //get new_image
            $file = $request->file('new_image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/banner/'; // uploads/brands
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $banner->image = $path_upload.$filename;
        }

        //loại
        $banner->type = $request->input('type');
        //trạng thái

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        //trạng thái
        $banner->is_active = $is_active;


        //mô tả
        $banner->description = $request->input('description');

        //lưu
        $banner->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.banner.index');
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
        $isDelete = Banner::destroy($id);

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
