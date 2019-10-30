@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data PemJualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('Jual') }}" class="active"><i class="fa fa-dashboard"></i> Data PemJualan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data PemJualan</h3>
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
                 <th>No. Nota Jual</th>
                 <th>Tanggal Jual</th>
                 <th>Supplier</th>
                 <th>Karyawan</th>
                 <th>Opsi</th>
               </tr>
             </thead>
             <tbody>

               @foreach ($masterjual as $key => $m)
               <tr>
                 <td>{{ $key+1 }}</td>
                 <td>{{ $m->noNotaJual }}</td>
                 <td>{{ $m->tglPesan }}</td>
                 <td>{{ $masterkonsumen[$m->id_konsumen]["namaKonsumen"] }}</td>
                <td>{{ $masterkaryawans[$m->id_karyawan]["namaKaryawan"] }}</td>
      					<td><a class="btn btn-success" href="{!! action('JualController@edit', $m->id) !!}">Ubah</a>
                  <a class="btn btn-warning" href="{!! action('JualController@detail', $m->id) !!}">Detail</a>
                  {{-- <form method="POST" action="{!! action('JualController@destroy', $m->id) !!}" onsubmit = "return confirm('Anda yakin untuk menghapus data ini?');">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" id = "hapus" type="submit">Delete</button>
                    </form> --}}
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