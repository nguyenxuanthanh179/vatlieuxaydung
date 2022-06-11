@extends('frontend.layouts.main')
@section('my-account')
    @if(Auth::guard('customer')->check())
    <main class="main">
       <div class="container pt-lg-5 mobile__account">
           <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                   <div class="d-lg-flex sidebar__account p-2 align-items-center">
                       <div class="col-lg-3 p-0">
                           @if(Auth::guard('customer')->user()->avatar)
                               <img style="border-radius: 50% " class="w-100" src="{{ asset(Auth::guard('customer')->user()->avatar)}}" alt="">
                           @else
                           <i style="font-size: 2.2em; color: #ddd; padding-left: 10px"  class="fa-solid fa-circle-user"></i>
                           @endif
                       </div>
                       <div class="pl-lg-2">
                           <p style="font-weight: bold; padding-bottom: 8px">{{Auth::guard('customer')->user()->name}}</p>
                           <p style="font-size: 13px; color: #3f3c3c">{{Auth::guard('customer')->user()->email}}</p>
                       </div>
                   </div>
                   <div class="sidebar__account mt-lg-2 p-3 pb-lg-5">
                       <ul class="tab tab__account ">
                           <li>
                               <a class="active" href="#account-details">
                                   <i class="fa-solid fa-user-large"></i>
                                   Hồ sơ của tôi
                               </a>
                           </li>
                           <li>
                               <a href="#orders">
                                   <i class="fa-solid fa-file-lines"></i>
                                   Đơn hàng của tôi
                               </a>
                           </li>
                           <li>
                               <a href="#password">
                                   <i class="fa-solid fa-lock"></i>
                                   Đổi mật khẩu
                               </a>
                           </li>
                           <li><a  href="{{ route('shop.logout') }}">
                                   <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                   Đăng xuất</a>
                           </li>
                       </ul>
                   </div>
               </div>
               <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                   <div class="tab-content dashboard-content">
                       <div id="account-details" class="tab-item">
                           <h3>Hồ sơ của tôi
                               @if (session('msg'))
                                   <span style="color: #6b9c1f; font-size: 14px; text-transform: none; margin-bottom: 20px">{{ session('msg') }}</span>
                               @endif
                           </h3>
                           <div class="login-form">
                               <form role="form" action="{{route('customer.update',['id' => Auth::guard('customer')->user()->id])}}" method="post" enctype="multipart/form-data">
                                   @csrf
                                   @method('PUT')
                                   <div class="form-group row">
                                       <label for="name" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Họ và tên</label>
                                       <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                           <input value="{{ Auth::guard('customer')->user()->name }}" type="text" class="form-control" name="name" id="name" required>
                                       </div>
                                   </div>
                                   @if ( $errors->has('name') )
                                       <span style="color:red;display: block; margin: -10px 0px 0px; text-align: center">{{ $errors->first('name') }}</span>
                                   @endif
                                   <div class="form-group row">
                                       <label for="avatar" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Avatar</label>
                                       <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                           <input type="file" name="avatar" id="avatar" ><br>
                                           <img src="{{ asset(Auth::guard('customer')->user()->avatar)}}" class="pt-lg-2" width="100px">
                                       </div>
                                   </div>
                                   @if ( $errors->has('avatar') )
                                       <span style="color:red;display: block; margin: -10px 0px 0px; text-align: center">{{ $errors->first('avatar') }}</span>
                                   @endif
                                   <div class="form-group row">
                                       <label for="phone" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
                                       <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                           <input value="{{ Auth::guard('customer')->user()->phone }}"type="text" class="form-control" name="phone" id="phone" required>
                                       </div>
                                   </div>
                                   @if ( $errors->has('phone') )
                                       <span style="color:red;display: block; margin: -10px 0px 0px; text-align: center">{{ $errors->first('phone') }}</span>
                                   @endif
                                   <div class="form-group row">
                                       <label for="email" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Email</label>
                                       <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                           <input value="{{ Auth::guard('customer')->user()->email }}" type="text" class="form-control" placeholder="Nhập email" name="email" id="email" required>
                                       </div>
                                   </div>
                                   @if ( $errors->has('email') )
                                       <span style="color:red;display: block; margin: -10px 0px 0px; text-align: center">{{ $errors->first('email') }}</span>
                                   @endif
                                   <div class="form-group row">
                                       <label for="address" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Địa chỉ</label>
                                       <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                           <input value="{{ Auth::guard('customer')->user()->address }}" type="text" class="form-control" name="address" id="address" required>
                                       </div>
                                   </div>
                                   @if ( $errors->has('address') )
                                       <span style="color:red;display: block; margin: -10px 0px 0px; text-align: center">{{ $errors->first('address') }}</span>
                                   @endif
                                   <div class="form-group row">
                                       <label for="gender" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Giới tính</label>
                                       <div class="col-12 col-sm-12 col-md-8 col-lg-9 col-form-label">
                                           <input checked {{ (Auth::guard('customer')->user()->gender == 1) ? 'checked' : '' }} value="1" type="radio"  name="gender" id="male">
                                           <label class="pr-lg-3" for="male">Nam</label>
                                           <input {{ (Auth::guard('customer')->user()->gender == 2) ? 'checked' : '' }} value="0" type="radio"  name="gender" id="female">
                                           <label for="female">Nữ</label>
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <label for="birthday" class="col-12 col-sm-12 col-md-4 col-lg-3 col-form-label">Ngày sinh</label>
                                       <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                           <input value="{{ Auth::guard('customer')->user()->birthday }}" type="date" class="form-control" name="birthday" id="birthday">
                                       </div>
                                   </div>
                                   @if ( $errors->has('birthday') )
                                       <span style="color:red;display: block; margin: -10px 0px 0px; text-align: center">{{ $errors->first('birthday') }}</span>
                                   @endif
                                   <div class="text-right">
                                       <button type="submit" class="btn">Cập nhật</button>
                                   </div>
                               </form>
                           </div>
                       </div>
                       <div id="orders" class="tab-item">
                           <h3>Đơn hàng của tôi</h3>
                           <div class="table-responsive">
                               <table class="table">
                                   <thead style="background: #d6efd5">
                                       <tr>
{{--                                           <th class="text-center">STT</th>--}}
                                           <th class="text-center" >Mã đơn hàng</th>
                                           <th class="text-center">Ngày đặt hàng</th>
                                           <th class="text-center">Trạng thái</th>
                                           <th class="text-center">Tổng tiền</th>
                                           <th class="text-center">Hành động</th>
                                       </tr>
                                   </thead>
                                   <tbody>

                                       @foreach($orders as $key => $item)
                                           @if(Auth::guard('customer')->user()->id == $item->customer_id)
                                               <tr> <!-- Thêm Class Cho Dòng -->
{{--                                                   <td class="text-center">{{ $key + 1 }}</td>--}}
                                                   <td class="text-center">{{ $item->code }}</td>
                                                   <td class="text-center">{{ date('d/m/Y H:i', strtotime($item->updated_at)) }}</td>
                                                   <td class="text-center">
                                                       @if ($item->order_status_id === 1)
                                                           <span class="label label-info">Đang xử lý</span>
                                                       @elseif($item->order_status_id === 2)
                                                           <span class="label label-success">Đã Hủy</span>
                                                       @else
                                                           <span class="label label-success">Hoàn thành</span>
                                                       @endif
                                                   </td>
                                                   <td class="price text-center">{{ number_format($item->total + 25000,0,",",".") }}đ</td>
                                                   <td class="text-center">
                                                       <a href="{{route('shop.orderDetails', ['id'=> $item->id ])}}">
                                                           <span type="submit" class="btn">Chi tiết</span>
                                                       </a>
                                                   </td>
                                               </tr>
                                           @endif
                                       @endforeach
                                   </tbody>
                               </table>
                           </div>
                       </div>
                       <div id="password" class="tab-item">
                           <h3>Đổi mật khẩu</h3>
                           <form action="{{route('customer.reset',['id' => Auth::guard('customer')->user()->id])}}" method="post" enctype="multipart/form-data">
                               @csrf
                               <div class="form-group">
                                   <input  class="form-control" type="password" name="new_password" placeholder="Nhập mật khẩu mới" >
                               </div>
                               @if ( $errors->has('new_password') )
                                   <span style="color:red;display: block; margin: -10px 0px 0px;">{{ $errors->first('new_password') }}</span>
                               @endif
                               <div class="text-right">
                                   <button type="submit" class="btn">Cập nhật</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </main>
    @else
        <main class="main">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> Đăng nhập </h4>
                                </a>
                                <a data-toggle="tab" href="#lg2" class="">
                                    <h4> Đăng ký</h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="{{route('shop.postLogin')}}" method="post">
                                                @csrf
                                                <div class="login-input-box">
                                                    <input type="email" id="email" name="email" placeholder="Email" required>
                                                    <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                                                </div>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox">
                                                        <label>Ghi nhớ</label>
                                                        <a href="#">Quên mật khẩu?</a>
                                                    </div>
                                                    <div class="button-box">
                                                        <button class="login-btn btn" type="submit"><span>Đăng nhập</span></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="{{route('shop.postRegister')}}" method="post">
                                                @csrf
                                                <div class="login-input-box">
                                                    <input type="text" id="name" name="name" placeholder="Họ và tên" required>
                                                    <input type="text" name="phone" placeholder="Số điện thoại" required>
                                                    <input type="Email" id="email" name="email" placeholder="Email" required>
                                                    <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                                                    <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
                                                </div>
                                                <div class="button-box">
                                                    <button class="register-btn btn" type="submit"><span>Đăng ký</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection
