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
            'company.required' => 'B???n c???n ph???i nh???p v??o t??n c??ng ty',
            'company.min' => 'T??n c??ng ty ph???i c?? ????? d??i t??? 10 ?????n 50 k?? t???',
            'company.max' => 'T??n c??ng ty ph???i c?? ????? d??i t??? 10 ?????n 50 k?? t???',

            'new_image.image' => 'File ???nh ph???i c?? d???ng jpeg,png,jpg,gif,svg',

            'website.required' => 'B???n c???n ph???i nh???p v??o ?????a ch??? webiste',
            'website.url' => '?????a ch??? webiste kh??ng ????ng ?????nh d???ng',

            'facebook.required' => 'B???n c???n ph???i nh???p v??o ?????a ch??? facebook',
            'facebook.url' => '?????a ch??? facebook kh??ng ????ng ?????nh d???ng',

            'email.required' => 'B???n c???n ph???i nh???p v??o ?????a ch??? email',
            'email.email' => 'D??? li???u nh???p ph???i l?? m???t email',
            'email.regex' => 'Email c???a b???n kh??ng h???p l???',
            'email.min' => 'Email ph???i c?? ????? d??i t??? 10 ?????n 50 k?? t???',
            'email.max' => 'Email ph???i c?? ????? d??i t??? 10 ?????n 50 k?? t???',

            'hotline.required' => 'B???n c???n ph???i nh???p v??o hotline',
            'hotline.numeric' => 'S??? Hotline ph???i l?? m???t s???',
            'hotline.digits_between' => 'S??? Hotline ph???i c?? d??? d??i t??? 8 ?????n 11 s???',

            'phone.required' => 'S??? ??i???n tho???i c???a b???n kh??ng ???????c b??? tr???ng',
            'phone.numeric' => 'S??? ??i???n tho???i ph???i l?? m???t s??? ',
            'phone.digits' => 'S??? ??i???n tho???i ph???i c?? ????? d??i 10 s??? ',

            'address.required' => 'B???n c???n ph???i nh???p v??o ?????a ch??? c??ng ty',
            'address.regex' => '?????a ch??? c???a b???n kh??ng h???p l???',
        ]);
        // 2. update d??? li???u
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
            // x??a file c??
            // @unlink(public_path($setting->image));
            // get file m???i
            $file = $request->file('new_image');
            // ?????t t??n cho file
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
