@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
          <h3>Leads Assign</h3>
          <form action="{{route('assignemployeeleads.store')}}" method="post">
            @csrf
          <div class="row">      
              <div class="col-md-6">
                <div class="form-group">
                  <label>Leads</label>
                  <select name="lead_type" id="lead_id" required class="form-control">      
                    <option value="">Select Lead</option>
                    <option value="Small Business">Small Business</option>
                    <option value="Life Insurance">Life Insurance</option>
                      {{-- @foreach($leads as $lead)
                      <option value="{{$lead->id}}">{{$lead->name}}</option>
                      @endforeach               --}}
                  </select>
                </div>       
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Available Leads</label>
                  <input type="text" id="available_leads" class="form-control" disabled placeholder="Total No Of Leads">           
                  <input type="hidden" name="available_leads" id="leads_no">
                </div>       
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Leads To Given</label>
                  <input type="text" id="available_leads" name="leads_given" class="form-control" placeholder="Enter Leads ">                       
                </div>       
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Employee </label>
                  <select name="employee_id" required id="" class="form-control">
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
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-tripped">
            <tr>
              <th>Employee Name</th>
              <th>Lead Assigned</th>
            </tr>
            @foreach($users as $lead)
            @php
            $leads = \App\Models\Customer::where('assigned_to', $lead->id)->get();
            @endphp
            <tr>
              <td>{{$lead->name}}</td>
              <td>{{$leads?count($leads):0}}</td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}

<script>
    // $(document).ready(function() {
    //     $('select[name="lead_id\[\]"]').select2({
    //         multiple: true
    //     });
    // });

    $(document).ready(function() {
    $('#lead_id').change(function() {
      var leadId = $(this).val();
      
      $.ajax({
        url: '{{ route("leads.getLeadRecord") }}',
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          lead_type: leadId
        },
        success: function(response) {
          $('#available_leads').val(response.available_leads);
          $('#leads_no').val(response.available_leads);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>

@stop

