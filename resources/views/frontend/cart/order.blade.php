@extends('frontend.layouts.main')

@section('cart')
<main class="main">
    <div class="container">
        <div id="order">
            <form action="{{ route('shop.cart.postOrder') }}" class="billing-form row" method="post" >
                @csrf
                <div class="col-md-4">
                    <div class="col-md-12">
                        <h3 class="contact__title">Thông tin nhận hàng</h3>
                    </div>
                    @if(Auth::guard('customer')->check())
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="fullname">Họ và tên</label>
                                <input value="{{ Auth::guard('customer')->user()->name }}" name="fullname" id="fullname" type="text" class="form-control"  >
                                @if ( $errors->has('fullname') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="phone">Số điện thoại</label>
                                <input value="{{ Auth::guard('customer')->user()->phone }}" name="phone" id="phone" type="text" class="form-control"  >
                                @if ( $errors->has('phone') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="email">Email</label>
                                <input value="{{ Auth::guard('customer')->user()->email }}" name="email" type="text" class="form-control" placeholder="" >
                                @if ( $errors->has('email') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="address">Địa chỉ</label>
                                <input value="{{ Auth::guard('customer')->user()->address }}" type="text" class="form-control" id="address" name="address" >
                                @if ( $errors->has('address') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="address2">Địa chỉ nhận hàng</label>
                                <input type="text" class="form-control" id="address2" name="address2" >
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="contact-inner">
                            <label for="note">Ghi chú</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
                        </div>
                    </div>
                    @else
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="fullname">Họ và tên</label>
                                <input name="fullname" type="text" class="form-control" id="fullname" >
                                @if ( $errors->has('fullname') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="phone">Số điện thoại</label>
                                <input name="phone" type="text" class="form-control" id="phone" >
                                @if ( $errors->has('phone') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="email">Email</label>
                                <input name="email" type="text" class="form-control" id="email" >
                                @if ( $errors->has('email') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" >
                                @if ( $errors->has('address') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="address2">Địa chỉ nhận hàng</label>
                                <input type="text" class="form-control" id="address2" name="address2" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-inner">
                                <label for="note">Ghi chú</label>
                                <textarea class="form-control" name="note" id="note"></textarea>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="col-md-12 pl-lg-0">
                        <h3 class="contact__title">Vận chuyển</h3>
                    </div>
                    <div class="col-md-12 pl-lg-0">
                        <div class="contact-inner">
                            <label>
                                <div class="box__paypal">
                                    <input type="radio" checked required>
                                    <span style="flex-grow: 1; margin-left: 3px">Giao hàng tận nơi</span>
                                    <span style="font-size: 16px">25.000đ</span>
                                </div>

                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 pl-lg-0">
                        <h3 class="contact__title" style="margin-top: 0px">Phương thức thanh toán</h3>
                    </div>
                    <div class="col-md-12 pl-lg-0">
                        <div class="contact-inner">
                            <label>
                                <div class="box__paypal">
                                    <input type="radio" checked required>
                                    <span style="flex-grow: 1; margin-left: 3px">Thanh toán khi giao hàng (COD)</span>
                                    <i class="fa-solid fa-money-bill-1" style="color: #0b97c4; font-size: 24px"></i>
                                </div>
                            </label>

                        </div>
                    </div>
                    <div class="col-md-12 pl-lg-0">
                        <div class="contact-inner">
                            <label>
                                <input type="checkbox" name="policy" value="" class="mr-2" > Tôi đã đọc và chấp nhận chính sách mua hàng.
                            </label>
                            @if ( $errors->has('policy') )
                                <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('policy') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12 pl-0">
                        <h3 class="contact__title">Thông tin đơn hàng</h3>
                    </div>
                    <div class="infor__order">
                        @foreach($cart as $item)
                            <div class="row order-info d-lg-flex align-items-center">
                                <div class="col-lg-3 pl-0">
                                    <div class="infor__image">
                                        <img src="{{asset($item->options->image)}}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 pl-0">
                                    <div class="infor__name">{{ $item->name }}</div>
                                    <div class="infor__qty">Số lượng : {{ $item->qty }}</div>
                                </div>
                                <div class="col-lg-3 p-0 d-lg-flex justify-content-center">
                                    <div class="infor__price">{{ number_format($item->price,0,",",".") }}đ</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pt-3 pb-3 infor__total">
                        <div class="d-lg-flex justify-content-between pb-lg-3">
                            <div class="">Tạm tính:</div>
                            <div class="infor__price">{{ number_format($totalPrice,0,",",".") }}đ</div>
                        </div>
                        <div class="d-lg-flex justify-content-between">
                            <div class="">Phí vận chuyển:</div>
                            <div class="infor__price">25.000 đ</div>
                        </div>
                    </div>
                    <div class="pt-3 ">
                        <div class="d-lg-flex justify-content-between pb-lg-3">
                            <div style="font-size: 18px; font-weight: bold">Tổng cộng:</div>
                            <div style="color: #0b97c4; font-size: 18px">{{ number_format($totalPrice + 25000,0,",",".") }}đ</div>
                        </div>
                    </div>
                    <div class="col-md-12 p-0 pt-lg-4 d-flex justify-content-between align-items-center">
                        <a href="/gio-hang"><i class="fa-solid fa-chevron-left"></i> Quay lại giỏ hàng</a>
                        <button type="submit" style="padding: 5px 15px" class="btn">Đặt Hàng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection


