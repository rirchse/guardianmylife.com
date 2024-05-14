@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>View Applicants</h3>
    <div class="card">
      <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Sr#</th>
              <th>Customer Name</th>
              <th>Agent </th>
              <th>Application</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($applicants as $appointment)
            <tr>
              <td>{{$loop->index+1}}</td>
              <td>{{$appointment->Customer->first_name}} {{$appointment->Customer->last_name}}</td>
              <td>{{$appointment->User->name}}</td>
              <td>{{$appointment->applicant}}</td>
              <td>  
                <a href="{{route('applicant.view',$appointment->customer_id)}}"><i title="Get Details" class="fa fa-edit" aria-hidden="true"></i></a>  
              </td>                                          
            </tr>
            @endforeach
         </tbody>       
        </table>
      </div>
    </div>
  </div>
</div><br>
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

