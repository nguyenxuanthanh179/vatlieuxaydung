@extends('frontend.layouts.main')
@section('my-account')
    <main class="main">
        <div class="container pt-5">
            <div class="row">
               <div class="pl-3 pb-3">
                   <a href="/tai-khoan" style="color: #000; font-size: 22px">
                       <i class="fa-solid fa-arrow-left"></i>
                       Hồ sơ của tôi
                   </a>
               </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div style="border: 15px solid #ddd; padding: 20px; background-color: #fff">
                        <div style="font-size: 20px; font-weight: 600; text-transform: uppercase ;text-align:center;padding-bottom: 20px">
                            Chi tiết đơn hàng
                        </div>
                        <div class="row">
                            <table class="table table-bordered text-center" style="background-color: #fff">
                                <thead style="background-color: #d6efd5">
                                <tr>
                                    <th>STT</th>
                                    <th style="max-with:200px">Tên SP</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->details as $key => $item)
                                    <tr >
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->image)
                                                <img src="{{asset($item->image)}}" width="50" height="50">
                                            @endif
                                        </td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($item->price ,0,",",".") }}đ</td>
                                        <td style="color:red;">{{ number_format($item->price * $item->qty ,0,",",".") }} đ</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right">Giá sản phẩm</td>
                                    <td>{{ number_format($order->total,0,",",".") }}đ</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Giao hàng tận nơi</td>
                                    <td>25.000 đ</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Tổng tiền</td>
                                    <td>{{ number_format($order->total + 25000,0,",",".") }}đ</td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div style="border: 1px solid #ddd; padding: 10px">
                                    <div style="font-size: 16px; font-weight: 500; text-transform: uppercase; background-color: #d6efd5; padding: 10px">
                                        Phương thức thanh toán
                                    </div>
                                    <div class="col-md-12 pl-lg-0">
                                        <div class="contact-inner">
                                            <label>
                                                <div class="d-lg-flex align-items-center">
                                                    <input type="radio" checked required>
                                                    <span style="flex-grow: 1; margin-left: 3px" >Thanh toán khi giao hàng (COD)</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <div style="border: 1px solid #ddd; padding: 10px">
                                   <div style="font-size: 16px; font-weight: 500; text-transform: uppercase; background-color: #d6efd5; padding: 10px">
                                       Thông tin giao hàng
                                   </div>
                                   <div class="col-md-12 pl-0">
                                       <div class="contact-inner">
                                           <label>
                                               <div class="row pb-3">
                                                   <div class="col-md-3">Họ và tên: </div>
                                                   <div class="col-md-9">{{ $order->fullname }}</div>
                                               </div>
                                               <div class="row pb-3">
                                                   <div class="col-md-3">Số điện thoại: </div>
                                                   <div class="col-md-9">{{ $order->phone }}</div>
                                               </div>
                                               <div class="row pb-3">
                                                   <div class="col-md-3">Địa chỉ: </div>
                                                   <div class="col-md-9">{{ $order->address }}</div>
                                               </div>
                                           </label>
                                       </div>
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
