<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | IBR'); ?>
</title>
        
        <div id="app">
             <ibr  usercompany="<?php echo e($user[0]); ?>" usercompanyname="<?php echo e($user[1]->company_name); ?>" usercompanyprefix="<?php echo e($user[1]->company_prefix); ?>"></ibr>
                  
        </div>

        
<?php $__env->stopSection(); ?>



   
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/IBR/create.blade.php ENDPATH**/ ?>