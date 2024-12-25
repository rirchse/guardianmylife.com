@extends('layouts.main')

@section('content')
@if(Auth::user()->role != 3)
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <h3>View Signed Up Agents</h3>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Sr#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>City</th>
          <th>State</th>
          <th>License</th>
          <th>Team Management</th>
          <th>How You Heard</th>
          <th>Your Hope</th>
          <th>Agent</th>
          <th>Action</th>
        </tr>
        </thead>
       <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$user->name}}</td>    
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->city}}</td>
            <td>{{$user->state}}</td>
            <td>{{$user->license}}</td>
            <td>{{$user->team_manage}}</td>
            <td>{{$user->how_find}}</td>
            <td>{{$user->your_hope}}</td>
            <td>{{$user->agent_name}}</td>
            <th>
              <a href="" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
              <a class="btn btn-warning btn-sm" href="{{route('user.edit',$user->id)}}"> <i class="fa fa-edit" aria-hidden="true"></i></a>              
                <a href="{{route('user.delete',$user->id)}}" onclick="return confirm('Are you sure you want to delete user?')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
            </th>
        </tr>
        @endforeach
       </tbody>
      </table>
    </div>
  </div>
</div>
@endif
@endsection
@section('scripts')

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });

    //select customer
    function selectCustomer(e)
    {
      var element = e.options[e.selectedIndex];      
      var name = document.getElementById('full_name');
      var email = document.getElementById('email');

      name.value = element.innerHTML;
      email.value = element.value;

      if(element.value == '')
      {
        name.value = '';
        email.value = '';
      }
      // console.log(e.options[e.selectedIndex]);
    }
  </script>
@stop