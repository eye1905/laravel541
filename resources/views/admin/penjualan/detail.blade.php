@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Jual
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('detailjual') }}" class="active"><i class="fa fa-dashboard"></i> Detail Jual </a></li>
    </ol>
  </section>

    <!-- Main content -->
    <form role="form" action="{{ route('penjualan.update', $jual->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field("PUT") }} 
    {!! csrf_field() !!}
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            @if($jual->statusNota == 0)
            <span class="label label-warning">Transaksi Belum Selesai</span>
            @elseif($jual->statusNota == 1)
            <span class="label label-success">Transaksi Sudah Selesai</span>
            @endif

            @if($jual->statusBayar == 0)
            <span class="label label-warning">Pembayaran Belum Lunas</span><br><br>
            @elseif($jual->statusBayar == 1)
            <span class="label label-success">Pembayaran Sudah Lunas</span><br><br>
            @endif

            <i class="fa fa-globe"></i> CV. DHOFIN BIRDNEST
            <?php
              $arrayBulan = array(1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

              $tgl = $jual->tglPesan;
              $pecah = explode('-', $tgl);// pisah format tanggal
              $pecahanTanggal = $pecah[2];//ambil tanggal
              $pecahanBulan = (int)$pecah[1];//ambil bulan dalam angka
              $pecahanTahun = $pecah[0];//ambil tahun
              $bulan = $arrayBulan[$pecahanBulan];

            ?>
            <small class="pull-right">Tanggal Penjualan: <?php echo $pecahanTanggal.' '.$bulan.' '.$pecahanTahun; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari :
          <address>
            <strong>{{ $jual->users->namaKaryawan }}</strong><br>
            CV. DHOFIN BIRDNEST<br>
            Telepon: 081703072928<br>
            Surabaya, Villa Bukit Mas Cluster Jepang D 30<br>
            Email: info@almasaeedstudio.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Tujuan :
          <address>
            <strong>Yth. {{ $jual->konsumens->namaKonsumen }}</strong><br>
            Alamat : {{ $jual->konsumens->alamat }}<br>
            No. Telp : {{ $jual->konsumens->noTelp }}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>No. Nota : {{ $jual->noNotaJual }}</b><br>
          <br>

          @if($jual->statusNota == 0)

            @if($jual->tglKirim == null)
            <b>Tanggal Kirim :</b> <input type="date" id="tglKirim" class="form-control" name="tglKirim"><br>
            @else
            <b>Tanggal Kirim :</b> <input type="date" id="tglKirim" class="form-control" value="{{ $jual->tglKirim }}" name="tglKirim"><br>
            @endif

            @if($jual->noResi == null)
            <b>No. Resi :</b> <input type="number" id="noResi" class="form-control" name="noResi" placeholder="No Resi"><br>
            @else
            <b>No. Resi :</b> <input type="number" id="noResi" class="form-control" name="noResi" value="{{ $jual->noResi }}"><br>
            @endif

            @if($jual->tglTerima == null)
            <b>Tanggal Sampai :</b> <input type="date" id="tglTerima" class="form-control" name="tglTerima"><br>
            @else
            <b>Tanggal Sampai :</b> <input type="date" id="tglTerima" class="form-control" value="{{ $jual->tglTerima }}" name="tglTerima"><br>
            @endif

          @elseif($jual->statusNota == 1)

            @if($jual->tglKirim == null)
            <b>Tanggal Kirim :</b> -<br>
            @else
            <b>Tanggal Kirim :</b> {{ $jual->tglKirim }}<br>
            @endif

            @if($jual->noResi == null)
            <b>No. Resi :</b> -<br>
            @else
            <b>No. Resi :</b> {{ $jual->noResi }}<br>
            @endif

            @if($jual->tglTerima == null)
            <b>Tanggal Sampai :</b> -<br>
            @else
            <b>Tanggal Sampai :</b> {{ $jual->tglTerima }}<br>
            @endif

          @endif
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped" id="tb">
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama Barang</th>
              <th>Berat (Kg)</th>
              <th>Harga</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($detailjual as $key => $m)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>
                <input name="barang[]" value="{{ $m->id_barang }}" hidden="">
                {{ $masterbarangs[$m->id_barang]["namaBarang"] }}
              </td>
              <td>
                <input name="berat[]" id="berat" class="berat" value="{{ $m->beratJual }}" hidden="">
                <p>{{ $m->beratJual }}</p>
              </td>
              <td>
                @if($jual->statusNota == 0)
                <input type="number" name="harga[]" class="form-control harga" id="harga" value="{{ $m->harga }}" required>
                @elseif($jual->statusNota == 1)
                Rp. <p class="pull-right">{{ number_format($m->harga, 2, ',', '.') }}</p>
                @endif
              </td>
              <td>
                <input name="subtotal[]" class="subtotal" id="subtotal" value="{{ $m->harga*$m->beratJual }}" hidden="">
                Rp. <p class="pull-right" class="subtot" id="subtot">{{ number_format($m->harga*$m->beratJual, 2, ',', '.') }}</p>
              </td>
            </tr>
            @endforeach
            <tr>
              <td align="right" colspan="4">Total Sebelum Diskon :</td>
              <td>Rp. <p class="pull-right" id="totalsebelum">{{ number_format($total->total, 2, ',', '.') }}</p></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:55%">Diskon :</th>
                <td>
                  @if($jual->statusBayar == 0)
                  <input type="number" id="diskon" min="0" max="100" style="border-radius: 0; box-shadow: none; border-color: #d2d6de; width: 50%; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc;" class="diskon" name="diskon" required value="{{ $jual->diskon }}"> %
                  @elseif($jual->statusBayar == 1)
                  <p class="pull-right">{{ $jual->diskon }} %</p>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Total Sesudah Diskon :</th>
                <td id="total">
                  <input name="total" value="{{ $jual->total }}" hidden="">
                  Rp. <p class="pull-right">{{ number_format($jual->total, 2, ',', '.') }}</p>
                </td>
              </tr>
              <tr>
                <th>Status Bayar :</th>
                @if($jual->statusBayar == 0)
                <td>
                  <div class="form-group">
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
                </td>
                @elseif($jual->statusBayar == 1)
                <td>
                <input name="statusBayar" value="1" hidden="">
                Pembayaran Sudah Lunas
                </td>
                @endif
                
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          @if($jual->statusNota == 1)
          <a href="#" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          @endif

          @if($jual->statusNota == 0)
          <input class="btn btn-success pull-right" type="submit" name="submit" value="Tutup Transaksi">
          <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-edit"></i> Tutup Transaksi</button> -->
          @endif
        </div>
      </div>
    </section>
    </form>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>


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

<script type="text/javascript">

  $(".harga, .diskon").on('keyup keydown',function(){

    var hrg, brt, subtot, sum = 0;
    brt  = Number($(this).closest('tr').find('td:nth-child(3)').find('input').val());
    hrg = Number($(this).closest('tr').find('td:nth-child(4)').find('input').val());

    subtot = brt*hrg;

    var formatuang = subtot.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); /*INI BUAT NGASIH . SETIAP RIBUAN FORMAT UANG*/

    Number($(this).closest('tr').find('td:nth-child(5)').html('<input name="subtotal[]" class="subtotal" id="subtotal" value="'+subtot+'" hidden="">Rp. <p class="pull-right" class="subtot" id="subtot">'+formatuang+',00</p>'));
    calculateSum();
  });
</script>

<script type="text/javascript">

function calculateSum()
{ 
  var sum = 0;
  var diskon = 0;
  var total = 0;
  diskon = $(".diskon").val();

  $(".subtotal").each(function () {
    if (!isNaN(this.value) && this.value.length != 0) {
      sum += parseFloat(this.value);
    } 
  });

  total = sum-(diskon/100*sum);

  var formatuangbefore = sum.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); /*INI BUAT NGASIH . SETIAP RIBUAN FORMAT UANG*/

  var formatuangafter = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); /*INI BUAT NGASIH . SETIAP RIBUAN FORMAT UANG*/

  $("#totalsebelum").html('<p class="pull-right" id="totalsebelum">'+formatuangbefore+',00</p>');
  $("#total").html('<input name="total" value="'+total+'" hidden="">Rp. <p class="pull-right">'+formatuangafter+',00</p>');
}

</script>
@endsection
@endsection