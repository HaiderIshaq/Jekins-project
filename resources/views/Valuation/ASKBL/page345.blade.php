<!DOCTYPE >
<html >
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Documnt</title>
<style>

    .container{
        width:100%;
       
        
    }

    .box{
        width:50%;
        float:left;
        text-align:center;
      
        
    }

    table {
  border-collapse: collapse;
  font-size:11px;
  width:100%
}

table, th, td {
  border: 1px solid black;
}
td{
    width:50%;
    padding:2px 10px 2px 10px
}
@page {
	
	      /* 'em' 'ex' and % are not allowed; length values are width height */
	margin: 10%; /* <any of the usual CSS values for margins> */
    margin-left:8%

	             /*(% of page-box width for LR, of height for TB) */
 /* <any of the usual CSS values for margins> */
}
</style>
</head>

<body>

  <div class="container" >

  <div class="row" style="margin-left:30px">
        <table >
        <tr>
                <td>Transmission System</td>
                <td>Good [ {{$transmission_system == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$transmission_system == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$transmission_system == 'Poor' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td>Electrical System</td>
                <td>Good [ {{$electric_system == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$electric_system == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$electric_system == 'Poor' ? '√' : ''}} ]</td>
                
            </tr>
            <tr>
                <td>Tires</td>
                <td>Good [ {{$tires == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$tires == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$tires == 'Poor' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td>Any Leaks (Engine, Brakes etc.)</td>
                <td>Good [ {{$any_leaks == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$any_leaks == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$any_leaks == 'Poor' ? '√' : ''}} ]</td>
               
            </tr>
            <tr>
                <td>Engine has Major Defects</td>
                <td>Good [ {{$engine_defects == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$engine_defects == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$engine_defects == 'Poor' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td>Chassis is Repaired </td>
                <td>Good [ {{$chassis_repaired == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$chassis_repaired == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$chassis_repaired == 'Poor' ? '√' : ''}} ]</td>
            </tr>
            <tr>
                <td>External Condition of Vehicle:<br>
                Body <br>
                Bonnet <br>
                Doors
                </td>
                <td>Good [ {{$external_body == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$external_body == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$external_body == 'Poor' ? '√' : ''}} ] <br>
                Good [ {{$external_bonnet == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$external_bonnet == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$external_bonnet == 'Poor' ? '√' : ''}} ] <br>
                Good [ {{$external_doors == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$external_doors == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$external_doors == 'Poor' ? '√' : ''}} ] </td>
            </tr>
            <tr>
                <td>Interior Condition of Vehicle:<br>
                Dashboard <br>
                Roof <br>
                Seats
                </td>
                <td>Good [ {{$dashboard_condition == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$dashboard_condition == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$dashboard_condition == 'Poor' ? '√' : ''}} ] <br>
                Good [ {{$roof == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$roof == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$roof == 'Poor' ? '√' : ''}} ] <br>
                Good [ {{$seats == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$seats == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$seats == 'Poor' ? '√' : ''}} ] </td>
            </tr>
            <tr>
                <td>Overall Condition </td>
                <td>Good [ {{$overall_condition == 'Good' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Average [ {{$overall_condition == 'Average' ? '√' : ''}} ] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poor [ {{$overall_condition == 'Poor' ? '√' : ''}} ]</td>
            </tr>
            <tr>
                <td>If any Negative Remarks - Pls. Provide Details </td>
                <td>
                    {{$negative_remarks}}.
                </td>
            </tr>
            
        </table>
        
   </div>
   <br>
   <div class="row" style="margin-left:30px">
   <span  style="font-size:13px;text-decoration:underline"><b>SECTION III – DOCUMENT REVIEW</b></span>
   
   </div>
   <div class="row" style="margin-left:30px">


        <table style="width:100%">
            <tr>
                <td style="width:50%">Original Registration Book</td>
                <td  style="width:50%">{{$original_registration_book}}</td>
            </tr>
            <tr>
                <td>Original CNIC of Owner</td>
                <td> {{$original_cnic}}</td>
            </tr>
            <tr>
                <td>Original ETO Certificate</td>
                <td>{{$original_eto}}</td>
            </tr>
            <tr>
                <td>Vehicle has been Hypothecated to Another Person (s) / Owner</td>
                <td>{{$vehicle_hypothecated}}</td>
            </tr>
            <tr>
                <td>Duplicate Registration Certificate / Book has been Issued </td>
                <td>{{$duplicate_registration_book}}</td>
            </tr>
            <tr>
                <td>Vehicle has been Transferred from Another Province</td>
                <td>{{$vehicle_transferred}}</td>
            </tr>
            <tr>
                <td>Vehicle is on Stolen Vehicle List (Retained by CPLC) </td>
                <td>{{$vehicle_stolen}}</td>
            </tr>

           
            
        </table>
   </div>

   <br>
   <div class="row" style="margin-left:30px">
   <span  style="font-size:13px;text-decoration:underline"><b>SECTION IV – VEHICLE VALUATION</b></span>
   
   </div>
   <div class="row" style="margin-left:30px">


        <table >
            <tr>
                <td>Market Value</td>
                <td><b>Rs.{{$market_value}}</b></td>
            </tr>
            <tr>
                <td>Less: FSV (Factor Percentage & Amount)</td>
                <td>{{$less_fsv}}%</td>
            </tr>
            <tr>
                <td>FSV – Calculated as per SBP & IFS Guidelines</td>
                <td><b>Rs.{{$fsv}}</b></td>
            </tr>
            <tr>
                <td>Basis of Discounting Factor / FSV</td>
                <td>The subject discount factor is based on prevailing
                market conditions including the extent of competitive
                cars / automobiles listed for sale and the length of
                market exposer of existing listening on the date of
                survey.</td>
            </tr>
         
           
            
        </table>
   </div>
   <br>
   <div class="row" style="margin-left:30px">
    <span  style="font-size:13px;text-decoration:underline"><b>SECTION III – DOCUMENT REVIEW</b></span>
    
   </div>
   <div class="row"  style="margin-left:30px">
   <p style="font-size:13px">This is to certify that on the request of {{$bank_name}} a Survey / Inspection of the above mentioned asset was
        carried out to evaluate its present forced sale value and conform the ownership from the original documents.
        This certificate is based on the review of original title documents and approximate value which has been calculated
        and evaluated to the best of our professional knowledge and belief, present market and prevailing condition of the
        asset.
        This report does not relieve either party from its contractual obligation and is issued without prejudice</p>
   </div>
    <div class="row" style="margin-top:20px">
        <div class="box" style="text-align:left">
          <h5 style="margin-left:30px"><b>SURVEYOR</b></h5>
        </div>
        <div class="box" style="text-align:right">
          <h5><b>FOR K.G. TRADERS (Pvt.) LTD.</b></h5>
        </div>
    </div>
   
 
   
    @foreach($images as $image)    
    <div class="box" >
        <img src="{{$image->path}}" height="200" width="300" alt="">
        <h4>{{$image->description}}</h4>
    </div>
    @endforeach


  </div>
        
          
            
           
      
            
      

       


    

    
       

</body>
</html>