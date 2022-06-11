@extends('frontend.layouts.main')
@section('product')
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
                        <li>Cửa hàng</li>
                    </ul>
                </div>
                <div class="product__search">
                    <label for="cars">Sắp xếp theo:</label>
                    <select>
                        <option value="">Thứ tự mặc định</option>
                        <option value="">Mới nhất</option>
                        <option value="">Thứ tự theo giá: thấp đến cao</option>
                        <option value="">Thứ tự theo giá: cao đến thấp</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3 col-md-12">
                    <div class="mb-3">
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
                    <div class="mobile__product">
                        <h3 class="navbar">Tin tức mới</h3>
                        <div class="navbar__news">
                            <ul class="navbar-list__news">
                                @foreach($data as $item)
                                    @if($item->is_new==1)
                                        <li class="row">
                                            <div class="box__image col-md-3">
                                                <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">
                                                    <img class="news-img__icon"
                                                         src="{{asset($item->image)}}" alt="">
                                                </a>
                                            </div>
                                            <a class="col-md-9" href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">{{$item->title}}</a>
                                        </li>
                                    @endif
                                @endforeach
                                @foreach($project as $item)
                                    @if($item->is_new==1)
                                        <li class="row">
                                            <div class="box__image col-md-3">
                                                <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">
                                                    <img class="news-img__icon"
                                                         src="{{asset($item->image)}}" alt="">
                                                </a>
                                            </div>
                                            <a class="col-md-9" href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">{{$item->title}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="mb-2">Từ khóa tìm kiếm "{{ $keyword }}" ({{ $totalResult }})</h3>
                    <div class="row product">
                        @foreach($products as $product)
                            <div class="col-lg-4 mb-3 col-md-4 col-6">
                                <div class="product__box ">
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
                    <div class="paginatoin-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

