<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Bill No : 1</title>
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
     padding-left:5px;
     padding-right:5px;
     padding-top:5px;
     padding-bottom:5px;
     font-size:10px

    }
th, td {
  padding: 5px;
}
.row{

}
div.box{
   float:left;
   width:50%;
   font-size:13px;
   font-weight:bold
}

div.box1{
    width:75%
}

div.box2{
    width:25%
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
  
    <div class="container-fluid">
        <div class="row" style="padding-bottom:20px">
            <div class="box box1">
                <img src="images/logo.jpg" style="height:30px;width:200px" alt="">
            </div>
            
            <div class="box box2">
                <img src="images/logo2.jpg"  alt="">
            </div>

        </div>
        <div class="row" style="text-align:center">
              <h3 style="text-decoration: underline;">Verification Bill</h3>
      
        </div>
        <div class="row">
            <div class="box box1">
                Invoice #&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;"> {{$data[0]}}</span>


            </div>
            <div class="box box2">
                Date&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;">{{$data[1]}}</span>
            </div>
      
        </div>
        <div class="row" style="margin-top:20px">
            <div class="box box1">
                The Manager,
            </div>
            <div class="box box1">
                {{$data[8]}}
            </div>
           
      
        </div>
        <div class="row">
            <table style="margin-top:20px">
                <thead>
                    <tr>
                        <th>S#</th> 
                        <th>Applicant</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>City</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                
                <tbody>
                @foreach($data[7] as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                        @foreach($value as $v)
                        
                            <td>{!!$v!!}</td>
                            
                        @endforeach
                        </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr > 

                    <td colspan="4" style="font-size:12px"> <span style="font-weight:bold"> Rupees </span>: {{ucwords($data[2])}}</td>


                    <td style="font-size:12px">
                    
                        <b>Total : </b> <br style="height:10px">

                        </td>
                    <td style="font-size:12px">  
                        {{number_format($data[3])}}<br style="height:10px">                                         
                    </td>
                    </tr>
                    
                </tfoot>
              
          
            </table>
        </div>
 


        <div class="row ml-0 mr-1">

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
     

</body>
</html>
