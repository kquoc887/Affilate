<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 806px;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Affilate</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
    
            <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-info"></i>
                        <p>
                            Dashboard
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="dashboard" class="nav-link active">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>General infomation </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                Campaign
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('advertiser')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Advertisers</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-diamond"></i>
                        <p>
                            Benefit
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('sale-profit')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Sale-Profit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>