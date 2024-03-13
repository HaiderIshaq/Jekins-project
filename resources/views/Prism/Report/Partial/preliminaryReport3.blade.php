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
    width:250px;padding:3px;height:20px;margin-bottom: 6px
    }
    .heading-boxs{
    width:645px;border:1px solid black;padding:3px;height:20px;margin-bottom: 10px
    }
    .page_break { page-break-before: always; }

    
    .signature{
        padding: 0
    }
</style>
<body>

        <div class="container-fluid" style="padding-top: 40px">
            <div>
                <h4 style="text-decoration: underline;text-align:center">Preliminary Assessment Report</h4>
            </div>
          
        </div>
        <div class="container" style="margin:0 auto;width:90%;margin-bottom:5px">
            <div class="row" style="border-top: 1px solid black;border-bottom: 1px solid black;padding:5px">
                <div class="box box1" style="font-size: 14px">
                    <span>Ref: {{$job_id}}</span>
                </div>
                <div class="box date" style="text-align: right;font-size: 14px">
                    <span>Dated: {{$report_date}}</span>
    
                </div>
            </div>
    
        </div>
        <div class="container"  style="margin:0 auto;width:90%;border:2px solid black;">
            
            {{-- @endif --}}


                {{-- @if(count($dismantle)+count($replaced)<20) --}}

                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Preliminary Claim Assessment</h5>
                     </div>
                   
                     <table>
                        <tr>
                            <td>Allowed Parts Price</td>
                            
                            <td>{{$part_rates==true?$costofparts:''}}</td>
                        </tr>
                        @if(count($dismantle)>0)
                     
                        <tr>
                            <td>SD Parts Price</td>
                            <td>{{$part_rates==true?$costofdismantle:''}}</td>
                        </tr>
                        @endif

                        <tr>
                            <th>Total Price of Parts</th>
                            
                            <th>{{$part_rates==true?number_format($totalcostofparts):''}}</th>
                        </tr>
                        @if($discount!=0)
                        <tr>
                            <td>Less Discount on Parts</td>
                            
                            <td>{{$part_rates==true?$discount:''}}</td>
                        </tr>
                        @endif
                        @if($deped!=0)

                        <tr>
                            <td>Less Depreciation on Parts &nbsp;&nbsp;&nbsp;&nbsp;{{$depedrate}}%</td>
                            
                            <td>{{$part_rates==true?$deped:''}}</td>
                        </tr>
                        @endif

                        @if($is_to_be_replaced_tax==1)

                        @if($gstax!=0)
                        <tr>
                            <td>Add GST on Parts &nbsp;&nbsp;&nbsp;&nbsp;{{$gstaxrate}}%</td>
                            
                            <td>{{$part_rates==true?$gstax:''}}</td>

                        </tr>
                        @endif
                     
                        @if($salvage!=0)
                        <tr>
                            <td>Less Salvage on Parts</td>
                            
                            <td>{{$part_rates==true?$salvage:''}}</td>

                        </tr>
                        @endif

                        @else
                       
                        @if($salvage!=0)
                            <tr>
                                <td>Less Salvage on Parts</td>
                                
                                <td>{{$part_rates==true?$salvage:''}}</td>

                            </tr>
                        @endif

                        @if($gstax!=0)
                            <tr>
                                <td>Add GST on Parts &nbsp;&nbsp;&nbsp;&nbsp;{{$gstaxrate}}%</td>
                                
                                <td>{{$part_rates==true?$gstax:''}}</td>

                            </tr>

                        @endif  
                    @endif  
                        
                        <tr>
                            <td><b>Total Price After Deducting Dep. & Salvage</b></td>
                           
                            <td><b>{{$part_rates==true?$totalbefore:''}}</b></td>
                        </tr>
                        <tr>
                            <td>Labour Charges Assessed</td>
                            
                            <td>{{$repaired_assesed}}</td>
                        </tr>
                        <tr>
                            <td>Add: PST on Labour@ {{$repaired_assesed_tax_rate}}%</td>
                           
                            <td>{{$repaired_assesed_tax}}</td>
                        </tr>
                        <tr>
                            <td><b>Total Labour with PST</b></td>
                            
                            <td><b>{{number_format($finallabour)}}</b></td>
                        </tr>
                        <tr>
                            <td><b>Total Labour + Price of Parts</b></td>
                            
                            <td><b>{{$part_rates==true?number_format($finalamount):''}}</b></td>
                        </tr>
                        
                    </table>
                    

               
                 
                </div>
                    
        </div>
       

                <div class="container " style="margin:0 auto;width:90%">
                    <div class="row" style="padding:0px">
                        <div class="box box4" style="font-size: 10px; text-align: justify;">
                            <span>Preliminary Report is submitted for your perusal/advice in this respect.</span>
                        </div>
                    
                    </div>

           

                    @if($stamp==true)
                    <div style="margin: 0;padding:0">
                        <img src="images/prismstamp.png" 
                        style="width: 50mm; height: 50mm;position:absolute" />
                    </div>
                    @else
                    <br>
                    <br>
                    <br>
                    <br>
                    @endif

                    <span class ="signature"><b>For Prism Surveyors (Pvt) Ltd.</b></span>   
        
                <div>
 
                    {{-- @endif --}}
  
    
    
    

</body>
</html>
