<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Inspection Report No : </title>
    
</head>
<style>
body{background:none;

} 

 
 
.container{width:90%}
.container-fluid{width:100%}

table{
     width: 95%;
     border-collapse: collapse;

     
 }

 table, td, th{
     border:1px solid black;
     padding-left:6px;
     padding-right:6px;
     padding-top:6px;
     padding-bottom:6px;
     font-size:13px;
     font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;

    }
th, td {
  padding: 6px;
}
.row{

}
div.box{
   float:left;
   font-size:14px ;


}

div.box1{
    width:30%
}

div.box2{
    width:35%
}
div.box3{
    width:35%
}
.details-box{
   border:2px solid black;
   font-size:15px;
   padding:0px 10px 0px 10px;
   
  
   margin-right:30px;
   
}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}


@page {
    margin-top: 5cm;
 
}
</style>

<body>
    <div class="container" style="padding-left:80px;padding-right:80px;">
    <div class="details-box" style="padding-top:20px;padding-bottom:10px;margin-bottom:250px">
                @foreach($data[12] as $remark)
                    <div class="row" style="padding-bottom:5px;font-size:14px">
                    
                        
                    <div class="box box1" >
                        <b>{{$remark->title}} </b>:
 
                    </div>
                    <div class="box box2" >
                    <b>[{{$remark->option_first_status == 1 ? '√' : 'x' }}] {{$remark->option_first_name}}</b>

                    </div>

                    <div class="box box3">
                    <b>[{{$remark->option_second_status == 1 ? '√' : 'x' }}] {{$remark->option_second_name}}</b>

                    </div>
                    </div>
                    @endforeach
               
                </div>
                <div style="margin-top:225px">
                        @if($data[17]==1)
                        <div class="row" style="padding-bottom:10px;border-bottom:dotted 2px black;width:40%">

                            <img src="images/sign.png"   alt="">
                            <br></div>
                            @else

                            <div class="row" style="padding-bottom:100px;border-bottom:dotted 2px black;width:40%">

                            <br></div>
                            @endif
                    
                    <div class="row" style="padding-bottom:10px;padding-top:20px;font-size:16px">Signature & Stamp;<br></div>
                    <div  class="row" style="padding-bottom:10px;font-size:14px">Authorized Signatory: &nbsp;&nbsp;&nbsp;&nbsp;Sunil Kumar<br></div>
                    <div  class="row" style="padding-bottom:10px;font-size:14px">Designation: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager Inspection<br></div>
                    <div  class="row" style="padding-bottom:5px;font-size:14px">Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data[7]}}</div>
            

                </div>
               
                <div class="row" style="padding-bottom:10px;border-bottom:solid 2px black;width:90%"><br></div>
                <div class="row" style="padding-bottom:10px;padding-top:10px;font-size:16px"><b>Acknowledged by Authorized signature(s) with company seal</b><br></div>
                

    
        </div>
         
    </div>
   
</body>
</html>