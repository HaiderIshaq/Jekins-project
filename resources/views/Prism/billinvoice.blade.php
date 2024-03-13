<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prism Bill No : {{$data['job_number']}} </title>
</head>
<style  type="text/css" media="print">
    .page
    {
        page-break-after: always;
        /* page-break-inside: avoid; */
    }
</style>
<style >

body{background:none;
    
}



.container{width:90%}
.container-fluid{width:100%}

table{
     width: 100%;
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
   font-size:13px
}

div.box1{
    width:50%
}

div.box2{
    width:40%
}
.details-box{
    float:right;
   border:1px solid black;
   font-size:12px;
   padding:5px 30px 5px 5px;
   margin-top:10px;
   width:40%;
   margin-right:0px;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}

td{
    font-size:16px
}

</style>
<body >
    @if($data['stamp']==true)
    <div style="position: absolute; left:6%; right: 0; top: 55%; bottom: 0;">
        <img src="images/prismstamp.png" 
             style="width: 50mm; height: 50mm; margin: 0;" />
    </div>
    @endif
    <div >
        <div class="container-fluid" style="padding-top:100px">

            
            <div class="row">
                <h4 style="text-decoration:underline;text-align:center;line-height:0.1;"><b>INOVICE</b></h4>
                <h4 style="text-decoration:underline;text-align:center;line-height:0.1;"><b>{{$data['is_takaful']==0?'INSURANCE SURVEY REPORT':'TAKAFUL SURVEY REPORT'}}</b></h4>
                {{-- @if($data['survey_type']==8)
                <h5 style="text-align:center;line-height:0.1;"><b>Pre-Insurance Survey</b></h5>
                @else --}}
                {{-- <h5 style="text-align:center;line-height:0.1;"><b>Partial Loss Survey  </b></h5> --}}
                <h5 style="text-align:center;line-height:0.1;"><b>{{$data['survey_mode']}} Survey</b></h5>
                {{-- @endif --}}
            </div>
        </div>
        <div class="container" style="margin:0 auto;width:90%">

            <div class="row" style="padding-bottom: 10px">
                <h5 style="line-height:0.1;">M/S. {{$data['insurer_name']}}</h5>
                <h5 style="line-height:0.1;">{{$data['insurer_branch_name']}}</h5>
            </div>
        </div>

 
        <div class="container" style="margin:0 auto;width:90%">

            <div class="row " style="padding-bottom:5px">

            <div class="box box1">
                <span>Bill No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data['job_number']}}</span>
            </div>
                <div class="box"  >
                    <div style="width: 75%;float: left; text-align:right">
                    Dated:
                </div>
                    <div style="width: 25%;float: left;text-align:right">
                    {{$data['dated']}}
                </div>
               
            </div>


            </div>
        </div>

    
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row mr-3">
                <b><hr style="color:black;height:2px;margin-top:0px"></b>
            </div>

        </div>

        <div class="container" style="margin:0 auto;width:90%">

            <div class="row">

                <table style="border:1px;">
                 
                        
                    
                            <tr >
                                
                                <td style="padding-left: 100px;">


                                        <table style="border:0px;">
                                            <tr>
                                                <td style="border:0px;padding:4px">
                                                <b>MOTOR </b>
                                            </td>
                                            </tr>
                                            <tr style="width:100%">
                                                <td  style="border:0px;padding:4px;width:175px">{{$data['is_takaful']==0?'Name of Insured:':'Name of Participant:'}}</td>
                                                <td style="border:0px;padding:4px;"><b>{{$data['name_of_insured']}}</b></td>
                                            </tr>
                                            @if($data['survey_type']==8)
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:15%">Address:</td>
                                                <td style="border:0px;padding:4px;width:85%"><b>{{$data['address']}}</b></td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:25%">Contact Person:</td>
                                                <td style="border:0px;padding:4px;width:75%"><b>{{$data['contact_person']}}</b></td>
                                            </tr>
                                            @else 
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:140px">Loss #:</td>
                                                <td style="border:0px;padding:4px;"><b>{{$data['loss_no']}}</b></td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:140px">{{$data['is_takaful']==0?'Policy #:':'PMD #:'}}</td>
                                                <td style="border:0px;padding:4px;"><b>{{$data['policy_no']}}</b></td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:140px">{{$data['is_takaful']==0?'Validity':'Period'}} From: </td>
                                                <td style="border:0px;padding:4px;width:140px"><b> {{$data['validity_from']}}</b></td>
                                                <td style="border:0px;padding:4px;width:140px">To:</td>
                                                <td style="border:0px;padding:4px;width:140px"><b>{{$data['validity_to']}}</b></td> 
                                            </tr>
                                            @endif

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"></td>
                                                <td style="border:0px;padding:4px;width:240px">
                                                    <b style="text-decoration: underline">Particulars of {{$data['is_takaful']==0?'Insured Item:':'Participant Item'}}</b>
                                                </td>
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:140px">Registration #:</td>
                                                <td style="border:0px;padding:4px;">
                                                   {{$data['reg_no']}}
                                                </td>
                                            </tr>


                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:140px">{{$data['survey_item']}}:</td>
                                                <td style="border:0px;padding:4px;width:140px"> {{$data['make']}}</td>
                                                <td style="border:0px;padding:4px;width:140px">Model:</td>
                                                <td style="border:0px;padding:4px;width:140px">{{$data['model']}}</td> 
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:140px">Engine #:</td>
                                                <td style="border:0px;padding:4px;width:140px"> {{$data['engine_no']}}</td>
                                                <td style="border:0px;padding:4px;width:140px">H.P/C.C:</td>
                                                <td style="border:0px;padding:4px;width:140px">{{$data['engine_capacity']}}</td> 
                                            </tr>
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;width:140px">Chassis #:</td>
                                                <td style="border:0px;padding:4px;">{{$data['chassis_no']}}</td>
                                            </tr>
                                           

                                        </table>    
                                        


                                        <table style="border:0px;margin-top:45px">
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Professional Fee:</td>
                                            </tr>
                                            @if($data['snaps']!=0)

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Snaps:</td>
                                            </tr>
                                            @endif
                                            @if($data['re_inspection_charges']!=0)

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Re-Inspection:</td>
                                            </tr>

                                            @endif

                                            @if($data['extra_visit']!=0)

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Extra Visit:</td>
                                            </tr>

                                            @endif

                                            @if($data['travelling']!=0)

                                            <tr style="">
                                                <td  style="border:0px;padding:4px;"> Travelling:  &nbsp;&nbsp;&nbsp;&nbsp;{{$data['ts_details']==''?'':$data['ts_details']}}</td>
                                            </tr>

                                            @endif
                                            <tr style="">
                                                <td  style="border:0px;padding:4px;">Sales Tax @ {{intval($data['st_rate'])}}% on Professional Fee</td>
                                            </tr>

                                        </table>

                                               

                                </td>
                                <td   style="text-align:right;padding:20px">
                               
                                <table style="border:0px;margin-top:288px">
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> {{$data['service_charges']}}</td>
                                    </tr>
                                    @if($data['snaps']!=0)
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> {{$data['snaps']}}</td>
                                    </tr>
                                    @endif
                                    @if($data['re_inspection_charges']!=0)
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> {{$data['re_inspection_charges']}}</td>
                                    </tr>
                                    @endif
                                    @if($data['extra_visit']!=0)
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;"> {{$data['extra_visit']}}</td>
                                    </tr>
                                    @endif
                                    @if($data['travelling']!=0)
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;">{{$data['travelling']}}</td>
                                    </tr>
                                    @endif
                                    <tr style="">
                                        <td  style="border:0px;padding:4px;">{{$data['tax']}}</td>
                                    </tr>

                                </table>

                            </td>
                            </tr>
                            <tr >
                                <td style="border: 1px solid black;padding:4px">
                                    <table style="border:0px">
                                        <tr style="border:0px">
                                            <td style="border:0px ;width:85%;">Rupees : &nbsp;&nbsp;&nbsp;&nbsp; {{strtoupper($data['total_amount_text'])}}
                                            </td>
                                            <td style="border:0px;width:15%;text-align:right;">Total :</td>
                                        </tr>
                                    </table>

                                    </td>

                                <td style="text-align:right;">
                                <span >
                                    <b>
                                    {{$data['total_amount']}}
                                    </b>
                                </span>
                                </td>
                            </tr>

                    </table>
                <div class="row ml-0 mr-1">

                    <p class="details-box">NTN No : 2734165-8 (Filer)<br>
                    <b>Accepted Methods of Payment</b><br>
                    P/O in the name of "Prism Surveyors (Pvt) Ltd
                    </p>

                </div>
                <div class="footer">
                    <span>FOR Prism Surveyors (Pvt) Ltd.</span>
                    <hr style="color:black;height:2px" class="mr-3">
                    <span style="font-size:12px">Invoice/Payment Queries : 92 (21) 35293363-64 <br>
                    Email : accounts@prismsurveyors.com <br>
                    URL : http://www.prismsurveyors.com <br>
                    Please our terms are strictly payment in full withing 30 days of invoice date
                    </span>
                    <hr style="color:black;height:2px" class="mr-3">
  
            </div>

        </div>
    </div>
</body>
</html>
