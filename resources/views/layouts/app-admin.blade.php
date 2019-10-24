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
        <span class="logo-mini"><b>Admin</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CV.DHOFIN</b>BIRDNEST</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->namaKaryawan }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->namaKaryawan ." - ". str_replace("_"," ",Auth::user()->jabatan ) }}
                      <BR>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Keluar</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
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
              <a href="{{ url('/home') }}">
                <i class="fa fa-dashboard"></i> <span>Beranda</span>
              </a>
            </li>

            @if(Auth::user()->jabatan==1 or Auth::user()->jabatan==2)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Supplier</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('supplier') }}"><i class="fa fa-list"></i>Data Supplier</a></li>
                <li><a href="{{ url('supplier/create') }}"><i class="fa fa-plus-square-o"></i>Input Data Supplier </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Pembelian</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('beli') }}"><i class="fa fa-plus-square-o"></i>Data Pembelian</a></li>
                <!-- <li><a href="{{ url('beli/create') }}"><i class="fa fa-list"></i>Input Data Pembelian</a></li> -->
              </ul>
            </li>
            @endif

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Barang</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('barang') }}"><i class="fa fa-list"></i>Data Barang</a></li>
                <li><a href="{{ url('barang/create') }}"><i class="fa fa-plus-square-o"></i>Input Data Barang </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Proses</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('proses') }}"><i class="fa fa-list"></i>Data Proses</a></li>
                <li><a href="{{ url('proses/create') }}"><i class="fa fa-plus-square-o"></i>Input Data Proses </a></li>
              </ul>
            </li>

             @if(Auth::user()->jabatan==1 or Auth::user()->jabatan==2)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Karyawan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('karyawan') }}"><i class="fa fa-list"></i>Data Karyawan</a></li>

              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Setting</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('setting') }}"><i class="fa fa-list"></i>Data Setting</a></li>

              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Penjualan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('penjualan') }}"><i class="fa fa-list"></i>Data Penjualan</a></li>
                <li><a href="{{ url('penjualan/create') }}"><i class="fa fa-plus-square-o"></i>Input Data Penjualan </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Konsumen</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('konsumen') }}"><i class="fa fa-list"></i>Data Konsumen</a></li>
                <li><a href="{{ url('konsumen/create') }}"><i class="fa fa-plus-square-o"></i>Input Data Konsumen </a></li>
              </ul>
            </li>
            @endif
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      @yield('content')

      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Data Stock Barang Akan Habis</h4>
            </div>
            <div class="modal-body">
              <table class="table table-striped table-responsive">
                <thead>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Stock </th>
                  <th>Satuan</th>
                </thead>
                <tbody id="modalku">

                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <a href="{{ url('barang') }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
          </div>

        </div>
      </div>

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

    <script type="text/javascript">
     @if(Route::currentRouteName()=="home")
      $(window).on('load',function(){
         $('#myModal').modal('show');
      });
      @endif

      $.ajax({
        type: "GET",
        url: '{{ url('getBarang') }}',
        success: function(data)
        { 
          var obj = JSON.parse(data);
          if (obj.length>0) {
            $.each(obj,function(key,value) {
              $("#modalku").append("<tr><td>"+key+"</td><td>"+value.nama+"</td><td>"+value.stok+"</td><td>"+value.satuan+"</td></tr>");
            });
          }else{
              $("#modalku").append("<tr><td colspan='4' class='text-center'>Stok Barang Sudah Penuh</td></tr>");
          }

        }
      });
    </script>
    </html>
