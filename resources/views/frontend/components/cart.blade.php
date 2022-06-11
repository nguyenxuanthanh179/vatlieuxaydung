@if(count($cart))
    <div class="container product__directional" >
        <div class="d-flex justify-content-between">
            <div class="directional">
                <ul class="d-flex">
                    <li style="margin-left: -15px">Trang chủ</li>
                    <li>/</li>
                    <li>Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-content table-responsive">
                <table class="table">
                    <thead style="background-color: #8cdf97">
                        <tr>
                            <th class="plantmore-product-thumbnail">Hình ảnh</th>
                            <th class="cart-product-name">Sản phẩm</th>
                            <th class="plantmore-product-price">Giá bán</th>
                            <th class="plantmore-product-quantity">Số lượng</th>
                            <th class="plantmore-product-subtotal">Tổng tiền</th>
                            <th class="plantmore-product-remove">Xóa</th>
                        </tr>
                    </thead>
                    @foreach($cart as $item)
                    <tbody>
                        <tr>
                            <td class="plantmore-product-thumbnail"><a href="#"><img src="{{asset($item->options->image)}}" alt=""></a></td>
                            <td class="plantmore-product-name"><a href="#" style="line-height: 1.6"></a>{{ $item->name }}</td>
                            <td class="plantmore-product-price"><span class="amount"> {{ number_format($item->price ,0,",",".") }} đ</span></td>
                            <td class="plantmore-product-quantity quantity css-input">
                                <input name="quantity" type="number" class="quantity item-qty input-text" min="1" max="99" value="{{ $item->qty }}" >
{{--                                @if(!session('msg'))--}}
                                <div class="input-color mt-2">
                                    <a data-id="{{ $item->rowId }}" href="javascript:void(0)" class="update-qty">
                                        <input type="submit" value="Cập nhật">
                                    </a>
                                </div>
                                @if ( $errors->has('quantity') )
                                    <span style="color:red; margin-top: 8px; display: block ">{{ $errors->first('quantity') }}</span>
                                @endif
{{--                                @endif--}}
                            </td>
                            <td class="product-subtotal"><span class="amount">{{ number_format($item->qty * $item->price ,0,",",".") }}đ</span></td>
                            <td class="plantmore-product-remove ">
                                <a class="remove-to-cart" data-id="{{$item->rowId}}" href="javascript:void(0)">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="coupon-all">
                        <div class="coupon2">
                            <a href="{{ route('shop.cart.destroy') }}" class="btn">Hủy đơn hàng</a>
                            <a href="{{ route('shop.product') }}" class="btn">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="cart-page-total">
                        <div class="pb-lg-4">
                            <h2>Tổng tiền: </h2>
                            <span>{{ number_format($totalPrice,0,",",".") }}đ</span>
                        </div>
                    </div>
                   <div style="text-align: end;">
                       <a href="{{route('shop.cart.order')}}" class="btn">Thanh toán</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="pt-5 pb-2">
        <h3 class="text-center"><i class="fa-solid fa-cart-shopping"></i> Bạn chưa có sản phẩm nào trong giỏ hàng</h3>
        <a href="/" class="buyother"><i class="fa fa-chevron-left"></i> Về trang chủ</a>
    </div>
@endif

