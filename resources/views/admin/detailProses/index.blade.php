@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Proses
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('detailproses') }}" class="active"><i class="fa fa-dashboard"></i> Detail Proses </a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Detail Proses</h3>
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
            <br>
            <p style="margin-left:10px;">
              @php
              $total = 0;
              @endphp
              @foreach($masterbarangs as $key => $val)
              @foreach($barang as $key1 => $val1)
              @if($val->id == $val1->id_barang)
              {{ $val->namaBarang." : ".$val1->jumlah }} <br>
              @endif
              @endforeach
              @endforeach
            </p>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div>
              @if($data->status==0)
              <a href="{{ URL::to('endproses'.'/'.$data->id) }}" class="btn btn-md btn-primary pull-right" > Tutup Proses </a>
              @endif
            </div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                 <th>No.</th>
                 <th>Barang</th>
                 <th>Berat</th>
                 <th>Sisa</th>
                 <th>Status</th>
                 <th>Opsi</th>
               </tr>
             </thead>

             <tbody>

               <!--  //jika ada barang disortir -->
               @if(count($masterdetailprosess)>0) 
               @foreach ($masterdetailprosess as $key => $m)
               <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                <td>{{ $m->jumlahBarang }}</td>
                <td>{{ $m->jumlah }}</td>
                @if($m->status==1 or $m->status==7)

                <td>{{ "Sortir" }}</td>

                @elseif($m->status==2)

                <td>{{ "Selesai Sortir" }}</td>

                @elseif($m->status==3 or $m->status==8)

                <td>{{ "Pengeringan" }}</td>

                @elseif($m->status==4)

                <td>{{ "Selesai Pengeringan" }}</td>

                @else

                <td>{{ "Barang Masuk" }}</td>

                @endif

                <td>{{ $m->created_at }}</td>
                <td>
                  @if($masterbarangs[$m->id_barang]["namaBarang"]!="Raw" and $m->jumlahBarang>0 and $m->status==2)
                  <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pengeringan
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#"  data-toggle="modal" data-target="#exampleModal" onclick="getpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})">Pengeringan</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})">Selesai Pengeringan</a></li>
                      </ul>
                    </div>
                    @elseif($masterbarangs[$m->id_barang]["namaBarang"]!="Raw" and $m->jumlahBarang>0 and $m->status==3)
                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})" >
                      Selesai Pengeringan
                    </button>
                    @elseif($masterbarangs[$m->id_barang]["namaBarang"]=="Raw" and $m->jumlahBarang>0 and ($m->status==2 or $m->status==3))

                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})" >
                      Selesai Pengeringan
                    </button>

                    @elseif($masterbarangs[$m->id_barang]["namaBarang"]=="Raw" and $m->status<=0 and $m->jumlahBarang>0)
                    <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target="#sortirModal" onclick="getSortir({{ $m->iddetail }}, {{ $m->id_barang}})" >
                      Sortir
                    </button>
                    @elseif($masterbarangs[$m->id_barang]["namaBarang"]=="Raw" and $m->status==1 and $m->jumlahBarang>0)
                    <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target="#EndsortirModal" onclick="endSortir({{ $m->iddetail }}, {{ $m->id_barang}})" >
                      Selesai Sortir
                    </button>
                    @elseif($masterbarangs[$m->id_barang]["namaBarang"]!="Raw" and $m->jumlahBarang>0 and $m->status==0)
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pengeringan
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="#"  data-toggle="modal" data-target="#exampleModal" onclick="getpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})">Pengeringan</a></li>
                          <li><a href="#" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})">Selesai Pengeringan</a></li>
                        </ul>
                      </div>
                      @elseif($masterbarangs[$m->id_barang]["namaBarang"]!="Raw" and $m->jumlahBarang>0 and $m->status==5 and $m->status==7)

                      @endif
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  @if($data->status==0)
                  <tr>
                    <form class="form-horizontal" method="POST" action="{{ url('detailproses') }}">
                      {{ csrf_field() }}
                      <td>  </td>
                      <td>  
                        <input type="hidden" name="id_proses" value="{{ $id }}"/>
                        <select id="barang" class="form-control" name="barang" required>
                          @foreach($masterbarangs as $key => $m)
                          <option value = "{{ $m->id }}">
                            {{ $m->namaBarang }}
                          </option>
                          @endforeach
                        </select> 
                      </td>
                      <td>  
                       <input type="text" class="form-control" id="jumlahBarang" name="jumlahBarang">
                     </td>
                     <td>  
             <!-- <select id="status" class="form-control" name="status" required>
                  <option value ="1">
                    Pengeringan
                  </option>
                  <option value ="2">
                    Sortir
                  </option>


                </select>  -->
              </td>
              <td> </td>
              <td></td>
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

<!-- Pengeringan MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Proses Pengeringan</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('pengeringan') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          Jumlah :
          <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah"/>
          <input type="hidden" id="idproses" name="idproses">
          <input type="hidden" id="idbarang" name="idbarang">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Sortir MODAL -->
<div class="modal fade" id="sortirModal" tabindex="-1" role="dialog" aria-labelledby="sortirModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="sortirModalLabel"><b>Proses Sortir</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('sortir') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          Jumlah :
          <input type="text" class="form-control" id="s_jumlah" name="s_jumlah" placeholder="Masukan Jumlah"/>
          <input type="hidden" id="s_idproses" name="s_idproses">
          <input type="hidden" id="s_idbarang" name="s_idbarang">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="EndsortirModal" tabindex="-1" role="dialog" aria-labelledby="EndsortirModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EndsortirModalLabel"><b>Selesai Sortir</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('endsortir') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          Jumlah :
          <input type="text" class="form-control" id="e_jumlah" name="e_jumlah" placeholder="Masukan Jumlah"/>
          <input type="hidden" id="e_idproses" name="e_idproses"><br> 
          <select id="e_idbarang" class="form-control" name="e_idbarang" required>
            @foreach($masterbarangs as $key => $m)
            @if($m->namaBarang!="Raw")
            <option value = "{{ $m->id }}">
              {{ $m->namaBarang }}
            </option>
            @endif
            @endforeach
          </select> 
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="EndKeringrModal" tabindex="-1" role="dialog" aria-labelledby="EndKeringModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EndKeringModalLabel"><b>Selesai Pengeringan</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('endpengeringan') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          Jumlah :
          <input type="text" class="form-control" id="k_jumlah" name="k_jumlah" placeholder="Masukan Jumlah"/>
          <input type="hidden" id="k_idproses" name="k_idproses">
          <input type="hidden" id="k_idbarang" name="k_idbarang">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


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
  // $(function () {
  //   $('#example1').DataTable({
  //     'paging'      : true,
  //     'lengthChange': true,
  //     'searching'   : false,
  //     'ordering'    : true,
  //     'info'        : true,
  //     'autoWidth'   : true
  //   })

  // });
  function getpengeringan (id, barang) {
   $("#idproses").val(id);
   $("#idbarang").val(barang);
 }

 function getSortir (id, barang) {
  $("#s_idproses").val(id);
  $("#s_idbarang").val(barang);
}

function endSortir (id, barang) {
 $("#e_idproses").val(id);
}

function endpengeringan  (id, barang, status) {
  $("#k_idproses").val(id);
  $("#k_idbarang").val(barang);
}

function pilih(id, berat) {
  $("#pberat").val(berat);
  $("#jumlahBarang").val(berat);
}
</script>
@endsection
@endsection