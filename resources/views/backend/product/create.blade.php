@extends('backend.layouts.main')

@section('content')
    <style>.w-50 { width: 50% }</style>

    <section class="content-header">
        <h1>
            Thêm mới sản phẩm <a href="{{route('admin.product.index')}}" class="btn btn-flat btn-success pull-right ">
                <i class="fa fa-list"></i> Danh Sách </a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin sản phẩm</h3>
                    </div>
                    <form role="form" action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên sản phẩm" required>
                                @if ( $errors->has('name') )
                                    <span style="color:red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh sản phẩm</label>
                                <input type="file" id="image" name="image">
                                @if ( $errors->has('image') )
                                    <span style="color:red;">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Danh mục sản phẩm</label>
                                        <select class="form-control" name="category_id" required>
                                            <option selected disabled>-- chọn Danh Mục --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('category_id') )
                                            <span style="color:red;">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nhà cung cấp</label>
                                        <select class="form-control" name="vendor_id" required>
                                            <option selected disabled>-- chọn NCC --</option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{ $vendor -> id }}">{{ $vendor -> name }}</option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('vendor_id') )
                                            <span style="color:red;">{{ $errors->first('vendor_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Giá gốc (vnđ)</label>
                                        <input type="number" class="form-control" id="price" name="price" value="0" required>
                                    </div>
                                    @if ( $errors->has('price') )
                                        <span style="color:red;">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sale">Giá khuyến mại (vnđ)</label>
                                        <input type="number" class="form-control" id="sale" name="sale" value="0" required>
                                        @if ( $errors->has('sale') )
                                            <span style="color:red;">{{ $errors->first('sale') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Số lượng</label>
                                        <input type="number" class="form-control" id="stock" name="stock" value="1" min="1" required>
                                        @if ( $errors->has('stock') )
                                            <span style="color:red;">{{ $errors->first('stock') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sku">Mã sản phẩm (SKU)</label>
                                        <input type="text" class="form-control" id="sku" name="sku" placeholder="Mã sản phẩm" required>
                                        @if ( $errors->has('sku') )
                                            <span style="color:red;">{{ $errors->first('sku') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                               <div class="col-md-4 ">
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
                               <div class="col-md-4">
                                   <div style="margin: 30px">
                                       <div class="form-group">
                                           <div class="checkbox">
                                               <input type="checkbox" value="1" name="is_active"> <b>Trạng thái hiển thị</b>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div style="margin: 30px">
                                       <div class="form-group">
                                           <div class="checkbox">
                                               <input type="checkbox" value="1" name="is_hot"> <b>Sản phẩm Hot</b>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                            <div class="form-group">
                                <label for="editor2">Mô tả ngắn</label>
                                <textarea id="editor2" name="summary" class="form-control" rows="10" placeholder="Mô tả ngắn" ></textarea>
                                @if ( $errors->has('summary') )
                                    <span style="color:red;">{{ $errors->first('summary') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="editor1">Mô tả chi tiết</label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" placeholder="Mô tả chi tiết"></textarea>
                                @if ( $errors->has('description') )
                                    <span style="color:red;">{{ $errors->first('description') }}</span>
                                @endif
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

