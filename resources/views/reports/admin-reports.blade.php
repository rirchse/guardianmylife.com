@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
        <h3>Admin Working Hours</h3>
        <form  method="get" action="{{route('reports.admindailysumhours')}}">
          @csrf
        <div class="row">  
            <div class="col-md-6">
                <div class="form-group">
                  <label>From </label>
                  <input type="date" required class="form-control" value="{{ request('from') }}" id="full_name" name="from" placeholder="Enter Full Name" >          
                </div>     
              </div> 
              <div class="col-md-6">
                <div class="form-group">
                  <label> To </label>
                  <input type="date" required class="form-control" value="{{ request('to') }}" id="email" name="to" placeholder="Enter Email" >          
                </div>     
              </div>         
           <br>
            <button type="submit" style="height:2.5rem" class="btn btn-success ml-3 mt-auto mb-3">Submit</button>
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
                  <th>Sr#</th>
                  <th>Daily Working Hours</th>
                  <th>Date</th>
              </tr>           
          </thead>
         <tbody>
          @if(isset($workinghours) != null)
          @foreach($workinghours as $hour) 
          <tr>
              <td>{{$loop->index+1}}</td>
           <td>{{$hour->workingHours}}</td>    
            <td>{{date('M/d/Y ', strtotime($hour->created_at))}}</td>              
          </tr>
          @endforeach        
         </tbody>   
         <tfoot>
         <tr>
          <th></th>
          <th>{{$totalWorkingHours}}</th>
                 
          </tr> 
         </tfoot>   
         @endif
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

