@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Barang
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('barang') }}" class="active"><i class="fa fa-dashboard"></i> Daftar Barang</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Daftar Barang</h3>
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
                 <th>Nama Barang</th>
                 <th>Stok</th>
                 <th>Satuan</th>
                 <th>Harga</th>
                 <th>Hpp</th>
                 <th>Status</th>
                 <th>Opsi</th>
               </tr>
             </thead>
             <tbody>
               @foreach ($masterbarangs as $key => $m)
               @if(strtoupper($m->namaBarang)!="RAW")
               <tr>
                 <td>{{ $key+1 }}</td>
                 <td>{{ $m->namaBarang }}</td>
                 <td>{{ $m->stok }}</td>
                 <td>{{ $m->satuan }}</td>
                 <td>{{ "Rp. ".number_format($m->harga, 2, ',', '.') }}</td>
                 <td>{{ "Rp. ".number_format($m->hpp, 2, ',', '.') }}</td>
                 <td> 
                  {{ "Barang Siap Jual" }}
                </td>
                <td><a class="btn btn-success" href="{!! action('BarangController@edit', $m->id) !!}">Edit</a></td>
                <td>

                  <form method="POST" action="{!! action('BarangController@destroy', $m->id) !!}" onsubmit = "return confirm('Anda yakin untuk menghapus data ini?');">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" id = "hapus" type="submit">Hapus</button>
                  </form>
                </td>
                
              </tr>
              @endif
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