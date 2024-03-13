<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | Supervision Edit '); ?>
</title>

<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fcfdff;
    background-color: #007bff;
}

hr{
       background-color: rgb(39, 81, 41);
        }

</style>



        <div id="app">
            <supervision-edit
          id="<?php echo e($data[1]); ?>"
                jobid="<?php echo e($data[0]); ?>"
                usertoken="<?php echo e($data[4]); ?>"
                common="<?php echo e($data[2]); ?>"
                cmpny="<?php echo e($data[3]); ?>"
           ></supervision-edit>

        </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Supervision/edit.blade.php ENDPATH**/ ?>