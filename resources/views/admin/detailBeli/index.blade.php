@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Beli
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('beli') }}" class="active"><i class="fa fa-dashboard"></i> Detail Beli </a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Detail Beli</h3>

            <div class="box-body">
            <table  id="example1" style="margin-left:10px">

              <tr> 
                <td width="75%">
                  No. Nota Beli : {{ $data->noNotaBeli }}
                </td>
                <td>
                  Tanggal : {{ date("d - m - Y", strtotime($data->tglBeli)) }}
                </td>
              </tr>
              <tr>
                <td>
                  Supplier : {{ $mastersuppliers[$data->id_suppliers]->namaSupplier }}
                </td>
                <td>
                  No. Rekening : {{ $mastersuppliers[$data->id_suppliers]->noRekening }}
                </td>

              </tr>
            </table>

            @if(session('status'))
            <div style="background-color:green; color:white;font-weight: bold">
              {{session('status')}}
            </div>
            @endif

            <div class="container-fluid">
              @if($data->status==0)
              <a href="{!! action('DetailbeliController@tutup', $id) !!}" class="btn btn-sm btn-success pull-right"> Tutup Transaksi </a>
              @else
              <a href="{!! action('DetailbeliController@cetak', $id) !!}" class="btn btn-sm btn-primary pull-right"> 
                <i class="fa fa-print"></i>
              Cetak Nota </a>
              @endif
            </div>
          </div>

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
              @php
                $total = 0;
              @endphp 
               @foreach ($masterdetailbelis as $key => $m)
               @php
               $total += $m->subTotal; 
               @endphp
               <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                <td>{{ $m->berat }}</td>
                <td>{{ "Rp. ".number_format($m->harga, 2, ',', '.') }}</td>
                <td>{{ "Rp. ".number_format($m->subTotal, 2, ',', '.') }}</td>
                <!-- jika harga barang kosong -->
                <td>
                 @if($data->status!=1 and $masterbarangs[$m->id_barang]["namaBarang"]!="Raw")
                 <button class="btn btn-sm btn-primary" onclick="pilih({{ $m->id_barang }}, {{ $m->berat }})">
                  <i class="fa fa-pencil"></i> Tambahkan harga
                </button>
                  {{-- @if($m->harga==0 && $masterbarangs[$m->id_barang]["namaBarang"]!="Raw")
                  <a href="{{ url('detailbeli/pengeringan')."/".$id."/".$m->id_barang }}" class="btn btn-info btn-sm">
                    Pengeringan
                  </a> --}}
                @elseif($masterbarangs[$m->id_barang]["namaBarang"]=="Raw") <!-- 
              <button type="button" onclick="pilih('{{ $m->id_barang }}', '{{ $m->berat }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal">
                  Sortir
                </button> -->
                @else
                -
                @endif
              </td>

            </tr>
            @endforeach
            @if($data->status!=1)

            <tr>
              <form class="form-horizontal" method="POST" action="#" id="myform">
                {{ csrf_field() }}
                <td><input type="hidden" name="beli" value="{{ $id }}"/></td>
                <td>  
                  <select id="barang" readonly class="form-control" name="barang" required>
                    @foreach($masterbarangs as $key => $m)
                    <option value = "{{ $m->id }}">
                      {{ $m->namaBarang }}
                    </option>
                    @endforeach
                  </select> 
                </td>
                <td>  
                 <input type="text" readonly class="form-control" id="berat" name="berat" required>
               </td>
               <td>  
                 <input type="number" class="form-control" id="harga" name="harga" required>
               </td>
               <td> </td>
               <td>
                <button class="btn btn-sm btn-success" type="submit">
                  Simpan
                </button>
              </td>
            </form>
          </tr>
          @else
          <tr>
              <td colspan="4" align="right" >
                TOTAL : 
              </td>
              <td align="right">
                {{ "Rp. ".number_format($total, 2, ',', '.') }}
              </td>
              <td>
                
              </td>
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

  function pilih(id, berat) {
    $("#myform").attr('action', "{{ url('detailbeli/updateharga') }}");
    $("#barang").val(id);
    $("#berat").val(parseFloat(berat));
  }

</script>
@endsection
@endsection