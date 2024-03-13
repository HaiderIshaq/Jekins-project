<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vehical Lumpsum Report  </title>

</head>
<style >
 /* cyrillic-ext */

body{background:none;
}
@page  *{
    margin-top: 100px;
}



.container{width:90%}
.container-fluid{width:100%}

table{
     width: 95%;
     border-collapse: collapse

 }

 table, td, th{
     border:1px solid black;
     padding-left:4px;
     padding-right:4px;
     padding-top:4px;
     padding-bottom:4px;
     font-size:11px

    }
th, td {
  /* padding: 15px; */
}
.row{

}
div.box{
   float:left;
   width:50%;
   font-size:11px
}

div.box1{
    width:60%;
}

div.box2{
    width:40%;
}
.details-box{
    float:right;
   border:1px solid black;
   font-size:12px;
   padding:3px 40px 5px 5px;
   margin-top:10px;
   width:30%;
   margin-right:35px;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}

.heading-box{
    width:250px;border:1px solid black;padding:3px;height:20px;margin-bottom: 10px; 
}
.heading-boxs{
    width:645px;border:1px solid black;padding:2px;height:13px;
    }
.page_break { page-break-before: always;margin-top: 6px }


</style>
<body>

    <?php if($stamp==true): ?>
    <div style="position: absolute; left:70%; right: 0; top: 70%; bottom: 0;">
        <img src="images/prismstamp.png" 
             style="width: 50mm; height: 50mm; margin: 0;" />
    </div>
    <?php endif; ?>
    

        <div class="container" style="margin:0 auto;width:90%;">
            <div class="row" style="border-top: 1px solid black;border-bottom: 1px solid black;padding:3px">
                <div class="box box1" style="font-size: 14px">
                    <span>Ref: <?php echo e($job_id); ?></span>
                </div>
                <div class="box box2" style="text-align: right;font-size: 14px">
                    <span>Dated: <?php echo e($report_date); ?></span>
    
                </div>
            </div>
    
        </div>
        <div class="container"  style="margin:0 auto;width:90%;height:85%;border:2px solid black;margin-top:8px">
   
            <?php if($circumstances!=''): ?>
            <div class="heading-box" style="margin: 5px">
                <h5 style="margin:0">Circumstances of Loss</h5>
             </div>
            <div style="width:100%;padding-left:5px;padding-right:5px;">
                <span style="font-size:12px;margin:8px"><?php echo e($circumstances); ?></span>
            </div>
            <?php endif; ?>

                <div class="row" style="padding:3px 3px;width:100%">
                    <div class="heading-box">
                        <h5 style="margin:0">Parts to be Repaired / Replaced</h5>
                     </div>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <b>Description</b>
                    </div>

                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <b>Description</b>
                    </div>

                    <?php $__currentLoopData = $repairedAndReplaced; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($key==54): ?>
                        
                        <div class="box page_break" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                            <?php echo e($rec->title==''?'-':$rec->title); ?>

                        </div>

                        <?php else: ?>
                        <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                            <?php echo e($rec->title==''?'-':$rec->title); ?>

                        </div>
                        <?php endif; ?>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($prdas==true): ?>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        -
                    </div>
                    <?php endif; ?>
                    

                    <div class="box" style="width: 100%;text-align:right;padding-right:3px;">
                       <b> Workshop Demanding Labour Charges &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($repaired_labour); ?><br></b>
                       <!-- <b>Labour / Repairing Charges  Settled &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<?php echo e($repaired_assesed); ?><br></b> -->
                         
                    </div>
                    <?php if($stamp==true): ?>
                    <div style="text-align:right">
                        <img src="images/prismstamp.png" 
                             style="width: 50mm; height: 50mm; margin: 0;" />
                    </div>
                    <?php endif; ?>

                
                    
                </div>

              
             
                
             
        
            </div>


</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/Report/Partial/lumpsumReportitems.blade.php ENDPATH**/ ?>