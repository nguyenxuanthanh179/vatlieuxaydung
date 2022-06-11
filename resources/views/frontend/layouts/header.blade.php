<header id="scroll" class="header">
    <div class="header__logo">
        <div class="icon">
            <div class="container" id="mobile__icon" style="padding: 0">
                <label for="nav__mobile-input" class="mobile__icon" >
                    <i class="fas fa-bars icon-menu"></i>
                </label>
            </div>
        </div>
        <div class="logo-padding-left">
            <a href="{{route('shop.index')}}">
                <img src="{{asset($setting->image)}}" alt="">
            </a>
        </div>
       <div class="icon">
           <a href="{{route('shop.cart')}}">
               <div class="header__list header__cart">
                   <a href="{{route('shop.cart')}}">
                       <i class="fa-solid fa-cart-shopping" style="color: #000"></i>
                       <span class="icon-shopping_cart" style="background: #ccc; color: #fff">
                           {{ !empty(session('totalItem')) ? session('totalItem') : 0 }}
                       </span>
                   </a>
               </div>
           </a>
       </div>
    </div>
    <div class="header__top">
        <div class="container d-lg-flex justify-content-between padding">
            <div class="header__logo1">
                <a href="{{route('shop.index')}}">
                    <img src="{{asset($setting->image)}}" alt="">
                </a>
            </div>
            <div class="header__title">
                {{$setting->company}}
            </div>
            <div class="d-md-flex align-items-center mr-2 header-top__search">
                <form action="{{ route('shop.search') }}" method="GET" >
                    <div class="d-flex">
                        <input type="text" class="form__search" value="{{isset($keyword) ? $keyword : ''}}" name="tu-khoa" placeholder="Tìm kiếm ...">
                        <button type="submit" class="header__search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container d-flex justify-content-between bottom__menu">
            <ul class="header__menu">
                <li class="header__list">
                    <a href="{{route('shop.index')}}">Trang chủ</a>
                </li>
                <li class="header__list">
                    <a href="{{route('shop.aboutUs')}}">Giới thiệu</a>
                </li>
                <li class="header__list">
                    <a href="{{route('shop.product')}}">Sản phẩm</a>
                </li>
                <li class="header__list">
                    <a href="{{route('shop.blog')}}">Tin tức</a>
                </li>
                <li class="header__list">
                    <a href="{{route('shop.project')}}">Dự án</a>
                </li>
                <li class="header__list">
                    <a href="{{route('shop.contact')}}">Liên hệ</a>
                </li>
            </ul>
            <div class="header__menu">
                @if( Auth::guard('customer')->check() )
                    <div class="header__list header__login">
                        <a href="#"><i style="font-size: 1.2em;"  class="fa-solid fa-circle-user"></i></a>
                        <ul class="menu_login">
                            <li class="">
                                <a class="" href="{{route('shop.myAccount')}}">Hồ sơ cá nhân</a>
                            </li>
                            <li class="">
                                <a class="" href="{{route('shop.logout')}}">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__list header__cart">
                        <a href="{{route('shop.cart')}}">
                            Giỏ hàng <i class="fa-solid fa-cart-shopping"></i>
                            <span class="icon-shopping_cart">
                            {{ !empty(session('totalItem')) ? session('totalItem') : 0 }}
                        </span>
                        </a>
                    </div>
                @else
                    <div class="header__list header__login"> <a href="{{route('shop.login')}}">Đăng nhập</a></div>
                    <div class="header__list header__cart">
                        <a href="{{route('shop.cart')}}">
                            Giỏ hàng <i class="fa-solid fa-cart-shopping"></i>
                            <span class="icon-shopping_cart">
                            {{ !empty(session('totalItem')) ? session('totalItem') : 0 }}
                        </span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
<nav>
    <input type="checkbox" name="" hidden class="nav__input" id="nav__mobile-input">
    <label for="nav__mobile-input" class="nav__overlay"></label>
    <div class="nav__mobile">
        <div class="nav__mobile-logo">
            <a href="{{ route('shop.index') }}">
                <img src="{{asset($setting->image)}}" alt="">
            </a>
        </div>
        <div class="nav__mobile-icon">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter "></i>
            <i class="fab fa-instagram "></i>
            <i class="fab fa-linkedin-in"></i>
            <i class="fab fa-youtube "></i>
        </div>
        <label  for="nav__mobile-input" class="nav__mobile-close">
            <i class="fas fa-times"></i>
        </label>
        <ul class="nav__mobile-list">
            <li class="nav__mobile-link search__mobile">
                <form action="{{ route('shop.search') }}" method="GET" >
                    <div class="d-flex">
                        <input type="text" class="form__search" value="{{isset($keyword) ? $keyword : ''}}" name="tu-khoa" placeholder="Tìm kiếm ...">
                        <button type="submit" class="header__search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </li>
            <li><a class="nav__mobile-link" href="{{ route('shop.index') }}">Trang chủ</a></li>
            <li><a class="nav__mobile-link" href="{{ route('shop.aboutUs') }}">Giới thiệu</a></li>
            <li><a class="nav__mobile-link" href="{{ route('shop.product') }}">Sản phẩm</a></li>
            <li><a class="nav__mobile-link" href="{{ route('shop.blog') }}">Tin tức</a></li>
            <li><a class="nav__mobile-link" href="{{ route('shop.project') }}">Dự án</a></li>
            <li><a class="nav__mobile-link" href="{{ route('shop.contact') }}">Liên hệ</a></li>
            @if( Auth::guard('customer')->check() )
                @if(Auth::guard('customer')->user()->role_id == 4)
                    <li>
                        <a class="nav__mobile-link" href="/tai-khoan">
                            <i style="font-size: 1.2em;"  class="fa-solid fa-circle-user"></i>
                        </a>
                    </li>
                @else
                    <li><a class="nav__mobile-link" href="{{ route('shop.login') }}">Đăng nhập</a></li>
                @endif
            @endif
            @if(Auth::guard('customer')->check() == false)
                <li><a class="nav__mobile-link" href="{{ route('shop.login') }}">Đăng nhập</a></li>
            @endif
        </ul>
    </div>
</nav>
