<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calculation Sheet</title>

</head>
<style media="print">
 /* cyrillic-ext */

body{background:none;
}



.container{width:90%}
.container-fluid{width:100%}

table{
     width: 95%;
     border-collapse: collapse

 }

 table, td, th{
     border:1px solid black;
     padding-left:20px;
     padding-right:20px;
     padding-top:20px;
     padding-bottom:20px;
     font-size:13px

    }
th, td {
  padding: 15px;
}
.row{

}
div.box{
   float:left;
   width:50%;
   font-size:13px
}

div.box1{
    width:60%;
}

div.box2{
    width:60%;
    border-bottom: 1px solid black;
}
.details-box{
    float:right;
   border:1px solid black;
   font-size:12px;
   padding:5px 40px 5px 5px;
   margin-top:10px;
   width:30%;
   margin-right:35px;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}

.heading-box{
    width:250px;border:1px solid black;padding:3px;height:20px;margin-bottom: 10px
}
.page_break { page-break-before: always; }

.signature{ 
    border-top: 1px solid #000;
    width: 200px; 
    text-align: center;
    }

</style>
<body>  

<?php if($stamp==true): ?>
<div style="position: absolute; left:10%; right: 0; top: 50%; bottom: 0;">
    <img src="images/prismstamp.png" 
         style="width: 50mm; height: 50mm; margin: 0;" />
</div>
<?php endif; ?>

       
        <div class="container-fluid" style="padding-top: 70px">
            <div>
                <h3 style="text-decoration: underline;text-align:center">Calculation Sheet</h3>
            </div>
          
        </div>
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row" style="border-top: 1px solid black;border-bottom: 1px solid black;padding:5px">
                <div class="box box1" style="font-size: 14px">
                    <span>Ref: <?php echo e($job_id); ?></span>
                </div>
              
            </div>
    
        </div>

        <div class="container"  style="margin:0 auto;width:90%;border:2px solid black;margin-top:8px">
                
                <div class="row" style="padding:5px 5px">
                    
                    <div class="box box1" style="width:40%">
                        <b><?php echo e('is_takaful'==0?'Name of Insured':'Name of Participant'); ?></b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($name_of_insured); ?></span>
                    </div>
                    
                </div>

                <div class="row" style="padding:5px 5px">
                    
                    <div class="box box1" style="width:40%">
                        <b>Tracking ID</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($tracking_id); ?></span>
                    </div>
                    
                </div>

                <div class="row" style="padding:5px 5px">
                    
                    <div class="box box1" style="width:40%">
                        <b>Registration #</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($reg_no); ?></span>
                    </div>
                    
                </div>

                <div class="row" style="padding:5px 5px">
                    
                    <div class="box box1" style="width:40%">
                        <b>Agreed Labour</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($repaired_assesed); ?></span>
                    </div>
                    
                </div>

                <div class="row" style="padding:5px 5px">
                    
                    <div class="box box1" style="width:40%">
                        <b>Add PST</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($repaired_assesed_tax_rate); ?>%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($repaired_assesed_tax); ?></span>
                    </div>
                    
                </div>

                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Parts Amount</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($totalcostofparts); ?></span>
                    </div>
                </div>

                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Less Depreciation</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($depedrate); ?>%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($deped); ?></span>
                    </div>
                </div>
                

                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Total Amount</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($totalbefore); ?></span>
                    </div>
                </div>
                
                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Less Discount</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($discountrate); ?>%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($discount); ?></span>
                    </div>
                </div>

                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Less Salvage</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($salvagerate); ?>%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($salvage); ?></span>
                    </div>
                </div>

                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Add GST.</b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span><?php echo e($gstaxrate); ?>%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($gstax); ?></span>
                    </div>
                </div>
 

                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Net Payable Amount</b>
                    </div>
                    <div class="box box2">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e(number_format($finalamount)); ?>

                        </span>
                    </div>
                </div>
               
                <div class="row" style="padding:5px 5px">
                    <div class="box box1" style="width:40%">
                        <b>Payment In Favour Of <br><?php echo e('is_takaful'==0?'Workshop/Insured':'Workshop/Participant'); ?></b>
                    </div>
                    <div class="box box2">
                        &nbsp;&nbsp;<span>Pay Amount to <?php echo e($manufacture); ?></span>
                    </div>
                </div>
        <div>
</div>
</div>
<div class="row" style="padding:10px;position:relative">
                    <div class="box box4" style="font-size: 13px;position:absolute">
                    
                        
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        
                    </div>

                   
                </div>
    
                <div class="container"  style="margin:0 auto;width:90%;">

                <span  style="font-size: 14px;border-top: 1px solid black;"><b>For Prism Surveyors (Pvt) Ltd.</b></span>   
            
</div>
        
        </div>

        
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/Report/calculation.blade.php ENDPATH**/ ?>