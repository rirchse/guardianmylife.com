@extends('layouts.main')

@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>View All Calls</h3>
    <div class="card">
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>SL#</th>
            <th>Customer Name</th>
            <th>Call Duration</th>
            <th>Appointment</th> 
            <th>Call Time</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach($calls as $call)
            <tr>
              <td>{{$loop->index+1}}</td>
              <td>{{$call->Customer ? $call->Customer->first_name : ''}} {{$call->Customer?$call->Customer->last_name:''}}</td>
              <td>{{$call->call_time}}</td>
              <td>{{isset($call->appointment)? $call->appointment: 'No'}}</td>  
              <td>{{$source->dtformat($call->created_at)}}</td>
              <td>{{$call->status}}</td>
              <th>
                <a href="{{route('customer.show', $call->customer_id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
              </th>
            </tr>
          @endforeach
          </tbody>
        </table> 
      </div>
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

