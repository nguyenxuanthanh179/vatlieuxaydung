<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('backend.category.index',['data'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 1. lấy toàn bộ dữ danh mục
        $categories = Category::all();
        $users = User::all();
        return view('backend.category.create',[
            'data' => $categories,
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
        $request->validate([
            'name' => 'required|min:3|max:100|unique:categories,name',
            'image' => 'required|image',
            'user_id' => 'required',
        ],[
            'name.required' => 'Tên danh mục không được bỏ trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'name.min' => 'Tên danh mục phải có độ dài từ 3 đến 100 kí tự',
            'name.max' => 'Tên danh mục phải có độ dài từ 3 đến 100 kí tự',
            'image.required' => 'Hình ảnh không được bỏ trống',
            'image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
        ]);
        //luu vào csdl
        $category = new Category;
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->parent_id = $request->input('parent_id');
        $category->user_id = $request->input('user_id');
        if ($request->hasFile('image')) {
            // get file
            $file = $request->file('image');
            // get ten
            $filename = time() . '_' . $file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'upload/category/';
            // upload file
            $request->file('image')->move($path_upload, $filename);

            $category->image = $path_upload . $filename;
        }
        $is_active = 0;
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $category->is_active = $is_active;

        $category->save();

        // chuyen dieu huong trang
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findorFail($id);
        return view('backend.category.show', ['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $data = Category::all();
        $category = Category::findorFail($id);
        return view('backend.category.edit',[
            'data'=>$category,
            'category'=>$data,
            'users'=>$users
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('categories')->ignore($id)
            ],
            'new_image' => 'image',
            'user_id' => 'required',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên danh mục',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'name.min' => 'Tên danh mục phải có độ dài từ 3 đến 100 kí tự',
            'name.max' => 'Tên danh mục phải có độ dài từ 3 đến 100 kí tự',
            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
        ]);
        $category = Category::findorFail($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->parent_id = $request->input('parent_id');
        $category->user_id  = $request->input('user_id');

        if ($request->hasFile('new_image')) {
            // xóa file cũ
            @unlink(public_path($category->image));
            // get file mới
            $file = $request->file('new_image');
            // get tên
            $filename = time() . '_' . $file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'upload/category/';
            // upload file
            $request->file('new_image')->move($path_upload, $filename);

            $category->image = $path_upload . $filename;
        }
        $is_active = 0;
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $category->is_active = $is_active;

        $category->save();

        // chuyen dieu huong trang
        return redirect()->route('admin.category.index');
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
        $isDelete = Category::destroy($id);

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
