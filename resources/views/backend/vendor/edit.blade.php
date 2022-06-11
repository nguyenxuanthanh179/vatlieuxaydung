@extends('backend.layouts.main')

@section('content')
    @if(Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
    <section class="content-header">
        <h1>
            Sửa thông tin nhà cung cấp
            <a href="{{route('admin.vendor.index')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Danh Sách</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin tin tức</h3>
                    </div>
                    <form role="form" action="{{route('admin.vendor.update', ['id' => $data->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Tên nhà cung cấp</label>
                                <input value="{{$data->name}}" type="text" class="form-control" id="name" name="name" placeholder="Nhập tên nhà cung cấp" required>
                                @if ( $errors->has('name') )
                                    <span style="color:red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="new_image">Thay đổi ảnh</label>
                                <input type="file" id="new_image" name="new_image">
                                @if ( $errors->has('new_image') )
                                    <span style="color:red;">{{ $errors->first('new_image') }}</span>
                                @endif
                                <br>
                                <img src="{{asset($data->image)}}" alt="" width="250">
                            </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="website">Website</label>
                                       <input value="{{ $data->website }}" type="text" class="form-control" id="website" name="website" placeholder="Website" required>
                                       @if ( $errors->has('website') )
                                           <span style="color:red;">{{ $errors->first('website') }}</span>
                                       @endif
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="facebook">Facebook</label>
                                       <input value="{{ $data->facebook }}" type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" required>
                                       @if ( $errors->has('facebook') )
                                           <span style="color:red;">{{ $errors->first('facebook') }}</span>
                                       @endif
                                   </div>
                               </div>
                           </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input value="{{ $data->email }}" type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                        @if ( $errors->has('email') )
                                            <span style="color:red;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hotline">Hotline</label>
                                        <input value="{{ $data->hotline }}" type="text" class="form-control" id="hotline" name="hotline" placeholder="Hotline" required>
                                        @if ( $errors->has('hotline') )
                                            <span style="color:red;">{{ $errors->first('hotline') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input value="{{ $data->address }}" type="text" class="form-control" id="address" name="address" placeholder="Đại chỉ" required>
                                @if ( $errors->has('address') )
                                    <span style="color:red;">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div style="margin: 30px;">
                                        <div class="form-group ">
                                            <div class="checkbox ">
                                                <input type="checkbox" value="1" name="is_active" {{ ($data->is_active == 1)? 'checked' : '' }}> Trạng thái hiển thị
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    @else
        <p class="text-center" style="padding-top: 100px">Tài khoản của bạn không có quyền truy cập vào mục này</p>
    @endif
@endsection

