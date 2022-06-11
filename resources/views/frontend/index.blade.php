@extends('frontend.layouts.main')

@section('home')
    <div id="toast">
        <div class="toast toast--success">
            <div class="toast__body pl-2">
                <p class="toast__msg ">Sản phẩm đã được bán hết.</p>
            </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
    <div class="silder">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/frontend/assets/image/slide-1.png" alt="First slide">
                </div>
                @foreach($banners as $banner)
                    @if($banner->type==1)
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset($banner->image)}}" alt="Second slide">
                    </div>
                    @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <main class="main">
        <section class="section1 container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <h3 class="home__color about">GIỚI THIỆU VỀ CHÚNG TÔI</h3>
                    <img src="/frontend/assets/image/mui-ten.png" alt="" class="icon__section6">
                    <div class="home-about__text text-justify">
                        {!! $introduce->summary !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="home__about mt-md-5">
                        <img src="{{asset($introduce->image)}}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="section2 container">
            <h3 class="text-center home__color">SẢN PHẨM BÁN CHẠY NHẤT</h3>
            <img src="/frontend/assets/image/mui-ten.png" alt="" class="mui-ten">
            <div class="row mb-4">
                @foreach($products as $product)
                <div class="col-lg-3 pt-lg-2 pb-lg-2 col-sm-6 col-6 pb-2 col-md-4">
                    <div class="product__box">
                        <div class="product__image">
                            <a href="{{route('shop.ProductDetails',['slug'=>$product->slug])}}">
                                <img src="{{asset($product->image)}}" alt="">
                            </a>
                        </div>
                        <div class="product__content">
                            <p class="product__category">{{$product['category']->name}}</p>
                            <a href="" class="product__title">{{ $product->name}}</a>
                            @if($product->stock > 0)
                                <a href="{{ route('shop.cart.add-to-cart', ['id' => $product->id]) }}" class="add__cart">Thêm vào giỏ hàng</a>
                            @else
                                <a class="add__cart add__cart1">Thêm vào giỏ hàng</a>
                            @endif
                            <div class="product-content__price">
                                @if($product -> sale == $product -> price)
                                    <p class="product__price">{{ number_format($product -> sale,0,",",".") }} đ</p>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <p class="product__price mr-4">{{ number_format($product -> sale,0,",",".") }} đ</p>
                                        <p class="product__price" style="color: #666; text-decoration: line-through">{{ number_format($product -> price,0,",",".") }} đ</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @foreach($list as $key => $item)
        <section class="section3 container">
            <h3 class="text-center home__color">{{$item['category']->name}}</h3>
            <img src="/frontend/assets/image/mui-ten.png" alt="" class="mui-ten">
            <div class="row position-relative">
                <div class="col">
                    <img id="slideLeft" class="bbb_viewed_prev arrow"
                         src="/frontend/assets/image/arrow-left.png">
                    <img id="slideRight" class="bbb_viewed_next arrow"
                         src="/frontend/assets/image/arrow-right.png">
                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                        @foreach($item['products'] as $product)
                                <div class="owl-item">
                                    <div class="product__box bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="product__image">
                                            <a href="{{route('shop.ProductDetails',['slug'=>$product->slug])}}">
                                                <img src="{{asset($product->image)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="product__content">
                                            <p class="product__category">{{$product['category']->name}}</p>
                                            <a href="" class="product__title">{{ $product->name}}</a>
                                            @if($product->stock > 0)
                                                <a href="{{ route('shop.cart.add-to-cart', ['id' => $product->id]) }}" class="add__cart">Thêm vào giỏ hàng</a>
                                            @else
                                                <a class="add__cart add__cart1">Thêm vào giỏ hàng</a>
                                            @endif
                                            <div class="product-content__price">
                                                @if($product -> sale == $product -> price)
                                                    <p class="product__price">{{ number_format($product -> sale,0,",",".") }} đ</p>
                                                @else
                                                    <div class="d-flex justify-content-center">
                                                        <p class="product__price mr-4">{{ number_format($product -> sale,0,",",".") }} đ</p>
                                                        <p class="product__price" style="color: #666; text-decoration: line-through">{{ number_format($product -> price,0,",",".") }} đ</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        <section class="section6 container">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-12">
                    <h3 class="home__color relative home__color1">TIN TỨC</h3>
                    <img src="/frontend/assets/image/mui-ten.png" alt="" class="icon__section5">
                    @foreach($article as $item)
                        <div class="row mb-2">
                            <div class=" col-md-4 col-4">
                                <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">
                                    <img class="home__news" src="{{asset($item->image)}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-8 news__content col-8">
                                <div class="home-news__content">
                                    <h3><a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">{{$item->title}}</a></h3>
                                    <div class="d-flex" style="font-size: 12px; opacity: .7; font-style: italic; margin-bottom: 10px">
                                        <div class="mr-3">
                                            <i class="fa-solid fa-user"></i>
                                            {{@$item->user->name}}
                                        </div>
                                        <div>
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ date('d/m/Y', strtotime($item->updated_at)) }}
                                        </div>
                                    </div>
                                    <div class="text-justify blog__summary">{!! $item->summary !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 col-lg-6 col-12">
                    <h3 class="home__color relative home__color1">HÌNH ẢNH</h3>
                    <img src="/frontend/assets/image/mui-ten.png" alt="" class="icon__section5">

                    <div class="row">
                        @foreach($banners as $banner)
                            @if($banner->type==2)
                                <div class="img__inner col-lg-6 col-md-4 col-6 image__image">
                                    <img id="click__image" src="{{asset($banner->image)}}" alt="">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section class="section7 container">
            <h3 class="text-center home__color ">DỰ ÁN</h3>
            <img src="/frontend/assets/image/mui-ten.png" alt="" class="mui-ten">
            <div class="row justify-content-center">
                @foreach($project as $item)
                    <div class="col-lg-3 col-6 mb-3 col-md-4 ">
                        <div class="project__image">
                            <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">
                                <img class="home__news" src="{{asset($item->image)}}" alt="">
                            </a>
                        </div>
                        <div class="box__project">
                            <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}" class="project__title">{{$item->title}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection



