@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Proses
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('proses') }}" class="active"><i class="fa fa-dashboard"></i> Data Proses</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Proses</h3>
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
                 <th>Tanggal Proses</th>
                 <th>Supplier</th>
                 <th>Karyawan</th>
                 <th>Status Proses</th>
                 <th>Opsi</th>
               </tr>
             </thead>
             <tbody>  


               @foreach ($masterproses as $key => $m)
               <tr>
                 <td>{{ $key+1 }}</td>
                 <td>{{ date("d - m - Y", strtotime($m->tglProses)) }}</td>
                <td>@if(isset($mastersuppliers[$m->id_suppliers]["namaSupplier"])){{ $mastersuppliers[$m->id_suppliers]["namaSupplier"] }}@endif</td>
                 <td>@if(isset($masterkaryawans[$m->id_users]["namaKaryawan"])){{ $masterkaryawans[$m->id_users]["namaKaryawan"] }} @endif</td>
                 <td>
                  @if($m->status==0)
                  <span style="background-color: orange; color:#fff">Proses Belum Selesai</span>
                  @else
                  <span style="background-color: green; color:#fff">Proses Selesai Di Transaksi</span>
                  @endif
                </td>
                <td>
                  <a class="btn btn-warning" href="{!! action('DetailprosesController@edit', $m->id) !!}">Detail</a>
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