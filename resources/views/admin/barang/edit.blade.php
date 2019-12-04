@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('barang/edit') }}" class="active"><i class="fa fa-dashboard"></i> Edit Data Barang</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Edit Barang</h3>
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
            <form role="form" action="{{ route('barang.update', $masterbarangs->id) }}" method="POST" enctype="multipart/form-data">
               {{ method_field("PUT") }} 
              {{ csrf_field() }} 

                <div class="form-group{{ $errors->has('namaBarang') ? ' has-error' : '' }}">
                    <label for="namaBarang" class="col-md-4 control-label">Nama Barang</label>

                    <div class="col-md-6">
                        <input id="namaBarang" type="text" class="form-control" name="namaBarang" value="{{ $masterbarangs->namaBarang }}" required autofocus>

                        @if ($errors->has('namaBarang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('namaBarang') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
                    <label for="harga" class="col-md-4 control-label">Harga Barang</label>

                    <div class="col-md-6">
                        <input id="harga" type="number" class="form-control" name="harga" value="{{ $masterbarangs->harga }}" required autofocus>

                        @if ($errors->has('harga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('stok') ? ' has-error' : '' }}">
                    <label for="harga" class="col-md-4 control-label">Stok Barang</label>

                    <div class="col-md-6">
                        <input id="stok" type="number" readonly class="form-control" name="stok" value="{{ $masterbarangs->stok }}" required autofocus>

                        @if ($errors->has('stok'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stok') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('satuan') ? ' has-error' : '' }}">
                    <label for="satuan" class="col-md-4 control-label">Satuan</label>

                    <div class="col-md-6">
                      <select id="satuan" class="form-control" name="satuan" required>
                        <option value = "Kg">
                          Kg
                        </option>

                    </select>

                        @if ($errors->has('satuan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('satuan') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

               

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Simpan

                        </button>
                        <br>
                        <br>
                    </div>
                </div>
            </form>
          </div>
          <!-- /.box -->

        </div>

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
    
  })
</script>
@endsection
@endsection