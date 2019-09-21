@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Data Pembelian
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('beli/create') }}" class="active"><i class="fa fa-dashboard"></i> Tambah Data Pembelian</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Input Beli</h3>
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
             <form class="form-horizontal" method="POST" action="{{ url('beli') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('supplier') ? ' has-error' : '' }}">
                    <label for="supplier" class="col-md-4 control-label">Supplier</label>

                    <div class="col-md-6">
                        <select id="supplier" class="form-control" name="supplier" required>
                        @foreach($mastersuppliers as $key => $m)
                        <option value = "{{ $m->id }}">
                          {{ $m->namaSupplier }}
                        </option>
                        @endforeach
                    </select>

                        @if ($errors->has('supplier'))
                            <span class="help-block">
                                <strong>{{ $errors->first('supplier') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Tambah

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