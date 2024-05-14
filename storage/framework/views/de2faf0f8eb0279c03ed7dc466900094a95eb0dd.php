<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">

      <h1>Welcome To 
        <?php if(Auth::user()->role == 1): ?>
        Admin
        <?php elseif(Auth::user()->role == 2): ?>
        Agent 
        <?php else: ?>
        Employee
        <?php endif; ?>
        Dashboard</h1>
    </div>
  </div>
</div>

<?php if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3): ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <form action="<?php echo e(route('main.home')); ?>" method="get">
        <?php echo csrf_field(); ?>
        <div class="row">
          <div class="col-md-5">
              <label for="">From</label>
              <input type="date" name="from_date" value="<?php echo e(request('from_date')); ?>" class="form-control">     
          </div>
          <div class="col-md-5">
              <label for="">To</label>
              <input type="date" value="<?php echo e(request('to_date')); ?>" name="to_date" class="form-control">
          </div>
          <div class="col-md-2">        
              <button class="btn btn-success"  type="submit"  style="margin-top: 2rem">Apply</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo e($leads); ?></h3>
              <p>Available Leads</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo e(route('lead.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo e($calls); ?></h3>
              <p>Calls</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo e(route('call.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo e($appointments); ?></h3>
              <p>Appointment Set </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo e(route('appointments.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo e($sold); ?></h3>
              <p>Sold</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo e(route('customer.index')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/fflfalcon/resources/views/home.blade.php ENDPATH**/ ?>