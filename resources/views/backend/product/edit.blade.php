@extends('backend.layouts.main')

@section('content')
    <style>.w-50 { width: 50% }</style>
    <section class="content-header">
        <h1>
            Sửa thông tin sản phẩm <a href="{{route('admin.product.index')}}" class="btn btn-success pull-right"><i
                    class="fa fa-list"></i> Danh Sách</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin sản phẩm</h3>
                    </div>
                    <form role="form" action="{{route('admin.product.update', ['id' => $product->id ])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input value="{{ $product->name }}" type="text" class="form-control" id="name" name="name" required>
                                @if ( $errors->has('name') )
                                    <span style="color:red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="new_image">Thay đổi ảnh sản phẩm</label>
                                <input type="file" id="new_image" name="new_image">
                                @if ( $errors->has('new_image') )
                                    <span style="color:red;">{{ $errors->first('new_image') }}</span>
                                @endif
                                <br>
                                @if ($product->image)
                                    <img src="{{asset($product->image)}}" width="200">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Danh mục sản phẩm</label>
                                        <select class="form-control" name="category_id" required>
                                            <option selected disabled>-- chọn Danh Mục --</option>
                                            @foreach($categories as $category)
                                                <option {{ ($product->category_id == $category->id ? 'selected':'') }} value="{{ $category -> id }}">{{ $category -> name }}</option>
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
                                                <option {{ ($product->vendor_id == $vendor->id ? 'selected':'') }} value="{{ $vendor->id }}">{{ $vendor->name }}</option>
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
                                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                                        @if ( $errors->has('price') )
                                            <span style="color:red;">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sale">Giá khuyến mại (vnđ)</label>
                                        <input type="number" class="form-control" id="sale" name="sale" value="{{ $product->sale }}" required>
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
                                        <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                                        @if ( $errors->has('stock') )
                                            <span style="color:red;">{{ $errors->first('stock') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sku">Mã sản phẩm (SKU)</label>
                                        <input  value="{{ $product->sku }}" type="text" class="form-control" id="sku" name="sku" placeholder="Mã sản phẩm" required>
                                        @if ( $errors->has('sku') )
                                            <span style="color:red;">{{ $errors->first('sku') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <select class="form-control" name="user_id" required>
                                            <option selected disabled> -- Chọn tác giả --</option>
                                            @foreach($users as $user)
                                                <option {{ ($product->user_id == $user->id) ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->name }}</option>
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
                                                <input {{ ($product->is_active) ? 'checked':'' }} type="checkbox" value="1" name="is_active"> <b>Trạng thái</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin: 30px">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <input {{ ($product->is_hot) ? 'checked':'' }} type="checkbox" value="1" name="is_hot" > <b>Sản phẩm Hot</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Tóm tắt</label>
                                <textarea id="editor2" name="summary" class="form-control" rows="10" >{{ $product->summary }}</textarea>
                                @if ( $errors->has('summary') )
                                    <span style="color:red;">{{ $errors->first('summary') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="editor1" >Mô tả</label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" >{{ $product->description }}</textarea>
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

