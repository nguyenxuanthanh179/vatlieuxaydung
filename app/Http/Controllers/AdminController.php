<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Trang đăng nhập
    public function login()
    {
        return view('backend.login.index');
    }

    public function postLogin(Request $request)
    {
        //validate dữ liệu
        $request->validate([
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|min:10|max:50',
            'password' => 'required|string|min:6'
        ],[
            'email.required' => 'Bạn cần phải nhập vào email',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.min' => 'Email phải có độ dài từ 10 đến 50 ký tự',
            'email.max' => 'Email phải có độ dài từ 10 đến 50 ký tự',

            'password.required' => 'Bạn cần phải nhập vào mật khẩu',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên',
        ]);

        // validate thành công

        $dataLogin = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $checkLogin = Auth::attempt($dataLogin, $request->has('remember'));

        // kiểm tra xem có đăng nhập thành côngh với email và password đã nhập hay không
        if ($checkLogin && Auth::check() && ( Auth::user()->role_id == 1 || Auth::user()->role_id == 2)) {
            return redirect()->route('admin.dashboard.index');
        }
        if ($checkLogin && Auth::check() && Auth::user()->role_id == 3) {
            return redirect()->route('admin.product.index');
        }
        return redirect()->back()->with('msg', 'Email hoặc Password không chính xác');
    }
    public function logout()
    {
        //đăng xuất
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
