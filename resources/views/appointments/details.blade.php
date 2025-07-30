@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mt-3">Your Appointment</h3>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Call Duration</th>
                <th>Appointment</th>
                <th>Appointment Location</th> 
                <th>Notes</th>
                <th>Call Time</th>  
              </tr>
            </thead>
            <tbody>
              @foreach($calls as $call)
              <tr>
                <td>{{$call->call_time}}</td>
                <td>{{isset($call->appointment)? $call->appointment: 'No'}}</td>  
                <td>{{$call->appointment_location}}</td>
                <td>{{$call->appointment_notes}}</td>
                <td>{{ $source->dtformat($call->created_at) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card card-body">

      <form action="{{route('applicant.store', $customer->id)}}" id="callForm" method="post">
          @csrf
          <input type="hidden" name="customer_id" value="{{$customer->id}}">
        <div class="customer_call_information mt-3" id="customer_call_information">
            <label for="">Did you meet with the customer?</label> <br>
           <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="meet" id="flexRadioDefault1" value="Yes">
              <label class="form-check-label" for="flexRadioDefault1">
                Yes
              </label>
            </div>
           <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="meet" id="flexRadioDefault2" value="No">
              <label class="form-check-label" for="flexRadioDefault2">
                No
              </label>
            </div>
          </div>
        <!--first Section end here-->
            <div class="second-option" id="second-option" style="display:none" >
              <label for="">Did you put an application for the customer?</label> <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="Yes" name="put_application" id="flexRadio1" >
                <label class="form-check-label" for="flexRadioDisabled">
                 Yes
                </label>
              </div>            
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="Not Interested" name="put_application" id="flexRadio3"  >
                <label class="form-check-label" for="flexRadioCheckedDisabled">
                Not Interested
                </label>
              </div>                     
            </div>      
          
        <!--second section end here-->         
      </form>    
  
   <form action="{{route('reappoint.customer', $calls[0]->id)}}" method="post" id="reappointFrom">
    @csrf
   </form>
  </div>

  <div class="card">
    <div class="card-body">
        <h3>Appointment Details</h3>
        <div class="row">
          <div class="col-md-6">
            <table class="table table-bordered table-striped">
              <tr>
                <th>Lead Type</th>
                <td>{{$customer->lead_type}}</td>
              </tr>
                <tr>
                  <th>Name</th>
                  <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                </tr>
                <tr>
                  <th>Home</th>
                  <td>{{$customer->home}}</td>
                </tr>
                <tr>
                  <th>Mobile</th>
                  <td>{{$customer->mobile}}</td>
                </tr>
                <tr>
                  <th>Work</th>
                  <td>{{$customer->work}}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{$customer->email}}</td>
                </tr>
                <tr>
                  <th>Company Name</th>
                  <td>{{$customer->company_name}}</td>
                </tr>
                <tr>
                  <th>Street</th>
                  <td>{{$customer->street_address}}</td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>{{$customer->city}}</td>
                </tr>
                <tr>
                  <th>State</th>
                  <td>{{$customer->state}}</td>
                </tr>
                <tr>
                  <th>Zip</th>  
                  <td>{{$customer->zip}}</td>
                </tr>
            </table>
            @if($customer->beneficiary)
            <table class="table table-striped">
            <tr>
              <th>Do you have beneficiary?</th>
              <td>{{$customer->beneficiary}}</td>
            </tr>
            <tr>
              <th>Relation</th>
              <td>{{$customer->relation}}</td>
            </tr>
            <tr>
              <th>Beneficiary Name</th>
              <td>{{$customer->beneficiary_name}}</td>
            </tr>
            <tr>
              <th>Beneficiary Contact</th>
              <td>{{$customer->beneficiary_mobile}}</td>
            </tr>
            <tr>
              <th>Beneficiary Email</th>
              <td>{{$customer->beneficiary_email}}</td>
            </tr>
            <tr>
              <th>Beneficiary Birth Date</th>
              <td>{{$source->dformat($customer->beneficiary_birth_date)}}</td>
            </tr>
            <tr>
              <th>Wedding Anniversary Date</th>
              <td>{{$source->dformat($customer->marriage_date)}}</td>
            </tr>
          </table>
            @endif
          </div>
          <div class="col-md-6">        
            <table class="table table-bordered table-striped">
              <tr>
                <th>Policy Number</th>
                <td>{{$customer->policy_number}}</td>
              </tr>
              <tr>
                <th>Policy Issued Date</th>
                <td>{{$source->dformat($customer->policy_issued_date)}}</td>
              </tr>
              <tr>
                <th>Date Of Birth</th>
                <td>{{$source->dformat($customer->date_of_birth)}}</td>
              </tr>
              <tr>
                <th>Age</th>
                <td>{{$source->ageCalc($customer->date_of_birth)}} Years</td>
              </tr>
              <tr>
                <th>Status</th>
                <td>{{$customer->status}}</td>
              </tr>
              @if($customer->mortgage)
              <tr>
                <th>Do you have a Mortgage?</th>
                <td>{{$customer->mortgage}}</td>
              </tr>
              <tr>
                <th>Lender</th>
                <td>{{$customer->lender}}</td>
              </tr>
              <tr>
                <th>Mortgage Date</th>
                <td>{{$source->dformat($customer->mortgage_date)}}</td>
              </tr>
              <tr>
                <th>Mortgage Total</th>
                <td>{{$customer->mortgage_amount}}</td>
              </tr>
              <tr>
                <th>Mortgage Balance</th>
                <td>{{$customer->mortgage_balance}}</td>
              </tr>
              @endif
              @if($customer->married)
              <tr>
                <th>Are you married?</th>
                <td>{{$customer->married}}</td>
              </tr>
              <tr>
                <th>Spouse Name</th>
                <td>{{$customer->spouse_name}}</td>
              </tr>
              <tr>
                <th>Spouse Birth Date</th>
                <td>{{$source->dformat($customer->spouse_birth_date)}}</td>
              </tr>
              <tr>
                <th>Wedding Anniversary Date</th>
                <td>{{$source->dformat($customer->marriage_date)}}</td>
              </tr>
              @endif
              <tr>
                <th>Contact Full Name</th>
                <td>{{$customer->full_name}}</td>
              </tr>
              <tr>
                <th>Contact Title</th>
                <td>{{$customer->contact_title}}</td>
              </tr>
              <tr>
                <th>Website</th>
                <td>{{$customer->website}}</td>
              </tr>
              <tr>
                <th>Notes</th>
                <td>{{$customer->notes}}</td>
              </tr>
              <tr>
                <th>Assets_Notes</th>
                <td>{{$customer->assets_notes}}</td>
              </tr>
              <tr>
                <th>Lead Owner</th>
                <td>{{$customer->name}}</td>
              </tr>
              <tr>
                <th>Lead Date</th>
                <td>{{$source->dtformat($customer->created_at)}}</td>
              </tr>
            </table>
          </div>
        </div>
    </div>
  </div>
  </div>
  @endsection
  @section('scripts')

  <script>
    $('input[name="meet"]').on('change', function() {  
      var selectedValue = $('input[name="meet"]:checked').val();    
      if (selectedValue === 'Yes') {
        $('#second-option').show();     
      } else {
        document.getElementById("reappointFrom").submit();
        $('#second-option').hide();         
      }
    });


    const putApplicationRadioGroup = document.getElementsByName("put_application");

    // Add a change event listener to the radio button group
    putApplicationRadioGroup.forEach(function(radioButton) {
        radioButton.addEventListener("change", function() {
            if (this.value === "Yes") {
              document.getElementById("callForm").submit();
            } else {
                document.getElementById("callForm").submit();
            }
        });
    });
  </script>
  @endsection
