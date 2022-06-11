@extends('backend.layouts.main')

@section('content')
    @if(Auth::check() && ( Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
        <section class="content-header">
            <h1>Thống kê</h1>
        </section>
        <section class="content">
            <div class="row" >
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $orders->count() }}</h3>
                            <p> Đơn Hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cart-plus"></i>
                        </div>
                        <a href="{{route('admin.order.index')}}" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $products->count() }}</h3>
                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-database"></i>
                        </div>
                        <a href="{{route('admin.product.index')}}" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $customers->count() }}</h3>
                            <p>Khách hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.customer.customer')}}" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $vendors->count() }}</h3>
                            <p>Nhà cung cấp</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-address-card"></i>
                        </div>
                        <a href="{{route('admin.vendor.index')}}" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <form autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                                        <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                                    </div>
                                    <div class="col-md-2">
                                        <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>Doanh số bán hàng</strong>
                                    </p>
                                    <div class="chart">
                                        <div id="myfirstchart" style="height: 250px;"></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer statistic">
                            <div class="row">
                                <div class="col-sm-4 col-xs-6">
                                    <div class="description-block border-right">
{{--                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>--}}
                                        <h5 class="description-header">{{ number_format($sales,0,',','.')}} VNĐ</h5>
                                        <span class="description-text">TỔNG DOANH THU</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-6">
                                    <div class="description-block border-right">
{{--                                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>--}}
                                        <h5 class="description-header">{{ number_format($sales - $profit,0,',','.')}} VNĐ</h5>
                                        <span class="description-text">TỔNG CHI PHÍ</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-6">
                                    <div class="description-block border-right">
{{--                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>--}}
                                        <h5 class="description-header">{{ number_format($profit,0,',','.')}} VNĐ</h5>
                                        <span class="description-text">TỔNG LỢI NHUẬN</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
{{--                                <div class="col-sm-3 col-xs-6">--}}
{{--                                    <div class="description-block">--}}
{{--                                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>--}}
{{--                                        <h5 class="description-header">1200</h5>--}}
{{--                                        <span class="description-text">MỤC TIÊU HOÀN THÀNH</span>--}}
{{--                                    </div>--}}
{{--                                    <!-- /.description-block -->--}}
{{--                                </div>--}}
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="view__product">
                                        <h4> Sản phẩm xem nhiều</h4>
                                        <ol>
                                            @foreach( $product_views as $item)
                                                <li style="padding: 3px 0px">
                                                    <a href="{{route('shop.ProductDetails',['slug'=>$item->slug])}}" >
                                                        {{ $item->name }}
                                                        <span style="color: #ffffff; padding-left: 6px;"><i class="fa fa-eye"></i>
                                                        <span style="padding-left: 2px">{{ $item->view }}</span>
                                                    </span>

                                                    </a>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="view__blog">
                                        <h4>Tin tức xem nhiều</h4>
                                        <ol>
                                            @foreach( $blog_views as $item)
                                                <li style="padding: 3px 0px">
                                                    <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}} " >
                                                        {{ $item->title }}
                                                        <span style="color: #ffffff;padding-left: 6px;"><i class="fa fa-eye"></i>
                                                         <span style="padding-left: 2px">{{ $item->view }}</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="view__project">
                                        <h4>Dự án xem nhiều</h4>
                                        <ol>
                                            @foreach( $project_views as $item)
                                                <li style="padding: 3px 0px">
                                                    <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">
                                                        {{ $item->title }}
                                                        <span style="color: #ffffff; padding-left: 6px;" ><i class="fa fa-eye"></i>
                                                        <span style="padding-left: 2px">{{ $item->view }}</span>
                                                    </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @else
        <p class="text-center" style="padding-top: 100px">Tài khoản của bạn không có quyền truy cập vào mục này</p>
    @endif
@endsection
@section('script')

<script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
            duration: "slow"
        });
        $( "#datepicker2" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
            duration: "slow"
        });
    } );
    $(document).ready(function () {
        chart30days();
        var chart = new Morris.Bar({
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            lineColors: ['#819C79','#fc8710','#FF6541','#8290c0','#766B56'],
            // pointFillColors: ['#fff'],
            // pointStrokeColors: ['#000'],
            // fillOpacity: 0.6,
            hideHover: 'auto',
            parseTime: false,
            // The name of the data record attribute that contains x-values.
            xkey: 'period',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['order','sales','profit','quantity'],
            // behaveLikeLine: true,
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
        });

        function chart30days() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('admin.dashboard.filter-month')}}",
                method: "POST",
                dataType: "JSON",
                data: {_token},
                success: function (data) {
                    chart.setData(data)
                }
            });
        }


        $('#btn-dashboard-filter').click(function () {
            var _token = $('input[name= "_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            $.ajax({
                url: "{{route('admin.dashboard.filter-by-date')}}",
                method: "POST",
                dataType: "JSON",
                data: {from_date: from_date, to_date: to_date, _token: _token},
                success: function (data) {
                    chart.setData(data);
                }
            });
        });

    });

</script>
@endsection
