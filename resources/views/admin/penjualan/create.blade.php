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


          <form role="form" action="{{ url('penjualan') }}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">

              <div class="form-group">
                <label>Karyawan</label>
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

              <div class="form-group">
                <label>Konsumen</label>
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

              <div class="form-group">
                <label>Tanggal Pesan</label>
                <input type="date" id="tglPesan" class="form-control" name="tglPesan" required>

                @if ($errors->has('tglPesan'))
                <span class="help-block">
                  <strong>{{ $errors->first('tglPesan') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group">
                <label>Tanggal Kirim</label>
                <input type="date" id="tglKirim" class="form-control" name="tglKirim">

                @if ($errors->has('tglKirim'))
                <span class="help-block">
                  <strong>{{ $errors->first('tglKirim') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group">
                <label>No Resi</label>
                <input type="number" id="noResi" class="form-control" name="noResi" placeholder="No Resi">

                @if ($errors->has('noResi'))
                <span class="help-block">
                  <strong>{{ $errors->first('noResi') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group">
                <label>Tanggal Terima</label>
                <input type="date" id="tglTerima" class="form-control" name="tglTerima">

                @if ($errors->has('tglTerima'))
                <span class="help-block">
                  <strong>{{ $errors->first('tglTerima') }}</strong>
                </span>
                @endif
              </div>

              <hr>
              <h3 class="box-title">Detail Jual</h3>

              <table  class="table table-hover table-bordered small-text" id="tb">
                <tr class="tr-header">
                  <th>Nama Barang</th>
                  <th>Berat (Kg)</th>
                  <th>Harga /Kg</th>
                  <th>Sub Total</th>
                  <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person"><span class="glyphicon glyphicon-plus"></span></a></th>
                </tr>
                <tr>
                  <td width="300px">
                    <input list="barangs" class="form-control brg" id="barang" name="barang[]" autocomplete="off" required>
                    <datalist id="barangs">
                      @foreach($masterbarangs as $key => $b)
                      @if($b->namaBarang!="Raw")
                        <option value="{{ $b->id.' - '.$b->namaBarang }}">{{ $b->namaBarang }}</option>
                      @endif
                      @endforeach
                    </datalist>
                  </td>
                  <td>
                    <input type="number" step="any" name="berat[]" class="form-control berat" id="berat" required>
                  </td>
                  <td>
                    <input type="number" name="harga[]" class="form-control harga" id="harga" required readonly>
                  </td>
                  <td>
                    <input type="number" name="subtot[]" class="form-control subtot" required readonly>
                  </td>
                  <td>
                    <a href='javascript:void(0);' class='remove'><i style="font-size: 18px;" class='glyphicon glyphicon-remove'></i></a>
                  </td>
                </tr>
              </table>
              <hr>

              <div class="form-group">
                <label>Diskon</label><br>
                <input type="number" id="diskon" main-footer="0" max="100" style="border-radius: 0; box-shadow: none; border-color: #d2d6de; width: 30%; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc;" min="0" max="100" class="diskon" name="diskon" placeholder="Masukkan nilai diskon disini"> %

                @if ($errors->has('diskon'))
                <span class="help-block">
                  <strong>{{ $errors->first('diskon') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group">
                <label>Total</label>
                <input type="number" name="total" class="form-control total" readonly>
              </div>

              <div class="form-group">
                <input class="btn btn-primary" id="btnsimpan" type="submit" name="submit" value="Simpan">
              </div>
            </div>
          </form>



      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; 2018 <a href="{{ url('/home') }}">CV.DHOFIN BIRDNEST</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->
@section('script')

<script type="text/javascript">

  $(document).on('change','.brg',function(){ /*<-- INI ARTINYA KETIKA MILIH BARANG FUNCTION YG JALAN ADA DIBAWAHNYA*/
    var brg = $(this).closest('tr').find('td:nth-child(1)').find('input').val(); /*NAMPUNG BARANG YG KEPILIH KE VARIABLE*/

    var hrg, brt = 0;
    var sum = 0;
    var diskon = 0;

    console.log(brg);

    /*KAN PAS MILIH BARANG VALUENYA IDBARANG-NAMABARANG, NAH INI BUAT MISAHNYA*/
    var pecahkode  = brg.split(' - ');
    var idbrg      = pecahkode[0];
    var namabarang = pecahkode[1];
    /*------------------------------------------------------------------------*/

    $.ajax({ type: 'GET',
      url: "{{ url('penjualan/getharga') }}"+"/"+idbrg, /*KALO SUDAH DAPET IDBARANGNYA DIKIRIM KE URL INI BUAT NYARI HARGA JUAL BARANGNYA*/
      success: function (data){
        
        console.log(data);
        
        $('.harga, .berat, .diskon').on('keyup keydown change',function(){ /*KALO KOLOM HARGA, BERAT, DISKON DIRUBAH MAKA FUNCTIONNYA BARU JALAN*/

          var harga = data;
          hrg = Number($(this).closest('tr').find('td:nth-child(3)').find('input').val(data));
          brt  = Number($(this).closest('tr').find('td:nth-child(2)').find('input').val());

          //ajax untuk auto ngecek stok setiap ada perubahan di numeric updown berat barang.
          $.ajax({
            type: 'GET',
            url: "{{ url('penjualan/getstok') }}"+'/'+brt+'/'+idbrg,
            success: function(data2){
              if(data2 === '1')
              {
                alert('Maaf, Stok '+namabarang+' Tidak Mencukupi !');
                document.getElementById("btnsimpan").disabled = true;
              }
            }
            
          });

          document.getElementById("btnsimpan").disabled = false;

          diskon = $("#diskon").val();

          var subtotal = harga * brt;

          $(this).closest('tr').find('td:nth-child(4)').find('input').val(subtotal.toFixed(0));
          calculateSum(diskon);

        });
      }
    });
  });
</script>


<script type="text/javascript">

function calculateSum(diskon)
{ 
  var sum = 0;

  $(".subtot").each(function () {
    if (!isNaN(this.value) && this.value.length != 0) {
      sum += parseFloat(this.value); 
    } 
  });

  console.log(sum);

  total = sum-(diskon/100*sum);
  $(".total").val(total);
}


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