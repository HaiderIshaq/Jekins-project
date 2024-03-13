<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
.page_break { page-break-before: always; }
.imgs{
    /* float: left; */
    width: 300px;
    padding-left: 25px;
    padding-right:25px;
    padding-top: 25px;
    padding-bottom: 25px;
    height:300px
}
@page  {
            margin: 150px 0px 150px 0px !important;
            padding: 150px 0px 150px 0px !important;
        }
</style>
<body>
    <div class="" style="text-align: center;padding-top:70px">

        <?php $__currentLoopData = $imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                <img src="<?php echo e($item->path); ?>"  class="imgs img" alt="">
                
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
        
    

</body>
</html><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/Report/imagepage.blade.php ENDPATH**/ ?>