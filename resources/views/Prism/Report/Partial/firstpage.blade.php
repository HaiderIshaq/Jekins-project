<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Partial Loss Report  asdsa</title>

</head>
<style media="print">
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
    width:60%;
}

div.box2{
    width:40%;
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

.heading-box{
    width:250px;border:1px solid black;padding:3px;height:20px;margin-bottom: 10px
}
.page_break { page-break-before: always; }


</style>
<body>  
        {{-- <img src="images/prismstamp.png" height="100" width="100" alt=""> --}}
        @if($stamp==true)
        <div style="position: absolute; left:70%; right: 0; top: 70%; bottom: 0;">
            <img src="images/prismstamp.png" 
                 style="width: 50mm; height: 50mm; margin: 0;" />
        </div>
        @endif
        <div class="container-fluid" style="padding-top: 55px">
            <div>
                <h3 style="text-decoration: underline;text-align:center">Vehicle - Partial Loss Survey Report</h3>
            </div>
          
        </div>
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row" style="border-top: 1px solid black;border-bottom: 1px solid black;padding:5px">
                <div class="box box1" style="font-size: 14px">
                    <span>Ref: {{$job_id}}</span>
                </div>
                <div class="box box2" style="text-align: right;font-size: 14px">
                    <span>Dated: {{$report_date}}</span>
    
                </div>
            </div>
    
        </div>
        <div class="container"  style="margin:0 auto;width:90%;border:2px solid black;margin-top:6px">
                <div style="width:100%;padding:0px;">
                    <p style="font-size:12px;margin:8px"> Detail of {{$is_takaful==0?'This is to certify that at the request of the Insurance Company we, the Insurance Surveyors, conducted
                        the survey of the subject vehicle & our findings on loss assessment, are as under:-':'This is to certify that at the request of the Takaful Company we, the Takaful Surveyors, conducted
                        the survey of the subject vehicle & our findings on loss assessment, are as under:-'}}</p>
                </div>
               
                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Detail of {{$is_takaful==0?'Insured':'Paricipant'}}</h5>
                     </div>
                    <div class="box box1" style="width:50%">
                                <b>Name of {{$is_takaful==0?'Insured':'Paricipant'}}</b> 

                    </div>
                    <div class="box box2">

                        <div class="row">
                            <div class="box box1" style="width: 10px" >:</div>
                            <div class="box box2" style="width: 240px" >
                            {{$name_of_insured}}

                            </div>
                        </div>
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Address</b>
                    </div>
                    <div class="box box2">
                        <div class="row">
                            <div class="box box1" style="width: 10px" >:</div>
                            <div class="box box2" style="width: 240px" >
                            {{$address}}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Detail of {{$is_takaful==0?'Insurer':'Takaful Company'}}</h5>
                     </div>
                    <div class="box box1" style="width:50%">
                        <b>Name of {{$is_takaful==0?'Insurer':'Takaful Company'}}</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;M/s. {{$insurer_name}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Branch</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$insurer_branch_name}}
                    </div>
                </div>
                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Detail of {{$is_takaful==0?'Insurance Policy':'PMD'}}</h5>
                     </div>
                    <div class="box box1" style="width:50%">
                        <b>{{$is_takaful==0?'Policy #':'PMD #'}}</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$policy_no}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Loss #</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$loss_no}}
                    </div>
                    @if($endors_no!=null)
                    <div class="box box1" style="width:50%">
                        <b>Endrs No #</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$endors_no}}
                    </div>
                    @endif
                    @if($tracking_id!=null)
                    <div class="box box1" style="width:50%">
                        <b>Tracking ID</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$tracking_id}}
                    </div>
                    @endif
                    <div class="box box1" style="width:50%">
                        <b>{{$is_takaful==0?'Validity of Policy':'Period of Takaful'}}</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;From {{$validity_from}} To {{$validity_to}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>{{$is_takaful==0?'Sum Insured':'Sum Covered'}}</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{number_format($sum_insured).'/-'}}
                    </div>
                </div>
                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Detail of Vehicle</h5>
                     </div>
                    <div class="box box1" style="width:50%">
                        <b>Make</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$make}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Model</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$model}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Registration #</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$reg_no}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Color</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$color}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Engine #</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$engine_no}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Chassis #</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$chassis_no}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Horse Power</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$engine_capacity}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Odometer Reading</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$odometer}}
                    </div>
                </div>
                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Detail of Driver</h5>
                     </div>
                    <div class="box box1" style="width:50%">
                        <b>Name of Driver</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$name_of_driver}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Age</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$age_of_driver}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>License #</b>
                    </div>
                    <div class="box box2">
                    :&nbsp;&nbsp;{{$license_no}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Date of Issue</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$issued_on}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Date of Expiry</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$expired_on}}
                    </div>
                </div>
                
                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Detail of Loss</h5>
                     </div>
                    <div class="box box1" style="width:50%">
                        <b>Nature of Loss</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$nature_of_loss}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Date of Loss</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$date_of_loss}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Time of Loss</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$time_of_loss}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Place of Loss</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$place_of_loss}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Requested for Survey</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$requested_date}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Date of Survey</b>
                    </div>
                    <div class="box box2">
                        :&nbsp;&nbsp;{{$date_of_inspection}}
                    </div>
                    <div class="box box1" style="width:50%">
                        <b>Place of Survey</b>
                    </div>
                    <div class="box box2">
                        
                        :&nbsp;&nbsp;<b>{{$place_of_survey}}</b>
                    </div>
                </div>    
        <div>
 
  
    
    
    

</body>
</html>
