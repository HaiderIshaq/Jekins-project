<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
   <title>Document</title>
</head>
<style>

 .head2{position:relative;left:500px} 
 body{background:none}

 .bank-ref{
     margin-left:200px
 }

 .heading{
    flex: 0 0 25%;
    max-width: 25%;
 }
 table{
     margin-top:30px;
     width: 90%;
     border-collapse: collapse
     
 }

 table, td, th{
     border:1px solid black;
     padding-left:20px;
     padding-right:20px;
     padding-top:20px;
     padding-bottom:20px;

    }
  
 
.container{width:90%}
 .container-fluid{width:100%}



div.box{
   float:left;
   width:50%;
  
}

div.box1{
    width:75%
}

div.box2{
    width:20%
}


</style>
<body>
<div class="container-fluid">
    <!-- <div class="row ">
        <img src="logo1.png" alt="">
    </div> -->
        <div class="box box1">
        <?php echo e($data[0]); ?>

        </div>
        <div class="box box2">
        Dated: <?php echo e(date('d-M-Y')); ?>

        </div>  
    <br>    

    <div class="container"  style="position:relative;left:-25px">
        <div class="row" style="text-align:center">
            <h2 style="text-decoration: underline;text-underline-offset: 1em;letter-spacing:1px;margin-left:40px"><b>INTERNATIONAL BUSINESS REPORT</b></h2> 
           
            <br>
        </div>
        
        <div class="row" style="text-align:center;margin-left:35px">
            
                <h4 ><b> <?php echo e($data[1]); ?>

                </b></h4>
            
        </div>
        <div class="row" style="text-align:center">
        
            <table  style="margin-left:90px">
                <tr>
                    <td>Business Name</td>
                    <td><?php echo e($data[1]); ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo e($data[6]); ?></td>
                </tr>
                <tr>
                    <td>Company Registration No.</td>
                    <td><?php echo e($data[10]); ?></td>
                </tr>
                <tr>
                    <td>Main Activity</td>
                    <td><?php echo e($data[11]); ?></td>
                </tr>
                <tr>
                    <td>Credit Rating / Score Description</td>
                    <td><?php echo e($data[7]); ?></td>
                </tr>
                <tr>
                    <td>Proposed Credit Limit / Line with Currency</td>
                    <td><?php echo e($data[8]); ?></td>
                </tr>
                <tr>
                    <td>Litigation</td>
                    <td><?php echo e($data[9]); ?></td>
                </tr>
            </table>
        </div>
    </div>
   

</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/pdf3.blade.php ENDPATH**/ ?>