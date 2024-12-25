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
        <h3>View Referrers</h3>
           {{-- <button class="btn btn-default btn-sm" onclick="this.select(); document.execCommand('copy');">Copy</button> --}}
          </p>
        <table id="examp/le1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>SL#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Ref. Link</th>
            <th>Ref. Count</th>
            <th>Balance</th>
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
              <td><a href="{{$val->referrer_code ? $source->host().'/signup/'.$val->referrer_code:''}}">{{$val->referrer_code ? $source->host().'/signup/'.$val->referrer_code:''}}</a></td>
              <td>{{$val->ref_user_count}}</td>
              <td>{{$val->ref_bal}}</td>
              <td>
                <a href="{{route('referred.customer', $val->id)}}"><i title="View Referred Customer List" class="fa fa-list" aria-hidden="true"></i></a>
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
<script>
</script>
@endsection
@section('scripts')

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": false ,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });

    
  // function copyText(e)
  // {
  //   // let elm = e.previousElementSibling;
  //   let elm = document.getElementById('referral_link');
  //   // elm.select();
  //   // elm.setSelectionRange(0, 999999);
  //   navigator.clipboard.writeText('texturi');
  //   alert('Link copied to clipboard');
  // }
  </script>
@stop

