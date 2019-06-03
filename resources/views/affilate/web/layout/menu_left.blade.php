
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
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
            <img src="{{asset('img/'. Auth::user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{Auth::user()->lastname . ' ' . Auth::user()->firstname}}</a>
        </div>
    </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul id="menuleft" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
          <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                  Tình Hình Chung
              </p>
            </a>

          </li>
          <li class="nav-item has-treeview">
          <a href="{{route('saleProFit')}}" class="nav-link">
            <i class="nav-icon fa fa-diamond"></i>
              <p>
                  Lợi Nhuận              
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-calculator"></i>
                  <p>Hoa Hồng</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user-secret"></i>
                <p>
                   Thông Tin Cá Nhân
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('publisher.editProfile')}}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Chỉnh sửa thông tin</p>
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
  @section('script')
    <script>
        $(document).ready(function(){
          var header = document.getElementById("menuleft");
          var item = header.getElementsByClassName("nav-link");
          for (var i = 0; i < item.length; i++) {
              item[i].addEventListener("click", function() {
              var current = document.getElementsByClassName("active");
              current[0].className = current[0].className.replace(" active", "");
              this.className += " active";
              });
            }
        });

    </script>
  @endsection