@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2>Danh sách liên hệ</h2>
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
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Nội dung liên hệ</th>
                                <th class="text-center">Hàng động </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contact as $key => $item)
                            <tr class="item-{{$item->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->email}}</td>
                                <td style="width: 350px; height: auto">{!! $item->content !!}</td>
                                <td class="text-center">
                                    <button onclick="deleteItem('contact', {{$item->id }})" class="btn btn-danger">
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


