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
        <h3>View Requested Contacts</h3>
        <table id="examp/le1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>SL#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>State</th>
            <th>Message</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            {{-- {{dd($customers)}} --}}
          @foreach($contacts as $customer)
          <tr>
              <td>{{$loop->index+1}}</td>
              <td>{{$customer->name}}</td>
              <td>{{$customer->email}}</td>
              <td>{{$customer->phone}}</td>
              <td>{{$customer->city}}</td>
              <td>{{$customer->state}}</td>
              <td>{{$customer->message}}</td>
              <td>
                {{-- <a href="{{route('customer.edit',$customer->customer_id)}}"><i title="Update Customer" class="fa fa-edit" aria-hidden="true"></i></a> --}}
              </td>
          </tr>
          @endforeach
          </tbody>
        </table>
        {!! $contacts->links() !!}
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

