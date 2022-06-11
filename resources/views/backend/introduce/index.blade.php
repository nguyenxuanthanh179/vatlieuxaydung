@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>Thông tin giới thiệu</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" action="{{route('admin.introduce.update', ['id' => $introduce->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input value="{{$introduce->title}}" type="text" class="form-control" id="title" name="title" placeholder="Nhập tên tiêu đề" required>
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
                                <br>
                                @if ($introduce->image)
                                    <img src="{{asset($introduce->image)}}" alt="" width="250">
                                @endif

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" name="user_id" >
                                            <option selected disabled> -- Chọn tác giả --</option>
                                            @foreach($users as $user)
                                                <option {{ ($introduce->user_id == $user->id) ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('user_id') )
                                            <span style="color:red;">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="margin: 30px;">
                                        <div class="form-group ">
                                            <div class="checkbox ">
                                                <input type="checkbox" value="1" name="is_active" {{ ($introduce->is_active == 1)? 'checked' : '' }}> Trạng thái hiển thị
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Mô tả ngắn</label>
                                <textarea id="editor2" name="summary" class="form-control" rows="3" placeholder="Mô tả ngắn  ..." required >{{$introduce->summary}}</textarea>
                                @if ( $errors->has('summary') )
                                    <span style="color:red;">{{ $errors->first('summary') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="editor1">Mô tả</label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" placeholder="Mô tả ..." required>{{$introduce->description}}</textarea>
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

