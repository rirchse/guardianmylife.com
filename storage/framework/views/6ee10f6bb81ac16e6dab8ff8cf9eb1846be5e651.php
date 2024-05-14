<?php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
?>


<?php $__env->startSection('content'); ?>
<style>
  .hide{display: none}
  .paginate nav{float:right}
</style>
<?php
$counter = 1;
?>
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
            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($counter); ?></td>
                <td><?php echo e($lead->lead_type); ?></td>
                <td><?php echo e($source->dformat($lead->lead_date)); ?></td>
                <td><?php echo e($lead->first_name.' '.$lead->last_name); ?></td>
                <td><?php echo e($lead->email); ?></td>
                <td><?php echo e($lead->mobile); ?></td>
                <td><?php echo e($lead->name); ?></td>
                <td>
                  <a href="<?php echo e(route('customer.show', $lead->id)); ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <?php if(auth()->user()->role == 2): ?>
                      <a href="<?php echo e(route('lead.edit', $lead->id)); ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

                      <?php if(!$lead->customer_id && $lead->assigned_to == 0): ?>
                      <a href="<?php echo e(route('lead.delete', $lead->id)); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete the lead?')"><i class="fa fa-trash"></i></a>
                      <?php endif; ?>
                    <?php endif; ?>
                </td>
            </tr>
              <?php
                $counter++;
              ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
          
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/fflfalcon/resources/views/leads/index.blade.php ENDPATH**/ ?>