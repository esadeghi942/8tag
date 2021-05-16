<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
{{-- <a href="index3.html" class="brand-link">
     <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
     <span class="brand-text font-weight-light">پنل مدیریت</span>
 </a>--}}

<!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('user_image\\').Auth::user()->user_image}}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#">{{ Auth::user()->fname .'  '. Auth::user()->lname }}</a>
                    <a href="{{route('logout')}}" class="logout"><i class="fa fa-power-off"></i></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p>میز کار</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-address-card-o"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.user.index')}}" class="nav-link">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p class="text">لیست کاربران</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.user.create')}}" class="nav-link">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p class="text">ثبت کاربر جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.leavement.index')}}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>مرخصی</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-address-card-o"></i>
                            <p>
                                شاخه کاری
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.role.index')}}" class="nav-link">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p class="text">لیست</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.role.create')}}" class="nav-link">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p class="text">ثبت جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>