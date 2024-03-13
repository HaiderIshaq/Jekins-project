<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
     <title>Document</title>
</head>
<style>

 body{background:none}

 
 
 .container{width:90%}
 .container-fluid{width:100%}


.row{
    text-align:center
}
div.box{
   float:left;
   width:50%;
  
}

div.box1{
    width:80%
}

div.box2{
    width:20%
}

</style>
<body>
<div class="container-fluid" >
   

        <?php if($data[16]==true): ?>
        <div class="row ">
             <img src="images/logo1.PNG" alt="">
         </div>
        <?php endif; ?>
        
        <div class="box box1">
        <?php echo e($data[0]); ?>

        </div>
        <div class="box box2">
        <?php echo e(date('d-M-Y')); ?>

        </div>  

        <br>    
        <div class="container" style="position:relative;left:-20px">
            <div class="row ">
               <h2 style="text-decoration: underline;text-underline-offset: 1em;letter-spacing:1px;margin-left:40px"><b>INTERNATIONAL BUSINESS REPORT</b></h2> 
                    
            </div>
            <div class="row">
                <center><h4>of</h4></center>
              
            </div>
            <div class="row  " >
                <center> <h4 ><b> </b><?php echo e($data[1]); ?></h4></center>  
                 
            </div>
            <div class="row">
                <center>
                    <p ><?php echo e($data[2]); ?></p>
                </center>
            
            </div>
            <div class="row  " >
                <center> <h4 ><b> <?php echo e($data[20]); ?></b></h4></center>  
               
            </div>
            <div class="row ">
                <center>
                    <p><b>Reference</b>: <?php echo e($data[3]); ?> <?php echo e($data[22]); ?></p>
                </center>
            
            </div>
            <div class="row ">
                <center>
                    <p><b>Order Date</b>: <?php echo e($data[26]); ?> </p>
                </center>   
            </div>
            <div class="row">
                <center>
                    <p><b>Acknowledged & Submitted To: </b><?php echo e(strtoupper($data[19])); ?> <?php echo e(strtoupper($data[21])); ?> <?php echo e($data[24]); ?> <?php echo e($data[5]); ?></p>
                </center>
            </div>
        </div>
        
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/pdf.blade.php ENDPATH**/ ?>