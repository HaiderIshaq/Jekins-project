<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pre-Insurance Report No : {{$job_id}} </title>

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
   /* width:50%; */
   font-size:13px
}

div.box1{
    width:74%
}

div.box2{
    width:25%
}
.details-box{
    float:right;
   border:1px solid black;
   font-size:13px;
   padding:5px 40px 5px 5px;
   margin-top:10px;
   width:30%;
   margin-right:35px;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}

.page_break { page-break-before: always; }
</style>
<body>
    {{-- First Page Start --}}
    <div class="container" style="width:90%;margin-left:35px;padding-top:80px;padding-bottom:10px">
        <div class="row" style="border: 1.5px solid blue;padding:2px">
            <!-- <img style="padding-right:40px" src="images/kgtlogo.png" height="130" width="130" alt="" > -->
            <div class="box box1" style="border: 1.5px solid blue;">
                <div style="padding: 5px">
                    <span style="font-size:15px">
                        <b>Motor Report No.</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{$job_id}}</span>

                </div>
            </div>
            <div class="box box2" style="border: 1.5px solid blue;padding:0px;margin-left:1px">
                <div style="padding: 5px">
                    <span  style="font-size:15px"><b>Dated:</b>&nbsp;&nbsp;&nbsp;{{$dated}}</span>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" style="text-align: center">
            <span style="text-decoration: underline;font-size:25px;padding-bottom:5px;"><b>PRE-INSURANCE INSPECTION REPORT</b></span>
        </div>
    </div>
    <div class="container" style="width:90%;margin-left:35px;">
        <div class="row">
            <h4 style="text-decoration:underline;">DETAILS OF PERPOSAL: </h4>
        </div>
        <div class="row" style="">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Insurer Co. Name</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> M/s. {{$insurer_name}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Division / Branch Name :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$insurer_branch}} {{{$development_officer!=''?'C/O '.$development_officer:''}}} </span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Name of Underwriter :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$underwriter}} </span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Request Date & Time :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <div class="row">
                    <div class="box" style="width: 50%;font-size:13px">
                        {{$requested_date}}
                    </div>
                    <div class="box" style="width: 50%;font-size:13px">
                       <b> Timing:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$requested_time}}
                    </div>
                 </div>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Insured Name  :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$name_of_insured}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Insured Contact No. :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$conatact_insured}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Insured Address :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$insured_address}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Contact Persons Name  :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$contact_person}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Contact Numbers  :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$contact_number}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px ">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Insured CNIC No.  :</b>
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span style="line-height: 1px"> {{$nic_of_insured}}</span>
            </div>
        </div>
    </div>
    <div class="container" style="width:90%;margin-left:35px;">
        <div class="row">
            <h4 style="text-decoration:underline;">DETAILS OF VEHICLE: </h4>
        </div>
        <div class="row" style="">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Manufacture</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$manufacture}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Make</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$make}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Horse Power</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$engine_capacity}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Variant</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$variant}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Registration No.</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span>{{$reg_no}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Registration Year</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span>{{$reg_date==""?'':$reg_date}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Manufacturing Year</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$manufacturing_year}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Engine No.</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$engine_no}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Chassis No.</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$chassis_no}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Cubic Capacity</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$seating}}</span>
            </div>
        </div>
       

        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Color</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{ucwords($color)}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>ODO Meter Reading</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$odometer}}</span>
            </div>
        </div><div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Body Type</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{ucwords($body_type)}}</span>
            </div>
        </div><div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Private or Commercial</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$choice_one}}</span>
            </div>
        </div><div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Local Assembled or Imported</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$choice_two}}</span>
            </div>
        </div>


    </div>
    <div class="container" style="width:90%;margin-left:35px;">
        <div class="row">
            <h4 style="text-decoration:underline;">ACCESSORIES DESCRIPTION: </h4>
        </div>
        <div class="row" style="">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Factory Fitted Accessories </b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$factory_fitted_accessories}}</span>
            </div>
        </div>
        <div class="row" style="margin-top:5px">
            <div class="box" style="width: 40%;font-size:13px">
                <b>Any Additional Accessories</b> <b style="position:absolute;right:10px">:</b> 
            </div>
            <div class="box" style="width: 60%;font-size:13px">
                 <span> {{$additional_accessories}}</span>
            </div>
        </div>
       
    </div>
    {{-- First Page End --}}
    


</body>
</html>
