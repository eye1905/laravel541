@extends('layouts.app-admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Setting
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('setting') }}" class="active"><i class="fa fa-dashboard"></i> Daftar Setting</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Setting</h3>
              @if(session('status'))
                <div style="background-color:green; color:white;font-weight: bold">
                  {{session('status')}}
                </div>
              @endif
            </div>
            <!-- /.box-header -->
          <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
				<tr>
					<th>No.</th>
					<th>Persen</th>
          <th>Opsi</th>
				</tr>
        </thead>
       <tbody>
        @foreach($data as $key=>$value)
          @if($key==0)
          <tr>
            <td> {{$key+1 }} </td>
            <td> {{$value->persen.' % '}} </td>
            <td>
              <button class="btn btn-sm btn-primary" onclick="pilih({{ $value->id_setting }}, {{ $value->persen }})">
                <i class="fa fa-pencil"></i> Update Setting
             </button>
            </td>
          </tr>
          @endif
        @endforeach
            <tr> 
              <form class="form-horizontal" method="POST" action="{{ url('setting') }}" id="myform">
                 {{ csrf_field() }}
              <td><input type='hidden' name='id_setting' id='id_setting'></td>
              <td> <input type='number' name='setting' id='setting' class='form-control'> </td>
              <td> <button type='submit' class='btn btn-sm btn-success'> Simpan </button> </td>
            </form>
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

  function pilih(id, setting) {
    //alert(setting);
    $("#myform").attr('action', "{{ url('setting/update') }}");
    $("#id_setting").val(id);
    $("#setting").val(setting);
}
</script>
@endsection
@endsection