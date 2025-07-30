@php
$user = $customer;
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@extends('layouts.main')

@section('content')
<style>.hide{display: none}</style>
  <div class="row"> 

    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h3 class="mt-3">Previous Records</h3>
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
                  <td>{{$call->appointment? $call->appointment: 'No'}}</td>  
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

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-8">
              <h3 style="display: inline-block">Call Details</h3></div>
            <div class="col-sm-4">
              <a style="display: inline-block; float:right" href="{{route('customer.edit', $customer->id)}}" class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a></div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <table class="table tab/le-bordered table-striped">
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

              @if($customer->mortgage)
              <table class="table table-striped">
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
              </table>
              @endif
            </div>
            <div class="col-md-6">
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
              <table class="table table-bordered table-striped">
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

    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <div style="font-size:32px;text-align:center; border:2px solid #aaa; border-radius:10px;background:#eee;margin-bottom:25px" id="timerDisplay1" class="timerDisplay ml-2">00:00:00</div>
          
          <table class="table">
            <tr>
              <th>Lead Type</th>
              <td>{{$user->lead_type}}</td>
            </tr>
            <tr>
              <th>Name:</th>
              <td>{{$user->first_name.' '.$user->last_name}}</td>
            </tr>
            <tr>
              <th>Email:</th>
              <td>{{$user->email}}</td>
            </tr>
            @if($customer->mobile)
            <tr>
              <th>Mobile Number:</th>
              <td>{{$customer->mobile}} <span class="btn btn-success btn-sm" onclick="call(this); window.location='tel:{{$customer->mobile}}'"><i class="fa fa-phone"></i> </span></td>
            </tr>
            @endif
            @if($customer->home)
            <tr>
              <th>Home Phone:</th>
              <td>{{$customer->home}} <span class="btn btn-success btn-sm" onclick="call(this); window.location='tel:{{$customer->home}}'"> <i class="fa fa-phone"></i> </span></td>
            </tr>
            @endif
            @if($customer->work)
            <tr>
              <th>Work Number:</th>
              <td>{{$customer->work}}<span class="btn btn-success btn-sm" onclick="call(this); window.location='tel:{{$customer->work}}'"><i class="fa fa-phone"></i> </span></td>
            </tr>
            @endif
            <tr>
              <td colspan="2">
                <div style="max-width: 400px" class="hide" id="call_end">
                  <button class="btn btn-danger" style="width:100%; display:inline-block" onclick="callEnd()" ><i class="fa fa-phone"></i> End</button>
                </div>
              </td>
            </tr>
          </table>
          <form action="{{route('calls.store')}}" id="callForm" method="post">
            @csrf
            <div class="customer_call_information mt-3" id="customer_call_information" style="display: none">
                <label for="">Have you talked to the customer?</label>
                <br>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="call_experience" id="flexRadioDefault1" value="Yes">
                    <label class="form-check-label" for="flexRadioDefault1"> Yes</label>
                  </div>
                  <div class="form-check">
                      <input onchange="callEnd()" class="form-check-input" type="radio" name="call_experience" id="flexRadioDefault2" value="No">
                      <label class="form-check-label" for="flexRadioDefault2"> No </label>
                  </div>
                  <div class="form-check">
                      <input onchange="callEnd()" class="form-check-input" type="radio" name="call_experience" id="exampleRadios1"  value="Wrong No">
                      <label class="form-check-label" for="exampleRadios1"> Wrong No </label>
                  </div>
                  <div class="form-check">
                      <input onchange="callEnd()" class="form-check-input" type="radio" name="call_experience" id="exampleRadios2"  value="Disconnect No">
                      <label class="form-check-label" for="exampleRadios2"> Disconnect No </label>
                  </div>
                </div>
              </div>
              <!--first Section end here-->
              <div class="second-option" id="second-option" style="display:none">
                <label for="">What you want about call?</label>
                <br>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="Callback" name="aboutcall" id="flexRadio0" onchange="check(this)">
                  <label class="form-check-label" for="flexRadio0"> Callback </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="Review" name="aboutcall" id="flexRadio1" onchange="check(this)">
                  <label class="form-check-label" for="flexRadio1"> Review </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="Reminder" name="aboutcall" id="flexRadio2" onchange="check(this)">
                  <label class="form-check-label" for="flexRadio2"> Reminder </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="Appointment" name="aboutcall" id="flexRadioChecked3" onchange="check(this)">
                  <label class="form-check-label" for="flexRadioChecked3"> Appointment </label>
                </div> 
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="Not Interested" name="aboutcall" id="flexRadioChecked4" onchange="callEnd(); check(this)">
                  <label class="form-check-label" for="flexRadioChecked4"> Not interested </label>
                </div>            
              </div>
              <!--second section end here-->

              <!--Call Back-->
        
              <div id="callback" style="display:none">
                <div class="text-center">
                  <h4>---- Callback ----</h4>
                </div>
                  <div class="form-group">
                    <label for="">Date & Time</label>
                    <input name="callback_date_time" type="datetime-local" class="form-control" id="callback_date">
                  </div>
                  <div class="form-group">
                    <label for="">Note</label>
                    <textarea name="callback_remarks" class="form-control" id="callback_note" cols="30" rows="2"></textarea>            
                  </div>
                  <a href="#" class="btn btn-primary mt-2" onclick="callEnd(); submitFormAndRunFunction()" id="submit_button">Submit</a>
              </div>

              <div class="form-group" id="remarks" style="display:none">
                <label for="">Give Remarks</label>
                <textarea name="remarks" class="form-control" id="rev_remarks" cols="30" rows="5"></textarea>   
                <a href="#" class="btn btn-primary mt-2" onclick="callEnd(); submitFormAndRunFunction()" id="submit_button">Submit</a> 
              </div>
              <!--remarks-->

              <div id="remainder" style="display:none">
                <div class="text-center">
                  <h4>---- Remainder ----</h4>
                </div>
                  <div class="form-group">
                    <label for="">Note</label>
                    <textarea name="remainder_remarks" class="form-control" id="rem_note" cols="30" rows="2"></textarea>            
                  </div>
                  <div class="form-group">
                    <label for="">Date & Time</label>
                    <input name="remainder_date_time" type="datetime-local" class="form-control" id="rem_date">
                  </div>
                  <a href="#" class="btn btn-primary mt-2" onclick="callEnd(); submitFormAndRunFunction()" id="submit_button">Submit</a>
              </div>
    
              <!--remainder-->
              <div id="appointment" style="display:none">
                <div class="text-center">
                  <h4>---- Appointment ----</h4>
                </div>
                <div class="form-group">
                  <label for="">Location</label>
                  <input type="text" name="appoint_location" class="form-control" placeholder="Enter Location" id="app_location">
                </div>
                <div class="form-group">
                  <label for="">Date & Time</label>
                  <input type="datetime-local" name="appoint_date_time" class="form-control" placeholder="First name" id="app_date">
                </div>
                <div class="form-group">
                  <label for="">Note</label>
                  <textarea name="appoint_note" class="form-control" id="app_note" cols="30" rows="5"></textarea>            
                </div>
                <input type="hidden" name="customer_id" id="customer_id" value="{{$customer->id}}">
                <input type="hidden" name="hour" id="hour">
                <input type="hidden" name="minutes" id="minutes">
                <input type="hidden" name="seconds" id="seconds">
                <a href="#" class="btn btn-primary mt-2" onclick="callEnd(); submitFormAndRunFunction()" id="submit_button">Submit</a> 
              <!--appoinment-->
              </div>
          </form>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('scripts')
<script src="{{'/js/custom_js.js'}}"></script>
      
<script>
  var customer_id = {{$customer->id}};
  window.addEventListener("load", (event) => {
    var local_timer = localStorage.getItem('startTime_'+customer_id);
    if(local_timer)
    {
      handleTimerClick();
      var customer_call_information = document.getElementById('customer_call_information');
      customer_call_information.style.display = 'block';
    }
  });
</script>
@endsection

