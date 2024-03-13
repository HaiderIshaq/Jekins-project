<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

 body{background:none}

 

.container{width:90%}
@page {
	
margin-bottom: 10%; 
   
}



div.box{
   float:left;
   width:50%;
  
}

div.box1{
    width:50%
}

div.box2{
    width:45%
}

</style>
<body>
<div class="container" style="margin:0px 0px 20px 8px">
    <div class="row">
         <img style="margin-left:400px"  src="images/logo.png" height="50" width="250" alt="">

    </div>
    <div class="row " style="margin-top:30px;margin-bottom:30px">
        <p  style="text-align:center;margin-left:32px;line-height:1">
        <b style="font-size:60px;">VALUATION REPORT</b>
        <br>
        </p>
        <p style="line-height:1;text-align:right">
        <b >({{ $carName }})</b>
        
        </p>

    </div>
    <div class="row">
    </div>
    <div class="row"  >
        <img style="margin-top:40px !important;margin-left:50px" 
           
        height="400px" width="600px" src="{{$frontImage}}" alt="">
   </div>
   <br>
   <br>
   <div class="row" style="margin-left:45px">
        <p  style="font-size:20px;text-decoration:underline;text-align:center;line-height:1.3"><b>CLIENT: {{ $client_name }}</b></p>
        <p style="font-size:20px;text-decoration:underline;text-align:center;line-height:1.3"><b>APPLICANT: {{ $applicant }}</b></p>
   </div>
  
    <br><br>
     <div class="row" style="margin-left:100px;">
        <div class="box box1"  >
          <p><b>Acknowledged & Submitted To:</b></p>
        </div>
        <div class="box box2" >
          <p ><b>{{$acknowledge_to}}</b></p>
          <p style="font-size:14px">{{$address}}</p>
        </div>
     </div>
   



</div>
</body>
</html>