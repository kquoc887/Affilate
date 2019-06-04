@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Chỉnh sửa thông tin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa thông tin</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
       <div class="row">
        <form action="{{route('publisher.postEditProfile')}}" class="col-4 ml-3" method="POST" id="frmUpdateProfile" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              {{-- <label for="avatar-old">Ảnh đại điện</label> --}}
                <img src="{{asset('img/'. Auth::user()->avatar)}}" id="img-avatar" class="img-circle elevation-2 ml-5" alt="avatar-old">
            </div>
            <div class="form-group">
              <label for="avater-new">Thay đổi ảnh đại diện</label>
              <input type="file" class="form-control-file" name="fileAvatar"  aria-describedby="fileHelpId">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Vui lòng nhập email" value={{$user->email}} aria-describedby="helpId">
            </div>
            @if($user->role == 1)
                <div class="form-group">
                    <label>Tên Công Ty</label>
                    <input type="text" class="form-control" value="{{$name_company}}" disabled aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label >Phần trăm hoa hồng:</label>
                    <select name="commission">
                        <option value="0.1">1%</option>
                        <option value="0.2">2%</option>
                        <option value="0.3">3%</option>
                        <option value="0.4">4%</option>
                        <option value="0.5">5%</option>
                        <option value="0.6">6%</option>
                        <option value="0.7">7%</option>
                        <option value="0.8">8%</option>
                        <option value="0.9">9%</option>
                        <option value="1">10%</option>
                    </select>
                </div>
            @endif
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password"  class="form-control" placeholder="Vui lòng nhập mật khẩu" disabled aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="repass">Nhập lại mật khẩu</label>
                <input type="password" name="repass"  class="form-control" placeholder="Vui lòng nhập lại mật khẩu" disabled aria-describedby="helpId">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"  id="ckcChangePass" > Đổi mật khẩu
                </label>
            </div>
            <div class="form-group">
              <label for="lastname">Họ và tên đệm</label>
            <input type="text" name="lastname" class="form-control" placeholder="Vui lòng nhập họ và tên đệm" value="{{$user->lastname}}" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="firstname">Tên</label>
            <input type="text" name="firstname" class="form-control" placeholder="Vui lòng nhập tên" value="{{$user->firstname}}" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" class="form-control" placeholder="" value="{{$user->address}}" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="phone">Điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder="" value="{{$user->phone}}" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="uri">Đường dẫn Website</label>
                <input type="text" name="uri" class="form-control" placeholder="" value="{{$user->uri}}" aria-describedby="helpId">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
       </div>
    </div>
</div>
@endsection