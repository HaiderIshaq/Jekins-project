<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Bill No : 1</title>
</head>
<style>
@page { sheet-size: A3; }

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
     padding-left:10px;
     padding-right:10px;
     padding-top:10px;
     padding-bottom:10px;
     font-size:10px

    }
th, td {
  padding: 10px;
}
.row{

}
div.box{
   float:left;
   width:50%;
   font-size:14px;
   font-weight:bold;
   letter-spacing:0.4px
}

div.box1{
    width:60%;
}

div.box2{
    width:35%;
    text-align:right;

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
    <div class="row" style="text-align:center;font-weight:bold">
        <span style="font-size:16px">K.G. TRADERS (PVT) LTD.</span> <br>
        <span style="text-decoration:underline;font-size:16px">VERIFICATION BILL DETAILS</h4>
    </div>
    <div class="row" style="padding-bottom:25px">
        <div class="box box1">
            Invoice # &nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration:underline">{{$data[0]}}</span><br>
            Attn:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data[2]}}
        </div>
        <div class="box box2">
        Date &nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration:underline">{{$data[1]}}</span><br>

        </div>
    </div>
    <div class="row">
        <table>
            <tr>
                <th>S#</th>
                <th>Job#</th>
                <th>Date</th>
                <th>Name of Applicant</th>
                <th>NIC of Applicant</th>
                <th>Type</th>
                <th>City</th>
                <th>Above 30 Km</th>
                <th>R</th>
                <th>L</th>
                <th>E/L</th>
                <th>Snap</th>
                <th>Amount</th>
            </tr>

            @foreach($data[3] as $key=>$value)
            <tr>
                <td>{{$key+1}}</td>
                @foreach($value as $v)
                
                    <td>{!!$v!!}</td>
                    
                @endforeach
                </tr>

            @endforeach
             <tr>
                 <td colspan="8">
                     <td>{{$data[4]}}</td>
                     <td>{{$data[5]}}</td>
                     <td>{{$data[6]}}</td>
                     <td>{{$data[7]}}</td>
                     <td>{{$data[8]}}</td>
                 </td>
            </tr>
        </table>    

    </div>
</body>
</html>
