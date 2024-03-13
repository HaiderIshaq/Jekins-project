<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Preliminary Assessment Report</title>

</head>
<style media="print">
    /* cyrillic-ext */

    body{background:none;
    }



    .container{width:90%}
    .container-fluid{width:100%}

    table{
        width: 100%;
        border-collapse: collapse;
        text-align: left;

    }

    table, td, th{
        border:1px solid black;
        padding-left:20px;
        padding-right:20px;
        padding-top:20px;
        padding-bottom:20px;
        font-size:12px;
        text-align: left;


    }
    th, td {
    padding: 5px;
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

    div.box3{
    width:20%;
    }

    div.box4{
    width:100%;
    }

    div.date{
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
    width:250px;padding:3px;height:20px;margin-bottom: 3px
    }
    .heading-boxs{
    width:645px;border:1px solid black;padding:3px;height:20px;margin-bottom: 5px
    }
    .page_break { page-break-before: always; }

    .signature{ 
    margin: 20px 10px;
    border-top: 1px solid #000;
    width: 200px; 
    text-align: center;
    }

</style>
<body>
   
        <div class="container-fluid" style="padding-top: 50px">
            <div style="padding: 0px">
                <h4 style="text-decoration: underline;text-align:center;padding-top:10px">Preliminary Assessment Report</h4>

            </div>
          
        </div>
        <div class="container" style="margin:0 auto;width:90%">

            <div class="row" style="border-top: 1px solid black;border-bottom: 1px solid black;padding:3px">
                <div class="box box1" style="font-size: 13px">
                    <span>Ref: {{$job_id}}</span>
                </div>
                <div class="box date" style="text-align: right;font-size: 13px">
                    <span>Dated: {{$report_date}}</span>
    
                </div>
            </div>
    
        </div>
        <div class="container"  style="padding:3px 5px;margin:0 auto;width:90%;border:2px solid black;margin-top:8px;height:75%">
                <div style="width:100%;padding:0px;">
                    <span style="font-size:13px;margin:8px">M/s. {{$insurer_name}}
                    </span><br>
                    <span style="font-size:13px;margin:8px">{{$insurer_branch_name}}
                    </span><br><br>
                    <span style="font-size:13px;margin:8px; text-algin:justify;">As per your directives, we have conducted the Survey of the subject vehicle. Our findings
                        are as under:-
                    </span>
                </div>

                <!--  -->

                <div class="row" style="padding:5px 0px;width:100%">
                    <div class="heading-box">
                        <h5 style="margin:0">Particulars of Vehicle</h5>
                     </div>
                    <!-- <div class="box" style="width:17%;float: left;border:1px solid black;padding:5px">
                        <b>Description</b>
                    </div> -->
                    <div class="box-tab" style="width:45%;float: left;border:1px solid black;padding:5px">
                        <table>
                            <tr>
                                <th>{{$is_takaful==0?'Insured':'Participant'}}</th>
                                
                                <td>{{$name_of_insured}}</td>
                            </tr>
                            <tr>
                                <th>{{$is_takaful==0?'Policy #':'PMD #'}}</th>
                                
                                <td>{{$policy_no}}</td>
                            </tr>
                            <tr>
                                <th>Endorsement #</th>
                                
                                <td>{{$endors_no}}</td>
                            </tr>
                            <tr>                         
                                <th>Loss #</th>
                                
                                <td>{{$loss_no}}</td>
                            </tr>

                            <tr>                           
                                <th>Sum Insured</th>
                                
                                <td>{{$sum_insured}}</td>
                            </tr>

                            <tr>
                                <th>Workshop</th>
                                
                                <!-- workshop error in this -->
                                <td>{{$workshop}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;border:1px solid black;padding:5px">
                        <table>
                            <tr>
                                <th>Make</th>
                                
                                <td>{{$make}}</td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                
                                <td>{{$model}}</td>
                            </tr>
                            <tr>
                                <th>Registration #</th>
                                
                                <td>{{$reg_no}}</td>
                            </tr>
                            <tr>                         
                                <th>Engine #</th>
                                
                                <td>{{$engine_no}}</td>
                            </tr>

                            <tr>                           
                                <th>Chassis #</th>
                                
                                <td>{{$chassis_no}}</td>
                            </tr>

                            <tr>
                                <th>Colour</th>
                                
                                <td>{{$color}}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- <div class="box" style="width:23%;float: left;border:1px solid black;padding:5px">
                        <b>Description</b>
                    </div>

                    <div class="box" style="width:17%;float: left;border:1px solid black;padding:5px;">
                        <b>Description</b>
                    </div>

                    <div class="box" style="width:23%;float: left;border:1px solid black;padding:5px">
                        <b>Description</b>
                    </div> -->
                    @if($circumstances!='')
                    <div class="heading-box" style="margin: 3px">
                        <!-- <h5 style="margin:0">Circumstances of Loss</h5> -->
                    </div>
                    <div class="heading-boxs" style="width:94%;padding:0px;">
                        <!-- <p style="font-size:12px;margin:4px">{{$circumstances}}</p> -->
                    </div>
                    @endif
                </div>

                <div class="row" style="padding:3px 5px;width:100%">
                    <div class="heading-box">
                        <h5 style="margin:0">Parts to be Repaired (Demand)</h5>
                     </div>
                     <div class="box" style="width:48%;float: left;border:1px solid black;padding:3px">
                        <div class="row">
                            <div class="box box1"><b>Description</b></div>
                           
                        </div>
                    </div>
                    <div class="box" style="width:48%;float: left;border:1px solid black;padding:3px">
                        <div class="row">
                            <div class="box box1"><b>Description</b></div>
                            
                        </div>
                    </div>
                    @foreach ($repaired as $rec)
                    <div class="box" style="width:48%;float: left;border:1px solid black;padding:3px">
                        <div class="row">
                            <div class="box box1"> 
                                {{$rec->title==''?'-':$rec->title}}
                            </div>
                            <div class="box box2" style="text-align: right">
                          </div>
                        </div>
                    </div>
                    @endforeach
                    @if ($prdas==true)
                    <div class="box" style="width:48%;float: left;border:1px solid black;padding:3px">
                        <div class="row">
                            <div class="box box1"> 
                                -
                            </div>
                            <div class="box box2" style="text-align: right">
                          </div>
                        </div>
                    </div>
                    @endif
                   



                    <div  style="width:48%;float: left;padding:3px">
                        <div class="row">
                            <div class="box box1" style="font-size:12px"><b> Labour Demanded &nbsp;&nbsp; </b></div>
                            <div class="box box2" style="font-size:12px;text-align:right"><b>  {{$repaired_labour}}</b></div>
                        </div>
                    </div>
                    <div  style="width:48%;float: left;padding:3px">
                        <div class="row">
                            <div class="box box1" style="font-size:12px"><b> Labour Assessed &nbsp;&nbsp; </b></div>
                            <div class="box box2" style="font-size:12px;text-align:right"><b>   {{$repaired_assesed}}</b></div>
                        </div>
                    </div>
                    
                </div>

                
                    
                    <!-- <div class="box" style="width:48%;float: left;border:1px solid black;padding:3px">
                        <b>Description</b>
                    </div>

                    <div class="box" style="width:48%;float: left;border:1px solid black;padding:5px">
                        Front Bumper Rear Bumper
                    </div>

                    <div class="box" style="width:48%;float: left;border:1px solid black;padding:5px">
                        Front Bumper Rear Bumper
                    </div>
                    <div class="box" style="width: 100%;text-align:right;padding:5px">
                       <b> Labour / Repairing Charges Demanded &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 11,000<br></b>
                       <b>Labour / Repairing Charges  Settled &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;30,000<br></b>
                         
                    </div> -->

                    
                

                <!--  -->
                <!-- <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Particulars of Vehicle</h5>
                     </div>
                   
                    
                    <div class="row" style="padding:5px 5px">
                    <div class="heading-boxs">
                        <h5 style="margin:0">Pay Amount to Margalla Motors.</h5>
                     </div>
                </div> -->

                <!-- <div class="row" style="padding:5px 5px">
                    <div class="heading-boxs">
                        <h5 style="margin:0">Re-Inspection/Survey Date 03-Sep-2022</h5>
                     </div>
                </div> -->
                 
                </div>
                    
        </div>
       

              
    <div>
 
  
    
    
    

</body>
</html>
