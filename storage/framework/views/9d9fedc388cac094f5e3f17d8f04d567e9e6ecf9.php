<?php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
$counter = 1;
?>


 <style>
  .pagination{
    float:right !important;
  }
  .hide{display: none}
 </style>
<?php $__env->startSection('content'); ?>
<h3>Add a Single Lead</h3><br>
<div class="card">
    <div class="card-body">
<form action="<?php echo e(route('lead.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="lead_type">Lead Type</label>
                <select required class="form-control" id="lead_type" name="lead_type" onchange="showHide(this)">
                    <option value="">--- Select Lead Type ---</option>
                    <option value="Life Insurance">Life Insurance</option>
                    <option value="Health Insurance">Health Insurance</option>
                    <option value="Small Business">Small Business</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lead_date">Lead Date</label>
                <input type="date" class="form-control" id="lead_date" name="lead_date">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="home">Home Number</label>
                <input type="text" class="form-control" id="home" name="home" onkeyup="phoneFormat(this)">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" class="form-control" id="mobile" name="mobile" onkeyup="phoneFormat(this)">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="work">Work Number</label>
                <input type="text" class="form-control" id="work" name="work" onkeyup="phoneFormat(this)">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name">
            </div>
        </div>
        <div style="clear:both;width:100%"></div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="street_address">Street Address</label>
                <input type="text" class="form-control" id="street_address" name="street_address">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip">
            </div>
        </div>
        <div class="col-md-6 LI">
            <!-- insurance -->
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
            </div>
        </div>
        <div class="col-md-6 LI">
            <!-- insurance -->
            <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control" id="age" name="age">
        </div>
        </div>
        <div class="col-md-12 LI"><br><hr>
            <!-- insurance -->
            <div class="form-group">
            <label for="mortgage">
            <input type="checkbox" class="" id="mortgage" name="mortgage" value="Yes" onchange="showMortgage(this)"> Do you have a Mortgage?</label>
        </div>
        </div>
        <!-- insurance -->
        <div class="col-md-3 LI">
            <div class="form-group hide">
                <label for="lender">Lender Name</label>
                <input type="text" class="form-control" id="lender" name="lender">
            </div>
        </div>
        <!-- insurance -->
        <div class="col-md-3 LI">
            <div class="form-group hide">
                <label for="mortgage_date">Mortgage Date</label>
                <input type="date" class="form-control" id="mortgage_date" name="mortgage_date">
            </div>
        </div>
        <!-- insurance -->
        <div class="col-md-3 LI">
            <div class="form-group hide">
                <label for="mortgage_amount">Mortgage Total</label>
                <input type="text" class="form-control" id="mortgage_amount" name="mortgage_amount">
            </div>
        </div>
        <!-- insurance -->
        <div class="col-md-3 LI">
            <div class="form-group hide">
                <label for="mortgage_balance">Mortgage Balance</label>
                <input type="text" class="form-control" id="mortgage_balance" name="mortgage_balance">
            </div>
        </div>
        <div class="col-md-12 LI"><br><hr>
            <!-- insurance -->
            <div class="form-group">
                <label for="beneficiary">
                <input type="checkbox" class="" id="beneficiary" name="beneficiary" value="Yes" onchange="showMarried(this)"> Do you have beneficiary?</label>
            </div>
        </div>
        <div class="col-md-4 LI BEN">
            <div class="form-group hide">
                <label for="relation">Relation with Beneficiary?</label>
                <input class="form-control" id="relation" name="relation" list="relation_names" onkeyup="checkMarried(this)">
                <datalist id="relation_names">
                    <option value="Wife">
                    <option value="Husband">
                    <option value="Son">
                    <option value="Daughter">
                    <option value="Father">
                    <option value="Mother">
                    <option value="Brother">
                    <option value="Sister">
            </datalist>
            </div>
        </div>
        <div class="col-md-4 LI BEN">
            <div class="form-group hide">
                <label for="beneficiary_name">Beneficiary Name</label>
                <input type="text" class="form-control" id="beneficiary_name" name="beneficiary_name">
            </div>
        </div>
        <div class="col-md-4 LI BEN">
            <div class="form-group hide">
                <label for="beneficiary_mobile">Beneficiary Mobile</label>
                <input type="text" class="form-control" id="beneficiary_mobile" name="beneficiary_mobile" onkeyup="phoneFormat(this)">
            </div>
        </div>
        <div class="col-md-4 LI BEN">
            <div class="form-group hide">
                <label for="beneficiary_email">Beneficiary Email</label>
                <input type="text" class="form-control" id="beneficiary_email" name="beneficiary_email">
            </div>
        </div>
        <div class="col-md-4 LI BEN">
            <div class="form-group hide">
                <label for="spouse_birth_date">Date of Birth</label>
                <input type="date" class="form-control" id="spouse_birth_date" name="beneficiary_birth_date">
            </div>
        </div>
        <div class="col-md-4 LI">
            <div class="form-group hide">
                <label for="marriage_date">Wedding Anniversary Date</label>
                <input type="date" class="form-control" id="marriage_date" name="marriage_date">
            </div>
        </div>
        <div class="col-md-6 SB">
            <!-- small business -->
            <div class="form-group">
            <label for="full_name">Contact Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name">
        </div>
        </div>
        <div class="col-md-6 SB">
            <!-- small business -->
            <div class="form-group">
            <label for="contact_title">Contact Title</label>
            <input type="text" class="form-control" id="contact_title" name="contact_title">
        </div>
        </div>
        <div class="col-md-12 SB">
            <!-- small business -->
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes"></textarea>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

