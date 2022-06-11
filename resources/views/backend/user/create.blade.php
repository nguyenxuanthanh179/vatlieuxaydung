@extends('backend.layouts.main')

@section('content')
    @if(Auth::check() && Auth::user()->role_id == 3)
        <p class="text-center" style="padding-top: 100px">Tài khoản của bạn không có quyền truy cập vào mục này</p>
    @else
        <section class="content-header">
            <h1>
                Thêm mới tài khoản <a href="{{route('admin.user.index')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Danh Sách</a>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin tài khoản</h3>
                        </div>
                        <form role="form" action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Họ Tên</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ & tên" >
                                    @if ( $errors->has('name') )
                                        <span style="color:red;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập Email">
                                    @if ( $errors->has('email') )
                                        <span style="color:red;">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập password">
                                    @if ( $errors->has('password') )
                                        <span style="color:red;">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" id="avatar" name="avatar" >
                                    @if ( $errors->has('avatar') )
                                        <span style="color:red;">{{ $errors->first('avatar') }}</span>
                                    @endif
                                </div>
                                @if(Auth::user()->role_id == 1)
                                    <div class="form-group">
                                        <label>Chọn Quyền</label>
                                        <select class="form-control" name="role_id">
                                            <option selected disabled>-- Chọn quyền --</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" >{{ $role->name }}</option>
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
                                                <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('role_id') )
                                            <span style="color:red;">{{ $errors->first('role_id') }}</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="checkbox">
                                    <label>
                                        <input checked type="checkbox" value="1" name="is_active"> Kích hoạt tài khoản
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
    @endif
@endsection

