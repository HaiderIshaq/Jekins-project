<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<style>

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
     padding-left:10px;
     padding-right:10px;
     padding-top:10px;
     padding-bottom:10px;
     font-size:12px

    }
th, td {
  padding: 8px;
}
.row{

}
div.box{
   float:left;
   width:50%;
   font-size:12px
}

div.box1{
    width:77%
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
   margin-right:35px;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}
</style>
<body>
    <div class="container-fluid" style="padding-top:100px">

        <div class="row">
            <h4 style="text-decoration:underline;text-align:center;line-height:0.1;padding-bottom:50px"><b>HANDLING & SUPERVISION DEPTT.</b></h4>
        </div>

        <div class="row " style="padding-bottom:5px">

            <div class="box box1">
                <span>Bill No.  <?php echo e($data['billnumber']); ?></span>
            </div>
            <div class="box box2">
                  <span >Dated:  <?php echo e($data['dated']=="0000-00-00" ? "0000-00-00" : $data['dated']); ?>  <span>
            </div>


        </div>




    </div>

    <div class="container" style="width:94%">
        <div class="row mr-3">
            <b><hr style="color:black;height:2px;margin-top:0px"></b>
        </div>

    </div>
    <div class="row " style="padding-bottom:5px">

            <div class="box box1">
                <span>Job No.  <?php echo e($data['jobid']); ?>       </span>
            </div>
            <div class="box box2">
                  <span ><?php echo e($data['bankcode']); ?>  NTN: <?php echo e($data['bankntn']); ?> <span>
            </div>


    </div>
    <div class="row" style="margin-top:14px">
        <div class="box box2">
            <span>Messers</span>
        </div>
        <div class="box box1" style="border-bottom:2px solid black;width:75%">
            <span><?php echo e($data['messer']); ?></span>
        </div>
    </div>
    <div class="row" style="margin-top:14px">
        <div class="box box2">
            <span>Account</span>
        </div>
        <div class="box box1" style="border-bottom:2px solid black;width:75%">
            <span><?php echo e($data['account']); ?></span>
        </div>
    </div>
    <div class="row" style="margin-top:14px">
        <div class="box box2">
            <span>Bill of Charges on</span>
        </div>
        <div class="box box1" style="border-bottom:2px solid black;width:35%">
            <span><?php echo e($data['package']); ?> (<?php echo e($data['container']); ?>)</span>
        </div>
        <div class="box box2" style="width:10%;text-align:center">
            <span>Weight</span>
        </div>
                <div class="box box1" style="border-bottom:2px solid black;width:30%">
            <span><?php echo e($data['weight']); ?> </span>
        </div>
    </div>
    <div class="row" style="margin-top:14px">
        <div class="box box2">
            <span>Packages of</span>
        </div>
        <div class="box box1" style="border-bottom:2px solid black;width:35%">
            <span><?php echo e($data['consigment']); ?> </span>
        </div>
        <div class="box box2" style="width:15%;text-align:center">
            <span>and Cleared S.S</span>
        </div>
                <div class="box box1" style="border-bottom:2px solid black;width:25%">
            <span><?php echo e($data['vesselNo']); ?></span>
        </div>
    </div>
    <div class="row" style="margin-top:14px">
        <div class="box box2" style="width:30%">
            <span>Delivered under our Supervision to:</span>
        </div>
        <div class="box box1" style="border-bottom:2px solid black;width:65%">
            <?php if($data['toIs']=='Bonded Warehouse'): ?>
            <span><?php echo e($data['warehouseAddress']); ?></span>
             <?php elseif($data['toIs']=='Party Premises'): ?>
            <span><?php echo e($data['partyAddress']); ?></span>
             <?php elseif($data['toIs']=='3rd Party Godown'): ?>
            <span><?php echo e($data['thirdpartyAddress']); ?></span>

            <?php endif; ?>

        </div>

    </div>
    <div class="row" style="margin-top:14px">
        <div class="box box2" style="width:40%">
            <span>As per Receipt No: </span>
        </div>
        <div class="box box1" style="width:30%">
            <span>Dated: </span>
        </div>
        <div class="box box1" style="width:30%">
            <span>Import/Export Value:  <?php echo e($data['importvalue']); ?></span>
        </div>

    </div>

    <div class="row" style="font-size:13px;padding-bottom:30px">
          
          




   </div>
   <div class="row">

   <table style="border:1px;font-size:">
            <tr >
                <th>PARTICULARS</th>
                <th>AMOUNT</th>
            </tr>
            <tr>
                <td>
                    <div class="">
                        Banks Letter No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($data['bankletterno']); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dated: <?php echo e($data['bankletterdate']); ?>


                    </div>



                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <div class="">
                       Letter of Credit No. / Contract No.
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <?php echo e($data['lcNo']); ?>


                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <div class="">
                      Under Lien of.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp; <?php echo e($data['account']); ?>



                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <div class="">
                      Delivery Expenses & Conveyance etc.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <div class="">
                      Miscellaneous Charges
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;



                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="padding-bottom: 100px">
                    <div class="">
                      Handling & Supervision Charges &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;



                    </div>
                </td >
                <td style="text-align: right;padding-bottom: 100px">
                    <?php echo e(number_format($data['serviceCharges'])); ?>

                </td>
            </tr>



        </table>

            <div class="" style="width: 95%;padding-top:10px">

                <div class="row" style="padding-top: 5px;margin-left:470px">

                    <div class="box" style="width: 58%">Total:</div>
                    <div class="box" style="width: 40%;text-align:right"><?php echo e(number_format($data['serviceCharges'])); ?></div>
                </div>
                <div class="row" style="padding-top: 5px;margin-left:470px">

                    <div class="box" style="width: 58%">Less Advance:</div>
                    <div class="box" style="width: 40%;text-align:right;border-bottom:1px solid black;"><?php echo e(number_format($data['recieved'])); ?></div>
                </div>
                <div class="row" style="padding-top: 5px;margin-left:470px">

                    <div class="box" style="width: 58%">Balance:</div>
                    <div class="box" style="width: 40%;border-bottom: 2px solid black;text-align:right"><?php echo e(number_format($data['serviceCharges']-$data['recieved'])); ?></div>
                </div>
            </div>


                <div class="row" style="padding-top: 5px;">

                    <div class="box" style="width: 20%">Rupees:</div>
                    <div class="box" style="width: 20%;text-align:right"><?php echo e($data['billText']); ?> Only</div>
                </div>



        <div class="row ml-0 mr-1">

            <p class="details-box">NTN No :3026733-1 (Filter)<br>
            <b>Accepted Methods of Payment</b><br>
            P/O in the name of "K.G Traders (Pvt.) Ltd."


            </p>

        </div>
        <div class="footer">
        <span>FOR K.G. TRADERS (PVT) LTD</span>
        <hr style="color:black;height:2px" class="mr-3">
        <span style="font-size:12px">Invoice/Payment Queries : 92 (21) 3529377-80   <br>
        Email : aacounts@kgtraders.com.pk,account-sup@kgtraders.com.pk <br>
        URL: http://www.kgtraders.com.pk <br>
        Please our terms are strictly payment in full withing 30 days of invoice date
        </span>
        <hr style="color:black;height:2px" class="mr-3">
        <div class="row" style="text-align:center;font-size:11px">

        <span ><b >609, Clifton Center, Khayaban-e-Roomi, Block-5, Clifton,Karachi. Tel:021-35293377-80 Fax: 021-35293382</b></span>

        </div>
    </div>

   </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Supervision/supinvoice.blade.php ENDPATH**/ ?>