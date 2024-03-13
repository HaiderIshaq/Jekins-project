<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Partial Loss Report  </title>

</head>
<style media="print">
    /* cyrillic-ext */

    body{background:none;
    }



    .container{width:90%}
    .container-fluid{width:100%}

    table{
        width: 80%;
        border-collapse: collapse;
        text-align: right;

    }

    table, td, th{
        border:1px solid black;
        padding-left:20px;
        padding-right:20px;
        padding-top:20px;
        padding-bottom:20px;
        font-size:12px;
        text-align: right;


    }
    th, td {
    padding: 5px;
    }
    .row{

    }
    div.box{
    float:left;
    width:50%;
    font-size:13px
    }

    div.box1{
    width:60%;
    }

    div.box2{
    width:20%;

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
    width:250px;border:1px solid black;padding:3px;height:20px;margin-bottom: 10px
    }
    .heading-boxs{
    width:645px;border:1px solid black;padding:3px;height:20px;margin-bottom: 10px
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
            <div>
                <h3 style="text-decoration: underline;text-align:center">Vehicle - Partial Loss Survey Report</h3>
            </div>
          
        </div>
        <div class="container" style="margin:0 auto;width:90%">
            <div class="row" style="border-top: 1px solid black;border-bottom: 1px solid black;padding:5px">
                <div class="box box1" style="font-size: 14px">
                    <span>Ref: {{$job_id}}</span>
                </div>
                <div class="box date" style="text-align: right;font-size: 14px">
                    <span>Dated: {{$report_date}}</span>
    
                </div>
            </div>
    
        </div>
        <div class="container"  style="margin:0 auto;width:90%;border:2px solid black;margin-top:8px">
                
                <div class="row" style="padding:5px 5px">
                    <div class="heading-box">
                        <h5 style="margin:0">Total Assessment</h5>
                     </div>
                   
                     <table>
                        <tr>
                            <th>Cost of Parts</th>
                            <th></th>
                            <th>{{$part_rates==true?number_format($totalcostofparts):''}}</th>
                        </tr>
                        

                        @if ($discount!=0)
                        <tr>
                            <td>Less Discount on Parts</td>
                            <td>{{$discountrate}}%</td>
                            <td>{{$part_rates==true?$discount:''}}</td>
                        </tr>                            
                        @endif


                        @if ($deped!=0)
                        <tr>
                            <td>Less Depreciation on Parts</td>
                            <td>{{$depedrate}}%</td>
                            <td>{{$part_rates==true?$deped:''}}</td>
                        </tr>
                        @endif

                        @if($is_to_be_replaced_tax==1)
                            @if ($gstax!=0)                            
                            <tr>
                                <td>Add GST on Parts</td>
                                <td>{{$gstaxrate}}%</td>
                                <td>{{$part_rates==true?$gstax:''}}</td>
                            </tr>
                            @endif
                        @endif
                        
                        @if ($salvage!=0)
                        <tr>
                            <td>Less Salvage on Parts</td>
                            <td>{{$salvagerate}}%</td>
                            <td>{{$part_rates==true?$salvage:''}}</td>
                        </tr>
                        @endif

                    @if($is_to_be_replaced_tax==0)
                        @if ($gstax!=0)                            
                        <tr>
                            <td>Add GST on Parts</td>
                            <td>{{$gstaxrate}}%</td>
                            <td>{{$part_rates==true?$gstax:''}}</td>
                        </tr>
                        @endif
                    @endif
                        


                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td><b>{{$part_rates==true?$totalbefore:''}}</b></td>
                        </tr>
                        <tr>
                            <td>Labour Charges Approved</td>
                            <td></td>
                            <td>{{$repaired_assesed}}</td>
                        </tr>
                        <tr>
                            <td>Add: PST on Labour@</td>
                            <td>{{$repaired_assesed_tax_rate}}%</td>
                            <td>{{$repaired_assesed_tax}}</td>
                        </tr>
                        <tr>
                            <td><b>Total Labour with PST</b></td>
                            <td></td>
                            <td><b>{{number_format($finallabour)}}</b></td>
                        </tr>
                        <tr>
                            <td><b>Total Payable Amont (Labour + Parts)</b></td>
                            <td></td>
                            <td><b>{{$part_rates==true?number_format($finalamount):''}}</b></td>
                        </tr>
                        
                    </table>
                   
                        <div class="row" style="padding:5px 5px">
                            <div class="heading-boxs">
                                <h5 style="margin:0">{{$payto}}.</h5>
                            </div>
                        </div>                        
                   
                @if($re_date!=null)
                    <div class="row" style="padding:5px 5px">
                        <div class="heading-boxs">
                            <h5 style="margin:0">Re-Inspection/Survey Date {{$re_inspection_date}}</h5>
                         </div>
                    </div>
                @endif

                 
                </div>
                    
        </div>
       

                <div class="container" style="margin:0 auto;width:90%">
            <div class="row" style="padding:0px">
                <div class="box box4" style="font-size: 10px; text-align: justify;">
                    <span>The Insurance survey firm or any of its Director, employee, associate or any other related party has any interest directly or
                    indirectly by way of Insurance/Takaful Operator, ownership, agency, commission, repair, disposal or salvage nor in any other
                    way other than as an insurance surveyor/Takaful Operator in the property or interest which constitute the subject matter of this
                    survey report. Issued subject to the terms & conditions of the relevant Insurance Policy.</span>
                </div>
               
            </div>

            <div class="row" style="padding:0px;position:relative">
                <div class="box box4" style="position:absolute">
                    <h3>ISSUED WITH PREJUDICE</h3>
                    @if($stamp==true)
                    <img src="images/prismstamp.png" 
                         style="display:block; margin-top: -55px;padding:0;width:45mm;height:45mm;" />
                     @else 
                    <br>
                    <br>
                    <br>
                    <br>
                    @endif   

                </div>
                <span class ="signature" ><b>For Prism Surveyors (Pvt) Ltd.</b></span>   
               
            </div>
        
    <div>
 
  
    
    
    

</body>
</html>
