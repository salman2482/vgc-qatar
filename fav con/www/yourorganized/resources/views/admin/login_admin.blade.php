<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/fontawesome-free/css/all.min.css') !!}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{!! asset('assets/admin/dist/css/adminlte.min.css') !!}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><img src="{!! asset('assets/main/assets/images/logo.png') !!}" ></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Admin Login </p>
      
                      @foreach ($errors->all() as $error)
                              <div class="alert alert-danger"> * {{ $error }} <br> </div>
                             @endforeach

     <form  method="post" action="{{ url($admin_url.'login') }}" autocomplete="off">
        <div class="input-group mb-3">
         <input class="form-control" placeholder="Email or Username"  autocomplete="off"  required  type="email" name="email" valid  />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <input autocomplete="off"  name="password" type="password" required class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="icheck-primary">
                <input type="checkbox" value="1" name="remember" id="remember">
              <label for="remember">
                  <small>Remember Me</small>
              </label>
            </div>
          </div>
            @csrf
            <!-- /.col --><br><br>
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     

   
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{!! asset('assets/admin/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>

</body>
</html>
