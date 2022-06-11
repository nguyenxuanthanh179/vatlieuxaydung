@extends('backend.layouts.main')
@section('content')
    <style>tr td:first-child {max-width: 250px} .price {color: red}</style>
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Danh sách đơn hàng</h2>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">TT</th>
                                    <th class="text-center">Ngày đặt</th>
                                    <th class="text-center">Mã ĐH</th>
                                    <th style="max-with:200px">Trạng thái</th>
                                    <th>Người đặt hàng</th>
                                    <th>SĐT</th>
                                    <th>Email</th>
                                    <th>Tổng tiền</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($orders as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ date('d/m/Y H:i', strtotime($item->updated_at)) }}</td>
                                    <td class="text-center">{{ $item->code }}</td>
                                    <td>
                                        @if ($item->order_status_id == 1)
                                            <span class="label label-info">Mới</span>
                                        @elseif ($item->order_status_id == 3)
                                            <span class="label label-success">Hoàn thành</span>
                                        @else
                                            <span class="label label-danger">Hủy</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->fullname }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="price">{{ number_format($item->total + 25000,0,",",".") }}đ</td>
                                    <td>
                                        <a href="{{route('admin.order.edit', ['id'=> $item->id ])}}">
                                            <span title="Edit" type="button" class="btn btn-flat btn-primary">Chi tiết</span>
                                        </a>&nbsp;
                                        <button onclick="deleteItem('order', {{$item->id }})" class="btn btn-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

