<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CV.DHOFIN BIRDNEST</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
   <!-- Morris chart -->
   <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">


   <!-- Date Picker -->
   <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
   <!-- fullCalendar -->
   <link rel="stylesheet" href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
   <link rel="stylesheet" href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">



   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>DB</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>D</b>HOFIN <b>B</b>IRDNEST</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            </ul>
          </div>
        </nav>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">DAFTAR MENU</li>
            
            <li class="active">
              <a href="{{ url('/front') }}">
                <i class="fa fa-dashboard"></i> <span>Stok Barang</span>
              </a>
            </li>

            <li class="">
              <a href="{{ url('/currency') }}">
                <i class="fa fa-dollar"></i> <span>Currency</span>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      @yield('content')

      <!-- jQuery 3 -->
      <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
        $.widget.bridge('uibutton', $.ui.button);
      </script>
      <!-- Bootstrap 3.3.7 -->

      <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
      <!-- Morris.js charts -->
      <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
      <script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
      <!-- Sparkline -->
      <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
      <!-- jvectormap -->
      <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
      <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
      <!-- jQuery Knob Chart -->
      <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
      <!-- daterangepicker -->
      <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
      <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
      <!-- datepicker -->
      <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
      <!-- bootstrap time picker -->
      <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
      <!-- Slimscroll -->
      <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
      <!-- DataTables -->
      <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
      <!-- FastClick -->
      <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{ asset('dist/js/demo.js') }}"></script>
      <!-- CK Editor -->
      <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
      <!-- fullCalendar -->
      <script src="{{ asset('bower_components/moment/moment.js') }}"></script>
      <script src="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    </body>
    @yield('script')
    </html>
