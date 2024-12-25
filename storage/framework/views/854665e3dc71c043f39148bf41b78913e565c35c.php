<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-dismissible sh/ow" role="alert">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
<div class="clearfix"></div>
</div>

<?php endif; ?>

<?php if($message = Session::get('error')): ?>

<div class="alert alert-danger alert-dismissible sh/ow" role="alert" onclick="this.style.display='none'">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
  <div class="clearfix"></div>

</div>

<?php endif; ?>

<?php if($message = Session::get('warning')): ?>

<div class="alert alert-warning alert-dismissible sh/ow" role="alert">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
  <div class="clearfix"></div>

</div>

<?php endif; ?>

<?php if($message = Session::get('info')): ?>

<div class="alert alert-info alert-dismissible sh/ow" role="alert">
  <strong><?php echo e($message); ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
  <div class="clearfix"></div>

</div>

<?php endif; ?>

<?php if($errors->any()): ?>

<div class="alert alert-danger alert-dismissible sh/ow" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
  
  <ul>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>

</div>

<?php endif; ?><?php /**PATH /srv/www/fflfalcon/resources/views/layouts/message.blade.php ENDPATH**/ ?>