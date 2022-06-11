@extends('frontend.layouts.main')
@section('product-details')
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
        <div class="container product__directional">
            <div class="d-flex justify-content-between">
                <div class="directional">
                    <ul class="d-flex">
                        <li>Trang chủ</li>
                        <li>/</li>
                        <li>Chi tiết sản phẩm</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="content-wrapper" class="container">
            <div class="row">
                <div class="col-md-6 column">
                    <img id="featured" src="{{asset($product->image)}}">
                    <div id="slide-wrapper">
{{--                        <img id="slideLeft" class="arrow" src="/frontend/assets/image/arrow-left.png">--}}
{{--                        <div id="slider">--}}
                            <img class="thumbnail active" src="{{asset($product->image)}}">
{{--                            <img class="thumbnail" src="/frontend/assets/image/Sơn-Lót-Beger-Nano-1-Shield-Alkali-Resisting-Primer-9999-03.png">--}}
{{--                            <img class="thumbnail" src="/frontend/assets/image/Sơn-Lót-Chịu-Ẩm-Beger-Primer-B-2100-10.png">--}}
{{--                            <img class="thumbnail" src="/frontend/assets/image/Sơn-Lót-Chịu-Ẩm-Beger-Primer-B-2100-10.png">--}}
{{--                            <img class="thumbnail" src="/frontend/assets/image/Sơn-Lót-Chịu-Ẩm-Beger-Primer-B-2100-10.png">--}}
{{--                        </div>--}}
{{--                        <img id="slideRight" class="arrow" src="/frontend/assets/image/arrow-right.png">--}}
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="product__detail">
                        <h3 class="">{{$product->name}}</h3>
                        <div class="detail-box__price">
                            @if($product->price == $product->sale)
                                <span class="box__price">
                                    <span class="new-price">{{ number_format($product -> sale,0,",",".") }} đ</span>
                                </span>
                            @else
                                <span class="box__price">
                                    <span class="new-price">{{ number_format($product -> sale,0,",",".") }} đ</span>
                                </span>
                                <span class="old-price">{{ number_format($product -> price,0,",",".") }} đ</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-short-description">
                        <style>
                            .product-short-description > div.text-justify > p {
                                line-height: 1.5;
                                padding-bottom: 10px;
                            }
                        </style>
                        <div class="text-justify">{!! $product->summary !!}</div>
                    </div>
                    <div class="d-flex mb-3">
                        <h5>Tình trạng:</h5>
                        @if($product->stock > 0)
                            <h5 style="color: #82ae46;">&emsp;CÒN HÀNG</h5>
                        @else
                            <h5 style="color: red;">&emsp;HẾT HÀNG</h5>
                        @endif
                    </div>
                    <div class="single-add-to-cart">
                        @if($product->stock > 0)
                        <form action="{{ route('shop.cart.add-to-cart', ['id' => $product->id]) }}" class="cart-quantity d-flex flex-column">
{{--                           <div class="quantity">--}}
{{--                               <div class="cart-plus-minus">--}}
{{--                                   <input type="number" class="input-text" name="quantity" min="1" value="1" required>--}}
{{--                               </div>--}}
{{--                           </div>--}}
                            <div class="buttons_added">
                                <input class="minus is-form" type="button" value="-">
                                <input class="input-qty" name="quantity" max="100" min="0" type="number" value="1">
                                <input class="plus is-form" type="button" value="+">
                            </div>
                            <button type="submit" class="add-to-cart">Thêm giỏ hàng</button>
                        </form>
                        @else
                            <div class="cart-quantity d-flex flex-column">
                                <div class="buttons_added">
                                    <input class="minus is-form" type="button" value="-">
                                    <input class="input-qty" name="quantity" max="99" min="0" type="number" value="1">
                                    <input class="plus is-form" type="button" value="+">
                                </div>
                                <button type="submit" class="add-to-cart add__cart1">Thêm giỏ hàng</button>
                            </div>
                        @endif
                    </div>
                    @if ( $errors->has('quantity') )
                        <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('quantity') }}</span>
                    @endif
                    <div class="product_meta">
                        <span class="sku_wrapper">Mã: <span class="sku">{{ $product->sku }}</span></span>
                        <span class="posted_in">Danh mục: <a href="" rel="tag">{{ $product['category']->name }}</a></span>
                    </div>
                    <div class="social__icon">
                        <a href="#">
                            <i class="fa-brands fa-facebook icon__facebook"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-twitter-square icon__twitter"></i>
                        </a>
                        <a href="#" class="">
                            <i class="fa-brands fa-whatsapp icon__whatsapp"></i>
                        </a>
                        <a href="#" class="">
                            <i class="fa-brands fa-pinterest icon__pinterest"></i>
                        </a>
                        <a href="" class="">
                            <i class="fa-brands fa-linkedin icon__linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-wrapper">
                            <ul class="tab">
                                <li>
                                    <a href="#tab-main-info">Mô tả</a>
                                </li>
                                <li>
                                    <a href="#tab-evaluate">Bình luận</a>
                                </li>
                            </ul>
                            <style>
                                #tab-main-info > div.text-justify > p {
                                    line-height: 1.5;
                                    padding-bottom: 20px;
                                }
                            </style>
                            <div class="tab-content">
                                <div class="tab-item" id="tab-main-info">
                                    <div class="text-justify">{!! $product->description !!}</div>
                                </div>
                                <div class="tab-item" id="tab-evaluate">
                                    <div class="product-details__send-comment mt-3">
                                        <h3>Hãy bình luận về sản phẩm " {{ $product->name }} "</h3>
                                        <p>Bình luận của bạn</p>
                                        <div class="form__contact">
                                            <form id="contact-form" action="{{route('shop.postComment',['slug'=>$product->slug])}}" method="post" enctype="multipart/form-data">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section3 container mobile-product__hot">
                <h3 class="text-center home__color">SẢN PHẨM TƯƠNG TỰ</h3>
                <img src="/frontend/assets/image/mui-ten.png" alt="" class="mui-ten">
                <div class="row position-relative">
                    <div class="col">
                        <img id="slideLeft" class="bbb_viewed_prev arrow"
                             src="/frontend/assets/image/arrow-left.png">
                        <img id="slideRight" class="bbb_viewed_next arrow"
                             src="/frontend/assets/image/arrow-right.png">
                        <div class="owl-carousel owl-theme bbb_viewed_slider">
                            @foreach($parityProduct as $product)
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
    </main>
@endsection

