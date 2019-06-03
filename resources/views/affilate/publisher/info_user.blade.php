@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thông tin cá nhân</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thông tin cá nhân</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="table-responsive col-5">
            <table class="table text-center">
                <tr>
                    <td colspan="2">
                        <img src="{{asset('img/'. Auth::user()->avatar)}}" id="img-avatar" class="img-circle elevation-2 ml-5" alt="avatar-old">
                    </td>
                </tr>
                <tr>
                    <td>Họ và tên đệm</td>
                    <td>{{Auth::user()->lastname}}</td>
                </tr>
                <tr>
                    <td>Tên</td>
                    <td>{{Auth::user()->firstname}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{Auth::user()->email}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>{{Auth::user()->address}}</td>
                </tr>
                <tr>
                    <td>Điện thoại</td>
                    <td>{{Auth::user()->phone}}</td>
                </tr>
                <tr>
                    <td>Đường dẫn web</td>
                    <td>{{Auth::user()->uri}}</td>
                </tr>
                <tr>
                    <td>Ngày đăng ký</td>
                    <td>{{date_format(Auth::user()->created_at, 'd/m/Y')}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection