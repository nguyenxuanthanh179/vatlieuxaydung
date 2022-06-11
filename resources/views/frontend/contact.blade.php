@extends('frontend.layouts.main')
@section('contact')

    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="contact__title">Gửi liên hệ</h3>
                    <h3 class="contact__title">{{ $setting->company }}</h3>
                    <ul class="contact__address">
                        <li>Địa chỉ : {{ $setting->address }}</li>
                        <li>Hotline : {{ $setting->hotline }}</li>
                        <li>Email : {{ $setting->email }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3 class="contact__title">Thông tin liên hệ</h3>
                    @if (session('msg'))
                        <div style="color: #2cad18; margin-top: 20px">{{ session('msg') }}</div>
                    @endif
                    <div class="form__contact">
                        @if(Auth::guard('customer')->check())
                            <form id="contact-form" action="{{ route('shop.postContact') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="contact-page-form">
                                    <div class="contact-input">
                                        <div class="contact-inner">
                                            <label for="name">Họ và tên</label>
                                            <input value="{{ Auth::guard('customer')->user()->name }}" class="form__data" id="name" name="name" type="text">
                                            @if ( $errors->has('name') )
                                                <span style="color:red;">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="contact-inner">
                                            <label for="email">Email</label>
                                            <input value="{{ Auth::guard('customer')->user()->email }}" class="form__data" id="email" name="email" type="email">
                                            @if ( $errors->has('email') )
                                                <span style="color:red;">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="contact-inner">
                                            <label for="phone">Số điện thoại</label>
                                            <input value="{{ Auth::guard('customer')->user()->phone }}" class="form__data" id="phone" name="phone" type="text">
                                            @if ( $errors->has('phone') )
                                                <span style="color:red;">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="contact-inner ">
                                            <label for="message">Tin nhắn</label>
                                            <textarea class="contact__message" id="message" name="content"></textarea>
                                            @if ( $errors->has('content') )
                                                <span style="color:red;">{{ $errors->first('content') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="contact-submit-btn">
                                        <button type="submit" class="submit-btn" id="btn-send">GỬI</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="contact-form" action="{{ route('shop.postContact') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="contact-page-form">
                                    <div class="contact-input">
                                        <div class="contact-inner">
                                            <label for="name">Họ và tên</label>
                                            <input class="form__data" id="name" name="name" type="text" >
                                            @if ( $errors->has('name') )
                                                <span style="color:red;">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="contact-inner">
                                            <label for="email">Email</label>
                                            <input class="form__data" id="email" name="email" type="email" >
                                            @if ( $errors->has('email') )
                                                <span style="color:red;">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="contact-inner">
                                            <label for="phone">Số điện thoại</label>
                                            <input class="form__data" id="phone" name="phone" type="text" >
                                            @if ( $errors->has('phone') )
                                                <span style="color:red;">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                        <div class="contact-inner ">
                                            <label for="message">Tin nhắn</label>
                                            <textarea class="contact__message" id="message" name="content" ></textarea>
                                            @if ( $errors->has('content') )
                                                <span style="color:red;">{{ $errors->first('content') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="contact-submit-btn">
                                        <button type="submit" class="submit-btn" id="btn-send">GỬI</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection
