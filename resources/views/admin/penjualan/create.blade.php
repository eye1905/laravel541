@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('penjualan/create') }}" class="active"><i class="fa fa-dashboard"></i> Penjualan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form Input Penjualan</h3>
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

          <div class="box-body container-fluid">
           @if(isset($data))
           <form class="form-horizontal" action="{{ route('penjualan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
             {{ method_field("PUT") }} 
             @else
             <form class="form-horizontal" method="POST" action="{{ url('penjualan') }}">
               @endif
               {{ csrf_field() }}

              <div class="form-group{{ $errors->has('karyawan') ? ' has-error' : '' }}">
                <label for="karyawan" class="col-md-4 control-label">Karyawan</label>

                <div class="col-md-6">
                  <select id="karyawan" class="form-control" name="karyawan" required>
                    @foreach($masterkaryawans as $key => $m)
                    <option value="{{ $m->id }}">
                      {{ $m->namaKaryawan }}
                    </option>
                    @endforeach
                  </select>

                  @if ($errors->has('karyawan'))
                  <span class="help-block">
                    <strong>{{ $errors->first('karyawan') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('konsumen') ? ' has-error' : '' }}">
                <label for="konsumen" class="col-md-4 control-label">Konsumen</label>
                <div class="col-md-6">
                  <select id="konsumen" class="form-control" name="konsumen" required>
                    @foreach($mastersuppliers as $key => $m)
                    <option value = "{{ $m->id }}">
                      {{ $m->namaKonsumen }}
                    </option>
                    @endforeach
                  </select>

                  @if ($errors->has('konsumen'))
                  <span class="help-block">
                    <strong>{{ $errors->first('konsumen') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('tglKirim') ? ' has-error' : '' }}">
                <label for="tglKirim" class="col-md-4 control-label">Tgl Kirim</label>

                <div class="col-md-6">
                  <input type="date" id="tglKirim" class="form-control" name="tglKirim" required>

                  @if ($errors->has('tglKirim'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tglKirim') }}</strong>
                  </span>
                  @endif

                </div>
              </div>

              <div class="form-group{{ $errors->has('tglPesan') ? ' has-error' : '' }}">
                <label for="tglPesan" class="col-md-4 control-label">Tgl Pesan</label>

                <div class="col-md-6">
                  <input type="date" id="tglPesan" class="form-control" name="tglPesan" required>

                  @if ($errors->has('tglPesan'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tglPesan') }}</strong>
                  </span>
                  @endif

                </div>
              </div>

              <div class="form-group{{ $errors->has('noResi') ? ' has-error' : '' }}">
                <label for="noResi" class="col-md-4 control-label">No Resi</label>

                <div class="col-md-6">
                  <input type="number" id="noResi" class="form-control" name="noResi" required placeholder="No Resi">

                  @if ($errors->has('noResi'))
                  <span class="help-block">
                    <strong>{{ $errors->first('noResi') }}</strong>
                  </span>
                  @endif

                </div>
              </div>

              <div class="form-group{{ $errors->has('tglTerima') ? ' has-error' : '' }}">
                <label for="tglTerima" class="col-md-4 control-label">Tgl Terima</label>

                <div class="col-md-6">
                  <input type="date" id="tglTerima" class="form-control" name="tglTerima" required placeholder="No Resi">

                  @if ($errors->has('tglTerima'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tglTerima') }}</strong>
                  </span>
                  @endif

                </div>
              </div>

              <div class="form-group{{ $errors->has('statusBayar') ? ' has-error' : '' }}">
                <label for="statusBayar" class="col-md-4 control-label">Status Bayar</label>

                <div class="col-md-6">
                  <select id="statusBayar" class="form-control" name="statusBayar" required>
                    <option value="0">Belum Lunas</option>
                    <option value="1">Lunas</option>
                  </select>

                  @if ($errors->has('statusBayar'))
                  <span class="help-block">
                    <strong>{{ $errors->first('statusBayar') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6">
                  @if(!isset($data) or (isset($data) and $data->statusBayar==0))
                  <button type="submit" class="btn btn-primary">
                    Simpan
                  </button>
                  @endif
                </div>
              </div>
              <div class="container-fluid">
                @if(isset($data) and $data->statusBayar==0)
                <a href="{!! action('DetailbeliController@tutup', $data->id) !!}" class="btn btn-sm btn-success pull-right"> Tutup Transaksi </a>
                @elseif(isset($data) and $data->statusBayar==1)
                <a href="{!! action('DetailbeliController@cetak', $data->id) !!}" class="btn btn-sm btn-primary pull-right"> 
                  <i class="fa fa-print"></i>
                  Cetak Nota </a>
                  @endif
                </div>
          </form>

        </div>

      </div>
      <!-- /.box -->

    </div>

  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box">

        <div class="box-header">
          <div class="container-fluid">
            @if(isset($data) and $data->statusBayar==0)
            <a href="{!! action('DetailbeliController@tutup', $data->id) !!}" class="btn btn-sm btn-success pull-right"> Tutup Transaksi </a>
            @elseif(isset($data) and $data->statusBayar==1)
            <a href="{!! action('DetailbeliController@cetak', $data->id) !!}" class="btn btn-sm btn-primary pull-right"> 
              <i class="fa fa-print"></i>
              Cetak Nota </a>
              @endif
            </div>
            <h3 class="box-title">Detail Jual</h3>
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
              @if(isset($masterjual))
              @foreach ($masterjual as $key => $m)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                <td>{{ $m->beratJual }}</td>
                <td><input type="text" class="form-control" readonly="true" id="harga{{ $m->id_barang }} " name="harga{{ $m->id_barang }}" value="{{ $m->harga }} "></td>
                <td>{{ $m->harga*$m->beratJual }}</td>
                <!-- jika harga barang kosong -->
                <td>
                  @if($data->statusBayar==0)
                  <button class="btn btn-sm btn-primary" onclick="pilih({{ $m->id_barang }}, {{ $m->harga }})">
                    <i class="fa fa-pencil"></i> Edit
                  </button>
                  @endif
                </td>
              </tr>
              @endforeach
              @endif

              @if($masterjual==null)
              <tr>
                <td colspan="6"><center>Detail Penjualan Kosong</center></td>
              </tr>
              @endif

              @if(isset($id))
              <tr>
                <form class="form-horizontal" method="POST" action="{{ url('detailjual') }}" id="myform">
                  {{ csrf_field() }}
                  <td>
                    <input type="hidden" name="beli" value="@if(isset($id)) {{ $id }}  @endif"/>
                  </td>
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
                   <input type="text" class="form-control" id="berat" name="berat" placeholder="Masukan Berat">
                 </td>
                 <td>  
                  <input type="hidden" id="harga" name="harga" class="form-control">
                </td>
                <td> </td>
                <td>
                  <button class="btn btn-sm btn-success" type="submit">
                    Simpan
                  </button>
                  <a href="{{ url('penjualan/create/'.$id) }}" class="btn btn-sm btn-warning">
                    Batal
                  </a>
                </td>
              </form>
            </tr>
            @endif
          </tbody>
        </table>

        <br><br><br>
        <div class="row">

          <div class="form-group{{ $errors->has('diskon') ? ' has-error' : '' }}">
            <label for="diskon" class="col-md-1 control-label">Diskon %</label>

            <div class="col-md-4">
              <input type="text" id="diskon" class="form-control" name="diskon" required placeholder="Diskon %">

              @if ($errors->has('diskon'))
              <span class="help-block">
                <strong>{{ $errors->first('diskon') }}</strong>
              </span>
              @endif

            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group{{ $errors->has('noResi') ? ' has-error' : '' }}">
            <label for="total" class="col-md-1 control-label">Total</label>

            <div class="col-md-4">
              <input type="text" id="total" class="form-control" name="total" required placeholder="Total" readonly="true">

              @if ($errors->has('total'))
              <span class="help-block">
                <strong>{{ $errors->first('total') }}</strong>
              </span>
              @endif

            </div>
          </div>
        </div>
        <br><br>
      </div>
      <!-- /.box-body -->
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
var tot = 0;
function pilih(id, harga) {
  $("#barang").val(id);
  $("#berat").attr('type', 'hidden');
  $("#harga").attr('type', 'text');
  $("#harga").val(harga);
}

@if(isset($data))
$("#karyawan").val('{{ $data->id_users }}');
$("#konsumen").val('{{ $data->id_konsumen }}');
$("#tglKirim").val('{{ $data->tglKirim }}');
$("#tglKirim").val('{{ $data->tglKirim }}');
$("#tglPesan").val('{{ $data->tglPesan }}');
$("#noResi").val('{{ $data->noResi }}');
$("#tglTerima").val('{{ $data->tglTerima }}');
$("#statusBayar").val('{{ $data->statusBayar }}');
$("#total").val('{{ $data->total }}');
tot = '{{ $data->total }}';
@endif

$("#diskon").keyup(function() {
  var diskon = $("#diskon").val();
  var subtotal = $("#total").val();
  var total = subtotal-(subtotal*diskon/100);
  $("#total").val(total);
});
</script>

<script type="text/javascript">
    $(document).ready(function(){
      var harga, qty = 0;
      
        $('.harga, .qty').on('keyup keydown',function(){
          harga  = Number($(this).closest('tr').find('td:nth-child(2)').find('input').val());

          qty  = Number($(this).closest('tr').find('td:nth-child(3)').find('input').val());

          var subtotal = harga * qty;

          $(this).closest('tr').find('td:nth-child(5)').find('input').val(subtotal);
          calculateSum();
        });    
    });
</script>

<script type="text/javascript">

function calculateSum()
{ var sum = 0; $(".subtot").each(function () {
    if (!isNaN(this.value) && this.value.length != 0) {
      sum += parseFloat(this.value); 
    } 
  }); 

  $(".total").val(sum.toFixed(2)); 
}

$(function () {
  //Initialize Select2 Elements
  $('.select2').select2();
});

$(function(){
    var myOpt = [];

    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
         var barang = $(this).closest('tr').find('td:nth-child(1)').find('select').find(":selected").val();
            if(trIndex>1) {
             $(this).closest("tr").remove();

             var removeItem = barang;

              myOpt = jQuery.grep(myOpt, function(value) {
                return value != removeItem;
              });
           } else {
             var removeItem = barang;

              myOpt = jQuery.grep(myOpt, function(value) {
                return value != removeItem;
              });

             $(this).closest('tr').find('td:nth-child(1)').find('select').val('');
           }
      });
});
</script>
@endsection
@endsection