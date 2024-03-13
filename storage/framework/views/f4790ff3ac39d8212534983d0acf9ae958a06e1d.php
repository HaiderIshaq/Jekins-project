<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT Traders | Prism Survey Stats'); ?>
</title>

<style>
.badge{
    font-size: 12px;
    margin-top:8px
}

#myTable1 td{
    font-size: 12px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
    <div id="app">
        <prism-stats

        usertoken="<?php echo e($user[2]); ?>" 

    ></prism-stats>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/stats.blade.php ENDPATH**/ ?>