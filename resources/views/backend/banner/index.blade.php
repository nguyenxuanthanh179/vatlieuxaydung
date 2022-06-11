@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Danh sách quảng cáo</h2>
            </div>
            <div class="col-md-6">
                <div style="margin-top: 20px">
                    <a href="{{route('admin.banner.create')}}" class="btn btn-success pull-right "><i class="fa fa-list"></i> Thêm mới</a>
                </div>
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
                                <th>TT</th>
                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Tác giả</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Hàng động </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                            <tr class="item-{{$item->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{asset($item->image)}}" alt="" width="50" height="50">
                                    @endif
                                </td>
                                <td>{{@$item->user->name}}</td>
                                <td>{{ ($item->type == 1 ) ? 'Slider' : 'Hình ảnh'}}</td>
                                <td>{{ ($item->is_active ==1) ? 'Hiển thị' : 'Ẩn' }}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.banner.edit', ['id' => $item->id])}}" class="btn bg-purple btn-flat margin">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <button onclick="deleteItem('banner', {{$item->id }})" class="btn btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

