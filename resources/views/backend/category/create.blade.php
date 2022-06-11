@extends('backend.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Thêm mới danh mục <a href="{{route('admin.category.index')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Danh Sách</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin danh mục</h3>
                    </div>
                    <form role="form" action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục">
                                @if ( $errors->has('name') )
                                    <span style="color:red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Danh mục cha</label>
                                        <select class="form-control" name="parent_id" >
                                            <option value="0"> -- Chọn --</option>
                                            @foreach($data as $item)
                                                <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" name="user_id" required>
                                            <option selected disabled> -- Chọn tác giả --</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('user_id') )
                                            <span style="color:red;">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">File</label>
                                <input type="file" id="image" name="image">
                                @if ( $errors->has('image') )
                                    <span style="color:red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_active"> Trạng thái hiển thị
                                </label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tạo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

