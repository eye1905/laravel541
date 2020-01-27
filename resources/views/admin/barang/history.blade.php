@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Riwayat Stok Barang
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('setting') }}" class="active"><i class="fa fa-dashboard"></i> Riwayat Stok Barang</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Stok Barang</h3>
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
                 <th>Barang</th>
                 <th>Stok Lama</th>
                 <th>Stok Baru</th>
                 <th>Tanggal Update</th>
                 <th>Deskripsi</th>
               </tr>
             </thead>
             <tbody>
              @foreach($data as $key=>$value)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->barang->namaBarang }}</td>
                <td>{{ $value->stok_awal }}</td>
                <td>{{ $value->stok_baru }}</td>
                <td>{{ $value->tanggal }}</td>
                <td>{{ $value->deskripsi }}</td>
              </tr>
              @endforeach
              {{-- <tr> 
                <form class="form-horizontal" method="POST" action="{{ url('history/store') }}" id="myform">
                 {{ csrf_field() }}
                 <td><input type='hidden' name='id_stok' id='id_stok'></td>
                 <td> 
                  <select name='idbarang' id='idbarang' class='form-control' required>
                    @foreach($barang as $key => $value)
                      @if(strtolower($value->namaBarang)!=="raw")
                      <option value="{{ $value->id }}">{{ $value->namaBarang }}</option>
                      @endif
                    @endforeach
                  </select>
                  </td>
                 <td> <input type='number' name='stok' id='stok' class='form-control' required placeholder="Masukan Stok"> </td>
                 <td> 
                  <textarea name='deskripsi' id='deskripsi' class='form-control' required placeholder="Masukan Deskripsi"></textarea>
                 </td>
                 <td> <button type='submit' class='btn btn-sm btn-success'> Simpan </button> </td>
               </form>
             </tr> --}}
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
    
  });

</script>
@endsection
@endsection