@extends('backend.layouts.main')

@section('content')

        <section class="content-header">
            <h1>
                Sửa thông tin tài khoản
                @if(Auth::check() && ( Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
                    <a href="{{route('admin.user.index')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Danh Sách</a>
                @endif
            </h1>
        </section>

        <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border d-flex">
                        <h3 class="box-title">Thông tin tài khoản</h3>
                        @if(session('msg'))
                            <span style="padding-left:20px;color: #2cad18; font-weight: 600"><i class="fa fa-check"></i></i>{{ session('msg') }}</span>
                        @endif
                    </div>
                    <form role="form" action="{{route('admin.user.update', ['id' => $user->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="form-group">
                                <label for="name">Họ Tên</label>
                                <input value="{{ $user->name }}" type="text" class="form-control" id="name" name="name" placeholder="Nhập họ & tên" required>
                                @if ( $errors->has('name') )
                                    <span style="color:red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            @if(Auth::user()->role_id == 1)
                                <div class="form-group">
                                    <label>Chọn Quyền</label>
                                    <select class="form-control" name="role_id">
                                        <option selected disabled>-- Chọn quyền --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ ($user->role_id == $role->id) ? 'selected' : '' }} >{{ $role->name }}</option>
                                    @endforeach
                                    </select>
                                    @if ( $errors->has('role_id') )
                                        <span style="color:red;">{{ $errors->first('role_id') }}</span>
                                    @endif
                                </div>
                            @endif
                            @if( Auth::user()->role_id == 2)
                                <div class="form-group">
                                    <label>Chọn Quyền</label>
                                    <select class="form-control" name="role_id">
                                        <option selected disabled>-- Chọn quyền --</option>
                                    @foreach($role_user as $role)
                                        <option value="{{ $role->id }}" {{ ($user->role_id == $role->id) ? 'selected' : '' }} >{{ $role->name }}</option>
                                    @endforeach
                                    </select>
                                    @if ( $errors->has('role_id') )
                                        <span style="color:red;">{{ $errors->first('role_id') }}</span>
                                    @endif
                                </div>
                            @endif
                            @if(Auth::user()->role_id == 3)
                                <div class="form-group">
                                    <label>Chọn Quyền</label>
                                    <select class="form-control" name="role_id">
                                        <option selected value="3" >Nhân viên</option>
                                    </select>
                                    @if ( $errors->has('role_id') )
                                        <span style="color:red;">{{ $errors->first('role_id') }}</span>
                                    @endif
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input value="{{ $user->email }}" type="email" class="form-control" id="email" name="email" placeholder="Nhập Email" required>
                                @if ( $errors->has('email') )
                                    <span style="color:red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="new_password" style="color: #9c3328">** Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" >
                            </div>
                            <div class="form-group">
                                <label for="new_avatar" style="color: #9c3328">** Thay đổi ảnh đại diện</label>
                                <input type="file" id="new_avatar" name="new_avatar" >
                                @if ( $errors->has('new_avatar') )
                                    <span style="color:red;">{{ $errors->first('new_avatar') }}</span>
                                @endif
                                <br>
                                <img src="{{ asset($user->avatar) }}" width="250">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_active" {{ ($user->is_active == 1) ? 'checked' : '' }}> Kích hoạt tài khoản
                                </label>
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

