<tbody>

 <!--  //jika ada barang disortir -->
 @if(count($parent)>0) 
 @foreach ($parent as $key => $m)
 @php
 $sisa = ($m->jumlahBarang-$m->jumlah)*10/100;
 @endphp
 <tr>
  <td>{{ $m->iddetail }}</td>
  @if($m->parent!=1)
  <td style="padding-left: 30px;">{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
  @else
  <td>{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
  @endif
               {{--  @if($m->status==1)
                <td style="padding-left: 5px;">{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                @elseif($m->status==2)
                <td style="padding-left: 30px;">{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                @elseif($m->status==3)
                <td style="padding-left: 35px;">{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                @elseif($m->status==4)
                <td style="padding-left: 40px;">{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                @elseif($m->status==5)
                <td style="padding-left: 5px;">{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                @else
                <td style="padding-left: 20px;">{{ $masterbarangs[$m->id_barang]["namaBarang"] }}</td>
                @endif --}}

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

                    @elseif($masterbarangs[$m->id_barang]["namaBarang"]=="Raw" and $m->status==0 and $m->jumlahBarang>0)
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
              <td>
                <button class="btn btn-sm btn-success" type="submit">
                  Simpan
                </button>

              </td>
            </form>
          </tr>
          @endif

        </tbody>