
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('publisher.dashboard')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
        
        @if (Auth::user()->role == 1)
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-bell-o"></i>
            <span class="badge badge-warning navbar-badge">{{count(Auth::user()->unreadNotifications)}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{count(Auth::user()->unreadNotifications)}} Notifications</span>
                @foreach (Auth::user()->unreadNotifications as $notification)
                <div class="dropdown-divider"></div>
                    <button type="button" id="clickNotifi" class="btn btn-default">
                    <i>Đơn hàng mới-{{'Mã đơn hàng:' .$notification->data['Order_ID']}}</i>
                    <span class="float-right text-muted text-sm">{{$notification->data['Created_at']}}</span>
                    <input type="hidden" id="hidden-read" value="{{$notification->id}}">
                    {{-- <input type="hidden" id="hidden-id" value="{{Auth::user()->user_id}}"> --}}
                </button>            
                @endforeach
            </div> 
        </li> 
        @endif
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="{{route('getLogout')}}">Thoát</a></li>
    </ul>
</nav>
