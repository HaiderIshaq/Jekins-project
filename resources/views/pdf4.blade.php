<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
</head>
<style>


 
 .container{width:90%}
 .container-fluid{width:100%}



div.box{
   float:left;
   width:50%;
  
}

div.box1{
    width:80%
}

div.box2{
    width:20%
}

</style>
<body>
<div class="container-fluid" >
   

        @if($data[16]==true)
        <div class="row ">
             <img src="images/logo1.PNG" alt="">
         </div>
        @endif
        <div class="row">
        
        <div class="box box1">
        {{$data[0]}}
        </div>
        <div class="box box2">
        {{ date('d-M-Y') }}
        </div>  

        </div>
        <br>    
        <div class="container" style="position:relative;left:-20px">
            <div class="row" style="text-align:center" >
            <h2 style="text-decoration: underline;text-underline-offset: 1em;letter-spacing:1px;margin-left:40px"><b>INTERNATIONAL BUSINESS REPORT</b></h2> 
      
            </div>
            <br><br><br><br>
            <div class="row" style="text-align:center" >
                <center><h4>of</h4></center>
              
            </div>
            <br><br><br><br>

            <div class="row" style="text-align:center" >
                <center> <h4 ><b> </b>{{$data[1]}}</h4></center>  
                 
            </div>
            <div class="row" style="text-align:center" >
                <center>
                    <p >{{$data[2]}}</p>
                </center>
            
            </div>
            <br><br><br><br>
            
            <div class="row" style="text-align:center" >
                <center>
                    <p><b>Acknowledged & Submitted To: </b>{{mb_strtoupper($data[20])}}</p>
                </center>
            </div>
        </div>
        
</div>
</body>
</html>