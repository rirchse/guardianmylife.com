@extends('layouts.main')
@section('styles')
 <style>
  .pagination{
    float:right !important;
  }
  .hide{display: none}
 </style>
@stop
@section('content')
<h3>Edit Schedule</h3><br>
<div class="card">
    <div class="card-body">
        <div class="col-md-12" style="width:100%">
            <a class="btn btn-sm btn-info" style="float:right" href="{{route('schedule.index')}}">View</a>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('schedule.update', $schedule->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type">Schedule Type</label>
                        <select required class="form-control" id="type" name="type" onchange="change(this)">
                            <option value="">--- Select schedule Type ---</option>
                            <option value="Birthday" {{$schedule->type == 'Birthday'? 'selected':''}}>Birthday</option>
                            <option value="Marriageday" {{$schedule->type == 'Marriageday'? 'selected':''}}>Marriageday</option>
                            <option value="Death" {{$schedule->type == 'Death'? 'selected':''}}>Death</option>
                            <option value="Reminder" {{$schedule->type == 'Reminder'? 'selected':''}}>Reminder</option>
                            <option value="Holiday" {{$schedule->type == 'Holiday'? 'selected':''}}>Holiday</option>
                            <option value="Newsletter" {{$schedule->type == 'Newsletter'? 'selected':''}}>Newsletter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$schedule->name}}">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$schedule->title}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="action_at">Action Date</label>
                                <input type="date" class="form-control" id="action_at" name="action_at" value="{{$schedule->action_at}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="day_left">Day Left</label>
                                <input class="form-control" id="day_left" name="day_left" value={{$schedule->day_left}}>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="banner">Banner</label>
                        <input type="file" class="form-control" id="banner" name="banner">
                    </div>
                    <a target="_blank" href="{{$schedule->banner}}"><img src="{{$schedule->banner}}" alt="" style="max-width: 100%;"></a>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea class="form-control" id="details" name="details" rows=10>{!! $schedule->details !!}</textarea>
                    </div>
                </div>
                <div class="col-md-12"><br>
                    <div class="form-group">
                        <label for="status">
                        <input type="checkbox" class="" id="status" name="status" value="Active" {{$schedule->status == 'Active'? 'Checked':''}}> Status</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function ()
    {
      //bootstrap WYSIHTML5 - text editor
      $('#details').wysihtml5()
    });

    //change type and disable action date
    function change(e)
    {
        var action_at = document.getElementById('action_at');
        var elm = e.options[e.selectedIndex];
        if(elm.value == 'Birthday' || elm.value == 'Marriageday' || elm.value == 'Death')
        {
            action_at.value = 'NULL';
            action_at.setAttribute('readonly', 'readonly');
        }
        else
        {
            action_at.removeAttribute('readonly');
        }
    }
  </script>
@endsection