@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('Jual') }}" class="active"><i class="fa fa-dashboard"></i> Data Penjualan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Penjualan</h3>
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
                 <th>Konsumen</th>
                 <th>Karyawan</th>
                 <th>Status Nota</th>
                 <th>Status Bayar</th>
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
                <td>{{ $masterkaryawans[$m->id_users]["namaKaryawan"] }}</td>
                
                @if($m->statusNota == 0)
                <td><span class="label label-warning">Transaksi Belum Selesai</span></td>
                @elseif($m->statusNota == 1)
                <td><span class="label label-success">Transaksi Sudah Selesai</span></td>
                @endif

                @if($m->statusBayar == 0)
                <td><span class="label label-warning">Belum Lunas</span></td>
                @elseif($m->statusBayar == 1)
                <td><span class="label label-success">Lunas</span></td>
                @endif
      					
                <td>
                  {{-- <a class="btn btn-success" href="{!! action('JualController@edit', $m->id) !!}">Ubah</a> --}}

                  <a class="btn btn-primary" href="{!! action('JualController@detail', $m->id) !!}">Detail</a>
                  @if($m->statusBayar == 0)
                    <a class="btn btn-success" href="{!! action('JualController@updatebayar', $m->id) !!}" onclick="return confirm('Anda yakin untuk mengubah nota ini menjadi lunas?');">Ubah Jadi Lunas</a>

                    {{-- <form role="form" action="{{ route('penjualan.updatebayar', $m->id) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field("PUT") }} 
                    {!! csrf_field() !!}
                      <input type="submit" class="btn btn-success pull-right" onclick="return confirm('Anda yakin untuk mengubah nota ini menjadi lunas?');" value="Ubah Jadi Lunas" name="submit">
                    </form> --}}
                  @endif

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