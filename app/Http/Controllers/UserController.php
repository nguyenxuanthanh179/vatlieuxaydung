<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::all();
        $user = User::whereNotIn('role_id', [1])->get();
        return view('backend.user.index', [
            'admin' => $admin,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('id', [4])->get();
        $role_user = Role::whereNotIn('id', [1,4])->get();;  // lấy toàn bộ quyền
        return view('backend.user.create',[
            'roles'=>$roles,
            'role_user'=>$role_user
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
            'name' => 'required|min:3|max:50',
            'avatar' => 'required|image',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email|max:255',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên của bạn',
            'name.min' => 'Họ tên phải có dộ dài từ 3 đến 50 ký tự',
            'name.max' => 'Họ tên phải có độ dài từ 3 đến 50 ký tự',

            'avatar.required' => 'Bạn cần phải chọn ảnh đại diện',
            'avatar.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',

            'role_id.required' => 'Bạn cần phải chọn quyền cho tài khoản',

            'email.required' => 'Bạn cần phải nhập vào email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.max' => 'Email của bạn không được dài hơn 255 ký tự',

            'password.required' => 'Bạn cần phải nhập vào mật khẩu',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên',
        ]);
        //luu vào csdl
        $user = new User();
        $user->name = $request->input('name'); // họ tên
        $user->email = $request->input('email'); // email
        $user->password = bcrypt($request->input('password')); // mật khẩu
        $user->role_id = $request->input('role_id'); // phần quyền
        if ($request->hasFile('avatar')) {
            // get file
            $file = $request->file('avatar');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'upload/user/';
            // upload file
            $request->file('avatar')->move($path_upload,$filename);

            $user->avatar = $path_upload.$filename;
        }

        $is_active = 0;
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }

        $user->is_active = $is_active;
        $user->save();

        // chuyen dieu huong trang

        return redirect()->route('admin.user.index');
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
        $user = User::findOrFail($id);
        $roles = Role::whereNotIn('id', [4])->get();
        $role_user = Role::whereNotIn('id', [1,4])->get();;
        return view('backend.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'role_user' => $role_user
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
            'name' => 'required|min:3|max:50',
            'new_avatar' => 'image',
            'email' => [
                'required',
                'email',
                'regex:/(.+)@(.+)\.(.+)/i',
                'min:10',
                'max:50',
                Rule::unique('users')->ignore($id)
            ],
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên của bạn',
            'name.min' => 'Họ tên phải có dộ dài từ 3 đến 50 ký tự',
            'name.max' => 'Họ tên phải có độ dài từ 3 đến 50 ký tự',

            'new_avatar.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',

            'email.required' => 'Bạn cần phải nhập vào email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.min' => 'Email phải có độ dài từ 10 đến 50 ký tự',
            'email.max' => 'Email phải có độ dài từ 10 đến 50 ký tự',

        ]);

        $user = User::findorFail($id);
        $user->name = $request->input('name'); // họ tên
        $user->email = $request->input('email'); // email
        $user->role_id = $request->input('role_id'); // phần quyền
        // kiểm tra xem có nhập mật khẩu mới không ,, nếu có thì mới cập nhật
        if ($request->input('new_password')) {
            $user->password = bcrypt($request->input('new_password')); // mật khẩu mới
        }

        if ($request->hasFile('new_avatar')) {
            // xóa file cũ
            @unlink(public_path($user->avatar)); // hàm unlink của PHP không phải laravel , chúng ta thêm @ đằng trước tránh bị lỗi
            // get file
            $file = $request->file('new_avatar');
            // get ten
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'upload/user/';
            // upload file
            $file->move($path_upload,$filename);
            $user->avatar = $path_upload.$filename;
        }

        $is_active = 0;
        if ($request->has('is_active')) { // kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
        }
        $user->is_active = $is_active;
        $user->save();

        if ($user->role_id == 3){
            return redirect()->back()->with('msg', 'Cập nhật tài khoản thành công');
        }
        return redirect()->route('admin.user.index');
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
        $isDelete = User::destroy($id);

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
}
