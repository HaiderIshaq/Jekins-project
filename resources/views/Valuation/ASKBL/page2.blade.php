<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Documnt</title>
    </head>
<style>
 .head2{position:relative;left:560px} 
 body{background:none;
    font-family: 'Roboto', sans-serif;}



    table {
  border-collapse: collapse;
  font-size:11px
}

table, th, td {
  border: 1px solid black;
}


div.box{
   float:left;
   width:50%;
  
}

div.box1{
    width:65%
}

div.box2{
    width:30%;
}
.container{
    width:90%
}
p{
    font-size:12px
}
span{
    font-size:12px

}

th, td {
  padding:4px 10px 4px 10px !important;
}

@page {
	
     
    margin-top: 15%; 
       
    }


</style>
<body>
<div class="container" style="margin:0px 0px 0px 25px">
  

    
      <div class="row" style="width:100%;margin-left:40px">
        <div class="box box1" >
          <p style="font-size:15px">Ref: - {{$job_id}}</p>
        </div>
        <div class="box box2" style="text-align:right" >
          <p style="font-size:15px">{{$delivery_date}}</p>
        </div>
  
      </div>
   
   <p  style="font-size:13px;text-decoration:underline;text-align:center;margin-left:50px"><b>MOTOR / VEHICLE APPRAISAL REPORT</b></p>
   
   <div class="row" style="margin-left:30px">
   <span  style="font-size:13px;text-decoration:underline"><b>{{$account}}</b></span>
   </div>
   <div class="row" style="margin-left:30px">
   <span  style="font-size:13px;text-decoration:underline"><b>SECTION I – VEHICLE DETAILS</b></span>
   
   </div>
   <div class="row" style="margin-left:30px">
        <table style="width:100%">
            <tr>
                <td style="width:50%">Applicant’s Name</td>
                <td style="width:50%">{{$applicant}}</td>
            </tr>
            <tr>
                <td>Name of Branch</td>
                <td>{{$branch_name}}</td>
            </tr>
            <tr>
                <td>Visit Date</td>
                <td>{{$visit_date}}</td>
            </tr>
            <tr>
                <td>Place of Inspection</td>
                <td>{{$place_of_inspection}}</td>
            </tr>
            <tr>
                <td>Customer Representative Name & CNIC No</td>
                <td>{{ $representative }} ( {{ $cnic }} )</td>
            </tr>
            <tr>
                <td>Year of Manufacturing </td>
                <td>{{$manufacturing_year}}</td>
            </tr>
            <tr>
                <td>Registration No</td>
                <td>{{$registration_no}}</td>
            </tr>
            <tr>
                <td>Class</td>
                <td>{{$class}}</td>
            </tr>
            <tr>
                <td>Name of Owner as per Original Title, Documents – Registration Book / Import Documents</td>
                <td>{{$name_of_owner}}</td>
            </tr>
            <tr>
                <td>Chassis No. </td>
                <td>{{$chassis_no}}</td>
            </tr>
            <tr>
                <td>Engine No</td>
                <td>{{$engine_no}}</td>
            </tr>
            <tr>
                <td>Genre </td>
                <td>{{$genre}}</td>
            </tr>
            <tr>
                <td>Body Type</td>
                <td>{{$body_type}}</td>
            </tr>
            <tr>
                <td>Color</td>
                <td>{{$color}}</td>
            </tr>
            <tr>
                <td>Air Conditioner</td>
                <td>{{$is_air_conditionar}} ({{$is_air_conditionar_working}})</td>
            </tr>
            <tr>
                <td>CNG </td>
                <td>{{$cng}}</td>
            </tr>
            <tr>
                <td>Accessories</td>
                <td>{{$accessories}}</td>
            </tr>
            <tr>
                <td>Engine Capacity</td>
                <td>{{$engine_capacity}}</td>
            </tr>
            <tr>
                <td>Drive</td>
                <td>{{$drive}}</td>
            </tr>
            <tr>
                <td>Fuel Type </td>
                <td>{{$fuel_type}}</td>
            </tr>
            <tr>
                <td>Transmission</td>
                <td>{{$transmission}}</td>
            </tr>
            <tr>
                <td>Seating Capacity</td>
                <td>{{$seating_capacity}}</td>
            </tr>
            <tr>
                <td>Mileage</td>
                <td>{{$mileage}}</td>
            </tr>
            <tr>
                <td>Rim Type </td>
                <td>{{$rim_type}}</td>
            </tr>
           
        </table>
        
   </div>
   <br>
   <div class="row" style="margin-left:30px">
   <span  style="font-size:13px;text-decoration:underline"><b>SECTION II – VEHICLE CONDITION</b></span>
   
   </div>
   <div class="row" style="margin-left:30px">


        <table style="width:100%" >
            <tr>
                <td style="width:50%">Body</td>
                <td style="width:50%">Good [ {{$body == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$body == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$body == 'Poor' ? '√' : '' }} ]</td>

            </tr>
            <tr>
                <td>Engine</td>
                <td>Good [ {{$engine == 'Good' ? '√' : ''}}  ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$engine == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$engine == 'Poor' ? '√' : '' }}  ]</td>

            </tr>
            <tr>
                <td>Steering Control</td>
                <td>Good [  {{$steering_control == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$steering_control == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$steering_control == 'Poor' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td>Axle </td>
                <td>Good [ {{$axle == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$axle == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$axle == 'Poor' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td>Suspension</td>
                <td>Good [ {{$suspension == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$suspension == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$suspension == 'Poor' ? '√' : ''}} ]</td>


            </tr>
           
            
        </table>
   </div>

   <!-- <div class="row" style="margin-left:30px">


        <table >
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
           
            
        </table>
   </div> -->
   
    

</div>
</body>
</html>