<form action="postSignUp" method="POST" id='frmRegisterAd' name="frmRegisterAd">
        @csrf
        <div class="card">
            <div class="card-header text-center">Vui lòng điền thông tin</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 for="user_info">Thông tin khách hàng</h4>
                        <div class="form-group">
                            <label for="company_name">Tên công ty (*)</label>
                            <input type="text" name="company_name" class="form-control" placeholder="Vui lòng nhập tên công ty" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="uri">Link web (*)</label>
                            <input type="text" name="uri"  class="form-control" placeholder="Vui lòng nhập link web" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="agent">Người đại diện (*)</label>
                            <select class="form-control" name="gender">
                                <option value="0">Chị</option>
                                <option value="1">Anh</option>
                            </select><br/>
                            <label for="lastname">Họ và tên lót</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Vui lòng nhập tên đầy đủ">
                            <label for="firstname">Tên</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Vui lòng nhập tên đầy đủ">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <textarea class="form-control"  name="address" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Điện thoại</label>
                            <input type="text" name="phone"  class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 for="info_login">Thông tin đăng nhập</h4>
                        <div class="form-group">
                            <label for="email">Email (*)</label>
                            <input type="email" name="email"  class="form-control" placeholder="Vui lòng nhập email" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu (*)</label>
                            <input type="password" name="password"  class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="repass">Nhập lại mật khẩu (*)</label>
                            <input type="password" name="repass" class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
                        </div>
                        <button type="submit" class="btn btn-primary offset-md-4">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
 </form>