<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | Prism Surveyors Edit '); ?>
</title>
        
<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fcfdff;
    background-color: #007bff;
}

</style>


        <div id="app">
                <prism-intimating

                  id="<?php echo e($data[1]); ?>"
                jobid="<?php echo e($data[0]); ?>" 
                usertoken="<?php echo e($data[4]); ?>" 
                common="<?php echo e($data[2]); ?>"
                cmpny="<?php echo e($data[3]); ?>"  
                 
                ></prism-intimating>
        </div>
       

        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/edit.blade.php ENDPATH**/ ?>