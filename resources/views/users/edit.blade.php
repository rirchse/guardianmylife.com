{{-- {{dd($user)}} --}}
@extends('layouts.main')
@section('styles')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@stop

@section('content')
<div class="col-md-6">
<div class="card p-2">
    <h3>User Update</h3>
    <div class="tools" style="text-align: right">
      <a class="btn btn-info" href="{{route('users.index')}}">View Users</a>
    </div>
    <form action="{{route('user.update', $user->id)}}" method="post">
      @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Roles</label>
          <select name="role" id="" class="form-control" required>
              <option value="">-- Please Select --</option>
              @foreach($roles as $role)
                @if(Auth::user()->role <= $role->id)
                <option {{$user->role == $role->id? 'selected': ''}} value="{{$role->id}}">{{$role->name}}</option>
                @endif
              @endforeach
          </select>
        </div>
      </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Full Name </label>
            <input type="text" value="{{$user->name}}" class="form-control" id="full_name" name="full_name" placeholder="Enter Full Name" >
          </div>
          <div class="form-group">
            <label> Email </label>
            <input type="email" value="{{$user->email}}" class="form-control" id="email" name="email" placeholder="Enter Email" >          
          </div>
          <div class="form-group">
            <label> Phone </label>
            <input type="number" value="{{$user->phone}}" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" >
          </div>
          <div class="form-group">
            <label> New Password </label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" >
          </div>
        </div>
        <!-- /.col -->
       <br>
        <button type="submit" style="height:2.5rem" class="btn btn-success ml-3 mt-auto mb-3">Update</button>
      </div>
    </form>
</div>
</div>

      
@endsection
@section('scripts')
{{-- <!-- DataTables  & Plugins -->
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script> --}}

@stop

