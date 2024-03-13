<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residence Verification</title>
</head>
<style>

    .imgs{
       
        margin:5px;
        height:200px;
        width:200px;
        


    }
</style>
<body>
  
    <div style="padding-left:30px;padding-top:200px;">

         @foreach($job as $value)
         @if($value->rotate=="Yes")
             <img class="imgs" src="{{$value->path}}" style="transform:rotate(90deg)" alt="" alt="">

         @else
             <img class="imgs" src="{{$value->path}}" alt="" alt="">

         @endif
           
           
            @endforeach
     
    </div>


</body>
</html>