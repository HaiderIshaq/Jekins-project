<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prism Bill No : <?php echo e($data['job_number']); ?> </title>
</head>
<style  type="text/css" media="print">
    .page
    {
        page-break-after: always;
        /* page-break-inside: avoid; */
    }
</style>
<style >

body{background:none;
    
}



.container{width:90%}
.container-fluid{width:100%}

table{
     width: 100%;
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
    width:80%
}

div.box2{
    width:20%
}
.details-box{
    float:right;
   border:1px solid black;
   font-size:12px;
   padding:5px 30px 5px 5px;
   margin-top:10px;
   width:35%;
   margin-right:0px;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}
</style>
<body >
    <?php if($data['stamp']==true): ?>
    <div style="position: absolute; left:0%; right: 0; top: 63%; bottom: 0;">
        <img src="images/prismstamp.png" 
             style="width: 50mm; height: 50mm; margin: 0;" />
    </div>
    <?php endif; ?>
    <div >
        <div class="container-fluid" style="padding-top:100px">

            
            <div class="row">
                <h4 style="text-decoration:underline;text-align:center;line-height:0.1;"><b>INOVICE</b></h4>
                <h4 style="text-decoration:underline;text-align:center;line-height:0.1;"><b>INSURANCE SURVEY REPORT</b></h4>
                
                
                <h5 style="text-align:center;line-height:0.1;"><b><?php echo e($data['survey_mode']); ?> Survey</b></h5>
                
            </div>

            <div class="row" style="padding-bottom: 10px">
                <h5 style="line-height:0.1;">M/S. <?php echo e($data['insurer_name']); ?></h5>
                <h5 style="line-height:0.1;"><?php echo e($data['insurer_branch_name']); ?></h5>
            </div>
            <div class="row " style="padding-bottom:5px">

                <div class="box box1">
                    <span>Bill No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($data['job_number']); ?></span>
                </div>
                <div class="box box2"  >
                    <div style="width: 30%;float: left;">Dated:</div>
                    <div style="width: 70%;float: left;text-align:right"><?php echo e($data['dated']); ?></div>
                <span >      <span>
                </div>


            </div>



        </div>
        <div class="container" style="width:100%;padding-bottom:10px">
            <div class="row mr-3">
                <b><hr style="color:black;height:2px;margin-top:0px"></b>
            </div>

        </div>


            <div class="row">

                <table style="border:1px;font-size:">
                 
                        
                    
                            <tr >
                                
                                <td style="padding-left: 100px;">


                                        <table style="border:0px;">
                                            <tr>
                                                <td style="border:0px;padding:4px">
                                                <b>MOTOR </b>
                                            </td>
                                            </tr>
                                            <tr style="width:100%">
                                                <td  style="border:0px;padding:4px;width:100px">Name of Insured:</td>
                                                <td style="border:0px;padding:4px;"><b><?php echo e($data['name_of_insured']); ?></b></td>
                                            </tr>
                                            <?php if($data['survey_type']==8): ?>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:25%">Address:</td>
                                                <td style="border:0px;padding:4px;width:75%"><b><?php echo e($data['address']); ?></b></td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:25%">Contact Person:</td>
                                                <td style="border:0px;padding:4px;width:75%"><b><?php echo e($data['contact_person']); ?></b></td>
                                            </tr>
                                            <?php else: ?> 
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:100px">Loss #:</td>
                                                <td style="border:0px;padding:4px;"><b><?php echo e($data['contact_person']); ?></b></td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:100px">Policy #:</td>
                                                <td style="border:0px;padding:4px;"><b><?php echo e($data['contact_person']); ?></b></td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:100px">Validity From: </td>
                                                <td style="border:0px;padding:4px;width:100px"><b> <?php echo e($data['validity_from']); ?></b></td>
                                                <td style="border:0px;padding:4px;width:100px">To:</td>
                                                <td style="border:0px;padding:4px;width:100px"><b><?php echo e($data['validity_to']); ?></b></td> 
                                            </tr>
                                            <?php endif; ?>

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:25%"></td>
                                                <td style="border:0px;padding:4px;width:75%">
                                                    <b style="text-decoration: underline">Particulars of Insured Item</b>
                                                </td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:100px">Registration #:</td>
                                                <td style="border:0px;padding:4px;">
                                                    <b style=""><?php echo e($data['reg_no']); ?></b>
                                                </td>
                                            </tr>


                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:100px"><?php echo e($data['survey_item']); ?>:</td>
                                                <td style="border:0px;padding:4px;width:100px"><b> <?php echo e($data['make']); ?></b></td>
                                                <td style="border:0px;padding:4px;width:100px">Model:</td>
                                                <td style="border:0px;padding:4px;width:100px"><b><?php echo e($data['model']); ?></b></td> 
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:100px">Engine #:</td>
                                                <td style="border:0px;padding:4px;width:100px"><b> <?php echo e($data['engine_no']); ?></b></td>
                                                <td style="border:0px;padding:4px;width:100px">H.P/C.C:</td>
                                                <td style="border:0px;padding:4px;width:100px"><b><?php echo e($data['horse_power']); ?></b></td> 
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:100px">Chassis #:</td>
                                                <td style="border:0px;padding:4px;"><b><?php echo e($data['chassis_no']); ?></b></td>
                                            </tr>
                                           

                                        </table>    
                                        


                                        <table style="border:0px;margin-top:40px">
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Professional Fee:</td>
                                            </tr>
                                            <?php if($data['snaps']!=0): ?>

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Snaps:</td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php if($data['re_inspection_charges']!=0): ?>

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Re-Inspection:</td>
                                            </tr>

                                            <?php endif; ?>

                                            <?php if($data['extra_visit']!=0): ?>

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Extra Visit:</td>
                                            </tr>

                                            <?php endif; ?>

                                            <?php if($data['travelling']!=0): ?>

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Travelling:</td>
                                            </tr>

                                            <?php endif; ?>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;">Sales Tax @ <?php echo e(intval($data['st_rate'])); ?>% on Professional Fee</td>
                                            </tr>

                                        </table>

                                               

                                </td>
                                <td   style="text-align:right;padding:20px">
                               
                                <table style="border:0px;margin-top:274px">
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> <?php echo e($data['service_charges']); ?></td>
                                    </tr>
                                    <?php if($data['snaps']!=0): ?>
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> <?php echo e($data['snaps']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($data['re_inspection_charges']!=0): ?>
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> <?php echo e($data['re_inspection_charges']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($data['extra_visit']!=0): ?>
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> <?php echo e($data['extra_visit']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($data['travelling']!=0): ?>
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"><?php echo e($data['travelling']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"><?php echo e($data['tax']); ?></td>
                                    </tr>

                                </table>

                            </td>
                            </tr>
                            <tr >
                                <td style="border: 1px solid black;padding:4px">
                                    <table style="border:0px">
                                        <tr style="border:0px">
                                            <td style="border:0px ;width:85%;">Rupees : &nbsp;&nbsp;&nbsp;&nbsp; <?php echo e(strtoupper($data['total_amount_text'])); ?>

                                            </td>
                                            <td style="border:0px;width:15%;text-align:right;">Total :</td>
                                        </tr>
                                    </table>

                                    </td>

                                <td style="text-align:right;">
                                <span >
                                    <b>
                                    <?php echo e($data['total_amount']); ?>

                                    </b>
                                </span>
                                </td>
                            </tr>

                    </table>
                <div class="row ml-0 mr-1">

                    <p class="details-box">NTN No : 2734165-8 (Filer)<br>
                    <b>Accepted Methods of Payment</b><br>
                    P/O in the name of "Prism Surveyors (Pvt) Ltd
                    </p>

                </div>
                <div class="footer">
                    <span>FOR Prism Surveyors (Pvt) Ltd.</span>
                    <hr style="color:black;height:2px" class="mr-3">
                    <span style="font-size:12px">Invoice/Payment Queries : 92 (21) 35293363-64 <br>
                    Email : accounts@prismsurveyors.com <br>
                    URL : http://www.prismsurveyors.com <br>
                    Please our terms are strictly payment in full withing 30 days of invoice date
                    </span>
                    <hr style="color:black;height:2px" class="mr-3">
  
            </div>

        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism\billinvoice.blade.php ENDPATH**/ ?>