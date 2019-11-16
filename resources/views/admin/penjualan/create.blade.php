@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('penjualan/create') }}" class="active"><i class="fa fa-dashboard"></i> Penjualan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form Input Penjualan</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          @if(session('status'))
          <div style="background-color:green; color:white;font-weight: bold">
            {{session('status')}}
          </div>
          @endif
          @foreach ($errors ->all() as $error)
          <h4 style="color: red">{{ $error }}</h4>
          @endforeach

          @if(isset($data))
          <form class="form-horizontal" action="{{ route('penjualan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            {{ method_field("PUT") }} 
            @else
            <form class="form-horizontal" method="POST" action="{{ url('penjualan') }}">
           @endif
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('karyawan') ? ' has-error' : '' }}">
                <label for="karyawan" class="col-md-4 control-label">Karyawan</label>

                <div class="col-md-6">
                  <select id="karyawan" class="form-control" name="karyawan" required>
                    @foreach($masterkaryawans as $key => $m)
                    <option value = "{{ $m->id }}">
                      {{ $m->namaKaryawan }}
                    </option>
                    @endforeach
                  </select>

                  @if ($errors->has('karyawan'))
                  <span class="help-block">
                    <strong>{{ $errors->first('karyawan') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('konsumen') ? ' has-error' : '' }}">
                <label for="konsumen" class="col-md-4 control-label">Konsumen</label>

                <div class="col-md-6">
                  <select id="konsumen" class="form-control" name="konsumen" required>
                    @foreach($mastersuppliers as $key => $m)
                    <option value = "{{ $m->id }}">
                      {{ $m->namaKonsumen }}
                    </option>
                    @endforeach
                  </select>

                  @if ($errors->has('konsumen'))
                  <span class="help-block">
                    <strong>{{ $errors->first('konsumen') }}</strong>
                  </span>
                  @endif
                </div>
              </div>


              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  @if(!isset($masterjual))
                  <button type="submit" class="btn btn-primary">
                    Tambah
                  </button>
                  @endif
                  <br>
                  <br>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>

      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="box-header">
              <div class="container-fluid">
                @if(isset($data) and $data->status==0)

                <a href="{!! action('DetailbeliController@tutup', $data->id) !!}" class="btn btn-sm btn-success pull-right"> Tutup Transaksi </a>
                @else
                <a href="{!! action('DetailbeliController@cetak', $data->id) !!}" class="btn btn-sm btn-primary pull-right"> 
                  <i class="fa fa-print"></i>
                Cetak Nota </a>
                @endif

              </div>
              <h3 class="box-title">Detail Jual</h3>
              @if(session('success'))
              <div style="background-color:green; color:white;font-weight: bold">
                {{session('success')}}
              </div>
              @endif

              @if(session('error'))
              <div style="background-color:red; color:white;font-weight: bold">
                {{session('error')}}
              </div>
              @endif

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                   <th>No.</th>
                   <th>Barang</th>
                   <th>Berat</th>
                   <th>Harga</th>
                   <th>Sub Total</th>
                   <th>Opsi</th>
                 </tr>
               </thead>

               <tbody>
                @if(isset($masterjual))
                @foreach ($masterjual as $key => $m)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                  <td>{{ $m->beratJual }}</td>
                  <td>{{ $m->harga }}</td>
                  <td>{{ $m->harga*$m->beratJual }}</td>
                  <!-- jika harga barang kosong -->
                  <td>

                  </td>

                </tr>
                @endforeach
                @endif
                @if(isset($id))
                <tr>
                  <form class="form-horizontal" method="POST" action="{{ url('detailjual') }}" id="myform">
                    {{ csrf_field() }}
                    <td><input type="hidden" name="beli" value="@if(isset($id)) {{ $id }}  @endif"/></td>
                    <td>  
                      <select id="barang" class="form-control" name="barang" required>
                        @foreach($masterbarangs as $key => $m)
                        @if($m->namaBarang!="Raw")
                        <option value = "{{ $m->id }}">
                          {{ $m->namaBarang }}
                        </option>
                        @endif
                        @endforeach
                      </select> 
                    </td>
                    <td>  
                     <input type="text" class="form-control" id="berat" name="berat">
                   </td>
                   <td>  

                   </td>
                   <td> </td>
                   <td>
                    <button class="btn btn-sm btn-success" type="submit">
                      Simpan
                    </button>
                  </td>
                </form>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2018 <a href="{{ url('/home') }}">CV.DHOFIN BIRDNEST</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->
@section('script')
<script type="text/javascript">
  $('#hapus').click(function(){
    return confirm("Anda yakin untuk menghapus data ini?");
  });
</script>

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
    
    @if(isset($data))
    $("#karyawan").val('{{ $data->id_karyawan }}');
    $("#konsumen").val('{{ $data->id_konsumen }}');
    @endif
  })
</script>
@endsection
@endsection