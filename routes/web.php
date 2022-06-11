<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//trang chủ
Route::get('/', 'ShopController@index')->name('shop.index');

//404
Route::get('/404', 'ShopController@notfound')->name('shop.notfound');

//liên hệ
Route::get('/lien-he', 'ShopController@contact')->name('shop.contact');
Route::post('/lien-he', 'ShopController@postContact')->name('shop.postContact');

//sản phẩm
Route::get('/danh-muc', 'ShopController@product')->name('shop.product');

//danh mục
Route::get('/danh-muc/{slug}', 'ShopController@category')->name('shop.category');

//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{slug}', 'ShopController@ProductDetails')->name('shop.ProductDetails');
//Bình luận
Route::post('/chi-tiet-san-pham/{slug}', 'ShopController@postComment')->name('shop.postComment');

//giỏ hàng
Route::get('/gio-hang', 'CartController@cart')->name('shop.cart');

// Thêm sản phẩm vào giỏ hàng
Route::get('/gio-hang/them-sp-vao-gio-hang/{product_id}', 'CartController@addToCart')->name('shop.cart.add-to-cart');
Route::post('/gio-hang/cap-nhat-so-luong-sp-sp', 'CartController@updateCart')->name('shop.update_cart_quantity');

// Xóa SP khỏi giỏ hàng
Route::get('/gio-hang/xoa-sp-gio-hang/{id}', 'CartController@removeToCart')->name('shop.cart.remove-to-cart');

// Cập nhật giỏ hàng
Route::get('/gio-hang/cap-nhat-so-luong-sp', 'CartController@updateToCart')->name('shop.cart.update-to-cart');

// Hủy đơn đặt hàng
Route::get('/gio-hang/huy-don-hang', 'CartController@destroy')->name('shop.cart.destroy');

//thanh toán
Route::get('/dat-hang', 'CartController@order')->name('shop.cart.order');
Route::post('/dat-hang', 'CartController@postOrder')->name('shop.cart.postOrder');
Route::get('/dat-hang/hoan-tat-dat-hang', 'CartController@completedOrder')->name('shop.cart.completedOrder');

//tin tức
Route::get('/tin-tuc', 'ShopController@blog')->name('shop.blog');
//chi tiết blog
Route::get('/chi-tiet-blog/{slug}', 'ShopController@blogDetails')->name('shop.blogDetails');

//dự án
Route::get('/du-an', 'ShopController@project')->name('shop.project');
//chi tiết dự án
Route::get('/chi-tiet-du-an/{slug}', 'ShopController@projectDetails')->name('shop.projectDetails');

//giói thiệu
Route::get('/gioi-thieu', 'ShopController@aboutUs')->name('shop.aboutUs');

//tìm kiếm
Route::get('/tim-kiem', 'ShopController@search')->name('shop.search');

//Đăng ky - đăng nhập
Route::get('/dang-nhap', 'ShopController@login')->name('shop.login');
Route::post('/dang-ky', 'CustomerController@postRegister')->name('shop.postRegister');

Route::post('/dang-nhap', 'CustomerController@postLogin')->name('shop.postLogin');
Route::get('/dang-xuat', 'CustomerController@logout')->name('shop.logout');

//tài khoản
Route::get('/tai-khoan', 'CustomerController@myAccount')->name('shop.myAccount');
Route::get('/tai-khoan/chi-tiet-don-hang/{id}', 'CustomerController@orderDetails')->name('shop.orderDetails');
Route::post('/tai-khoan/doi-mat-khau/{id}', 'CustomerController@reset')->name('customer.reset');
Route::resource('customer', 'CustomerController');

// ================ Quản trị ===================
Route::get('/admin/login', 'AdminController@login')->name('admin.login');
Route::post('/admin/login', 'AdminController@postLogin')->name('admin.postLogin');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

// Gom nhom route
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware'=>'checkLogin'],function () {
    Route::resource('banner', 'BannerController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('vendor', 'VendorController');
    Route::resource('setting', 'SettingController');
    Route::resource('introduce', 'IntroduceController');
    Route::resource('contact', 'ContactController');
    Route::resource('user', 'UserController');
    Route::resource('article','ArticleController');
    Route::resource('project','ProjectController');
    Route::resource('dashboard','DashboardController');
    Route::resource('customer', 'CustomerController');
    Route::post('/filter-by-date','DashboardController@filter_by_date')->name('dashboard.filter-by-date');
    Route::post('/filter-month','DashboardController@filter_month')->name('dashboard.filter-month');
    Route::get('/customer', 'CustomerController@index')->name('customer.customer');
    Route::get('/search', 'ProductController@search')->name('product.search');

    Route::resource('order', 'OrderController');
});

