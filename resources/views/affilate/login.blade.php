<!doctype html>
<html lang="en">
  <head>
    <title>Affilate|Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <form action="{{route('login')}}" method="POST" id='frmLogin'>
            @csrf
            <div class="row">
              <div class="col-md-5 offset-md-3">
                <div class="card">
                  <div class="card-header text-center">Vui lòng điền thông tin để đăng nhập</div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Vui lòng nhập email" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Vui lòng nhập password" aria-describedby="helpId">
                    </div>
                    <div class="chkRemember">
                      <label for="remmber">Ghi nhớ mật khẩu</label>
                      <input type="checkbox" name="chkRe" id="chkRe">
                    </div>
                    <a href="{{route('forgetpass')}}">Bấm vào đây để lấy lại mật khẩu</a>
                    <button type="submit" class="btn btn-primary offset-md-4">Đăng nhập</button>
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