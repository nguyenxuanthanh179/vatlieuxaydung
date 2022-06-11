@extends('frontend.layouts.main')
@section('blog-details')
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
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="container">
                        <p class="blog">TIN TỨC</p>
                        <h3 class="main__tiltle main__color">{{$article->title}}</h3>
                        <div class="mt-3 d-flex mobile__time" style="font-size: 12px; opacity: .7; font-style: italic">
                            <div class="mr-3">
                                <i class="fa-solid fa-user"></i>
                                {{@$article->user->name}}
                            </div>
                            <div>
                                <i class="fa-regular fa-calendar-days"></i>
                                {{ date('d/m/Y', strtotime($article->updated_at)) }}
                            </div>
                        </div>
                    </div>
                    <div class="blog__detail text-justify">
                        {!!$article->description!!}
                    </div>
                </div>
                <div class="col-md-3 mobile__blog">
                    <div class="mb-3 mt-5">
                        <h3 class="navbar">Danh mục sản phẩm</h3>
                        <div class="category-sub-menu">
                            <ul class="border__category">
                                @foreach($menu as $item)
                                    @if($item->parent_id==0)
                                        <li class="has-sub">
                                            <a href="{{route('shop.category',['slug'=>$item->slug])}}">{{$item->name}}
                                            </a>
                                            <ul>
                                                @foreach($menu as $child)
                                                    @if($child->parent_id==$item->id)
                                                        <li><a href="{{route('shop.category',['slug'=>$child->slug])}}">{{$child->name}}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        <h3 class="navbar">Tin tức mới</h3>
                        <div class="navbar__news">
                            <ul class="navbar-list__news">
                                @foreach($data as $item)
                                    @if($item->is_new == 1)
                                        <li class="row">
                                            <div class="box__image col-md-3">
                                                <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">
                                                    <img class="news-img__icon"
                                                         src="{{asset($item->image)}}" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <div>
                                                    <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">
                                                        {{$item->title}}
                                                    </a>
                                                </div>
                                                <div style="margin-top: 3px; font-size: 11px; opacity: .7; font-style: italic">
                                                    <i class="fa-regular fa-calendar-days"></i>
                                                    {{ date('d/m/Y', strtotime($item->updated_at)) }}
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                                @foreach($project as $item)
                                    @if($item->is_new == 1)
                                        <li class="row">
                                            <div class="box__image col-md-3">
                                                <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">
                                                    <img class="news-img__icon"
                                                         src="{{asset($item->image)}}" alt="">
                                                </a>
                                            </div>

                                            <div>
                                                <div>
                                                    <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">
                                                        {{$item->title}}
                                                    </a>
                                                </div>
                                                <div style="margin-top: 3px; font-size: 11px; opacity: .7; font-style: italic">
                                                    <i class="fa-regular fa-calendar-days"></i>
                                                    {{ date('d/m/Y', strtotime($item->updated_at)) }}
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-wrapper">
                                <ul class="tab">
                                    <li>
                                        <a href="">Bình luận</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="product-details__comment mt-4">
                                        @foreach($comment as $item)
                                            <div class="mb-3 d-flex">
                                                <div>
                                                    <div class="avt_comment">
                                                        @if($item->avatar)
                                                            <img src="{{asset($item->avatar)}}" alt="" width="100%" style="border-radius: 50%">
                                                        @else
                                                            <i class="fa fa-user"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ml-2">
                                                    <div class="user_comment">{{ $item->name }}</div>
                                                    <div class="time_comment">
                                                        <i class="fa-regular fa-calendar-days"></i>
                                                        {{ date('d/m/Y H:i', strtotime($item->created_at)) }}
                                                    </div>
                                                    <div class="content_comment">{{ $item->content }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="product-details__send-comment mt-3">
                                        <p>Bình luận của bạn</p>
                                        <div class="form__contact">
                                            <form id="contact-form" action="{{route('shop.postComment',['slug'=>$article->slug])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="contact-page-form">
                                                    <div class="contact-input">
                                                        @if(Auth::guard('customer')->check())
                                                            <div class="contact-inner">
                                                                <label for="content">Bình luận của bạn *</label>
                                                                <textarea class="contact__message" name="content" id="content" required></textarea>
                                                            </div>
                                                        @else
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="contact-inner">
                                                                        <label for="name">Tên *</label>
                                                                        <input class="form__data" name="name" id="name" type="text" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="contact-inner">
                                                                        <label for="email">Email *</label>
                                                                        <input class="form__data" name="email" id="email" type="email" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="contact-inner">
                                                                <label for="content">Bình luận của bạn *</label>
                                                                <textarea class="contact__message" name="content" id="content" required></textarea>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="contact-submit-btn">
                                                        <button type="submit">GỬI ĐI</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section3 container mobile-product__hot">
                    <h3 class="text-center home__color">SẢN PHẨM HOT</h3>
                    <img src="/frontend/assets/image/mui-ten.png" alt="" class="mui-ten">
                    <div class="row position-relative">
                        <div class="col">
                            <img id="slideLeft" class="bbb_viewed_prev arrow"
                                 src="/frontend/assets/image/arrow-left.png">
                            <img id="slideRight" class="bbb_viewed_next arrow"
                                 src="/frontend/assets/image/arrow-right.png">
                            <div class="owl-carousel owl-theme bbb_viewed_slider">
                                @foreach($hotProducts as $product)
                                    <div class="owl-item">
                                        <div
                                            class="product__box bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
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
            </div>
        </div>
    </main>

@endsection
