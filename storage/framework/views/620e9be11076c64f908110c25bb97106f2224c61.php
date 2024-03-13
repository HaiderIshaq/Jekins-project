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
    <div class="container-fluid" style="padding-top:90px">
        <div class="row" >
               <div class="box box1">
                   Ref:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our Job No. <?php echo e($data[0]); ?>

               </div>
               <div class="box box2">
                   <?php echo e($data[1]); ?>

               </div>


        </div>
        <div class="row" style="padding-top:10px;padding-bottom:10px" >
            <div class="box box1">
              <b> <?php echo e($data[2]); ?></b><br>
               <?php echo e($data[3]); ?><br>
               <span style="border-bottom: 1px solid #000;display: inline-block;padding-bottom: 10px;"><?php echo e($data[4]); ?></span> <br>
            </div>
        </div>
        <div class="row" >
            <div class="box box1">

               Dear Sir,<br>
            </div>

        </div>
        <div class="row" style="margin-left:50px">
            <div class="box box1" style="width:50px">
                Sub:-
            </div>
            <div class="box box2" style="width:550px;border-bottom:2px solid #000;text-align:justify;word-spacing: 8px;">
                <b> <?php echo e($data[5]); ?></b>

            </div>
        </div>
        <div class="row" >
            <div class="box" style="width:93%">
                <p style="text-align:justify;line-height:18px;word-spacing: 3px;"><?php echo nl2br(e($data[6])); ?></p>
                
                
                <p style="text-align:justify;line-height:18px;word-spacing: 2px;">Assuring you of our fullest co-operation and best services at all times.</p>
                <p style="text-align:justify;line-height:18px;word-spacing: 2px;">
                Thanking you, we remain.<br>
                Yours faithfully,<br>
                <b>For K.G. TRADERS (PVT) LTD</b>

                </p>


            </div>

        </div>
        <div class="row" >
               <div class="box box1" style="text-transform:underline">
               <span style="border-bottom: 1px solid #000;display: inline-block;padding-bottom: 10px;"><b><?php echo e($data[9]); ?></b></span> <br>
                   <b>(<?php echo e($data[10]); ?>)</b>
               </div>
               <div class="box box2">
               Encls : As Above
               </div>


        </div>
    </div>
    <div class="row" style="font-size:12px;width:90%;margin-top:5px">
        c.c.to:-
        <ol style="margin-left:10px">
        <li style="word-spacing:5px"><?php echo e($data[11]); ?></li>
        <li style="word-spacing:5px"><?php echo e($data[12]); ?></li>
        <li style="word-spacing:5px"><?php echo e($data[13]); ?></li>
        <li style="word-spacing:5px"><?php echo e($data[14]); ?></li>
        <li style="word-spacing:5px"><?php echo e($data[15]); ?></li>
    </ol>
    </div>

    
</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Supervision/Reports/letter.blade.php ENDPATH**/ ?>