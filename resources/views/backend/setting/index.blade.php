@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thông tin cấu hình website
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" action="{{ route('admin.setting.update', ['id' => $setting->id ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="company">Tên Công Ty</label>
                                <input value="{{ $setting->company }}" type="text" class="form-control" id="company"
                                       name="company" placeholder="Nhập tên công ty" required>
                                @if ( $errors->has('company') )
                                    <span style="color:red;">{{ $errors->first('company') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="new_image">Thay đổi Logo</label>
                                <input type="file" id="new_image" name="new_image">
                                @if ( $errors->has('new_image') )
                                    <span style="color:red;">{{ $errors->first('new_image') }}</span>
                                @endif
                                <br>
                                @if ($setting->image)
                                    <img src="{{ asset($setting->image) }}" width="200">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input value="{{ $setting->phone }}" type="text" class="form-control" id="phone"
                                               name="phone" placeholder="Nhập số điện thoại" required>
                                        @if ( $errors->has('phone') )
                                            <span style="color:red;">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hotline">Hotline</label>
                                        <input value="{{ $setting->hotline }}" type="text" class="form-control" id="hotline"
                                               name="hotline" placeholder="Nhập số hotline" required>
                                        @if ( $errors->has('hotline') )
                                            <span style="color:red;">{{ $errors->first('hotline') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input value="{{ $setting->facebook }}" type="text" class="form-control" id="facebook"
                                               name="facebook" placeholder="Nhập địa chỉ facebook" required>
                                        @if ( $errors->has('facebook') )
                                            <span style="color:red;">{{ $errors->first('facebook') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input value="{{ $setting->website }}" type="text" class="form-control" id="website"
                                               name="website" placeholder="Nhập địa chỉ website" required>
                                        @if ( $errors->has('website') )
                                            <span style="color:red;">{{ $errors->first('website') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input value="{{ $setting->email }}" type="text" class="form-control" id="email"
                                               name="email" placeholder="Nhập địa chỉ email" required>
                                        @if ( $errors->has('email') )
                                            <span style="color:red;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" name="user_id" >
                                            <option selected disabled> -- Chọn tác giả --</option>
                                            @foreach($users as $user)
                                                <option {{ ($setting->user_id == $user->id) ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('user_id') )
                                            <span style="color:red;">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input value="{{ $setting->address }}" type="text" class="form-control" id="address"
                                       name="address" placeholder="Nhập địa chỉ" required>
                                @if ( $errors->has('address') )
                                    <span style="color:red;">{{ $errors->first('address') }}</span>
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
