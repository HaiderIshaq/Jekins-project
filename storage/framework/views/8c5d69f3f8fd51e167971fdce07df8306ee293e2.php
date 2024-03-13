<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | Billing '); ?>
</title>


    <div id="app">
      <billing-prism
      usercompany="<?php echo e($user[0]); ?>"
      useregion="<?php echo e($user[2]); ?>"
      usercompanyname="<?php echo e($user[1]->company_name); ?>"
      usercompanyprefix="<?php echo e($user[1]->company_prefix); ?>"
      useregionname="<?php echo e($user[3]); ?>"
      useregionprefix="<?php echo e($user[4]); ?>"
    ></billing-prism>
        
        


    </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Bill/index.blade.php ENDPATH**/ ?>