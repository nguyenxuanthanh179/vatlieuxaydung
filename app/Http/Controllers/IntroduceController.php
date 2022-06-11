<?php

namespace App\Http\Controllers;

use App\Models\Introduce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IntroduceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $introduce = Introduce::first();
        $users = User::all();
        return view('backend.introduce.index', [
            'introduce' => $introduce,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
            'title' => 'required|min:3|max:100',
            'new_image' => 'image',
            'user_id' => 'required',
            'summary' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.max' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 kí tự',
            'title.min' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 kí tự',
            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'summary.required' => 'Bạn cần phải nhập vào mô tả vắn tắt',
            'description.required' => 'Bạn cần phải nhập vào mô tả chi tiết',
        ]);

        $introduce = Introduce::findorFail($id);
        $introduce->title = $request->input('title');
        $introduce->slug = Str::slug($request->input('title')); //slug
        $introduce->user_id = $request->input('user_id');
        if ($request->hasFile('new_image')) { // kiểm tra xem có image có đc chọn ko
            //xóa file cũ
            @unlink(public_path($introduce->image)); // hàm unlink của php không phải của laravel, chúng ta thêm @ đằng trước để tránh bị lỗi
            //get new_image
            $file = $request->file('new_image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/introduce/';
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $introduce->image = $path_upload.$filename;
        }
        //mô tả ngắn
        $introduce->summary = $request->input('summary');

        //trạng thái

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        //trạng thái
        $introduce->is_active = $is_active;

        //mô tả
        $introduce->description = $request->input('description');

        //lưu
        $introduce->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.introduce.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
