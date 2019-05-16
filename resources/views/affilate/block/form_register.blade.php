<form action="#" method="POST" id='frmRegister' name="frmRegister">
        @csrf
        <div class="card">
            <div class="card-header text-center">Vui lòng điền thông tin</div>
            <div class="card-body">
                <label for="user_info">Thông tin khách hàng</label>
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
                 <select class="form-control" name="gender" id="gender">
                   <option value="0">Chị</option>
                   <option value="1">Anh</option>
                 </select><br/>
                 <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Vui lòng nhập tên đầy đủ">
               </div>
                <div class="form-group">
                  <label for="address">Địa chỉ</label>
                  <textarea class="form-control"  id="address" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">Điện thoại</label>
                    <input type="text" name="phone"  class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
                </div>
                <label for="info_login">Thông tin đăng nhập</label>
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
 </form>