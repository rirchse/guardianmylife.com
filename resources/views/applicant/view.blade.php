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
                <td>{{isset($call->appointment_location)?$call->appointment_location:''}}</td>
                <td>{{isset($call->appointment_notes)?$call->appointment_notes:''}}</td>
                <td>{{$source->dtformat($call->created_at)}}</td>  
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form action="{{route('applicant.tocustomer',$customer->id)}}" id="callForm" method="post">
          @csrf
          {{-- @dd($customer) --}}
          <input type="hidden" name="customer_id" value="{{$customer->id}}">
            <div class="third-option" id="third-option" >
              <label for="">Did Customer approved?</label> <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="Yes" name="customer_approve" id="flexRadio3" >
                <label class="form-check-label" for="flexRadioDisabled">
                 Yes
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="No" name="customer_approve" id="flexRadio4"  >
                <label class="form-check-label" for="flexRadioCheckedDisabled"> No </label>
              </div>                     
            </div>
  
            <div class="fourth-option" id="fourth-option" style="display:none" >
              <h4>Enter Following Information</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Company Name</label>
                  <input class="form-control" type="text" name="company_name">             
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Policy Number</label>
                  <input class="form-control" type="text"  name="policy_number">             
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">            
                  <label>Policy Issued Date</label>
                  <input class="form-control" type="date"  name="policy_issued_date">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">            
                  <label>Monthly Premium</label>
                  <input class="form-control" type="text"  name="monthly_premium" placeholder="$00.00">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">            
                  <label>Contract Rate %</label>
                  <input class="form-control" type="text"  name="contract_rate" placeholder="00.00 %">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">            
                  <label>Commission Rate %</label>
                  <input class="form-control" type="text"  name="commission_rate" placeholder="00.00 %">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">            
                  <label>Death Benefit Amount</label>
                  <input class="form-control" type="text"  name="benefit_amount" placeholder="$00.00">
                </div>
              </div>
              <div class="col-md-12">
                <button class="btn btn-primary mt-2 ml-3" type="submit">Submit</button>  
              </div>                    
            </div>
          </div>
        <!--second section end here-->         
      </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h3>Applicant Details</h3>
    <div class="card">
      <div class="card-body">
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
</div>

   
@endsection
@section('scripts')
<script>
  // Get the radio buttons with the name "aboutcall"
  var aboutCallRadios = document.getElementsByName("aboutcall");

  // Add event listener to each radio button
  aboutCallRadios.forEach(function(radio) {
    radio.addEventListener("change", function() {
      // Get the selected value
      var selectedValue = document.querySelector('input[name="aboutcall"]:checked').value;     

      // Show the corresponding div based on the selected value
      if (selectedValue === "approve") {
        document.getElementById("callForm").submit();
      } else if (selectedValue === "applicant") {
        document.getElementById("callForm").submit();
      } 
    });
  });
</script>

<script>
   $('input[name="meet"]').on('change', function() {  
    var selectedValue = $('input[name="meet"]:checked').val();    
    if (selectedValue === 'Yes') {
      $('#second-option').show();     
    } else {     
      $('#second-option').hide();   
      // document.getElementById("callForm").submit();
    }
  });


  const putApplicationRadioGroup = document.getElementsByName("put_application");

// Add a change event listener to the radio button group
putApplicationRadioGroup.forEach(function(radioButton) {
    radioButton.addEventListener("change", function() {
        if (this.value === "Yes") {
            document.getElementById("third-option").style.display = "block";
        } else {
            document.getElementById("third-option").style.display = "none";
        }
    });
});

  // Get the radio button group
  const customerApproveRadioGroup = document.getElementsByName("customer_approve");
    const fourthOptionDiv = document.getElementById("fourth-option");

    // Add a change event listener to the radio button group
    customerApproveRadioGroup.forEach(function(radioButton) {
        radioButton.addEventListener("change", function() {
            if (this.value === "Yes") {
                fourthOptionDiv.style.display = "block";
            } else {
                fourthOptionDiv.style.display = "none";
                document.getElementById("callForm").submit();
            }
        });
    });
</script>
@stop

