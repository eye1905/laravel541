<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
  </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-box-body">
            <h3 class="text-center"><a href="{{ url('/') }}"><b>CV. DHOFIN BIRDNEST</b></a></h3>
            <center><img src="{{ asset('logoku.png') }}" class="img-responsive" style="width: 45%"></center>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <br>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Masukan Nama" autofocus>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukan Email" required>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">

                        <div class="col-md-12">
                            <select class="form-control select2" style="width: 100%;" id="jabatan" name="jabatan" required>
                              <option selected="selected" value = "1">Pegawai Keuangan</option>
                              <option value = "2">Akuntan</option>
                              <option value = "3">Pegawai Gudang</option>
                              <option value = "4">Pegawai Barang</option>
                          </select>

                          @if ($errors->has('jabatan'))
                          <span class="help-block">
                            <strong>{{ $errors->first('jabatan') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" placeholder="MAsukan Password" required>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            </form>
            <a href="{{ route('password.request') }}">Lupa Password</a><br>
            <a href="{{ url('login') }}" class="text-center">Login</a>
        </div>
    </div>
</div>
</body>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script>

</script>

</body>
</html>
