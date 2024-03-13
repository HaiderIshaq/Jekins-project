<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | Post/Edit Receipts'); ?>
</title>


    <div id="app">
        <billing-edit
            usercompany="<?php echo e($data[0]); ?>"
            useregion="<?php echo e($data[2]); ?>"
            usercompanyname="<?php echo e($data[1]->company_name); ?>"
            usercompanyprefix="<?php echo e($data[1]->company_prefix); ?>"
            useregionname="<?php echo e($data[3]); ?>"
            useregionprefix="<?php echo e($data[4]); ?>"
            jobid="<?php echo e($data[5]); ?>"
          ></billing-edit>


    </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Bill/edit.blade.php ENDPATH**/ ?>