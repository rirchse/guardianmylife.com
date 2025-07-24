@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@extends('layouts.main')
 <style>
  .pagination{
    float:right !important;
  }
 </style>

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>View Reminders</h3>
    <div class="card card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Sr#</th>
          <th>Employee Name</th>
          <th>Cutomer Name</th>
          <th>Date & Time</th>
          <th>Note</th>         
          <th>Action</th>
        </tr>
        </thead>
       <tbody>
        {{-- @dd($remainders) --}}
        @foreach($remainders as $remainder)
        <tr>
            <td>{{$remainder->customer_id}}</td>
            <td>{{$remainder->User->name}}</td>
            <td>{{$remainder->Call->Customer->first_name}} {{$remainder->Call->Customer->last_name}}</td>
            <td>{{ $source->dtformat($remainder->reminder_time) }}</td>
            <td>{{$remainder->note}}</td>            
            <th>
              <a href="{{route('customer.show', $remainder->customer_id)}}"><i title="Make a call" class="fa fa-phone" aria-hidden="true"></i></a>
            </th>
        </tr>
        @endforeach
       </tbody>        
      </table>  
      {!! $remainders->links() !!} 
    </div>
  </div>
</div>
@endsection
@section('scripts')

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": false ,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });
  </script>
@stop

