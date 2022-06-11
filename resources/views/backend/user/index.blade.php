@extends('backend.layouts.main')

@section('content')
    @if(Auth::check() && ( Auth::user()->role_id == 1))
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2>Danh sách tài khoản</h2>
                </div>
                <div class="col-md-6">
                    <div style="margin-top: 20px">
                        <a href="{{route('admin.user.create')}}" class="btn btn-success pull-right "><i class="fa fa-list"></i> Thêm mới</a>
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
                                    <th>Họ & Tên</th>
                                    <th>Email</th>
                                    <th>Hình ảnh</th>
                                    <th>Phân Quyền</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($admin as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{$key+1}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                    @if ($item->avatar) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{asset($item->avatar)}}" width="70">
                                        @endif
                                    </td>
                                    <td>{{@$item->role->name}}</td>
                                    <td>{{ ($item->is_active == 1) ? 'Kích hoạt' : 'Chưa kích hoạt' }}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.user.edit', ['id' => $item->id])}}" class="btn bg-purple btn-flat margin">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <button onclick="deleteItem('user', {{$item->id }})" class="btn btn-danger">
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

    @elseif(Auth::check() && ( Auth::user()->role_id == 2))

        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2>Danh sách tài khoản</h2>
                </div>
                <div class="col-md-6">
                    <div style="margin-top: 20px">
                        <a href="{{route('admin.user.create')}}" class="btn btn-success pull-right "><i class="fa fa-list"></i> Thêm mới</a>
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
                                    <th>Họ & Tên</th>
                                    <th>Email</th>
                                    <th>Hình ảnh</th>
                                    <th>Phân Quyền</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $key => $item)
                                    <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                        <td>{{$key+1}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                        @if ($item->avatar) <!-- Kiểm tra hình ảnh tồn tại -->
                                            <img src="{{asset($item->avatar)}}" width="70">
                                            @endif
                                        </td>
                                        <td>{{@$item->role->name}}</td>
                                        <td>{{ ($item->is_active == 1) ? 'Kích hoạt' : 'Chưa kích hoạt' }}</td>
                                        <td class="text-center">
                                            <a href="{{route('admin.user.edit', ['id' => $item->id])}}" class="btn bg-purple btn-flat margin">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <button onclick="deleteItem('user', {{$item->id }})" class="btn btn-danger">
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

