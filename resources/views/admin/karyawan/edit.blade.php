@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Karyawan
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('karyawan.edit') }}" class="active"><i class="fa fa-dashboard"></i> Edit Data Karyawan</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Karyawan</h3>
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

            <form role="form" action="{{ route('karyawan.update', $masterkaryawans->id) }}" method="POST" enctype="multipart/form-data">
              {{ method_field("PUT") }} 
			        {{ csrf_field() }} 
              <div class="box-body">
				        <div class="form-group">
                  <label>Nama Karyawan</label>
                  <input type="text" name="namaKaryawan" class="form-control" value="{{ $masterkaryawans->namaKaryawan }}"/>
                </div>
            	  <!-- <div class="form-group">
                  <label>Jabatan </label>
                  <input type="text" name="jabatan" class="form-control" value="{{ $masterkaryawans->jabatan }}"/>
                </div> -->
                 <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                            <label for="jabatan" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                                <select class="form-control select2" style="width: 100%;" id="jabatan" name="jabatan" required>
                                  <option selected="selected" value = "1">Pegawai Keuangan</option>
                                  <option value = "2">Direktur</option>
                                  <option value = "3">Pegawai Gudang</option>
                                </select>

                                @if ($errors->has('jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
              <!-- /.box-body -->

                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
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
    <strong>Copyright &copy; 2019 <a href="{{ url('/home') }}">CV.DHOFIN BIRDNEST</a>.</strong> All rights
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
  
  $("#jabatan").val({{ $masterkaryawans->jabatan }});

  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
    
  });


</script>
@endsection
@endsection