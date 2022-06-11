<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::all();

        return view('backend.article.index', [
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
        $users = User::all();

        return view('backend.article.create',[
            'users'=>$users
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
            'title' => 'required|min:20|max:255|unique:articles,title',
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

        $article = new Article();
        $article->title = $request->input('title');
        $article->slug = Str::slug($request->input('title')); //slug
        $article->user_id = $request->input('user_id');

        if ($request->hasFile('image')) { // kiểm tra xem có image có đc chọn ko
            // get file
            $file = $request->file('image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/article/'; // upload/article
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $article->image = $path_upload.$filename;
        }

        $is_new = 0;
        if ($request->has('is_new')){
            $is_new = $request->input('is_new');
        }
        $article->is_new = $is_new;

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        $article->is_active = $is_active;

        $article->summary = $request->input('summary');
        $article->description = $request->input('description');

        $article->save();

        return redirect()->route('admin.article.index');
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
        $article = Article::findorFail($id);

        return view('backend.article.edit', [
            'data' => $article,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => [
                'required',
                'min:20',
                'max:255',
                Rule::unique('articles')->ignore($id)
            ],
            'user_id' => 'required',
            'new_image' => 'image',
            'summary' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Bạn cần phải nhập vào tên tiêu đề',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.min' => 'Tên tiêu đề phải có độ dài từ 20 đến 255 kí tự',
            'title.max' => 'Tên tiêu đề phải có độ dài từ 20 đến 255 kí tự',
            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',
            'user_id.required' => 'Bạn cần phải chọn tác giả',
            'summary.required' => 'Bạn cần phải nhập vào mô tả ngắnt',
            'description.required' => 'Bạn cần phải nhập vào mô tả chi tiết',
        ]);

        $article = Article::findorFail($id);
        $article->title = $request->input('title');
        $article->slug = Str::slug($request->input('title'));
        $article->user_id = $request->input('user_id');

        if ($request->hasFile('new_image')) { // kiểm tra xem có image có đc chọn ko
            //xóa file cũ
            @unlink(public_path($article->image)); // hàm unlink của php không phải của laravel, chúng ta thêm @ đằng trước để tránh bị lỗi
            //get new_image
            $file = $request->file('new_image');
            // dặt tên cho file image
            $filename = time().'_'.$file->getClientOriginalName(); //tên ban đầu của file
            // Định nghĩa đường dẫn file upload lên
            $path_upload = 'upload/article/'; // upload/article
            // thực hiện upload file
            $file->move($path_upload,$filename);
            // lưu lại cái tên
            $article->image = $path_upload.$filename;
        }
        $is_new = 0;
        if ($request->has('is_new')){
            $is_new = $request->input('is_new');
        }
        $article->is_new = $is_new;

        $is_active = 0;
        if ($request->has('is_active')){ // kiểm tra is_active có tồn tại không?
            $is_active = $request->input('is_active');

        }
        $article->is_active = $is_active;

        //mô tả
        $article->description = $request->input('description');

        //mô tả ngắn
        $article->summary = $request->input('summary');

        //lưu
        $article->save();

        //chuyển hướng trang về trang danh sách
        return redirect()->route('admin.article.index');
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
        $isDelete = Article::destroy($id);

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
