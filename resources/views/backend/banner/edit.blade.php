@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Sửa thông tin quảng cáo<a href="{{route('admin.banner.index')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Danh Sách</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin hình ảnh</h3>
                    </div>
                    <form role="form" action="{{route('admin.banner.update', ['id' => $data->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input value="{{$data->title}}" type="text" class="form-control" id="title" name="title" placeholder="Nhập tên tiêu đề" required>
                                @if ( $errors->has('title') )
                                    <span style="color:red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="new_image">Thay đổi ảnh</label>
                                <input type="file" id="new_image" name="new_image">
                                @if ( $errors->has('new_image') )
                                    <span style="color:red;">{{ $errors->first('new_image') }}</span>
                                @endif
                                <!-- Hiển thị ảnh cũ -->
                                <br>
                                <img src="{{asset($data->image)}}" alt="" width="250">
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" name="user_id" required>
                                            <option selected disabled> -- Chọn tác giả --</option>
                                            @foreach($users as $user)
                                                <option {{ ($data->user_id == $user->id) ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('user_id') )
                                            <span style="color:red;">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Loại</label>
                                        <select class="form-control" name="type">
                                            <option value="1" {{ ($data->type == 1)? 'selected' : '' }}>Slide</option>
                                            <option value="2" {{ ($data->type == 2)? 'selected' : '' }}>Image</option>
                                        </select>
                                        @if ( $errors->has('type') )
                                            <span style="color:red;">{{ $errors->first('type') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin: 30px;">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <input type="checkbox" value="1" name="is_active" {{ ($data->is_active == 1)? 'checked' : '' }}>
                                                Trạng thái hiển thị
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Mô tả</label>
                                <textarea id="editor2" name="description" class="form-control" rows="10" placeholder="Enter ...">{{$data->description}}</textarea>
                                @if ( $errors->has('description') )
                                    <span style="color:red;">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

