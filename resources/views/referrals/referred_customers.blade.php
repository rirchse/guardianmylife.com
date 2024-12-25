<?php
  use \App\Http\Controllers\SourceCtrl;
  $source = New SourceCtrl;
?>
@extends('layouts.main')
 <style>
  .pagination{
    float:right !important;
  }
 </style>

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3>View Referred Customers</h3>
        <table id="examp/le1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>SL#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Ref. Code</th>
            <th>Referrer Name</th>
            <th>Join Date</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            {{-- {{dd($customers)}} --}}
          @foreach($referrals as $val)
          <tr>
              <td>{{$loop->index+1}}</td>
              <td>{{$val->first_name}} {{$val->last_name}}</td>
              <td>{{$val->email}}</td>
              <td>{{$val->mobile}}</td>
              <td><a href="{{$source->host()}}/signup/{{$val->referrer_code}}">{{$val->referrer_code}}</a></td>
              <td>{{$val->ref_first_name.' '.$val->ref_last_name}}</td>
              <td>{{$source->dformat($val->created_at)}}</td>
              <td>
                <a href="{{route('customer.show', $val->id)}}"><i title="View Customer Details" class="fa fa-file" aria-hidden="true"></i></a>
              </td>
          </tr>
          @endforeach
          </tbody>
        </table>
        {{-- {!! $referrals->links() !!} --}}
      </div>
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

