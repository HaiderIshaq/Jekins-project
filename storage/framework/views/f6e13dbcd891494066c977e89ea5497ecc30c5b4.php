<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residence Verification</title>
</head>
<style>

    .imgs{
       
        margin:5px;
        height:200px;
        width:200px;
        


    }
</style>
<body>
  
    <div style="padding-left:30px;padding-top:200px;">

         <?php $__currentLoopData = $job; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php if($value->rotate=="Yes"): ?>
             <img class="imgs" src="<?php echo e($value->path); ?>" style="transform:rotate(90deg)" alt="" alt="">

         <?php else: ?>
             <img class="imgs" src="<?php echo e($value->path); ?>" alt="" alt="">

         <?php endif; ?>
           
           
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
    </div>


</body>
</html><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Verification/Reports/residenceimages.blade.php ENDPATH**/ ?>