<form action="postLogin" method="POST" id='frmLogin'>
    @csrf
    <div class="card">
        <div class="card-header text-center">Vui lòng điền thông tin để đăng nhập</div>
        <div class="card-body">
        @if (Session::has('message'))
            <p class="alert {{Session::get('text-alert')}}">
                {{Session::get('message')}}
            </p>
        @endif
        <div class="form-group">
            <label for="">Email <span class="text-danger" id ="email_error"></span></label>
            <input type="email" name="email"  class="form-control" placeholder="Vui lòng nhập email" aria-describedby="helpId" >
        </div>
        <div class="form-group">
            <label for="password">Password <span class="text-danger" id ="password_error"></span></label>
            <input type="password" name="password"  class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
        </div>
        <div class="chkRemember">
            <label for="remmber">Ghi nhớ mật khẩu</label>
            <input type="checkbox" name="chkRemember" id="chkRemember">
        </div>
        <div class="form-group">
            <a href="#" data-toggle="modal" data-target="#myModal">Bấm vào đây để lấy lại mật khẩu</a>
        </div>
        <div class="form-group text-center">
            <button type="button" class="btn btn-primary" id="login">Đăng nhập</button>
        </div>
        </div>
    </div>
</form>

@include('affilate.modal.modal_forget_pass')