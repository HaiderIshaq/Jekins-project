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
        width:50%;
        height:10px !important;
        float:left;
        text-align:center
}
div.box1{width:30%}
div.box2{width:70%}

.details-box{
   border:2px solid black;
   font-size:16px;
   padding:5px 5px 5px 5px;

   margin-right:35px;

}
@page {
    margin-top: 2cm;

}
.footer{position:relative;
top:140px;
font-size:13px;
width:94%}
</style>
<body>
    <div class="container" style="padding-left:32px">
       {{--  <div class="row" style="text-align:right">  --}}
           {{--  <div>  --}}
               {{--  <img src="images/kgtimageslogo.png" height="85px" width="125px" alt="">  --}}
           {{--  </div>  --}}
       {{--  </div>  --}}
        <div class="row" style="margin-left:16px;padding-bottom:10px">
            <div>
                <h3>{{ucwords($data[19])}}</h3>
            </div>
        </div>
        <!-- Layout 4 in a page  -->
        <div class="row" style="margin-left:10px;">
            @foreach($data[13] as $image)
            <div class="box"  style="text-align:center;padding-bottom:20px;">
                <img src="{{$image->path}}" style="width:300px;height:250px"  alt="">

            </div>

            @endforeach

        </div>
<!--

        <div class="row" style="margin-left:10px;">
            @foreach($data[13] as $image)
            <div class="box"  style="text-align:center;padding-bottom:20px;">
                <img src="{{$image->path}}" style="width:300px;height:350px"  alt="">

            </div>

            @endforeach

        </div> -->
    </div>
</body>
</html>
