<form action="#" method="POST" id='frmLogin'>
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
        <a href="#">Bấm vào đây để lấy lại mật khẩu</a>
        <button type="submit" class="btn btn-primary offset-md-4">Đăng nhập</button>
        </div>
    </div>
</form>