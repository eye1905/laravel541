@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pembelian
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('beli') }}" class="active"><i class="fa fa-dashboard"></i> Data Pembelian</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pembelian</h3>
              @if(session('status'))
                <div style="background-color:green; color:white;font-weight: bold">
                  {{session('status')}}
                </div>
              @endif
            </div>
            <!-- /.box-header -->
          <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
				<tr>
					<th>No.</th>
					<th>No. Nota Beli</th>
					<th>Tanggal Beli</th>
          <th>Supplier</th>
          <th>Karyawan</th>
          <th>Opsi</th>
				</tr>
        </thead>
       <tbody>
      @php
      $no = 0;
      @endphp
       @foreach ($masterjual as $key => $m)
      @php
      $no++;
      @endphp
				<tr>
					<td>{{ $no }}</td>
					<td>{{ $m->noNotaBeli }}</td>
					<td>{{ $m->tglBeli }}</td>
          <td>{{ $mastersuppliers[$m->id_supplier]["namaSupplier"] }}</td>
          <td>{{ $masterkaryawans[$m->id_karyawan]["namaKaryawan"] }}</td>
					<td><a class="btn btn-success" href="{!! action('BeliController@edit', $m->id) !!}">Ubah</a>
            <a class="btn btn-warning" href="{!! action('DetailbeliController@edit', $m->id) !!}">Detail</a>
            <a class="btn btn-info" href="{!! action('DetailbeliController@cetak', $m->id) !!}">Cetak</a>
            <form method="POST" action="{!! action('BeliController@destroy', $m->id) !!}" onsubmit = "return confirm('Anda yakin untuk menghapus data ini?');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger" id = "hapus" type="submit">Delete</button>
            </form>
          </td>
          
				</tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
    
  })
</script>
@endsection
@endsection