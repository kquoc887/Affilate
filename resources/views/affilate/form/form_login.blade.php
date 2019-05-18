<form action="postLogin" method="POST" id='frmLogin'>
    @if(session('success'))
    <div class="alert alert-success " role="alert">
            {{session('success')}}
    </div>
    @endif
    @csrf
    <div class="card">
        <div class="card-header text-center">Vui lòng điền thông tin để đăng nhập</div>
        <div class="card-body">
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email"  class="form-control" placeholder="Vui lòng nhập email" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password"  class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
        </div>
        <div class="chkRemember">
            <label for="remmber">Ghi nhớ mật khẩu</label>
            <input type="checkbox" name="chkRe" id="chkRe">
        </div>
        <div class="form-group">
            <a href="#" data-toggle="modal" data-target="#myModal">Bấm vào đây để lấy lại mật khẩu</a>
        </div>
        <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </div>
    </div>
</form>

@include('affilate.modal.modal_forget_pass')