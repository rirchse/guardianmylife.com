@extends('layouts.main')
@section('styles')
 <!-- DataTables --> 
 <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> 
@stop

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card card-body">
        
      <form action="{{route('user.resetPassword')}}" method="post">
        @csrf        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label>User</label>
                  <select name="user_id" required id="" class="form-control" required>
                      <option value="">-- Please Select --</option>
                     @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                  </select>
                </div>       
              </div>                        
            <div class="col-md-12">
                <div class="form-group">
                  <label>New Password </label>
                  <input type="password" required class="form-control" id="num_lead" name="new_password" placeholder="Enter New Password" >          
                </div>     
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" required class="form-control" id="amount_paid" name="confirm" placeholder="Confirm Password">          
                </div>     
              </div>            
            <!-- /.col -->
            <button type="submit" class="btn btn-success ml-2">Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection