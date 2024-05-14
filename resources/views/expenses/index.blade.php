@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
        <h3>Budget Add</h3>
        <form action="{{route('budget.store')}}" method="post">
          @csrf
        <div class="row">      
            <div class="col-md-6">
              <div class="form-group">
                <label>Date</label>
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
              <input required type="date" class="form-control" name="expense_date" >
              </div>       
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Amount</label>
              <input required type="text" class="form-control" name="amount" placeholder="Enter Amount">
              </div>     
            </div>      
            <!-- /.col -->
            <button type="submit" class="btn btn-success ml-2">Submit</button>
          </div>
        </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
               <th>Amount</th>
               <th>Expense Date</th>
              </tr>
              </thead>
             <tbody>
              @php
              $total = $balance = 0;
              @endphp
              @foreach($expenses as $expense)
              <tr>
                  <td>{{$loop->index+1}}</td>
                  <td>{{$expense->User->name}}</td>
                  <td>${{$expense->amount}}</td>
                  <td>{{$source->dformat($expense->expense_date)}}</td>
              </tr>
              @php
              $total += $expense->amount;
              @endphp
              @endforeach
             </tbody>
             <tr><td colspan="2" style="text-align:right">Total Budget = <br>Total Cost =<br>Balance = </td><th>${{$total}}<br>${{$cost}}<br>${{$total - $cost}}</th><td></td></tr>
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

