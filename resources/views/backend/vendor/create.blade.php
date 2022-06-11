@extends('backend.layouts.main')

@section('content')
    @if(Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
    <section class="content-header">
        <h1>
            Thêm mới nhà cung cấp
            <a href="{{route('admin.vendor.index')}}" class="btn btn-success pull-right"><i class="fa fa-list"></i> Danh Sách</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin nhà cung cấp</h3>
                    </div>
                    <form role="form" action="{{ route('admin.vendor.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Tên nhà cung cấp</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên nhà cung cấp">
                                @if ( $errors->has('name') )
                                    <span style="color:red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh</label>
                                <input type="file" id="image" name="image">
                                @if ( $errors->has('image') )
                                    <span style="color:red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="website">Website</label>
                                       <input type="text" class="form-control" id="website" name="website" placeholder="Website">
                                       @if ( $errors->has('website') )
                                           <span style="color:red;">{{ $errors->first('website') }}</span>
                                       @endif
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="facebook">Facebook</label>
                                       <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" >
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
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        @if ( $errors->has('email') )
                                            <span style="color:red;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hotline">Hotline</label>
                                        <input  type="text" class="form-control" id="hotline" name="hotline" placeholder="Hotline">
                                        @if ( $errors->has('hotline') )
                                            <span style="color:red;">{{ $errors->first('hotline') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Đại chỉ" >
                                @if ( $errors->has('address') )
                                    <span style="color:red;">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" name="user_id">
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
                               <div class="col-md-6">
                                   <div style="margin: 30px">
                                       <div class="checkbox">
                                           <input type="checkbox" value="1" name="is_active"> Trạng thái hiển thị
                                       </div>
                                   </div>
                               </div>
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
    @else
        <p class="text-center" style="padding-top: 100px">Tài khoản của bạn không có quyền truy cập vào mục này</p>
    @endif
@endsection

