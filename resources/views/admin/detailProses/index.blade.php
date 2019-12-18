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
                  <th>Barang</th>
                  <th>Berat</th>
                  {{-- <th>Id</th>
                  <th>Parent</th> --}}
                  <th>Sisa</th>
                  <th>Status</th>
                  <th>Tanggal Proses</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              @php
              $jumlah = 0;
              @endphp

              @if(isset($detail["tingkat0"]))
              @foreach($detail["tingkat0"] as $key => $m)
              @php
              $jumlah =$m->jumlah-$m->jumlahBarang;
              @endphp
              
              <tr>
                <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                <td>{{ $m->jumlahBarang }}</td>
               {{--  <td>{{ $m->iddetail }}</td>
                <td>{{ $m->parent }}</td> --}}
                <td>{{ $m->jumlah }}</td>
                <td>{{ $status[$m->status] }}</td>
                <td>{{ date("d-m-Y H:i:s", strtotime($m->created_at)) }}</td>
                <td>
                  @if($data->status==0)
                      @if($masterbarangs[$m->id_barang]["namaBarang"]=="Raw" and $m->status==0)
                      <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target="#sortirModal" onclick="getSortir({{ $m->iddetail }}, {{ $m->id_barang}})" >
                        Sortir 
                      </button>
                      @elseif($masterbarangs[$m->id_barang]["namaBarang"]=="Raw" and $m->status==5)

                      @else
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pengeringan
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="#"  data-toggle="modal" data-target="#exampleModal" onclick="getpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})">Pengeringan</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $m->iddetail }}, {{ $m->id_barang}})">Selesai Pengeringan</a></li>
                          </ul>
                        </div>  
                      </td>
                      @endif
                  @endif
                </td>
              </tr>
              @if(isset($detail["tingkat1"]))
              @foreach($detail["tingkat1"] as $key1 => $value1)
              @if($m->iddetail==$value1->parent)
              @php
              $jumlah =$value1->jumlah-$value1->jumlahBarang;
              @endphp
              <tr>
                <td style="padding-left:3%">{{ $masterbarangs[$value1->id_barang]["namaBarang"] }}</td>
                <td>{{ $value1->jumlahBarang }}</td>
                {{-- <td>{{ $value1->iddetail }}</td>
                <td>{{ $value1->parent }}</td> --}}
                <td>{{ $value1->jumlah }}</td>
                <td>{{ $status[$value1->status] }}</td>
                <td>{{ date("d-m-Y H:i:s", strtotime($value1->created_at)) }}</td>
                <td>
                  @if($data->status==0)
                      @if($value1->status==1)
                        <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target="#EndsortirModal" onclick="endSortir({{ $value1->iddetail }}, {{ $value1->id_barang}})" >
                          Selesai Sortir
                        </button>
                      @else

                      @endif
                  @endif
                </td>
              </tr>
              @if(isset($detail["tingkat2"]))
              @foreach($detail["tingkat2"] as $key2 => $value2)
              @if($value1->iddetail==$value2->parent)
              <tr>
                <td style="padding-left:5%">{{ $masterbarangs[$value2->id_barang]["namaBarang"] }}</td>
                <td>{{ $value2->jumlahBarang }}</td>
                {{-- <td>{{ $value2->iddetail }}</td>
                <td>{{ $value2->parent }}</td> --}}
                <td>{{ $value2->jumlah }}</td>
                <td>{{ $status[$value2->status] }}</td>
                <td>{{ date("d-m-Y H:i:s", strtotime($value2->created_at)) }}</td>
                <td>
                  @if($data->status==0)
                      @if($value2->status==2)
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pengeringan
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="#"  data-toggle="modal" data-target="#exampleModal" onclick="getpengeringan({{ $value2->iddetail }}, {{ $value2->id_barang}})">Pengeringan</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $value2->iddetail }}, {{ $value2->id_barang}})">Selesai Pengeringan</a></li>
                          </ul>
                        </div> 
                        @else

                        @endif 
                    @endif
                  </td>
                </tr>

                @if(isset($detail["tingkat3"]))
                @foreach($detail["tingkat3"] as $key3 => $value3)
                @if($value2->iddetail==$value3->parent)
                <tr>
                  <td style="padding-left:7%">{{ $masterbarangs[$value3->id_barang]["namaBarang"] }}</td>
                  <td>{{ $value3->jumlahBarang }}</td>
                  {{-- <td>{{ $value3->iddetail }}</td>
                  <td>{{ $value3->parent }}</td> --}}
                  <td>{{ $value3->jumlah }}</td>
                  <td>{{ $status[$value3->status] }}</td>
                  <td>{{ date("d-m-Y H:i:s", strtotime($value3->created_at)) }}</td>
                  <td>
                    @if($data->status==0)
                      @if($value3->status==3)
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pengeringan
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">

                              <li><a href="#" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $value3->iddetail }}, {{ $value3->id_barang}})">Selesai Pengeringan</a></li>

                            </ul>
                          </div>
                        @endif
                      @endif
                    </td>
                  </tr>

                  @if(isset($detail["tingkat4"]))
                  @foreach($detail["tingkat4"] as $key4 => $value4)
                  @if($value3->iddetail==$value4->parent)
                  <tr>
                    <td style="padding-left:10%">{{ $masterbarangs[$value4->id_barang]["namaBarang"] }}</td>
                    <td>{{ $value4->jumlahBarang }}</td>
                    {{-- <td>{{ $value4->iddetail }}</td>
                    <td>{{ $value4->parent }}</td> --}}
                    <td>{{ $value4->jumlah }}</td>
                    <td>{{ $status[$value4->status] }}</td>
                    <td>{{ date("d-m-Y H:i:s", strtotime($value4->created_at)) }}</td>
                    <td>
                      @if($data->status==0)
                        @if($value4->status==3)
                          <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pengeringan
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">

                                <li><a href="#" data-toggle="modal" data-target="#EndKeringrModal" onclick="endpengeringan({{ $value4->iddetail }}, {{ $value4->id_barang}})">Selesai Pengeringan</a></li>

                              </ul>
                            </div>
                          @endif
                        @endif
                      </td>
                    </tr>
                      @endif
                      @endforeach
                      @endif

                    @endif
                    @endforeach
                    @endif

                    @endif
                    @endforeach
                    @endif
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @endif
                    @if($data->status==0)
                    <tr>
                        <form class="form-horizontal" method="POST" action="{{ url('detailproses') }}">
                          {{ csrf_field() }}
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
                           <input type="text" class="form-control" id="jumlahBarang" name="jumlahBarang" required>
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
                <input type="hidden" id="parent" name="parent">
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
                <input type="hidden" id="s_parent" name="s_parent">
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
                <input type="hidden" id="e_idproses" name="e_idproses">
                <input type="hidden" id="e_parent" name="e_parent">
                <br> 
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
                <input type="hidden" id="k_parent" name="k_parent">
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
   $("#parent").val(id);
 }

 function getSortir (id, barang) {
  $("#s_idproses").val(id);
  $("#s_idbarang").val(barang);
  $("#s_parent").val(id);
}

function endSortir (id, barang) {
 $("#e_idproses").val(id);
 $("#e_parent").val(id);
}

function endpengeringan  (id, barang, status) {
  $("#k_idproses").val(id);
  $("#k_idbarang").val(barang);
  $("#k_parent").val(id);
}

function pilih(id, berat, $parent) {
  $("#pberat").val(berat);
  $("#jumlahBarang").val(berat);
}
</script>
@endsection
@endsection