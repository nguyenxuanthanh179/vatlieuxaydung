<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $setting = Setting::first();
        return view('backend.setting.index', [
            'setting' => $setting,
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
        // 1. step 1 validate
        $request->validate([
            'company' => 'required|min:10|max:50',
            'new_image' => 'image',
            'website' => 'required|url',
            'facebook' => 'required|url',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|min:10|max:50',
            'phone' => 'required|numeric|digits:10',
            'hotline' => 'required|numeric|digits_between:8,11',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
        ],[
            'company.required' => 'Bạn cần phải nhập vào tên công ty',
            'company.min' => 'Tên công ty phải có độ dài từ 10 đến 50 ký tự',
            'company.max' => 'Tên công ty phải có độ dài từ 10 đến 50 ký tự',

            'new_image.image' => 'File ảnh phải có dạng jpeg,png,jpg,gif,svg',

            'website.required' => 'Bạn cần phải nhập vào địa chỉ webiste',
            'website.url' => 'Địa chỉ webiste không đúng định dạng',

            'facebook.required' => 'Bạn cần phải nhập vào địa chỉ facebook',
            'facebook.url' => 'Địa chỉ facebook không đúng định dạng',

            'email.required' => 'Bạn cần phải nhập vào địa chỉ email',
            'email.email' => 'Dữ liệu nhập phải là một email',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.min' => 'Email phải có độ dài từ 10 đến 50 ký tự',
            'email.max' => 'Email phải có độ dài từ 10 đến 50 ký tự',

            'hotline.required' => 'Bạn cần phải nhập vào hotline',
            'hotline.numeric' => 'Số Hotline phải là một số',
            'hotline.digits_between' => 'Số Hotline phải có dộ dài từ 8 đến 11 số',

            'phone.required' => 'Số điện thoại của bạn không được bỏ trống',
            'phone.numeric' => 'Số điện thoại phải là một số ',
            'phone.digits' => 'Số điện thoại phải có độ dài 10 số ',

            'address.required' => 'Bạn cần phải nhập vào địa chỉ công ty',
            'address.regex' => 'Địa chỉ của bạn không hợp lệ',
        ]);
        // 2. update dữ liệu
        $setting = Setting::findorFail($id);
        $setting->company = $request->input('company');
        $setting->phone = $request->input('phone');
        $setting->hotline = $request->input('hotline');
        $setting->address = $request->input('address');
        $setting->facebook = $request->input('facebook');
        $setting->website = $request->input('website');
        $setting->email = $request->input('email');
        $setting->user_id = $request->input('user_id');
        if ($request->hasFile('new_image')) {
            // xóa file cũ
            // @unlink(public_path($setting->image));
            // get file mới
            $file = $request->file('new_image');
            // đặt tên cho file
            $filename = time().'_'.$file->getClientOriginalName();
            // duong dan upload
            $path_upload = 'upload/setting/';
            // upload file
            $file->move($path_upload,$filename);

            $setting->image = $path_upload.$filename;
        }

        $setting->save();

        // chuyen dieu huong trang
        return redirect()->route('admin.setting.index');
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
