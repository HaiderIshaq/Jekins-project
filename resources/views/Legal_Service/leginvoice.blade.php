<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Property Related Services Bill</title>
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
            <h4 style="text-decoration:underline;text-align:center;line-height:0.1;padding-bottom:50px"><b>Property Related Services</b></h4>
        </div>

        <div class="row " style="padding-bottom:5px">

            <div class="box box1">
                <span>Bill No:        {{$data[0] }}</span>
            </div>
            <div class="box box2">
            <span >Dated:      {{$data[1]}}<span>
            </div>


          </div>



    </div>
    <div class="container" style="width:94%">
        <div class="row mr-3">
            <b><hr style="color:black;height:2px;margin-top:0px"></b>
        </div>

    </div>

    <div class="row" style="font-size:13px;padding-bottom:30px">
          @if($data[2]=="Bank")
          <p><b>The Manager<br>
            {{ strtoupper($data[3])

            }}<br>
            {{
                ucwords($data[4])
            }},
            <br></b>
            <b>{{ucwords($data[13])}}</b>
            </p>
            @elseif($data[2]=="Customers")

            <p><b> {{ strtoupper($data[5])

            }}<br>
            {{
                ucwords($data[6])
            }}
            <br></b></p>
            @else

            <p><b> {{ strtoupper($data[11])

            }}<br>
            {{
                ucwords($data[12])
            }}
            <br></b></p>
          @endif




   </div>
   <div class="row">

   <table style="border:1px;font-size:">
            <tr >
                <td style="padding:30px 30px 30px 30px">

                    <p>Particulars :  <?php echo strtoupper('Property Related Services');?> </p><br>
                        <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REF:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$data[7]}} </span><br><br>
                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$data[8]}} </span><br><br>



                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M/S.    {{ strtoupper($data[5]) }} </span><br><br>

                    <br><br><br>
                     <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Service Charges</p>
                    <br> @if($data[15] > 0)

                          <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Traveling Charges</p>
                        <br>

                      @endif
                     <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total</b></p>
                    @if($data[17] > 0)

                     <br>
                     <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SST</p>
                     @endif

                     <br><br><br>

                    <p>Rupees: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ ucwords($data[9]) }} Only</p>
                </td>
                <td style="text-align:right">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <!-- Survey Charges -->
                <p style="padding-top:10px;padding-bottom:10px">{{number_format($data[14])}}</p><br>
                <!-- Survey Charges -->

                <!-- Traveling Charges -->
                @if($data[15] > 0)
                <p style="padding-top:10px;padding-bottom:10px">{{number_format($data[15])}}</p><br>

                @endif
                <!-- Traveling Charges -->

                <!-- Total -->
                <p style="padding-top:10px;padding-bottom:10px">{{number_format($data[16])}}</p><br>
                <!-- Total -->

                @if($data[17] > 0)

                <!-- SST -->
                <p style="padding-top:10px;padding-bottom:10px">{{number_format($data[17])}}%</p><br>
                <p style="padding-top:10px;padding-bottom:10px">{{number_format($data[18])}}</p><br>
                <!-- SST -->
                @endif


            </td>
            </tr>
            <tr >
                <td style="text-align:right">Sub-Total: </td>
                <td style="text-align:right"><b> {{number_format($data[10])}}</b></td>
            </tr>

        </table>
        <div class="row ml-0 mr-1">

            <p class="details-box">NTN No :3026733-1 (Filter)<br>
            <b>Accepted Methods of Payment</b><br>
            P/O in the name of "K.G Traders (Pvt.) Ltd."<br>
            <b>Direct Credits:</b><br>
            Please make payments to the account below<br>
            <b>A/C Title: </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;K.G.Traders (PVT) LTD.<br>
            <b>A/C No.: </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;00077900190903<br>

            </p>

        </div>
        <div class="footer">
        <span>FOR K.G. TRADERS (PVT) LTD</span>
        <hr style="color:black;height:2px" class="mr-3">
        <span style="font-size:12px">Invoice/Payment Queries : 92 (21) 3529377-80   URL: http://www.kgtraders.com.pk <br>
        Email : aacounts@kgtraders.com.pk,account-ibr@kgtraders.com.pk <br>
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
