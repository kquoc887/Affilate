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
  <body class="">
    <div class="wrapper">
      <div class="container region-login">
         <div class="row">
            <div class="col-sm-3 text-center mt-5 mb-2 region-action">
              <img src="" alt="">
              <h2 class="text-white">Đăng ký</h2>
              <div class="btn-group">
                <button type="button" class="btn btn-success btn-register" value="Advertiser">Advertiser</button>
                <button type="button" class="btn btn-danger btn-register" value="Publisher">Publisher</button>
              </div>
            </div>
            <div class="col-sm-9">
                @include('affilate.form.form_login')
                @include('affilate.form.form_register_advertiser')
                @include('affilate.form.form_register_publisher')
            </div>
         </div>
      </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @routes 
    <script src="{{asset('js/action.js')}}"></script>
  </body>
</html>