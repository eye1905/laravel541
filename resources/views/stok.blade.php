@extends('frontlayout')

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
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                 <th>No.</th>
                 <th>Nama Barang</th>
                 <th>Harga</th>
                 <th>Stok</th>
               </tr>
             </thead>
             <tbody>
               @foreach ($masterbarangs as $key => $m)
               @if(strtoupper($m->namaBarang)!="RAW")
               <tr>
                 <td>{{ $key+1 }}</td>
                 <td>{{ $m->namaBarang }}</td>
                 <td>{{ "Rp. ".number_format($m->harga, 2, ',', '.') }}</td>
                 <td>{{ $m->stok }}</td>
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


   <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Keranjang</h3>
          @if(session('status'))
          <div style="background-color:green; color:white;font-weight: bold">
            {{session('status')}}
          </div>
          @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>No.</th>
               <th>Nama Barang</th>
               <th>Harga</th>
               <th>Jumlah</th>
               <th>
                 Tambah
               </th>
             </tr>
           </thead>

           <tbody>
            <tr>
              <td></td>
              <td>
                <select class="form-control" id="barang[]" name="barang[]">
                  <option>-- Pilih Barang ---</option>
                  @foreach($masterbarangs as $key => $value)
                  <option value="{{ $value->id }}">{{ $value->namaBarang }}</option>
                  @endforeach
                </select>
              </td>
              <td>
                  
              </td>
              <td>
                <input type="text" name="isi[]" id="isi[]" class="form-control" placeholder="Masukan Jumlah">
              </td>
              <td>
                <button class="btn btn-sm btn-success">
                  <i class="fa fa-plus"></i> Tambah
                </button>
              </td>
            </tr>

            <tr>
              <td></td>
              <td colspan="2" class="text-right"><b>Total :</b> </td>
              <td></td>
            </tr>
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