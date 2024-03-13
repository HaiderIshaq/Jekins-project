<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vehical Lumpsum Report  </title>

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
                        <h5 style="margin:0">Parts to be Repaired / Replaced</h5>
                     </div>
                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <b>Description</b>
                    </div>

                    <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                        <b>Description</b>
                    </div>

                    <?php $__currentLoopData = $repairedAndReplaced; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="box" style="width:48.6%;float: left;border:1px solid black;padding:3px">
                            <?php echo e($rec->title==''?'-':$rec->title); ?>

                        </div>
                        
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

                    
                </div>

              
             
                <?php if(count($repairedAndReplaced)>17): ?>
                <div class="heading-box page_break" style="margin-left:6px;margin-top:4px;">

                <?php else: ?>
                <div class="heading-box" style="margin-left:6px;margin-top:4px;">

                <?php endif; ?>
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
                    <?php if($salvage!=0): ?>
                    <tr>
                        <td>Less Salvage on Parts</td>
                        <td><?php echo e($salvagerate); ?>%</td>
                        <td><?php echo e($part_rates==true?$salvage:''); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if($gstax!=0): ?>                            
                    <tr>
                        <td>Add GST on Parts</td>
                        <td><?php echo e($gstaxrate); ?>%</td>
                        <td><?php echo e($part_rates==true?$gstax:''); ?></td>
                    </tr>
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

                <div class="row" style="padding:1px 1px">
                    <div class="heading-boxs" style="border:none; text-align: center;">
                        <h5 style="margin:0;">Settlement on Lumpsum Basis (Labour+ Parts) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($lumpsum); ?></h5>
                    </div>
                </div>

                <div style="width: 100%;">
                    <div class="row" style="padding:5px"    >
                        <div class="box box4" style="font-size: 12px; text-align: justify;width: 100%">
                            <p>We held detailed discussion with the repairer to settle the matter on Lump Sum
                                basis. Finally the repairer expressed his willingness to accept <?php echo e($lumpsum); ?>/-  (<?php echo e($lumpsumWords); ?>) 
                                on Lump Sum basis towards cost of repair/replacement, which in our opinion is fair & reasonable.
                            </p>
                        </div>
                    
                    </div>
                </div>

                <?php if($dents_remarks!=null): ?>
                        <div class="row" style="padding:5px 5px">
                            <div class="heading-boxs">
                                <h5 style="margin:0">Remarks</h5>
                            </div>
                            <div class="box box4" style="padding:2px 2px; font-size: 12px; text-align: justify;width: 100%">
                            <span><?php echo e($dents_remarks); ?></span>
                        </div>
                           
                        </div>
                    <?php endif; ?>

                <div class="row" style="padding:3px 3px">
                    <div class="heading-boxs" >
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
                
             
        
            </div>

            <div style="width: 90%;margin-left:33px">
                <div class="row" style="padding:0px"    >
                    <div class="box box4" style="font-size: 10px; text-align: justify;width: 100%">
                        <span>The Insurance survey firm or any of its Director, employee, associate or any other related party has any interest directly or
                        indirectly by way of Insurance/Takaful Operator, ownership, agency, commission, repair, disposal or salvage nor in any other
                        way other than as an insurance surveyor/Takaful Operator in the property or interest which constitute the subject matter of this
                        survey report. Issued subject to the terms & conditions of the relevant Insurance Policy.</span>
                    </div>
                   
                </div>
    
                <div class="row" style="padding:0px;position:relative">
                    <div class="box box4" style="font-size: 13px;position:absolute">
                        <h3 style="">ISSUED WITH PREJUDICE</h3>
                        <?php if($stamp==true): ?>
                        <img src="images/prismstamp.png" 
                             style="display:block; margin-top: -55px;padding:0;width:40mm;height:40mm;" />
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
    
    

</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/Report/Partial/lumpsumReport2.blade.php ENDPATH**/ ?>