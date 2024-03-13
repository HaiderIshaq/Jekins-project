<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
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
     width: 95%;
     border-collapse: collapse

 }

 table, td, th{
     border:2px solid black;
     padding-left:20px;
     padding-right:20px;
     padding-top:20px;
     padding-bottom:20px;

    }

p{
    font-size:12px
}
span{
    font-size:12px

}

th, td {
  padding: 15px;
}

.box{
    float:right;
   border:2px solid;
   padding:5px 5px 5px 5px;
   margin-top:10px
}
.footer{position:relative;
top:140px}

</style>
<body>
<div class="container-fluid" style="margin-top:55px">
<div class="row ">
        <center><h4 style="text-decoration: underline"><b>INTERNATIONAL BUSINESS REPORT</b></h4></center>
        <br>
    </div>
   <div class="row">
    <p><b>The Manager<br>
        {{strtoupper($data[1])}}{{strtoupper($data[13])}}<br>
        {{ucwords($data[2])}}{{ucwords($data[15])}}<br></b></p>

   </div>

       <div class="row pb-0">

                <div class="head1">
                    <span><b>Bill No: </b>{{$data[3]}}</span>
                </div>
                <div class="head2">
                <span > <b>Dated</b>: {{date('d-M-Y')}}<span>
                </div>


       </div>

       <div class="row mr-3">
   <hr style="background:black;height:2px;margin-top:0px">

   </div>

    <div class="row ">

        <table style="border:1px">
            <tr>
                <td>
                    <p style="text-decoration:underline">International Regular Report</p>
                    <br>
                    <p><b>{{strtoupper($data[2])}}{{strtoupper($data[15])}}</b></p>
                    <br>
                    <p>Reference :  {{$data[5]}} {{$data[19]}} <br>
                    Dated: {{$data[6]}}</p>
                    <br>
                    <p>Service Chargers : US ${{$data[7]}} <br>
                    Exchange Rate : {{$data[8]}} <br>
                    Sales Tax : {{$data[0]}}%
                    </p>
                    <!-- <p>Rupees: One Thousand Eight Hundred Only</p> -->
                </td>
                <td>{{number_format($data[9]) }}
                <br>
                <br>
                <br>
                 <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                    {{$data[11] }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td><b>{{number_format($data[10] )}}</b></td>
            </tr>

        </table>
    </div>
    <div class="row ml-0 mr-3">

            <p class="box">NTN No :3026733-1 (Filter)<br>
            <b>Accepted Methods of Payment</b><br>
            P/O in the name of "K.G Traders (Pvt.) Ltd."<br>
            <b>Direct Credit:</b><br>
            Please make payments to the account below <br>
            <b>A/c Title:</b> K.G Traders (PVT) LTD. <br>
            <b>A/c No:</b> 00077900190903 <br>
            </p>

    </div>


    <div class="footer">
        <p>FOR K.G. TRADERS (PVT) LTD</p>
        <hr style="background:black;height:2px" class="mr-3">
        <P>Invoice/Payment Queries : 92 (21) 3529377-80   URL: http://www.kgtraders.com.pk <br>
        Email : aacounts@kgtraders.com.pk,account-ibr@kgtraders.com.pk <br>
        Please our terms are strictly payment in full withing 30 days of invoice date
        </P>
        <hr style="background:black;height:2px" class="mr-3">
        <center><p><b>609, Clifton Center, Khayaban-e-Roomi, Block-5, Clifton,Karachi.<br> Tel:021-35293377-80 <br>Fax: 021-35293382</b></p></center>

    </div>

</div>
</body>
</html>
