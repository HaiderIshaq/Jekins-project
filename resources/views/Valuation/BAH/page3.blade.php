<!DOCTYPE >
<html >
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Documnt</title>
<style>

    .container{
        width:90%;
       
        
    }

    .box{
        width:50%;
        height:10px !important;
        float:left;
      
        
    }
p{
    line-height:0.1;
}
    .box1{width:30%}
    .box2{width:70%}

    table {
  border-collapse: collapse;
  font-size:12px;
  width:100%
}

table, th, td {
  border: 1px solid black;
}
td{
    padding:2px 10px 2px 10px
}
.rating{
    float:left
}
@page {
	
	      /* 'em' 'ex' and % are not allowed; length values are width height */
	 /* <any of the usual CSS values for margins> */
   
    margin:10% 5% 14% 5%

	             /*(% of page-box width for LR, of height for TB) */
 /* <any of the usual CSS values for margins> */
}
</style>
</head>

<body>

  <div class="container" style="margin-left:30px">

  
   <div class="row" style="margin-top:20px">
        <div class="box" style="text-align:left">
          <h4 style="margin-left:30px"><b>SECTION A: Vehicle Details</b></h4>
        </div>
       
    </div>

    <div class="row" >
        <div class="box box1" style="text-align:left;width:50%">
          <p style="margin-left:30px;font-size:13px">Brand : {{$carName}}</p>
        </div>
        <div class="box box2" style="text-align:left;width:30%">
          <p style="margin-left:30px;font-size:13px">Model:</p>
        </div>
        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">{{$carModel}} </p>
        </div>

        <div class="box box1" style="text-align:left;width:50%">
          <p style="margin-left:30px;font-size:13px">Color: {{$carColor}}</p>
        </div>
        <div class="box box2" style="text-align:left;width:30%">
          <p style="margin-left:30px;font-size:13px">Registration Number:</p>
        </div>
        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">{{$regNo}}</p>
        </div>
        
        
        <div class="box box1" style="text-align:left;width:50%">
          <p style="margin-left:30px;font-size:13px">Date of Registration: {{$regDate}}</p>
        </div>
        <div class="box box2" style="text-align:left;width:30%">
          <p style="margin-left:30px;font-size:13px">Engine Number:</p>
        </div>
        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">{{$EngineNo}}</p>
        </div>


        <div class="box box1" style="text-align:left;width:50%">
          <p style="margin-left:30px;font-size:13px">Chassis Number : {{$ChassisNo}}</p>
        </div>
        <div class="box box2" style="text-align:left;width:30%">
          <p style="margin-left:30px;font-size:13px">Engine Capacity:</p>
        </div>
        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">{{$EngineCapacity}}</p>
        </div>

        <div class="box box1" style="text-align:left;width:50%">
          <p style="margin-left:30px;font-size:13px">Odometer Reading (Kms): {{$odometer}}</p>
        </div>

        <div class="box box2" style="text-align:left;width:100%">
            <div class="row">
                <div class="rating rating1" style="width:20%">
                <p style="margin-left:30px;font-size:13px">New &nbsp;&nbsp;&nbsp;&nbsp;[ <b>{{$acquired == 'New' ? '√' : ''}}</b> ]</p>
                </div>  
                <div class="rating rating2" style="width:30%">
                <p style="margin-left:30px;font-size:13px">Reconditioned &nbsp;&nbsp;&nbsp;&nbsp;[ <b>{{$reconditioned == 1 ? '√' : ''}}</b> ]</p>
                </div>  
                <div class="rating rating3" style="width:20%">
                <p style="margin-left:30px;font-size:13px">Used &nbsp;&nbsp;&nbsp;&nbsp;[ {{$acquired == 'Used' ? '√' : ''}} ]</p>
                </div>  
                <div class="rating rating4" style="width:25%">
                <p style="margin-left:30px;font-size:13px">Repossessed &nbsp;&nbsp;[ {{$repossesed == 1 ? '√' : ''}} ]</p>
                </div>  
            </div>
        </div>

        <div class="box box2" style="text-align:left;width:100%">
            <div class="row">
                <div class="rating rating1" style="width:50%">
                <p style="margin-left:30px;font-size:13px">Locally Manufactured &nbsp;&nbsp;&nbsp;&nbsp;[ <b>{{$manufactured == 'Locally Manufactured' ? '√' : ''}}</b> ]</p>
                </div>  
                <div class="rating rating2" style="width:50%">
                <p style="margin-left:30px;font-size:13px">Foreign Assembled &nbsp;&nbsp;&nbsp;&nbsp;[ <b>{{$manufactured == 'Foreign Assembled' ? '√' : ''}}</b> ]</p>
                </div>  
            </div>
        </div>
        
        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">Transmission:</p>
        </div>
        <div class="box box2" style="text-align:left;width:80%">
            <div class="row">
                <div class="rating rating1" style="width:50%">
                <p style="margin-left:30px;font-size:13px">Automatic&nbsp;&nbsp;&nbsp;&nbsp;[ <b>{{$transmission == 'Automatic' ? '√' : ''}}</b> ]</p>
                </div>  
                <div class="rating rating1" style="width:50%">
                <p style="margin-left:30px;font-size:13px">Manual &nbsp;&nbsp;&nbsp;&nbsp;[ {{$transmission == 'Manual' ? '√' : ''}} ]</p>
                </div>  
                
            </div>
        </div>

        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">Engine Type:</p>
        </div>
        <div class="box box2" style="text-align:left;width:80%">
            <div class="row">
                <div class="rating rating1" style="width:30%">
                <p style="margin-left:30px;font-size:13px">Petrol &nbsp;&nbsp;&nbsp;&nbsp;[ <b>{{$fuelType == 'Petrol' ? '√' : ''}}</b> ]</p>
                </div>  
                <div class="rating rating1" style="width:30%">
                <p style="margin-left:30px;font-size:13px">Diesel &nbsp;&nbsp;&nbsp;&nbsp;[ {{$fuelType == 'Diesel' ? '√' : ''}} ]</p>
                </div>  
                <div class="rating rating1" style="width:30%">
                <p style="margin-left:30px;font-size:13px">Hybrid &nbsp;&nbsp;&nbsp;&nbsp;[ {{$isHybrid == 0 ? '√' : ''}} ]</p>
                </div>  
            </div>
        </div>

        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">CNG Kit:</p>
        </div>
        <div class="box box2" style="text-align:left;width:80%">
            <div class="row">
                <div class="rating rating1" style="width:40%">
                <p style="margin-left:30px;font-size:13px">Self Installed &nbsp;&nbsp;&nbsp;&nbsp;[ <b>{{$cngKit == 'Company Fitted' ? '√' : ''}}</b> ]</p>
                </div>  
                <div class="rating rating1" style="width:40%">
                <p style="margin-left:30px;font-size:13px">Company Ftd. &nbsp;&nbsp;&nbsp;&nbsp;[ {{$cngKit == 'Self Installed' ? '√' : ''}} ]</p>
                </div>  
                <div class="rating rating1" style="width:20%">
                <p style="margin-left:30px;font-size:13px">N/A &nbsp;&nbsp;&nbsp;&nbsp;[ {{$cngKit == 'N/A' ? '√' : ''}} ]</p>
                </div>  
            </div>
        </div>

        <div class="box box1" style="text-align:left;width:20%">
          <p style="margin-left:30px;font-size:13px">Drive:</p>
        </div>
        <div class="box box2" style="text-align:left;width:80%">
            <div class="row">
                <div class="rating rating1" style="width:50%">
                <p style="margin-left:30px;font-size:13px"> Right hand &nbsp;&nbsp;&nbsp;&nbsp;[ <b> {{$isDrive == 'Right Hand' ? '√' : ''}}</b> ]</p>
                </div>  
                <div class="rating rating1" style="width:50%">
                <p style="margin-left:30px;font-size:13px">Left hand &nbsp;&nbsp;&nbsp;&nbsp;[  {{$isDrive == 'Left Hand' ? '√' : ''}} ]</p>
                </div>  
                 
            </div>
        </div>

    </div>

  

    <div class="row" style="" >
        <div class="box" style="text-align:left;width:100%">
          <h4 style="margin-left:30px;text-decoration:underline"><b>SECTION B: Physical (Body) Conditions of Vehicle:</b></h4>
        </div>
    </div>

    <table style="width:100%;margin-left:30px" >
            <tr>
                <td style="width:30%"><b> Right Side of the body is </b></td>
                <td style="width:70%">Good [ {{$rightSide == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$rightSide == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$rightSide == 'Dented' ? '√' : ''}}] &nbsp;&nbsp;Original Paint [ {{$rightSide == 'Original Paint' ? '√' : ''}}] &nbsp;&nbsp;Re-Painted [ {{$rightSide == 'Re-Painted' ? '√' : ''}}]</td>

            </tr>

            <tr>
                <td style="width:30%"><b>Left Side of the Body </b></td>
                <td style="width:70%">Good [ {{$leftSide == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$leftSide == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$leftSide == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$leftSide == 'Original Paint ' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [  {{$leftSide == 'Re-Painted ' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Front Side of the Body & Bonnet </b></td>
                <td style="width:70%">Good [ {{$frontSide == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$frontSide == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [  {{$frontSide == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$frontSide == 'Original Paint' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [  {{$frontSide == 'Re-Painted' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Rear Side of the Body & Trunk  </b></td>
                <td style="width:70%">Good [ {{$rearSide == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [{{$rearSide == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$rearSide == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$rearSide == 'Original Paint' ? '√' : ''}}  ] &nbsp;&nbsp;Re-Painted [{{$frontSide == 'Re-Painted' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Front Show Grill </b></td>
                <td style="width:70%">In Good Condition [ {{$showGrill == 'In Good Condition' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$showGrill == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Broken / Dented [ {{$showGrill == 'Broken / Dented' ? '√' : ''}} ] &nbsp;&nbsp;Not Available [ {{$showGrill == 'Not Available' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [ {{$showGrill == 'Re-Painted' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Front Lower Shield </b></td>
                <td style="width:70%">Good [ {{$lowerShield == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [{{$lowerShield == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$lowerShield == 'Dented' ? '√' : ''}}] &nbsp;&nbsp;Original Paint [ {{$lowerShield == 'Original Paint' ? '√' : ''}}] &nbsp;&nbsp;Re-Painted [ {{$lowerShield == 'Re-Painted' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Front / Back Bumper</b></td>
                <td style="width:70%">Good [ {{$frontBackBumper == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [{{$frontBackBumper == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$frontBackBumper == 'Dented' ? '√' : ''}}] &nbsp;&nbsp;Original Paint [ {{$frontBackBumper == 'Original Paint' ? '√' : ''}}] &nbsp;&nbsp;Re-Painted [{{$frontBackBumper == 'Re-Painted' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Wheel Caps</b></td>
                <td style="width:70%">Available [ {{$wheelCaps == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [ {{$wheelCaps == 'Not Available' ? '√' : ''}}] &nbsp;&nbsp; Missing [ {{$wheelCaps == 'Missing' ? '√' : ''}}] &nbsp;&nbsp; Alloy Rims [ {{$wheelCaps == 'Alloy Rims' ? '√' : ''}}] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Monograms </b></td>
                <td style="width:70%">Available [ {{$monograms == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$monograms == 'Not Available' ? '√' : ''}} ] &nbsp;&nbsp; Missing [ {{$monograms == 'Missing' ? '√' : ''}}] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Original Number Plates </b></td>
                <td style="width:70%">Available [ {{$numberPlates == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$numberPlates == 'Not Available' ? '√' : ''}} ] &nbsp;&nbsp;Un-Registered [{{$numberPlates == 'Un-Registered' ? '√' : ''}} ]&nbsp;&nbsp;Not Issued [ {{$numberPlates == 'Not Issued' ? '√' : ''}}] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Suspension/ Shock Absorbers </b></td>
                <td style="width:70%">Good [ {{$shockAbsorbers == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Need Repair  [ {{$shockAbsorbers == ' Need Repair' ? '√' : ''}}] &nbsp;&nbsp;  Need to be changed  [ {{$shockAbsorbers == 'Need to be changed ' ? '√' : ''}}] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Assemblies / Matts / Upholstery</b></td>
                <td style="width:70%">Fixed Perfectly [ {{$assemblies == 'Fixed Perfectly' ? '√' : ''}} ] &nbsp;&nbsp; Somewhat Loose  [{{$assemblies == 'Somewhat Loose' ? '√' : ''}} ] &nbsp;&nbsp;  Needs Replacement [{{$assemblies == 'Needs Replacement' ? '√' : ''}} ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Tires </b></td>
                <td style="width:70%">Good Working Condition [ {{$tires == 'Good Working Condition' ? '√' : ''}} ] &nbsp;&nbsp;  Needs Replacement  [{{$tires == 'Needs Replacement' ? '√' : ''}} ] &nbsp;&nbsp; Average [{{$tires == 'Average' ? '√' : ''}} ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Spare Tire </b></td>
                <td style="width:70%">Available [{{$spareTires == '1' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$spareTires == '0' ? '√' : ''}}] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Car Tool Kit </b></td>
                <td style="width:70%">Available [ {{$carToolkit == '1' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$carToolkit == '0' ? '√' : ''}}] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Tikli  </b></td>
                <td style="width:70%">Available [ {{$tickli == '1' ? '√' : ''}} ] &nbsp;&nbsp; Not Available[ {{$tickli == '0' ? '√' : ''}} ]</td>

            </tr>
            
           
            
        </table>
          <div class="row" style="" >
        <div class="box" style="text-align:left;width:100%">
          <h4 style="margin-left:30px;text-decoration:underline"><b>SECTION B: Physical (Body) Conditions of Vehicle:</b></h4>
        </div>
    </div>

    <table style="width:100%;margin-left:30px" >
            <tr>
                <td style="width:30%"><b> Ignition Takes  </b></td>
                <td style="width:70%">Good [ {{$ignitionTakes == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$ignitionTakes == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$ignitionTakes == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$ignitionTakes == 'Original Paint' ? '√' : ''}}  ] &nbsp;&nbsp;Re-Painted [ {{$ignitionTakes == 'Re-Painted' ? '√' : ''}} ]</td>

            </tr>

            <tr>
                <td style="width:30%"><b>Battery Starts in  </b></td>
                <td style="width:70%">Good [ {{$batteryStarts == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$batteryStarts == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$batteryStarts == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$batteryStarts == 'Original Paint' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [ {{$batteryStarts == 'Re-Painted ' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Engine  </b></td>
                <td style="width:70%">Good [ {{$cengineIs == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$cengineIs == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$cengineIs == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$cengineIs == 'Original Paint' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [ {{$cengineIs == 'Re-Painted ' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Chassis </b></td>
                <td style="width:70%">Good [ {{$chassisIs == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$chassisIs == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [{{$chassisIs == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$tickli == 'Original Paint' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [ {{$chassisIs == 'Re-Painted ' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Radiator </b></td>
                <td style="width:70%">Good [ {{$radiator == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [{{$radiator == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$radiator == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$radiator == 'Original Paint' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [ {{$radiator == 'Re-Painted ' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Right Head Light</b></td>
                <td style="width:70%">Good [ {{$rightHeadLight == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$rightHeadLight == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [{{$rightHeadLight == 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$rightHeadLight == 'Original Paint' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [ {{$rightHeadLight == 'Re-Painted ' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Left Head Light </b></td>
                <td style="width:70%">Good [ {{$leftHeadLight == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Scratched [ {{$leftHeadLight == 'Scratched' ? '√' : ''}} ] &nbsp;&nbsp;Dented [ {{$leftHeadLight== 'Dented' ? '√' : ''}} ] &nbsp;&nbsp;Original Paint [ {{$leftHeadLight == 'Original Paint' ? '√' : ''}} ] &nbsp;&nbsp;Re-Painted [ {{$leftHeadLight == 'Re-Painted' ? '√' : ''}} ]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Right Tail Light </b></td>
                <td style="width:70%">Available [ {{$rightTailLight == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [ {{$rightTailLight == 'Not Available' ? '√' : ''}} ] &nbsp;&nbsp; Missing [ {{$rightTailLight == 'Missing' ? '√' : ''}} ] &nbsp;&nbsp; Alloy Rims [ {{$rightTailLight == 'Alloy Rims' ? '√' : ''}} ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Left Tail Light </b></td>
                <td style="width:70%">Available [ {{$leftTailLight == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [ {{$leftTailLight == 'Not Available' ? '√' : ''}} ] &nbsp;&nbsp; Missing [ {{$leftTailLight == 'Missing' ? '√' : ''}} ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Right Indicator Light </b></td>
                <td style="width:70%">Available [ {{$rightIndicatorLight == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [ {{$rightIndicatorLight == 'Not Available' ? '√' : ''}} ] &nbsp;&nbsp;Un-Registered [ {{$rightIndicatorLight == 'Un-Registered' ? '√' : ''}} ]&nbsp;&nbsp;Not Issued [ {{$rightIndicatorLight == 'Not Issued' ? '√' : ''}} ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Left Indicator Light  </b></td>
                <td style="width:70%">Good [ {{$leftIndicatorLight == 'Good' ? '√' : ''}} ] &nbsp;&nbsp; Need Repair  [ {{$leftIndicatorLight == 'Need Repair' ? '√' : ''}} ] &nbsp;&nbsp;  Need to be changed  [ {{$leftIndicatorLight == 'Need to be changed' ? '√' : ''}} ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Inner Lights </b></td>
                <td style="width:70%">Fixed Perfectly [ {{$innerLights == 'Fixed Perfectly' ? '√' : ''}} ] &nbsp;&nbsp; Somewhat Loose  [ [{{$innerLights == 'Somewhat Loose' ? '√' : ''}}] ] &nbsp;&nbsp;  Needs Replacement [ [{{$innerLights == 'Needs Replacement' ? '√' : ''}}] ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Steering Control  </b></td>
                <td style="width:70%">Good Working Condition [ {{$steeringControl == 'Good Working Condition' ? '√' : ''}} ] &nbsp;&nbsp;  Needs Replacement  [ [{{$steeringControl == 'Needs Replacement' ? '√' : ''}}] ] &nbsp;&nbsp; Average [ [{{$steeringControl == 'Average' ? '√' : ''}}] ] </td>

            </tr>
            <tr>
                <td style="width:30%"><b>Axel  </b></td>
                <td style="width:70%">Available [ {{$axle == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$axle == 'Not Available' ? '√' : ''}}]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Clutch  </b></td>
                <td style="width:70%">Available [ {{$clutch == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$clutch == 'Not Available' ? '√' : ''}}]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Brakes   </b></td>
                <td style="width:70%">Available [ {{$brakes == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$brakes == 'Not Available' ? '√' : ''}}]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Suspension  </b></td>
                <td style="width:70%">Available [ {{$suspension == 'Available' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$suspension == 'Not Available' ? '√' : ''}}]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Air Conditioner  </b></td>
                <td style="width:70%">Available [ {{$airConditionarAvalibility == '1' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$airConditionarAvalibility == '0' ? '√' : ''}}]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Heater  </b></td>
                <td style="width:70%">Available [ {{$heaterAvalibility == '1' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$heaterAvalibility == '0' ? '√' : ''}}]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Bluetooth/CD Player </b></td>
                <td style="width:70%">Available [ {{$bluetoothAvalibility == '1' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [{{$bluetoothAvalibility == '0' ? '√' : ''}}]</td>

            </tr>
            <tr>
                <td style="width:30%"><b>Cameras / Sensors  </b></td>
                <td style="width:70%">Available [ {{$camerasAvalibility == '1' ? '√' : ''}} ] &nbsp;&nbsp; Not Available [ {{$camerasAvalibility == '0' ? '√' : ''}} ]</td>

            </tr>
            
           
            
        </table>


        




    <div class="row"  >
        <div class="box" style="text-align:left;width:100%">
          <h4 style="margin-left:30px;text-decoration:underline"><b>SECTION C: Summary of Valuation:</b></h4>
          <p style="line-height:1.2;width:100%;margin-left:30px;font-size:13px;">After careful inquiry from the market and verification from various Car dealers in the market, we have
            assessed the Values as under:
            </p>
        </div>
    </div>

    <div class="row">
        <div class="box" style="text-align:left;width:100%">
          <h6 style="margin-left:30px;line-height:0.2"><b>Present Market Value:</b>   </h6>
        <p style="line-height:0.2;font-size:12px;margin-left:60px">Toyota Corolla GLI M/T (2017)</p>
          <p style="line-height:1.2;font-size:13px;text-align:right"><b>Rs. 1,775,000.00</b><br>
          <b>(Rupees One Million Seven Hundred and Seventy Five Thousand Only)</b>
          </p>
        </div>
    </div>
    <div class="row">
    <h6 style="margin-left:30px;line-height:0.2"><b>Present Market Value:</b></h6>

        <div class="box" style="text-align:left;width:90%;margin-left:60px">
          <p style="line-height:1.2;font-size:13px;text-align:right"><b>Rs. 1,686,250.00</b><br>
          <b>(Rupees One Million Six Hundred and Eighty Six Thousand Two Hundred and Fifty Only)</b>
          </p>
        </div>
    </div>

    <div class="row" style="" >
        <div class="box" style="text-align:left;width:100%">
          <h4 style="margin-left:30px;text-decoration:underline"><b>REMARKS:</b></h4>
         <ul style="font-size:13px;line-height:1.4">
          <li>None Observed</li>

         </ul>
        </div>
    </div>
   
    <div class="row" style="" >
        <div class="box" style="text-align:left;width:100%">
          <h4 style="margin-left:30px;text-decoration:underline;line-height:1.4"><b>NOTE:</b></h4>
         <ol style="font-size:13px;line-height:1.4">
          <li>If any supplied documents either by the financial institution or the borrower / customer are
          fraudulent, the valuating company will not be held responsible. Since the excise certificate is
          obtained from the Excise & Taxation Office (ETO), the valuating company is free from any
          responsibility in case any dispute may arise on the ownership / title of the vehicle.</li>
          <li>The above relates to our findings and is based on approximate assessment which to the best of our
          knowledge and professional experience is true & correct.
          </li>
          <li>It is beyond the scope of our services to scrutinize and ascertain the ownership of the
          Asset/Vehicle. </li>

         </ol>
        </div>
    </div>

  <div class="row">
    <p style="line-height:1.2;width:100%;margin-left:30px;font-size:13px;"> <b>This report consists of Three (03) Pages along-with photographs and is issued without Prejudice,
        Obligation or any Legal Binding on us.</b></p><br><br><br><br>
        
        <div class="box" style="text-align:left">
          <h5 style="margin-left:30px"><b>SURVEYOR</b></h5>
        </div>
        <div class="box" style="text-align:right">
          <h5><b>FOR K.G. TRADERS (Pvt.) LTD.</b></h5>
        </div>
  </div>


   


</div>
        
          
            
           
      
            
      

       


    

    
       

</body>
</html>