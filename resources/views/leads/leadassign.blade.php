@extends('layouts.main')

@section('content')
<div class="card p-2">
    <h3>Leads Assign</h3>
    <form action="{{route('assignagentleads.store')}}" method="post">
      @csrf
    <div class="row">      
        <div class="col-md-6">
          <div class="form-group">
            <label>Leads</label>
            <select name="lead_id[]" required class="form-control" multiple>
                <option value="">-- Please Select --</option>
                @foreach($leads as $lead)
                <option value="{{$lead->id}}">FFL#{{$lead->id}}</option>
                @endforeach
              
            </select>
          </div>       
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Agent </label>
            <select name="agent_id" required id="" class="form-control">
                <option value="">-- Please Select --</option>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              
            </select>
          </div>     
        </div>     
        <button type="submit" class="btn btn-success ml-2">Submit</button>
      </div>
    </form>
</div>     
@endsection
@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('select[name="lead_id\[\]"]').select2({
            multiple: true
        });
    });
</script>

@stop

