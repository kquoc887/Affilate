<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <form action="" name="frmRePass" id="frmRePass">
            @csrf
            <div class="row">
                <div class="col-md-5 offset-md-3">
                    <div class="card">
                        <div class="card-header text-center">Nhập Email lấy lại mật khẩu</div>
                        <div class="card-body">
                            <div class="bs-example-bg-classes">
                                <p class="bg-secondary text-white">Nếu bạn quên mật khẩu, vui lòng nhập địa chỉ e-mail của bạn mà bạn đã đăng ký từ trước.
                                <br/>
                                Đường link hướng dẫn thay đổi pass sẽ được gửi đến email của bạn !
                                </p>
                            </div>
                            <div class="form-group">
                              <input type="text" name="" id="" class="form-control" placeholder="Vui lòng điền vào Email của bạn" aria-describedby="helpId">
                            </div>
                            <button type="submit" class="btn btn-danger offset-md-4">Lấy thông tin</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>