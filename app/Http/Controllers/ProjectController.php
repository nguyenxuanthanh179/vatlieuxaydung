<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        return view('backend.project.index', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('backend.project.create',[
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
        $request->validate([
            'title' => 'required|min:20|max:255|unique:projects,title',
            'image' => 'required|image',
            'user_id' => 'required',
            'summary' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.min' => 'Tên tiêu đề phải có độ dài từ 20 đến 255 kí tự',
            'title.max' => 'Tên tiêu đề phải có độ dài từ 20 đến 255 kí tự',
            'image.required' => 'Hình ảnh không được bỏ trống',
            'image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'summary.required' => 'Bạn cần phải nhập vào mô tả vắn tắt',
            'description.required' => 'Bạn cần phải nhập vào mô tả chi tiết',
        ]);
        $project = new Project();
        $project->title = $request->input('title');
        $project->slug = Str::slug($request->input('title')); //slug
        $project->user_id = $request->input('user_id');

        if ($request->hasFile('image')) { // kiểm tra xem có image có đc chọn ko
            // get file
            $file = $request->file('image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/project/'; // uploads/brands
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $project->image = $path_upload.$filename;
        }
        //Loại
        $is_new = 0;
        if ($request->has('is_new')){
            $is_new = $request->input('is_new');
        }
        //Loại
        $project->is_new = $is_new;

        //trạng thái
        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        //trạng thái
        $project->is_active = $is_active;

        //mô tả ngắn
        $project->summary = $request->input('summary');

        //mô tả
        $project->description = $request->input('description');


        //lưu
        $project->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.project.index');
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
        $project = Project::findorFail($id);
        return view('backend.project.edit', [
            'project' => $project,
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
            'title' => [
                'required',
                'min:20',
                'max:255',
                Rule::unique('projects')->ignore($id)
            ],
            'user_id' => 'required',
            'new_image' => 'image',
            'summary' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Bạn cần phải nhập vào tên tiêu đề',
            'title.min' => 'Tên tiêu đề phải có độ dài từ 20 đến 255 kí tự',
            'title.max' => 'Tên tiêu đề phải có độ dài từ 20 đến 255 kí tự',
            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'summary.required' => 'Bạn cần phải nhập vào mô tả vắn tắt',
            'description.required' => 'Bạn cần phải nhập vào mô tả chi tiết',
        ]);

        $project = Project::findorFail($id);
        $project->title = $request->input('title');
        $project->slug = Str::slug($request->input('title')); //slug
        $project->user_id = $request->input('user_id');

        if ($request->hasFile('new_image')) { // kiểm tra xem có image có đc chọn ko
            //xóa file cũ
            @unlink(public_path($project->image)); // hàm unlink của php không phải của laravel, chúng ta thêm @ đằng trước để tránh bị lỗi
            //get new_image
            $file = $request->file('new_image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/project/'; // uploads/brands
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $project->image = $path_upload.$filename;
        }

        //Loại
        $is_new = 0;
        if ($request->has('is_new')){
            $is_new = $request->input('is_new');
        }
        //Loại
        $project->is_new = $is_new;

        //trạng thái

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        //trạng thái
        $project->is_active = $is_active;

        //mô tả ngắn
        $project->summary = $request->input('summary');

        //mô tả
        $project->description = $request->input('description');

        //lưu
        $project->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.project.index');
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
        $isDelete = Project::destroy($id);

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
