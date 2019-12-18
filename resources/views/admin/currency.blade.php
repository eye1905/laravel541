@extends('frontlayout')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Currency
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('currency') }}" class="active"><i class="fa fa-dashboard"></i> Daftar Currency</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Daftar Currency</h3>
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
                 <th>Mata Uang</th>
                 <th>Jual</th>
                 <th>Beli</th>
               </tr>
             </thead>
             <tbody>
               @foreach ($kurs as $key => $m)
               <tr>
                 <td>{{ $key }}</td>
                 <td>{{ "Rp. ".number_format($m["Jual"], 2, ',', '.') }}</td>
                 <td>{{ "Rp. ".number_format($m["Beli"], 2, ',', '.') }}</td>
               </tr>
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
 </section>
</div>
@endsection