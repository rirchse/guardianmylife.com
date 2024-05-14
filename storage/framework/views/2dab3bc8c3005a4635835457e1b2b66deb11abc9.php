<?php
$user = $customer;
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
?>



<?php $__env->startSection('content'); ?>
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
            <?php $__currentLoopData = $calls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($call->call_time); ?></td>
              <td><?php echo e($call->appointment? $call->appointment: 'No'); ?></td>  
              <td><?php echo e($call->appointment_location); ?></td>
              <td><?php echo e($call->appointment_notes); ?></td>
              <td><?php echo e($source->dtformat($call->created_at)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
          <a style="display: inline-block; float:right" href="<?php echo e(route('customer.edit', $customer->id)); ?>" class="btn btn-warning btn-md"><i class="fa fa-edit"></i></a></div>
      </div>
    <div class="row">
      <div class="col-md-6">
        <table class="table tab/le-bordered table-striped">
          <tr>
            <th>Lead Type</th>
            <td><?php echo e($customer->lead_type); ?></td>
          </tr>
            <tr>
              <th>Name</th>
              <td><?php echo e($customer->first_name); ?> <?php echo e($customer->last_name); ?></td>
            </tr>
            <tr>
              <th>Home</th>
              <td><?php echo e($customer->home); ?></td>
            </tr>
            <tr>
              <th>Mobile</th>
              <td><?php echo e($customer->mobile); ?></td>
            </tr>
            <tr>
              <th>Work</th>
              <td><?php echo e($customer->work); ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo e($customer->email); ?></td>
            </tr>
            <tr>
              <th>Company Name</th>
              <td><?php echo e($customer->company_name); ?></td>
            </tr>
            <tr>
              <th>Street</th>
              <td><?php echo e($customer->street_address); ?></td>
            </tr>
            <tr>
              <th>City</th>
              <td><?php echo e($customer->city); ?></td>
            </tr>
            <tr>
              <th>State</th>
              <td><?php echo e($customer->state); ?></td>
            </tr>
            <tr>
              <th>Zip</th>  
              <td><?php echo e($customer->zip); ?></td>
            </tr>
        </table>
        <?php if($customer->mortgage): ?>
        <table class="table table-striped">
        <tr>
          <th>Do you have a Mortgage?</th>
          <td><?php echo e($customer->mortgage); ?></td>
        </tr>
        <tr>
          <th>Lender</th>
          <td><?php echo e($customer->lender); ?></td>
        </tr>
        <tr>
          <th>Mortgage Date</th>
          <td><?php echo e($source->dformat($customer->mortgage_date)); ?></td>
        </tr>
        <tr>
          <th>Mortgage Total</th>
          <td><?php echo e($customer->mortgage_amount); ?></td>
        </tr>
        <tr>
          <th>Mortgage Balance</th>
          <td><?php echo e($customer->mortgage_balance); ?></td>
        </tr>
        </table>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <?php if($customer->beneficiary): ?>
        <table class="table table-striped">
        <tr>
          <th>Do you have beneficiary?</th>
          <td><?php echo e($customer->beneficiary); ?></td>
        </tr>
        <tr>
          <th>Relation</th>
          <td><?php echo e($customer->relation); ?></td>
        </tr>
        <tr>
          <th>Beneficiary Name</th>
          <td><?php echo e($customer->beneficiary_name); ?></td>
        </tr>
        <tr>
          <th>Beneficiary Contact</th>
          <td><?php echo e($customer->beneficiary_mobile); ?></td>
        </tr>
        <tr>
          <th>Beneficiary Email</th>
          <td><?php echo e($customer->beneficiary_email); ?></td>
        </tr>
        <tr>
          <th>Beneficiary Birth Date</th>
          <td><?php echo e($source->dformat($customer->beneficiary_birth_date)); ?></td>
        </tr>
        <tr>
          <th>Wedding Anniversary Date</th>
          <td><?php echo e($source->dformat($customer->marriage_date)); ?></td>
        </tr>
      </table>
        <?php endif; ?>
        <table class="table table-bordered table-striped">
          <tr>
            <th>Date Of Birth</th>
            <td><?php echo e($source->dformat($customer->date_of_birth)); ?></td>
          </tr>
          <tr>
            <th>Age</th>
            <td><?php echo e($source->ageCalc($customer->date_of_birth)); ?> Years</td>
          </tr>
          <tr>
            <th>Status</th>
            <td><?php echo e($customer->status); ?></td>
          </tr>
          <tr>
            <th>Contact Full Name</th>
            <td><?php echo e($customer->full_name); ?></td>
          </tr>
          <tr>
            <th>Contact Title</th>
            <td><?php echo e($customer->contact_title); ?></td>
          </tr>
          <tr>
            <th>Website</th>
            <td><?php echo e($customer->website); ?></td>
          </tr>
          <tr>
            <th>Notes</th>
            <td><?php echo e($customer->notes); ?></td>
          </tr>
          <tr>
            <th>Assets_Notes</th>
            <td><?php echo e($customer->assets_notes); ?></td>
          </tr>
          <tr>
            <th>Lead Owner</th>
            <td><?php echo e($customer->name); ?></td>
          </tr>
          <tr>
            <th>Lead Date</th>
            <td><?php echo e($source->dtformat($customer->created_at)); ?></td>
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
          <td><?php echo e($user->lead_type); ?></td>
        </tr>
        <tr>
          <th>Name:</th>
          <td><?php echo e($user->first_name.' '.$user->last_name); ?></td>
        </tr>
        <tr>
          <th>Email:</th>
          <td><?php echo e($user->email); ?></td>
        </tr>
        <?php if($customer->mobile): ?>
        <tr>
          <th>Mobile Number:</th>
          <td><?php echo e($customer->mobile); ?> <span class="btn btn-success btn-sm" onclick="call(this); window.location='tel:<?php echo e($customer->mobile); ?>'"><i class="fa fa-phone"></i> </span></td>
        </tr>
        <?php endif; ?>
        <?php if($customer->home): ?>
        <tr>
          <th>Home Phone:</th>
          <td><?php echo e($customer->home); ?> <span class="btn btn-success btn-sm" onclick="call(this); window.location='tel:<?php echo e($customer->home); ?>'"> <i class="fa fa-phone"></i> </span></td>
        </tr>
        <?php endif; ?>
        <?php if($customer->work): ?>
        <tr>
          <th>Work Number:</th>
          <td><?php echo e($customer->work); ?><span class="btn btn-success btn-sm" onclick="call(this); window.location='tel:<?php echo e($customer->work); ?>'"><i class="fa fa-phone"></i> </span></td>
        </tr>
        <?php endif; ?>
        <tr>
          <td colspan="2">
            <div style="max-width: 400px" class="hide" id="call_end">
              
              <button class="btn btn-danger" style="width:100%; display:inline-block" onclick="callEnd()" ><i class="fa fa-phone"></i> End</button>
            </div>
          </td>
        </tr>
      </table>
      <form action="<?php echo e(route('calls.store')); ?>" id="callForm" method="post">
        <?php echo csrf_field(); ?>
          <div class="customer_call_information mt-3" id="customer_call_information" style="display: none">
              <label for="">Have you talked to the customer?</label> <br>
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
                  <label for="">What you want about call?</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="Review" name="aboutcall" id="flexRadio1" onchange="check(this)">
                    <label class="form-check-label" for="flexRadioDisabled"> Review </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="Reminder" name="aboutcall" id="flexRadio2" onchange="check(this)">
                    <label class="form-check-label" for="flexRadioCheckedDisabled"> Reminder </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="Appointment" name="aboutcall" id="flexRadioChecked3" onchange="check(this)">
                    <label class="form-check-label" for="flexRadioCheckedDisabled"> Appointment </label>
                  </div> 
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="Not Interested" name="aboutcall" id="flexRadioChecked4" onchange="callEnd(); check(this)">
                    <label class="form-check-label" for="flexRadioCheckedDisabled"> Not interested </label>
                  </div>            
                </div>
            <!--second section end here-->
      
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
                <input type="hidden" name="customer_id" id="customer_id" value="<?php echo e($customer->id); ?>">
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

<script>
  // function check(e)
  // {
  //   if(e.value == 'Review')
  //   {
  //     document.getElementById('rev_remarks').setAttribute('required', 'required');
  //   }
  //   console.log(e);
  // }
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e('/js/custom_js.js'); ?>"></script>
      
<script>
  var customer_id = <?php echo e($customer->id); ?>;
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/fflfalcon/resources/views/customers/view.blade.php ENDPATH**/ ?>