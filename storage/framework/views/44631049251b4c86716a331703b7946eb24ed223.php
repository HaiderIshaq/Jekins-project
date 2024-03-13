<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | IBR'); ?>
</title>

        <div id="app">
             <ibr-edit id="<?php echo e($data[1]); ?>" jobid="<?php echo e($data[0]); ?>" common="<?php echo e($data[2]); ?>" cmpny="<?php echo e($data[3]); ?>" ></ibr-edit>
        </div>

        
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/IBR/edit.blade.php ENDPATH**/ ?>