</div>
</div>
<br>
<div class="row" id="current_lead">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
        <div class="label label-info">
            <h3>Current Leads</h3>
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Lead Type</th>
                <th>Lead Date</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Lead Owner</th>
                <th style="min-width: 100px">Action</th>
            </tr>
            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($counter); ?></td>
                <td><?php echo e($lead->lead_type); ?></td>
                <td><?php echo e($source->dformat($lead->lead_date)); ?></td>
                <td><?php echo e($lead->first_name); ?></td>
                <td><?php echo e($lead->last_name); ?></td>
                <td><?php echo e($lead->email); ?></td>
                <td><?php echo e($lead->mobile); ?></td>
                <td><?php echo e($lead->name); ?></td>
                <td>
                    <i class="btn btn-info btn-sm fa fa-eye" onclick="view(this)"></i>
                    <a href="<?php echo e(route('lead.edit', $lead->id)); ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <tr class="hide">
                <td colspan=3>
                    <?php if($lead->assigned_to): ?>
                    <p><b>Assigned To:</b> <?php echo e($lead->assigned_to); ?></p>
                    <?php endif; ?>
                    <?php if($lead->home): ?>
                    <p><b>Home Number:</b> <?php echo e($lead->home); ?></p>
                    <?php endif; ?>
                    <?php if($lead->work): ?>
                    <p><b>Work Number:</b> <?php echo e($lead->work); ?></p>
                    <?php endif; ?>
                    <?php if($lead->email): ?>
                    <p><b>Email:</b> <?php echo e($lead->email); ?></p>
                    <?php endif; ?>
                    <?php if($lead->company_name): ?>
                    <p><b>Company Name:</b> <?php echo e($lead->company_name); ?></p>
                    <?php endif; ?>
                    <?php if($lead->street_address): ?>
                    <p><b>Street Address:</b> <?php echo e($lead->street_address); ?></p>
                    <?php endif; ?>
                    <?php if($lead->city): ?>
                    <p><b>City:</b> <?php echo e($lead->city); ?></p>
                    <?php endif; ?>
                    <?php if($lead->state): ?>
                    <p><b>State:</b> <?php echo e($lead->state); ?></p>
                    <?php endif; ?>
                    <?php if($lead->zip): ?>
                    <p><b>Zip:</b> <?php echo e($lead->zip); ?></p>
                    <?php endif; ?>
                </td>
                <?php if($lead->lead_type == 'Life Insurance' || $lead->lead_type == 'Health Insurance'): ?>
                <td colspan=3>
                    <?php if($lead->date_of_birth): ?>
                    <p><b>Date of Birth:</b> <?php echo e($source->dformat($lead->date_of_birth)); ?></p>
                    <?php endif; ?>
                    <?php if($lead->age): ?>
                    <p><b>Age:</b> <?php echo e($lead->age); ?></p>
                    <?php endif; ?>
                    <?php if($lead->mortgage): ?>
                    <p><b>Do you have a Mortgage?:</b> <?php echo e($lead->mortgage); ?></p>
                    <?php endif; ?>
                    <?php if($lead->lender): ?>
                    <p><b>Lender Name:</b> <?php echo e($lead->lender); ?></p>
                    <?php endif; ?>
                    <?php if($lead->mortgage_date): ?>
                    <p><b>Mortgage Date:</b> <?php echo e($lead->mortgage_date); ?></p>
                    <?php endif; ?>
                    <?php if($lead->mortgage_amount): ?>
                    <p><b>Mortgage Total:</b> <?php echo e($lead->mortgage_amount); ?></p>
                    <?php endif; ?>
                    <?php if($lead->mortgage_balance): ?>
                    <p><b>Mortgage Balance:</b> <?php echo e($lead->mortgage_balance); ?></p>
                    <?php endif; ?>
                    <?php if($lead->policy_number): ?>
                    <p><b>Policy Number:</b> <?php echo e($lead->policy_number); ?></p>
                    <?php endif; ?>
                    <?php if($lead->policy_issued_date): ?>
                    <p><b>Policy Issued Date:</b> <?php echo e($lead->policy_issued_date); ?></p>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <td colspan=4>
                    <?php if($lead->married): ?>
                    <p><b>Are you Married?:</b> <?php echo e($lead->married); ?></p>
                    <?php endif; ?>
                    <?php if($lead->spouse_name): ?>
                    <p><b>Spouse Name:</b> <?php echo e($lead->spouse_name); ?></p>
                    <?php endif; ?>
                    <?php if($lead->spouse_birth_date): ?>
                    <p><b>Spouse Date of Birth?:</b> <?php echo e($lead->spouse_birth_date); ?></p>
                    <?php endif; ?>
                    <?php if($lead->marriage_date): ?>
                    <p><b>Wedding Anniversary Date:</b> <?php echo e($lead->marriage_date); ?></p>
                    <?php endif; ?>
                    <?php if($lead->full_name): ?>
                    <p><b>Contact Full Name:</b> <?php echo e($lead->full_name); ?></p>
                    <?php endif; ?>
                    <?php if($lead->contact_title): ?>
                    <p><b>Contact Title:</b> <?php echo e($lead->contact_title); ?></p>
                    <?php endif; ?>
                    <?php if($lead->website): ?>
                    <p><b>Website:</b> <?php echo e($lead->website); ?></p>
                    <?php endif; ?>
                    <?php if($lead->monthly_premium): ?>
                    <p><b>Monthly Premium:</b> <?php echo e($lead->monthly_premium); ?></p>
                    <?php endif; ?>
                    <?php if($lead->contract_rate): ?>
                    <p><b>Contract Rate:</b> <?php echo e($lead->contract_rate); ?></p>
                    <?php endif; ?>
                    <?php if($lead->commission_rate): ?>
                    <p><b>Commission Rate:</b> <?php echo e($lead->commission_rate); ?></p>
                    <?php endif; ?>
                    <?php if($lead->notes): ?>
                    <p><b>Notes:</b> <?php echo e($lead->notes); ?></p>
                    <?php endif; ?>
                    <div style="text-align:right"><a onclick="return confirm('Are you sure you want to delete this lead?')" class="text-danger" title="Delete" href="<?php echo e(route('lead.delete', $lead->id)); ?>"><i class="fa fa-trash"></i></a></div>
                </td>
            </tr>
                <?php
                $counter++;
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <div class="col-md-12">
            <a href="<?php echo e(route('lead.index')); ?>" class="btn btn-info">View All Leads</a>
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

    function showHide(e)
    {
        console.log(e.options[e.selectedIndex].value)
        var SB = document.getElementsByClassName('SB');
        var LI = document.getElementsByClassName('LI');

        if(e.options[e.selectedIndex].value == 'Small Business')
        {
            for(var m = 0; m < LI.length; m++)
            {
                LI[m].classList.add('hide');
            }
            
            for(var m = 0; m < SB.length; m++)
            {
                SB[m].classList.remove('hide');
            }
        }
        else
        {
            for(var m = 0; m < SB.length; m++)
            {
                SB[m].classList.add('hide');
            }

            for(var m = 0; m < LI.length; m++)
            {
                LI[m].classList.remove('hide');
            }
        }
    }

    //mortgage fields show hide
    function showMortgage(e)
    {
        var mrg = e.parentNode.parentNode.parentNode.nextElementSibling;
        var mrg1 = mrg.firstChild.nextElementSibling;
        var mrg2 = mrg.nextElementSibling.firstChild.nextElementSibling;
        var mrg3 = mrg.nextElementSibling.nextElementSibling.firstChild.nextElementSibling;
        var mrg4 = mrg.nextElementSibling.nextElementSibling.nextElementSibling.firstChild.nextElementSibling;

        mrg1.classList.toggle('hide');
        mrg2.classList.toggle('hide');
        mrg3.classList.toggle('hide');
        mrg4.classList.toggle('hide');        
    }

    //mortgage fields show hide
    function showMarried(e)
    {
        var bens = document.getElementsByClassName('BEN');
        for(var x = 0; bens.length > x; x++)
        {
            bens[x].children[0].classList.toggle('hide');
        }
    }

    //phone number format
    function phoneFormat(e)
    {
        var numbers = e.value.replace(/\D/g, ''),
        char = {0:'(', 3:') ', 6:'-'};
        e.value = '';
        for(var i = 0; i < numbers.length; i++)
        {
            e.value += (char[i]||'') + numbers[i];
        }
    }

    /* check married */
    function checkMarried(e)
    {
        var marriage_date = document.getElementById('marriage_date');
        if(e.value == 'Husband' || e.value == 'Wife')
        {
            marriage_date.parentNode.classList.remove('hide');
        }
        else
        {
            marriage_date.parentNode.classList.add('hide');
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/fflfalcon/resources/views/leads/create.blade.php ENDPATH**/ ?>