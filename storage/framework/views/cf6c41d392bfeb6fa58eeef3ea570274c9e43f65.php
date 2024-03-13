<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | Muccadum'); ?>

<style>
        hr{
       background-color: rgb(39, 81, 41);
        }
        </style>
</title>

        <div id="app">
            <muccaduum
            usercompany="<?php echo e($user[0]); ?>"
            usertoken="<?php echo e($user[2]); ?>"
            usercompanyname="<?php echo e($user[1]->company_name); ?>"
            usercompanyprefix="<?php echo e($user[1]->company_prefix); ?>"
           ></muccaduum>

        </div>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Muccaduum/create.blade.php ENDPATH**/ ?>