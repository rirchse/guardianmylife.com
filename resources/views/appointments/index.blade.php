@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>View Appointments</h3>
    <div class="card">
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
                <tr>
                  <th>SL#</th>
                  <th>Customer Name</th>
                  <th>Appointment</th> 
                  <th>Appointment Time</th>  
                  <th>Location</th>               
                  <th>Event</th>
                  <th>Applied By </th>
                  <th>Action</th>
                </tr>
                @foreach($appointments as $app)
                <tr>
                    <td>{{$app->id}}</td>
                    <td>{{$app->Customer->first_name}} {{$app->Customer->last_name}}</td>
                    <td>{{isset($app->appointment)? $app->appointment: 'No'}}</td>  
                    <td>{{ $source->dtformat($app->appointment_time) }}</td>                  
                    <td>{{$app->appointment_location}}</td>  
                    <td>
                      @if($app->event_id)
                      <a target="_blank" class="btn btn-info btn-xs" href="{{$app->htmlLink}}">View</a>
                      
                      @if(!is_null($app->attendees))
                      <label class="label text-success">Invited</label>
                      @endif
                      @endif
                      <button class="btn btn-primary btn-xs" title="{{$app->appointment_notes}}" onclick="viewNote(this)">Note?</button>
                    </td>
                    <td>{{$app->User->name}}</td>
                    <td>  
                      <a href="{{route('appointment.view', $app->customer_id)}}"><i title="Update Status" class="fa fa-edit" aria-hidden="true"></i></a>  
                    </td>                                          
                </tr>
                @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
<div id="view_note" style="position: fixed;top:0; left:0;right:0;bottom:0; z-index:9999; width:100%;background:rgba(0,0,0,0.5); display:none" onclick="this.style.display = 'none';">
  <div style="width:100%;max-width:400px;min-height:200px; padding:25px; margin: 15% auto; background:#fff">
    <i style="float:right; right:0; margin-top:-10px; margin-right:-5px" class="fa fa-times"></i></div>
</div>
@endsection
@section('scripts')

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });

    /* view note */
    function viewNote(e)
    {
      var view_note = document.getElementById('view_note');
      view_note.children[0].innerHTML = '<i style="float:right; right:0; margin-top:-10px; margin-right:-5px" class="fa fa-times"></i>'+e.title;
      view_note.style.display = 'block';
      // console.log(view_note.children[0]);
    }
  </script>
@stop

