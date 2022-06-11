@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Danh sách tài khoản khách hàng</h2>
            </div>
        </div>
    </section>
    <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>TT</th>
                                    <th>Họ & Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Phân Quyền</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer as $key => $item)
                                    <tr class="item-{{$item->id}}"> <!-- Thêm Class Cho Dòng -->
                                        <td>{{$key+1}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{@$item->role->name}}</td>
                                        <td>{{ ($item->is_active == 1) ? 'Kích hoạt' : 'Chưa kích hoạt' }}</td>
                                        <td class="text-center">
                                            <button onclick="deleteItem('customer', {{$item->id }})" class="btn btn-danger">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

