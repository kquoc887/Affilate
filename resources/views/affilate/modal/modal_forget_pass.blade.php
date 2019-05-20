<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center">Quên mật khẩu</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div>

      </div>
      <form action='{{route('reset-password')}}' method="POST" id="frmForgotPass">
          @csrf
          <div class="bs-example-bg-classes">
              <p class="bg-secondary text-white">Nếu bạn quên mật khẩu, vui lòng nhập địa chỉ e-mail của bạn mà bạn đã đăng ký từ trước.
              <br/>
              Đường link hướng dẫn thay đổi pass sẽ được gửi đến email của bạn !
              </p>
          </div>
        <div class="form-group">
          <label for="email">Nhập Email (*) <span class="text-danger" id="email_error"></span></label>
          <input type="email" name="email"  class="form-control" placeholder="Vui lòng nhập email" aria-describedby="helpId">
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Yêu cầu lấy lại</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
