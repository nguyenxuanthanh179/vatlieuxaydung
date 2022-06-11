@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Sửa thông tin dự án <a href="{{route('admin.project.index')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Danh Sách</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin dự án</h3>
                    </div>
                    <form role="form" action="{{route('admin.project.update', ['id' => $project->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input value="{{$project->title}}" type="text" class="form-control" id="title" name="title" placeholder="Nhập tên tiêu đề" required>
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
                                <img src="{{asset($project->image)}}" alt="" width="250">
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" name="user_id" required>
                                            <option selected disabled> -- Chọn tác giả --</option>
                                            @foreach($users as $user)
                                                <option {{ ($project->user_id == $user->id) ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('user_id') )
                                            <span style="color:red;">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin: 30px;">
                                        <div class="form-group ">
                                            <div class="checkbox ">
                                                <label>
                                                    <input type="checkbox" value="1" name="is_new" {{ ($project->is_new == 1)? 'checked' : '' }}> Dự án mới
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin: 30px;">
                                        <div class="form-group ">
                                            <div class="checkbox ">
                                                <label>
                                                    <input type="checkbox" value="1" name="is_active" {{ ($project->is_active == 1)? 'checked' : '' }}> Trạng thái hiển thị
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Mô tả ngắn</label>
                                <textarea id="editor2" name="summary" class="form-control" rows="3" placeholder="Mô tả ngắn  ..." required>{{$project->summary}}</textarea>
                                @if ( $errors->has('summary') )
                                    <span style="color:red;">{{ $errors->first('summary') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="editor1">Mô tả</label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" placeholder="Enter ..." required>{{$project->description}}</textarea>
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

