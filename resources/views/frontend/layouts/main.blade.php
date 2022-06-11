<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng kho vật liệu xây dựng</title>
    <link rel="shortcut icon" type="image/x-icon" href="/frontend/assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/frontend/assets/css/style.css">
    <link rel="stylesheet" href="/frontend/assets/css/responsive.css">
</head>

<body>
<div id="warpper">
    {{-- Header   --}}
    @include('frontend.layouts.header')

    {{--    Trang chủ--}}
    @yield('home')

    {{-- Trang giới thiệu --}}
    @yield('aboutUs')

    {{-- Trang sản phẩm--}}
    @yield('product')
    @yield('product-details')

    {{-- Trang tin tức --}}
    @yield('blog')
    @yield('blog-details')

    {{-- Trang dự án --}}
    @yield('project')
    @yield('project-details')

    {{-- Trang liên hệ --}}
    @yield('contact')

    {{-- Trang đặt hàng  --}}
    @yield('cart')

    {{-- Trang đăng nhập --}}
    @yield('login-register')

    {{-- Trang tài khoản của tôi --}}
    @yield('my-account')

    {{--  trang 404   --}}
    @yield('errors')

    {{--  Footer  --}}
    @include('frontend.layouts.footer')
</div>
<button id="btnScrollToTop">
    <i class="fas fa-chevron-up"></i>
</button>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<script src="/frontend/assets/js/jquery.min.js"></script>
<script src="/frontend/assets/js/bootstrap.min.js"></script>
<script src="/frontend/assets/js/script.js"></script>
@yield('script')
</body>

</html>
