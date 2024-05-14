@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@extends('layouts.main')
@section('content')
<style>
  .hide{display: none}
  .paginate nav{float:right}
</style>
@php
$counter = 1;
@endphp
<div class="row" id="current_lead">
  <div class="col-md-12">
    <div class="label label-info">
        <h3>View Available Leads</h3>
    </div>
    <div class="card">
        <div class="card-body">
          
          <table class="table" id="example1">
            <thead>
            <tr>
                <th>#</th>
                <th>Lead Type</th>
                <th>Lead Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Lead Owner</th>
                <th style="min-width: 100px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($leads as $lead)
            <tr>
                <td>{{$counter}}</td>
                <td>{{$lead->lead_type}}</td>
                <td>{{$source->dformat($lead->lead_date)}}</td>
                <td>{{$lead->first_name.' '.$lead->last_name}}</td>
                <td>{{$lead->email}}</td>
                <td>{{$lead->mobile}}</td>
                <td>{{$lead->name}}</td>
                <td>
                  <a href="{{route('customer.show', $lead->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    @if(auth()->user()->role == 2)
                      <a href="{{route('lead.edit', $lead->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

                      @if(!$lead->customer_id && $lead->assigned_to == 0)
                      <a href="{{route('lead.delete', $lead->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete the lead?')"><i class="fa fa-trash"></i></a>
                      @endif
                    @endif
                </td>
            </tr>
              @php
                $counter++;
              @endphp
            @endforeach
            </tbody>
        </table>
          {{-- <p><label for="">Total Leads Assigned: ({{$counter}})</label></p>
            <div class="col-md-12 paginate">
              {{$leads->links()}}
            </div> --}}
        </div>
    </div>
  </div>
</div>

<script>
  // function view(e)
  //   {
  //       e.parentNode.parentNode.nextElementSibling.classList.toggle('hide');
  //   }
</script>
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