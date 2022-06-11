@extends('backend.layouts.main')

@section('content')
    @if(Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Danh sách nhà cung cấp</h2>
            </div>
            <div class="col-md-6">
                <div style="margin-top: 20px">
                    <a href="{{route('admin.vendor.create')}}" class="btn btn-success pull-right "><i class="fa fa-list"></i> Thêm mới</a>
                </div>
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
                                    <th>Tên NCC</th>
                                    <th>Hình ảnh</th>
                                    <th>Website</th>
                                    <th>Facebook</th>
                                    <th>Email</th>
                                    <th>Hotline</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hàng động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $item)
                                <tr class="item-{{$item->id}}">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        @if($item->image)
                                            <img src="{{asset($item->image)}}" alt="" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>{{$item->website}}</td>
                                    <td>{{$item->facebook}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->hotline}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{ ($item->is_active ==1) ? 'Hiển thị' : 'Ẩn' }}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.vendor.edit', ['id' => $item->id])}}" class="btn bg-purple btn-flat margin">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <button onclick="deleteItem('vendor', {{$item->id }})" class="btn btn-danger">
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
    @else
        <p class="text-center" style="padding-top: 100px">Tài khoản của bạn không có quyền truy cập vào mục này</p>
    @endif
@endsection
