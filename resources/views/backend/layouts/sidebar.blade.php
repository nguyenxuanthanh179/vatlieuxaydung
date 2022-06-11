<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image" style="width: 100%; max-width: 50px; height: 50px;">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="{{ route('admin.product.search') }}" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="search" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <a href="{{route('admin.dashboard.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Thống kê</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.category.index')}}">
                    <i class="fa fa-folder-open-o"></i>
                    <span>QL Danh Mục</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.product.index') }}">
                    <i class=" fa fa-database"></i>
                    <span>QL Sản Phẩm</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.order.index')}}">
                    <i class="fa fa-cart-plus"></i>
                    <span>QL Đơn Hàng</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.banner.index')}}">
                    <i class="fa fa-photo"></i>
                    <span>QL Quảng Cáo</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.project.index')}}">
                    <i class="fa fa-align-justify"></i>
                    <span>QL Dự Án</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.article.index')}}">
                    <i class="fa  fa-newspaper-o"></i>
                    <span> QL Tin Tức</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.contact.index')}}">
                    <i class="fa fa-compress"></i>
                    <span>QL Liên Hệ</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.vendor.index')}}">
                    <i class="fa fa-address-card"></i>
                    <span>QL Nhà Cung Cấp</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.customer.customer')}}">
                    <i class="fa fa-users"></i>
                    <span>QL Khách hàng</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.user.index')}}">
                    <i class="fa fa-user"></i>
                    <span>QL Tài Khoản</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.introduce.index')}}">
                    <i class="fa fa-info-circle"></i>
                    <span> Giới Thiệu</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.setting.index')}}">
                    <i class="fa fa-gear"></i>
                    <span> Cấu hình </span>
                </a>
            </li>
        </ul>
    </section>
</aside>
