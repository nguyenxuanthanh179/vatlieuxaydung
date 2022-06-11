@extends('frontend.layouts.main')

@section('cart')
    <main class="main">
        <div id="my-cart" class="mt-5">
            @if(session('msg'))
                <h3 class="text-center">{{ session('msg') ? session('msg') : '' }}</h3>
            @else
                <h3 class="text-center"><i class="fa-solid fa-cart-shopping"></i> Bạn chưa có sản phẩm nào trong giỏ hàng</h3>
            @endif
            <a href="/" class="buyother"><i class="fa fa-chevron-left"></i> Về trang chủ</a>
        </div>
    </main>
@endsection


