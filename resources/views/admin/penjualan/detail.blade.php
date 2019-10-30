@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Beli
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('detailbeli') }}" class="active"><i class="fa fa-dashboard"></i> Detail Beli </a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Detail Beli</h3>
            @if(session('success'))
            <div style="background-color:green; color:white;font-weight: bold">
              {{session('success')}}
            </div>
            @endif

            @if(session('error'))
            <div style="background-color:red; color:white;font-weight: bold">
              {{session('error')}}
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
                 <th>Berat</th>
                 <th>Harga</th>
                 <th>Sub Total</th>
                 <th>Opsi</th>
               </tr>
             </thead>

             <tbody>
              @foreach ($masterjual as $key => $m)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                <td>{{ $m->beratJual }}</td>
                <td>{{ $m->harga }}</td>
                <td>{{ $m->harga*$m->beratJual }}</td>
                <!-- jika harga barang kosong -->
                <td>

                </td>

              </tr>
              @endforeach

              @if($data->status!=1)

              <tr>
                <form class="form-horizontal" method="POST" action="{{ url('detailjual') }}" id="myform">
                  {{ csrf_field() }}
                  <td><input type="hidden" name="beli" value="{{ $id }}"/></td>
                  <td>  
                    <select id="barang" class="form-control" name="barang" required>
                      @foreach($masterbarangs as $key => $m)
                      @if($m->namaBarang!="Raw")
                      <option value = "{{ $m->id }}">
                        {{ $m->namaBarang }}
                      </option>
                      @endif
                      @endforeach
                    </select> 
                  </td>
                  <td>  
                   <input type="number" class="form-control" id="berat" name="berat">
                 </td>
                 <td>  
                   
                 </td>
                 <td> </td>
                 <td>
                  <button class="btn btn-sm btn-success" type="submit">
                    Simpan
                  </button>
                </td>
              </form>
            </tr>
            @endif

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

<!-- Modal -->
<!-- <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    Modal content-->
    <div class="modal-content">
      <form class="form-horizontal" method="POST" action="{{ url('detailproses') }}">
        {{ csrf_field() }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih Proses</h4>
        </div>

        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label for="name">Berat Barang</label>
              <input type="hidden" name="pberat" id="pberat">
              <input type="number" name="jumlahBarang" id="jumlahBarang" class="form-control">
            </div>

            <div class="form-group">
              <label for="name">Nama Barang</label>
              <select id="id_barang" class="form-control" name="id_barang" required>
                @foreach($masterbarangs as $key => $m)
                @if($m->namaBarang!="Raw")
                <option value = "{{ $m->id }}">
                  {{ $m->namaBarang }}
                </option>
                @endif
                @endforeach
              </select> 
            </div>

            <div class="form-group">
              <label for="name">Jenis Proses</label>
              <select id="status" class="form-control" name="status" required>
                <option value ="1">
                  Sortir
                </option>
              </select>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-sm btn-success" type="submit">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </form>
    </div>

  </div>
</div> -->

<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; 2019 <a href="{{ url('/home') }}">CV.DHOFIN BIRDNEST</a>.</strong> All rights
  reserved.
</footer>
</div>
<!-- ./wrapper -->
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    
  });

  function pilih(id, berat) {
    $("#myform").attr('action', "{{ url('detailbeli/updateharga') }}");
    $("#barang").val(id);
    $("#berat").val(berat);
  }

</script>
@endsection
@endsection