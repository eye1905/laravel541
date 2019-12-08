<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CV.DHOFIN BIRDNEST</title>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
</head>
<body>
	<div class="col-md-6">

<h4>
	CV.DHOFIN BIRDNEST
</h4>
<table  id="example1" style="margin-left:10px">

	<tr> 
		<td width="75%">
			No. Nota Beli : {{ $data->noNotaBeli }}
		</td>
		<td>
			Tanggal : {{ date("d-m-Y", strtotime($data->tglBeli)) }}
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

<table id="example1" class="table table-bordered table-striped">
     <thead>
		<tr>
		  <th>No.</th>
		  <th>Barang</th>
		  <th>Berat</th>
          <th>Harga</th>
          <th>Sub Total</th>
         
		</tr>
        </thead>

       <tbody>
       	<?php $total=0; ?>

         @foreach ($masterdetailbelis as $key => $m)
         <?php $total+=$m->subTotal; ?>

        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
          <td>{{ $m->berat }}</td>
          <td>{{ "Rp. ".number_format($m->harga, 2, ',', '.') }}</td>
          <td>{{ "Rp. ".number_format($m->subTotal, 2, ',', '.') }}</td>
         
          </tr>
          
       @endforeach
       <tr>
       	<td colspan="4" align="right" >
       		TOTAL : 
       	</td>
       	<td align="right">
       		{{ "Rp. ".number_format($total, 2, ',', '.') }}
       	</td>
       </tr>
   </tbody>
   </table>
   <button onclick="Cetak()" id="ok">
   	Cetak
   	</button>
   </div>
</body>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
function Cetak()
{
  window.print();
}

</script>

</html>