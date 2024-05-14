<?php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
?>



<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <?php if(Auth::user()->role != 1): ?>
    <div class="card card-body">
        <h3>Leads Upload File <a class="btn btn-info" style="float:right" href="<?php echo e(route('lead.index')); ?>">View</a></h3><br>
        <form action="<?php echo e(route('lead.upload.store')); ?>" method="post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
        <div class="row">   
          <div class="col-md-4">
            <div class="form-group">
              <label>Name</label>
              <select name="lead_type" required id="lead_name" class="form-control">
                  <option value="">-- Please Select --</option>
                  <option value="Life Insurance">Life Insurance</option>
                  <option value="Health Insurance">Health Insurance</option>
                  <option value="Small Business">Small Business </option>            
              </select>
            </div>       
          </div>   
            <div class="col-md-4" id="lead_type" style="display: none">
              <div class="form-group">
                <label>Type</label>
                <select name="lead_sub_type" id="lead_type" class="form-control">
                    <option value="">-- Please Select --</option>
                    <option value="Mortgage">Mortgage</option>
                    <option value="Finale Expense">Finale Expense</option>
                    <option value="Instant Internet">Instant Internet</option>
                </select>
              </div>       
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <label>Purchase Date</label>
                <input type="date" required class="form-control" name="purchase_date" >          
              </div>     
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label>No Of Leads </label>
                  <input type="number" required class="form-control" id="num_lead" name="num_lead" placeholder="Enter No Of Leads" >          
                </div>     
              </div> 
              <div class="col-md-4">
                <div class="form-group">
                  <label>Amount Paid</label>
                  <input type="number" required class="form-control" id="amount_paid" name="amount_paid" placeholder="Enter Paid Amount">          
                </div>     
              </div> 
              <div class="col-md-4">
                <div class="form-group">
                  <label>Cost Per Lead</label>
                  <input type="number" class="form-control" id="cost_per_lead" disabled  placeholder="Enter Cost Per Lead">          
                  <input type="hidden" name="cost_per_lead" id="cost_per_lead1">
                </div>     
              </div>
              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Leads File</label><br>
                  <input type="file" class="form-control"  name="fileURL" required>          
                </div>     
              </div>    
            <!-- /.col -->
            <button type="submit" class="btn btn-success ml-2">Submit</button>
          </div>
        </form>
    </div>
    <?php endif; ?>

  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Sr#</th>
          <th>Type</th>
          <th>Date</th>
          <th>Num Leads</th>
          <th>Amount Paid</th>
          <th>Cost Per Lead</th>
          <th>Action</th>
        </tr>
        </thead>
       <tbody>
        <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->index+1); ?></td>
            <td><?php echo e($lead->type); ?></td>
            <td><?php echo e($source->dformat($lead->purchase_date)); ?></td>
            <td><?php echo e($lead->no_of_leads); ?></td>
            <td><?php echo e($lead->amount_paid); ?></td>
            <td><?php echo e($lead->cost_per_lead); ?></td>
            <th>
              <a href="<?php echo e(route('lead.show',$lead->id)); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp;
              
              <form action="<?php echo e(route('lead.destroy', $lead->id)); ?>" method="post" style="max-width: 20px; display:inline-block">
                  <?php echo method_field('delete'); ?>
                  <?php echo csrf_field(); ?>
                  <button type="submit" onclick="return confirm('Are you sure you want to delete the lead?')" style="border:none">
                    <i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                </form>
            </th>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </tbody>
       
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
  // Retrieve input field elements
  const numLeadInput = document.getElementById('num_lead');
  const amountPaidInput = document.getElementById('amount_paid');
  const costPerLeadInput = document.getElementById('cost_per_lead');
  const costPerLeadInput1 = document.getElementById('cost_per_lead1');

  // Add event listeners to input fields
  numLeadInput.addEventListener('input', calculateCostPerLead);
  amountPaidInput.addEventListener('input', calculateCostPerLead);

  // Calculate and update cost_per_lead value
  function calculateCostPerLead() {
    const numLeads = parseFloat(numLeadInput.value);
    const amountPaid = parseFloat(amountPaidInput.value);

    // Perform division and update cost_per_lead value
    const costPerLead = (amountPaid / numLeads).toFixed(2);
    costPerLeadInput.value = isNaN(costPerLead) ? '' : costPerLead;
    costPerLeadInput1.value = isNaN(costPerLead) ? '' : costPerLead;
  }

  $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });
 
    document.addEventListener("DOMContentLoaded", function() {
      var leadNameSelect = document.getElementById("lead_name");
      var leadTypeDiv = document.getElementById("lead_type");
  
      leadNameSelect.addEventListener("change", function() {
        var selectedValue = this.value;
        if (selectedValue === "Insurrance") {
          leadTypeDiv.style.display = "block";
        } else {
          leadTypeDiv.style.display = "none";
        }
      });
    });
  </script>
  
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/fflfalcon/resources/views/leads/upload.blade.php ENDPATH**/ ?>