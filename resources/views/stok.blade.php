@extends('frontlayout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      List Items
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('barang') }}" class="active"><i class="fa fa-dashboard"></i> List Items</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">List Items</h3>
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
                 <th>Items Name</th>
                 <th>Price</th>
                 <th>Stock (Kg)</th>
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
          <h3 class="box-title">Cart</h3>
          @if(session('status'))
          <div style="background-color:green; color:white;font-weight: bold">
            {{session('status')}}
          </div>
          @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped" id="table-barang">
            <thead>
              <tr>
               <th>Items Name</th>
               <th>Price</th>
               <th>Qty</th>
               <th>Sub Total</th>
               <th>
                 Add
               </th>
             </tr>
           </thead>

           <tbody>
            <tr>
              <td>
                <select class="form-control" id="barang" name="barang">
                  <option>-- Choose Item ---</option>
                  @foreach($masterbarangs as $key => $value)
                  @if($value->namaBarang!="Raw")
                  <option value="{{ $value->id }}">{{ $value->namaBarang }}</option>
                  @endif
                  @endforeach
                </select>
              </td>
              <td></td>
              <td>
                <input type="text" name="isi" id="isi" class="form-control" placeholder="Fill The Amount">
              </td>
              <td></td>
              <td>
                <button class="btn btn-sm btn-success" type="button" onclick="addData()">
                  <i class="fa fa-plus"></i> Add
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td></td>
              <td><b>Total :</b></td>
              <td><label id="label"></label></td>
            </tr>

            <tr>
              <td>
                <select class="form-control" id="mata-uang" name="mata-uang">
                  <option> -- Choose Currency --</option>

                  @foreach($kurs as $key => $val)
                  <option value="{{ $val["Jual"] }}">{{ $key }}</option>
                  @endforeach
                  
                </select>
              </td>
              
              <td>
                <button class="btn btn-sm btn-primary" onclick="getCount()">
                    <i class="fa fa-dollars"></i> Convert
                  </button>
              </td>
                  
              <td>
                  <input type="text" readonly name="total" id="total" class="form-control" placeholder="Total Conversion">
              </td>
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
  var total = 0;
  var harga = <?php echo json_encode($masterbarangs, JSON_FORCE_OBJECT); ?>;
  var jumlah = 0;

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

  function addData() {
    $.ajax({
      type: "GET",
      url: '{{ url('barang/show') }}'+'/'+$("#barang").val(),
      data: $(this).serialize(),
      success: function(data)
      {   
        var obj = JSON.parse(data);

        if(obj.stok<$("#isi").val()){

            alert("Stock Barang tidak Cukup");

        }else{
          var jumlah = parseInt(obj.harga)*parseInt($("#isi").val());

          total += jumlah;

          $("#table-barang").append('<tr><td>'+$("#barang option:selected").text()+'</td><td>'+obj.harga+'</td><td>'+$("#isi").val()+'</td><td>'+jumlah+'</td><td></td></tr');

          $("#label").html(total);
        }
      }
    });
  }

  function getCount() {
    var tot = parseFloat(total)/parseFloat($("#mata-uang").val());
    
    $("#total").val(tot);
  }
</script>
@endsection
@endsection