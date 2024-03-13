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
                   Ref:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our Job No. {{$data[0]}}
               </div>
               <div class="box box2">
                   {{$data[1]}}
               </div>


        </div>
        <div class="row" style="padding-top:10px;padding-bottom:10px" >
            <div class="box box1">
              <b> {{$data[2]}}</b><br>
               {{$data[3]}}<br>
               <span style="border-bottom: 1px solid #000;display: inline-block;padding-bottom: 10px;">{{$data[4]}}</span> <br>
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
                <b> {{$data[5]}}</b>

            </div>
        </div>
        <div class="row" >
            <div class="box" style="width:93%">
                <p style="text-align:justify;line-height:18px;word-spacing: 3px;">{!! nl2br(e($data[6])) !!}</p>
                {{--  <p style="text-align:justify;line-height:18px;word-spacing: 3px;">{{$data[7]}}</p>  --}}
                {{--  <p style="text-align:justify;line-height:18px;word-spacing: 3px;">{{$data[8]}}</p>  --}}
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
               <span style="border-bottom: 1px solid #000;display: inline-block;padding-bottom: 10px;"><b>{{$data[9]}}</b></span> <br>
                   <b>({{$data[10]}})</b>
               </div>
               <div class="box box2">
               Encls : As Above
               </div>


        </div>
    </div>
    <div class="row" style="font-size:12px;width:90%;margin-top:5px">
        c.c.to:-
        <ol style="margin-left:10px">
        <li style="word-spacing:5px">{{$data[11]}}</li>
        <li style="word-spacing:5px">{{$data[12]}}</li>
        <li style="word-spacing:5px">{{$data[13]}}</li>
        <li style="word-spacing:5px">{{$data[14]}}</li>
        <li style="word-spacing:5px">{{$data[15]}}</li>
    </ol>
    </div>

    {{--  <div class="container" style="padding-top:220px">
        <div class="row"  style="text-align:right;font-size:16px;padding-right:60px;margin-bottom:10px">
            <span style=""><b></b></span>


        </div>
        <div class="row" style="text-align:center;font-size:32px;">
        <span style="text-decoration:underline;"><b>LIVESTOCK INSPECTION REPORT</b></span>


        </div>
        <!-- <div class="row" style="text-align:right;font-size:14px;padding-right:60px">
        <span ><b>(Livestock)</b></span>


        </div> -->
        <div class="row" style="text-align:center;font-size:30px;padding-top:150px">
        <span style="s">  </span>


        </div>
        <div class="row" style="text-align:center;font-size:25px;padding-top:30px;padding-left:70px;padding-right:70px">
        <span style=""></span>


            <div style="padding-top:20px"></div>


        </div>
        <br><br><br>
        <div class="row" style="padding-top:80px;padding-left:200px;padding-right:90px">
                <div class="box" style="width:30%">
                <p style="font-size:14px;padding-top:6px"><b>Submitted To: </b></p>
                </div>
                <div class="box">
                    <p style="font-size:17px;"></p>
                </div>

            </div>

    </div>
    <!-- <div class="container-fluid" style="padding-top:100px">

        <div class="row">
            <h4 style="text-decoration:underline;text-align:center;line-height:0.1;padding-bottom:50px"><b>VALUATION, SURVEY & INSPECTION</b></h4>
        </div>

        <div class="row " style="padding-bottom:5px">

            <div class="box box1">
                <span>Bill No:        KGT/INS/KHI/BIPL/10610/2021</span>
            </div>
            <div class="box box2">
            <span >Dated:      28-Jul-2021<span>
            </div>


          </div>



    </div>
    <div class="container" style="width:94%">
        <div class="row mr-3">
            <b><hr style="color:black;height:2px;margin-top:0px"></b>
        </div>

    </div>

    <div class="row" style="font-size:13px;padding-bottom:30px">
            <p><b>The Manager<br>
            BANKISLAMI PAKISTAN LIMITED<br>
            15th Floor, Executive Tower One, Dolmen City,
            marine Drive<br></b></p>

   </div>
   <div class="row">

        <table style="border:1px;font-size:">
            <tr >
                <td style="padding:30px 30px 30px 30px">

                    <p>Particulars :  INSPECTION OF ISTISNA STOCKS </p><br>
                        <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REF:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email </span><br><br>
                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; July 27, 2021 </span><br><br>



                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M/S. CONWILL PAKISTAN (PVT) LTD </span><br><br>

                    <br><br><br><br><br><br>
                     <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inspection Fee</p>
                     <br><br><br><br><br><br>

                    <p>Rupees: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;One Thousand Eight Hundred Only</p>
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
                <br>
                3,000.00</td>
            </tr>
            <tr >
                <td style="text-align:right">Total: </td>
                <td style="text-align:right"><b> 3,000.00</b></td>
            </tr>

        </table>
        <div class="row ml-0 mr-3">

            <p class="details-box">NTN No :3026733-1 (Filter)<br>
            <b>Accepted Methods of Payment</b><br>
            P/O in the name of "K.G Traders (Pvt.) Ltd."<br>

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

   </div> -->  --}}
</body>
</html>
