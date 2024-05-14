@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>Login Logs</h3>
    <div class="card card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Sr#</th>
         <th>Email</th> 
         <th>Name</th>  
         <th>Time</th> 
         <th>Action</th>   
          <th> Date</th>
        </tr>
        </thead>
       <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$log->email}}</td>    
            <td>{{$log->name}}</td>
            <td>{{ Carbon\Carbon::parse($log->created_at)->format('h:i:s A') }}</td>
            <td>{{$log->action}}</td>  
            <td>{{date('M/d/Y', strtotime($log->created_at))}}</td>              
        </tr>
        @endforeach
       </tbody>       
      </table>
    </div>
  </div>
</div>
@endsection
@section('scripts')

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });
  </script>
@stop

