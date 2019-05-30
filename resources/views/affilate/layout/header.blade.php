
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('publisher.dashboard')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
        @if (isset($new_order))
        
        <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge">{{count($new_order)}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{count($new_order)}} Notifications</span>
                    @foreach ($new_order as $item)
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                    {{-- <i class="fa fa-envelope mr-2"></i>  --}}
                    <i>{{$item->fullname}}-{{'Mã đơn hàng:' .$item->order_id}}</i>
                    <span class="float-right text-muted text-sm">{{$item->created_at}}</span>
                    </a>
                   
                   
            
                    @endforeach
                </div>
        </li>
        @endif
    </ul>
    <ul class="navbar-nav ml-auto">
        
        <li class="nav-item"><a href="{{route('getLogout')}}">Thoát</a></li>
       
    </ul>
</nav>