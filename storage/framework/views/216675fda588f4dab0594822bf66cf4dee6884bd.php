<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT Traders | MCR'); ?>
</title>

<style>
.badge{
    font-size: 15px;
    margin-top:8px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
<a href="/home" class="btn btn-primary">Back</a>
<a href="/mcrCreate"><button class="btn btn-success"><i class="fa fa-plus pr-2"></i>New MCR</button></a>



<table class="table display" id="myTable1" style="width:100%" style="width:100%" >
        
        <tbody>
        </tbody>
        </table>


        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/MCR/index.blade.php ENDPATH**/ ?>