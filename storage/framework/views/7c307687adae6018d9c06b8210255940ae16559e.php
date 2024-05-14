
 <style>
  .pagination{
    float:right !important;
  }
 </style>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3>View Customers</h3>
        <table id="examp/le1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Sr#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Company</th>
            <th>Policy No</th>
            <th>Applied By</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            
          <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
              <td><?php echo e($loop->index+1); ?></td>
              <td><?php echo e($customer->first_name); ?> <?php echo e($customer->last_name); ?></td>
              <td><?php echo e($customer->email); ?></td>
              <td><?php echo e($customer->mobile); ?></td>
              <td><?php echo e($customer->company_name); ?></td>
              <td><?php echo e($customer->policy_number); ?></td>
              <td><?php echo e($customer->name); ?></td>
              <td><a href="<?php echo e(route('customer.edit',$customer->customer_id)); ?>"><i title="Update Customer" class="fa fa-edit" aria-hidden="true"></i></a></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <?php echo $customers->links(); ?>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": false ,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/fflfalcon/resources/views/customers/index.blade.php ENDPATH**/ ?>