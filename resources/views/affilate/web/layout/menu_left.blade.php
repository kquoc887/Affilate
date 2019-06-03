
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Affilate</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul id="menuleft" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
          <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard   
              </p>
            </a>

          </li>
          <li class="nav-item has-treeview">
          <a href="{{route('saleProFit')}}" class="nav-link">
              <i class="nav-icon fa fa-th"></i>
              <p>
               Sale Profit
              
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Payment
              </p>
            </a>
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