<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | Prism Surveyors (Pvt) Ltd.'); ?>
</title>
        
        <div id="app">
            <prism
            usercompany="<?php echo e($user[0]); ?>"
            usertoken="<?php echo e($user[2]); ?>"
            usercompanyname="<?php echo e($user[1]->company_name); ?>"
            usercompanyprefix="<?php echo e($user[1]->company_prefix); ?>" 
           ></prism>
        </div>

        
<?php $__env->stopSection(); ?>



   
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/create.blade.php ENDPATH**/ ?>