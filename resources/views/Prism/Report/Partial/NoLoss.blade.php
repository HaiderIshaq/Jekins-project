<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>No Loss Report</title>

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
        width:50%;
        font-size:12px
        }

        div.box1{
            width:77%
        }

        div.box2{
            width:20%
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
        .heading-box{
            width:250px;border:1px solid black;padding:3px;height:20px;margin-bottom: 10px
        }
        .footer{position:relative;
        top:140px;
        font-size:13px;
        width:94%}

        .signature{ 
            margin: 20px 10px;
            border-top: 1px solid #000;
            width: 200px; 
            text-align: center;
            }
</style>
<body>
    @if($stamp==true)
    <div style="position: absolute; left:10%; right: 0; top: 62%; bottom: 0;">
        <img src="images/prismstamp.png" 
             style="width: 50mm; height: 50mm; margin: 0;" />
    </div>
    @endif
        <div class="container" style="margin:0 auto; width:90%; padding-top:85px;">
            <div class="row" >
                <div class="box box1">
                    Ref:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$job_id}}
                </div>
                <div class="box box2">
                    Date: {{$report_date}}
                </div>
            </div>
        </div>
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row" style="padding-top:10px;padding-bottom:10px" >
                <div class="box box1">
                <b>The Manager,</b><br>
                    Motor Claims Department,<br>
                    {{$insurer_name}}.<br>
                    {{$insurer_branch_name}}<br>
                    {{$region_name}}
                <span style="border-bottom: 1px solid #000;display: inline-block;padding-bottom: 10px;"></span> <br><br>
                </div>
            </div>
        </div>
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row" >
                <div class="box box1">
                    Dear Sir,<br>
                </div>
            </div>
        </div>
        <br>
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row" >
                <div class="box box1" style="width:50px">
                    Sub:-
                </div>
                <div class="box box2" style="width:550px;border-bottom:2px solid #000;text-align:center;word-spacing: 5px;">
                    <b> Issuance of No Loss / No Claim Report</b>

                </div>
            </div>
        </div>    
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row" >
                <div class="box" style="width:93%">                
                    <p style="text-align:justify;line-height:18px;word-spacing: 2px;">
                    {{$text_of_letter}}.</p>
                </div>
                <div class="box box2" style="width:100%;border-bottom:2px solid #000;text-align:justify;word-spacing: 8px;">
                    <b> Under the above circumstances, we are recommending the insurace Company to close the claim file as "NO LOSS-NOCLAIM".</b>
                </div>
        </div>
            
            <div class="row" style="padding:5px 5px; margin-top: 10px;">
                    <div class="heading-box">
                        <h5 style="margin:0">Particulars of the Case</h5>
                     </div>
                    <div class="box box1" style="width:25%">
                        <b>Name of Insured</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$name_of_insured}}
                    </div>
                    <div class="box box1" style="width:25%">
                        <b>Policy #</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$policy_no}}
                    </div>
                    <div class="box box1" style="width:25%">
                        <b>Loss #</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$loss_no}}
                    </div>
                    <div class="box box1" style="width:25%">
                        <b>Make</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$make}}
                    </div>
                    <div class="box box1" style="width:25%">
                        <b>Model</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$model}}
                    </div>
                    <div class="box box1" style="width:25%">
                        <b>Registration #</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$reg_no}}
                    </div>
                    <div class="box box1" style="width:25%">
                        <b>Engine #</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$engine_no}}
                    </div>
                    <div class="box box1" style="width:25%">
                        <b>Chassis #</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$chassis_no}}
                    </div> 
                    <div class="box box1" style="width:25%">
                        <b>Horse Power #</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$horse_power}}
                    </div>
                    @if($sum_insured!='')  
                    <div class="box box1" style="width:25%">
                        <b>Sum Insured</b>
                    </div>
                    <div class="box box2" style="width:75%">
                        :&nbsp;&nbsp;{{$sum_insured}}
                    </div> 
                    @endif

                </div>
            <div class="box" style="width:93%">

                <p style="text-align:justify;line-height:18px;word-spacing: 20px;">
                    Issued without prejudice/subject to the terms/conditions/exceptions of Insurance Policy
                </p>
                <p style="text-align:justify;line-height:18px;word-spacing: 2px;">
                    Thanking you and assuring you of our best services and cooperation at all times.
                </p>
                <p style="text-align:justify;line-height:18px;word-spacing: 2px;">
                    Yours Truly.
                </p>

            </div>

        </div> 
        <br><br><br>
        <div class="container" style="margin:0 auto;width:90%">
            
            <span class ="signature" ><b>For Prism Surveyors (Pvt) Ltd.</b></span>
        </div>    
</body>
</html>
