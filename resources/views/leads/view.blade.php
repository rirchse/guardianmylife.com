@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
$counter = 1;
@endphp

@extends('layouts.main')
 <style>
  .pagination{
    float:right !important;
  }
 </style>

@section('content')
<h3>Leads Customers</h3>
<div class="card card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Lead Type</th>
        <th>Lead Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Lead Owner</th>
        <th style="min-width: 100px">Action</th>
    </tr>
    </thead>
   <tbody>
    @foreach($customers as $lead)
    <tr>
      <td>{{$counter}}</td>
      <td>{{$lead->lead_type}}</td>
      <td>{{$source->dformat($lead->lead_date)}}</td>
      <td>{{$lead->first_name.' '.$lead->last_name}}</td>
      <td>{{$lead->email}}</td>
      <td>{{$lead->mobile}}</td>
      <td>{{$lead->name}}</td>
      <td>
        <a href="{{route('customer.show', $lead->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
          @if(auth()->user()->role == 2)
            <a href="{{route('lead.edit', $lead->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

            @if(!$lead->customer_id && $lead->assigned_to == 0)
            <a href="{{route('lead.delete', $lead->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete the lead?')"><i class="fa fa-trash"></i></a>
            @endif
          @endif
      </td>
  </tr>
  @php
  $counter++;
  @endphp
    @endforeach
   </tbody>        
  </table>  
  {!! $customers->links() !!} 
</div>
@endsection
@section('scripts')

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true, "paging": false ,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });
  </script>
@stop

