@extends('frontend.layouts.main')
@section('login-register')

    <main class="main">
        <div class="container mt-lg-4">
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
                                        <form role="form" action="{{route('shop.postLogin')}}" method="post">
                                            @csrf
                                            <div class="login-input-box">
                                                <input type="email" id="email" name="email-login" placeholder="Email" required>
                                                @if ( $errors->has('email-login') )
                                                    <span style="color:red;display: block; margin: -10px 0px 20px;">{{ $errors->first('email-login') }}</span>
                                                @endif
                                                <input type="password" id="password" name="password-login" placeholder="Mật khẩu" required>
                                                @if ( $errors->has('password-login') )
                                                    <span style="color:red;display: block; margin: -10px 0px 20px;">{{ $errors->first('password-login') }}</span>
                                                @endif
                                            </div>
                                            @if(session('msg'))
                                                <div class="form-group">
                                                    <span style="color: #c93816; font-weight: 600"><i class="fa fa-exclamation-triangle" ></i>{{ session('msg') }}</span>
                                                </div>
                                            @endif
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox" id="remember">
                                                    <label for="remember">Ghi nhớ</label>
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
                                                @if ( $errors->has('name') )
                                                    <span style="color:red;display: block; margin: -10px 0px 20px;">{{ $errors->first('name') }}</span>
                                                @endif
                                                <input type="text" id="phone" name="phone" placeholder="Số điện thoại" required>
                                                @if ( $errors->has('phone') )
                                                    <span style="color:red;display: block; margin: -10px 0px 20px;">{{ $errors->first('phone') }}</span>
                                                @endif
                                                <input type="email" id="email" name="email" placeholder="Email" required>
                                                @if ( $errors->has('email') )
                                                    <span style="color:red;display: block; margin: -10px 0px 20px;">{{ $errors->first('email') }}</span>
                                                @endif
                                                <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                                                @if ( $errors->has('password') )
                                                    <span style="color:red;display: block; margin: -10px 0px 20px;">{{ $errors->first('password') }}</span>
                                                @endif
                                                <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
                                                @if ( $errors->has('address') )
                                                    <span style="color:red;display: block; margin: -10px 0px 20px;">{{ $errors->first('address') }}</span>
                                                @endif
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

@endsection
