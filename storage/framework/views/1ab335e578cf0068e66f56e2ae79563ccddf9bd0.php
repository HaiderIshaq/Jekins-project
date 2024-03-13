<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Partial Loss Report  </title>

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
.page_break { page-break-before: always; }


</style>
<body>

    <?php if($totalparts>10): ?>
    <?php if($stamp==true): ?>
    <div style="position: absolute; left:70%; right: 0; top: 70%; bottom: 0;">
        <img src="images/prismstamp.png" 
             style="width: 50mm; height: 50mm; margin: 0;" />
    </div>
    <?php endif; ?>
    <?php endif; ?>
    

        <div class="container" style="margin:0 auto;width:90%;padding-top: 80px">
            <div class="row" style="border-top: 1px solid black;border-bottom: 1px solid black;padding:3px">
                <div class="box box1" style="font-size: 14px">
                    <span>Ref: <?php echo e($job_id); ?></span>
                </div>
                <div class="box box2" style="text-align: right;font-size: 14px">
                    <span>Dated: <?php echo e($report_date); ?></span>
    
                </div>
            </div>
    
        </div>
        <div class="container"  style="margin:0 auto;width:90%;border:2px solid black;margin-top:8px">
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
                        <h5 style="margin:0">Parts to be Repaired</h5>
                     </div>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <b>Description</b>
                    </div>

                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <b>Description</b>
                    </div>

                    <?php $__currentLoopData = $repaired; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <?php echo e($rec->title==''?'-':$rec->title); ?>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($prdas==true): ?>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        -
                    </div>
                    <?php endif; ?>
                    

                    <div class="box" style="width: 100%;text-align:right;padding-right:3px">
                       <b> Labour / Repairing Charges Demanded &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($repaired_labour); ?><br></b>
                       <b>Labour / Repairing Charges  Settled &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<?php echo e($repaired_assesed); ?><br></b>
                         
                    </div>

                    
                </div>

                
                <?php if(count($replaced) > 0): ?>

                <div class="row" style="padding:3px 3px;width:100%">
                    <div class="heading-box">
                        <h5 style="margin:0">Parts to be Replaced</h5>
                     </div>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <div class="row">
                            <div class="box box1"><b>Description</b></div>
                            <div class="box box2" style="text-align: right"><b>Amount</b></div>
                        </div>
                    </div>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <div class="row">
                            <div class="box box1"><b>Description</b></div>
                            <div class="box box2" style="text-align: right"><b>Amount</b></div>
                        </div>
                    </div>

                    <?php $__currentLoopData = $replaced; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <div class="row">
                            <div class="box box1"><?php echo e(ucwords($item->title)); ?></div>
                            <?php if($part_rates==true): ?>
                            <div class="box box2" style="text-align: right"><?php echo e(number_format($item->amount)); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                   

                
                    
                </div>
                <?php endif; ?>
             

                <?php if($totalparts<=10): ?>
                <div class="heading-box" style="margin-left:6px;margin-top:4px">
                    <h5 style="margin:0">Total Assessment</h5>
                 </div>

                 <table class="mytable" style="text-align: right;margin:5px">
                    <tr style="text-align: right">
                        <th style="text-align: right">Cost of Parts</th>
                        <th></th>
                        <th style="text-align: right"><?php echo e($part_rates==true?number_format($totalcostofparts):''); ?></th>
                    </tr>
                    
                    <?php if($discount!=0): ?>
                    <tr>
                        <td>Less Discount on Parts</td>
                        <td><?php echo e($discountrate); ?>%</td>
                        <td><?php echo e($part_rates==true?$discount:''); ?></td>
                    </tr>                            
                    <?php endif; ?>


                    <?php if($deped!=0): ?>
                    <tr>
                        <td>Less Depreciation on Parts</td>
                        <td><?php echo e($depedrate); ?>%</td>
                        <td><?php echo e($part_rates==true?$deped:''); ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if($is_to_be_replaced_tax==1): ?>
                        <?php if($gstax!=0): ?>                            
                        <tr>
                            <td>Add GST on Parts</td>
                            <td><?php echo e($gstaxrate); ?>%</td>
                            <td><?php echo e($part_rates==true?$gstax:''); ?></td>
                        </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if($salvage!=0): ?>
                    <tr>
                        <td>Less Salvage on Parts</td>
                        <td><?php echo e($salvagerate); ?>%</td>
                        <td><?php echo e($part_rates==true?$salvage:''); ?></td>
                    </tr>
                    <?php endif; ?>

                <?php if($is_to_be_replaced_tax==0): ?>
                    <?php if($gstax!=0): ?>                            
                    <tr>
                        <td>Add GST on Parts</td>
                        <td><?php echo e($gstaxrate); ?>%</td>
                        <td><?php echo e($part_rates==true?$gstax:''); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endif; ?>
                    


                    <tr>
                        <td><b>Total</b></td>
                        <td></td>
                        <td><b><?php echo e($part_rates==true?$totalbefore:''); ?></b></td>
                    </tr>
                    <tr>
                        <td>Labour Charges Approved</td>
                        <td></td>
                        <td><?php echo e($repaired_assesed); ?></td>
                    </tr>
                    <tr>
                        <td>Add: PST on Labour@</td>
                        <td><?php echo e($repaired_assesed_tax_rate); ?>%</td>
                        <td><?php echo e($repaired_assesed_tax); ?></td>
                    </tr>
                    <tr>
                        <td><b>Total Labour with PST</b></td>
                        <td></td>
                        <td><b><?php echo e(number_format($finallabour)); ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Total Payable Amont (Labour + Parts)</b></td>
                        <td></td>
                        <td><b><?php echo e($part_rates==true?number_format($finalamount):''); ?></b></td>
                    </tr>
                    
                </table>
             
                         
                <div class="row" style="padding:3px 3px">
                    <div class="heading-boxs">
                        <h5 style="margin:0"><?php echo e($payto); ?>.</h5>
                    </div>
                </div>                        
                               
                    <?php if($re_date!=null): ?>
                        <div class="row" style="padding:3px 3px">
                            <div class="heading-boxs">
                                <h5 style="margin:0">Re-Inspection/Survey Date <?php echo e($re_inspection_date); ?></h5>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                <?php endif; ?> 
             
        
            </div>
            <?php if($totalparts<=10): ?>

            <div style="width: 90%;margin-left:33px">
                <div class="row" style="padding:0px"    >
                    <div class="box box4" style="font-size: 10px; text-align: justify;width: 100%">
                        <span>
                        <?php echo e($is_takaful==0?'The Insurance survey firm or any of its Director, employee, associate or any other related party has any interest directly or
                        indirectly by way of Insurance/Takaful Operator, ownership, agency, commission, repair, disposal or salvage nor in any other
                        way other than as an insurance surveyor/Takaful Operator in the property or interest which constitute the subject matter of this
                        survey report. Issued subject to the terms & conditions of the relevant Insurance Policy.':'The Takaful survey firm or any of its Director, employee, associate or any other related party has any interest directly or
                        indirectly by way of Insurance/Takaful Operator, ownership, agency, commission, repair, disposal or salvage nor in any other
                        way other than as an Talkaful surveyor/Takaful Operator in the property or interest which constitute the subject matter of this
                        survey report. Issued subject to the terms & conditions of the relevant PMD of Takaful.'); ?>


                    </span>
                    </div>
                    
                    
                   
                </div>
    
                <div class="row" style="padding:0px;position:relative">
                    <div class="box box4" style="font-size: 13px;position:absolute">
                        <h3 style="">ISSUED WITH PREJUDICE</h3>
                        <?php if($stamp==true): ?>
                        <img src="images/prismstamp.png" 
                             style="display:block; margin-top: -55px;padding:0;width:35mm;height:35mm;" />
                         <?php else: ?> 
                        <br>
                        <br>
                        <br>
                        <br>
                        <?php endif; ?>   
                    </div>

                   
                </div>
                
                <span class="signature" style="font-size: 14px;border-top: 1px solid black">For Prism Surveyors (Pvt) Ltd.</span>   
                
            </div>
            <?php endif; ?>            
    
    

</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/Report/Partial/second.blade.php ENDPATH**/ ?>