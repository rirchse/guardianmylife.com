@extends('layouts.main')
@section('content')
<style>
  .hide{display: none}
  .paginate nav{float:right}
</style>
@php
$counter = 0;
@endphp
<div class="row" id="current_lead">
  <div class="col-md-12">
    <div class="label label-info">
        <h3>View All Schedules</h3>
    </div>
    <div class="card">
        <div class="card-body">
          <div class="col-md-12" style="width:100%">

            <a target="_blank" href="schedule_birthday" class="btn btn-danger"><i class="fa fa-envelope"></i> Birthday</a>
            <a target="_blank" href="schedule_marriage_day" class="btn btn-danger"><i class="fa fa-envelope"></i> Marriage Day</a>
            <a target="_blank" href="schedule_holiday" class="btn btn-danger"><i class="fa fa-envelope"></i> Holidays</a>
            <a target="_blank" href="schedule_reminder" class="btn btn-danger"><i class="fa fa-envelope"></i> Reminder</a>
            <a target="_blank" href="schedule_newsletter" class="btn btn-danger"><i class="fa fa-envelope"></i> Newsletter</a>
            
            <a class="btn btn-sm btn-info" style="float:right" href="{{route('schedule.create')}}">Add</a>
              <div class="clearfix"></div>
          </div>
            <table class="table">
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action Date</th>
                  <th>Day Left</th>
                  <th style="min-width: 100px">Action</th>
              </tr>
              @foreach ($schedules as $schedule)
              <tr>
                  <td>{{$schedule->id}}</td>
                  <td>{{$schedule->name}}</td>
                  <td>{{$schedule->type}}</td>
                  <td>{{$schedule->title}}</td>
                  <td style="color: {{$schedule->status == 'Active'? 'green':'red'}}">{{$schedule->status}}</td>
                  <td>{{$schedule->action_at}}</td>
                  <td>{{$schedule->day_left}}</td>
                  <td>
                    <button class="btn btn-info btn-sm" onclick="view(this)">
                      <i class="fa fa-angle-down"></i>
                    </button>
                    <a class="btn btn-primary btn-sm" target="_blank" href="{{route('schedule.show', $schedule->id)}}">
                      <i class="fa fa-file-alt"></i>
                    </a>
                      @if(auth()->user()->role == 2)
                      <a href="{{route('schedule.edit', $schedule->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                      @endif
                      @if(auth()->user()->role == 3)
                      <a href="{{route('customer.show', $schedule->id)}}" class="btn btn-sm btn-success"><i class="fa fa-phone-alt"></i></a>
                      @endif
                  </td>
              </tr>
              <tr class="hide">
                  <td colspan=7 style="border-top:none">
                      <p><b>Details:</b><br> {!!$schedule->details!!}</p>
                  </td>
              </tr>
                  @php
                      $counter++;
                  @endphp
              @endforeach
          </table>
          <p><label for="">Total Schedules: ({{$counter}})</label></p>
            <div class="col-md-12 paginate">
              {{$schedules->links()}}
            </div>
        </div>
    </div>
  </div>
</div>

<script>
  function view(e)
    {
        e.parentNode.parentNode.nextElementSibling.classList.toggle('hide');
    }
</script>
@endsection