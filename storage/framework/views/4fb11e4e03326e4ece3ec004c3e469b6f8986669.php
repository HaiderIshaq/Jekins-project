<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inspection Report No : </title>

</head>
<style>
 /* cyrillic-ext */

body{background:none;
}



.container{width:90%;}
.container-fluid{width:100%}

table{
     width: 95%;
     border-collapse: collapse;
     border:1px solid black;

 }
 th{
    border:1px solid black;

 }
 td{
     border-left:1px solid black
 }

 table, td, th{

     text-align:center;
     font-size:10px

    }


    td,th{
        padding:6px 6px 6px 6px
    }
.row{

}
div.box{
   float:left;
   width:50%;
   font-size:11px
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
   padding:5px 40px 5px 5px;
   margin-top:10px;
   width:30%;
   margin-right:35px;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}
</style>
<body>
    <div class="container">

        <div class="row" style="text-align:CENTER;">
                <span style="padding-bottom: 20px;"><b>K.G. Traders (PVT) LTD.</b></span><br>
        </div>
        <div class="row" style="text-align:Center;margin-top:10px">

                <span style="border-bottom: 1px solid #000;display: inline-block;padding-bottom: 10px;"><b>List of Letter Printed</b></span>

        </div>


    </div>
    <div class="container" style="margin-left:30px;margin-top:10px">
    <div class="row" style="padding-bottom:5px;padding-top:30px" >
            <div class="box box1" style="width:15%">
                Job No
            </div>
            <div class="box box1" style="width:85%">
                 <?php echo e($data[0]); ?>

            </div>

        </div>
        <div class="row" style="padding-bottom:5px" >
            <div class="box box1" style="width:15%">
            Bank
            </div>
            <div class="box box1" style="width:85%">
            <?php echo e($data[1]); ?>


            </div>

        </div>
        <div class="row" style="padding-bottom:5px" >
            <div class="box box1" style="width:15%">
            Branch
            </div>
            <div class="box box1" style="width:85%">
            <?php echo e($data[2]); ?>


            </div>

        </div>
        <div class="row" style="padding-bottom:5px" >
            <div class="box box1" style="width:15%">
            Borrower
            </div>
            <div class="box box1" style="width:85%">
            <?php echo e($data[3]); ?>



            </div>

        </div>
        <div class="row" style="margin-top:20px">
            <table>
                <tr>
                    <th>Date & Time</th>
                    <th>Type of Letter </th>
                    <th>Signed By </th>
                    <th>Designation </th>
                </tr>
                <?php $__currentLoopData = $data[4]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e(date_format(date_create($rec->datetime), "d-M-Y h:i:s")); ?></td>
                        <td>Letter to <?php echo e($rec->type_of_letter); ?></td>
                        <td><?php echo e($rec->signed_by); ?></td>
                        <td>Assistant</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </table>
        </div>
    </div>
    
</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Supervision/Reports/logreport.blade.php ENDPATH**/ ?>