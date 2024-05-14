@extends('layouts.main')

@section('content')
@if(Auth::user()->role != 3)
<div class="card card-body">
    <h3>Create New User</h3>
    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="row">    
      <div class="col-md-6">
        <div class="form-group">
          <label>Select From Final Customer (Optional) </label>
          <select type="text" class="form-control" id="customer" name="customer" onclick="selectCustomer(this)">
            <option value="">Select Customer</option>
            @foreach($customers as $customer)
            <option value="{{$customer->email}}">{{$customer->first_name.' '.$customer->last_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Roles</label>
          <select name="role" id="" class="form-control" required>
              <option value="">-- Please Select --</option>
              @foreach($roles as $role)
                @if(Auth::user()->role <= $role->id)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endif
              @endforeach
          </select>
        </div>
      </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Full Name </label>
              <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter Full Name" required>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="form-group">
              <label> Email </label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>          
            </div>     
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Password </label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter Passowrd" autocomplete="new-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div> 
          <div class="col-md-6">
            <div class="form-group">
              <label>Confirm Password </label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password" autocomplete="new-password">
            </div>     
          </div>
      
        <!-- /.col -->
       <br>
        <button type="submit" style="height:2.5rem" class="btn btn-success ml-3 mt-auto mb-3">Submit</button>
      </div>
    </form>
</div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <h3>View Users</h3>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Sr#</th>
         <th>Name</th>
         <th>Email</th>
         <th>Designation</th>
          <th>Action</th>
        </tr>
        </thead>
       <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$user->name}}</td>    
            <td>{{$user->email}}</td>
            <td>{{$user->role_name}}</td>
            <th>
              <a href="{{route('user.edit',$user->id)}}"> <i class="fa fa-edit" aria-hidden="true"></i></a>              
                {{-- <a href="{{route('user.delete',$user->id)}}" onclick="return confirm('Are you sure you want to delete user?')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a> --}}
            </th>
        </tr>
        @endforeach
       </tbody>
        <tfoot>
            <tr>
                <th>Sr#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                 <th>Action</th>
              </tr>
        </tfoot>
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