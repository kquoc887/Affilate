<form action="postSignUp" method="POST" id='frmRegisterPub' name="frmRegisterPub">
    @csrf
    <div class="card">
        <div class="card-header text-center">Vui lòng điền thông tin</div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h4 for="user_info">Thông tin khách hàng</h4>
                    <div class="form-group">
                        <label for="agent">Người đại diện (*)</label>
                        <select class="form-control" name="gender">
                            <option value="0">Chị</option>
                            <option value="1">Anh</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Họ và tên lót (*)  <span class="text-danger" id ="lastname_error"></span></label>
                        <input type="text" class="form-control" name="lastname" placeholder="Vui lòng nhập Họ và tên lót">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Tên (*)  <span class="text-danger" id ="firstname_error"></span></label>
                        <input type="text" class="form-control" name="firstname" placeholder="Vui lòng nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="uri">Link web (*)  <span class="text-danger" id ="uri_error"></label>
                        <input type="text" name="uri"  class="form-control" placeholder="Vui lòng nhập link web" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ (*)  <span class="text-danger" id ="address_error"></label>
                        <textarea class="form-control"  name="address" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Điện thoại (*)  <span class="text-danger" id ="phone_error"></label>
                        <input type="text" name="phone"  class="form-control" placeholder="Vui lòng nhập điện thoại" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-6">
                    <h4 for="info_login">Thông tin đăng nhập</h4>
                    <div class="form-group">
                        <label for="email">Email (*) <span class="text-danger" id ="email_error"></label>
                        <input type="email" name="email"  class="form-control" placeholder="Vui lòng nhập email" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu (*) <span class="text-danger" id ="password_error"></label>
                        <input type="password" name="password"  class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="repass">Nhập lại mật khẩu (*) <span class="text-danger" id ="repass_error"></label>
                        <input type="password" name="repass" class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
                    </div>
                    <button type="submit" class="btn btn-primary offset-md-4 btn-signup">Đăng ký</button>
                    <p class="text-success" id="form_result"></p>
                </div>
            </div>
        </div>
    </div>
</form>