<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice No :  {{$data['invoice']}}</title>

</head>
<style>
 /* cyrillic-ext */

body{background:none;
}



.container{width:90%}
.container-fluid{
    width:100%;
    margin-left: 35px;    
}


table{
     width: 100%;
     /* margin-top: 15px; */
     border-collapse: collapse

 }

 table, td, th{
     border:1px solid black;
     padding-left:8px;
     padding-right:8px;
     padding-top:8px;
     padding-bottom:8px;
     font-size:13px

    }
th, td {
  padding: 5px;
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
   font-size:9px;
   padding:5px 40px 5px 5px;
   margin-top:10px;
   /* width:30%; */
   /* margin-right:35px; */

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}

.page_break { display: block; page-break-before: always; }

/* table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group } */

</style>
@if(count($data['jobs'])<=10)
<style>
    @page {
    margin-top: 130px; /* <any of the usual CSS values for margins> */
        /* margin-bottom: 180px; */
	/* margin-footer: 5mm; */
}
</style>
@else
<style>
    @page {
    margin-top: 130px; /* <any of the usual CSS values for margins> */
    margin-bottom: 150px; /* <any of the usual CSS values for margins> */
        /* margin-bottom: 180px; */
	/* margin-footer: 5mm; */
}
</style>
@endif
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="box box1">
               <b> {{$data['insurer']}} </b> <br>
               <b> {{$data['insurer_branch']}} </b>
            </div>
            <div class="box box2" style="text-align: right">
            <b>DATED: {{$data['dated']}}</b>
            </div>
        </div>
        <div class="row" style="text-align: center;padding-top:10px">
            <b style="text-decoration: underline;font-size:12px;">Subject: REQUEST FOR PAYMENT OF PRE-INSURANCE BILLS  </b><br>
            <b style="text-decoration: underline;font-size:12px;">Invoice No. {{$data['invoice']}}</b>
        </div>
        <div class="row">
            <div class="box box1" style="width: 100%;word-spacing:10px;font-size:12px">
                Dear Sir, <br>
                We give hereunder the details of our Pre-Insurance bills with the request to please process the same at your earliest.
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <table style="margin-top:20px;">
            <tr> <td style="text-align: center;font-size:12px">{{$data['insurer']}}</td></tr>
            <tr ><td style="text-align: center;font-size:12px">{{$data['insurer_branch']}}</td></tr>
            <tr ><td style="text-align: center;font-size:12px">Pre-Insurance Inspection Reports Details Upto {{date_format(date_create($data['dated']),'F d, Y')}}</td></tr>
        </table>
        <table  >
                
                <tr style="border-top:4px ">
                    <th style="font-size:9px;padding:5px">S#</th>
                    <th style="font-size:9px;padding:5px">Ref#</th>
                    <th style="font-size:9px;padding:5px">Insured Name</th>
                    <th style="font-size:9px;padding:5px">Reg #</th>
                    <th style="font-size:9px;padding:5px">Make</th>
                    <th style="font-size:9px;padding:5px; width:8%;">Engine #</th>
                    <th style="font-size:9px;padding:5px; width:10%;">Chassis #</th>
                    <th style="font-size:9px;padding:5px">Date of Inspection</th>
                    <th style="font-size:9px;padding:5px width:8%;">Place of Inspection</th>
                    <th style="font-size:9px;padding:5px">Fee</th>
                    <th style="font-size:9px;padding:5px">travelling</th>
                </tr>           
                
                    @foreach ($data['jobs'] as $key => $value)

                        <tr style="margin-bottom:20px">                    
                        <td style="font-size:8px;padding:5px">{{$key+1}}</td>
                        <td style="font-size:8px;padding:5px">{{$value->id}}</td>
                        <td style="font-size:8px;padding:5px">{{ucwords($value->name_of_insured)}}</td>
                        <td style="font-size:8px;padding:5px">{{$value->reg_no}}</td>
                        <td style="font-size:8px;padding:5px">{{$value->make}}</td>
                        <td style="font-size:8px;padding:5px;width:8%;">{{$value->engine_no}}</td>
                        <td style="font-size:8px;padding:5px;width:10%;">{{$value->chassis_no}}</td>
                        <td style="font-size:8px;padding:5px;text-align:center">{{date_format(date_create($value->date_of_inspection),'d-M-Y')}}</td>
                        <td style="font-size:8px;padding:5px; width:8%;">{{$value->place_of_survey}}</td>
                        <td style="font-size:8px;padding:5px;text-align:right">{{number_format($value->service_charges)}}</td>
                        <td style="font-size:8px;padding:5px;text-align:right">{{number_format($value->travelling)}}</td>
                        </tr>
                         
                    @endforeach
    
                            
                    
                    <tr  >  
                        <td  colspan="7" style="border-bottom: 0px" ></td>
                        <td colspan="2" style="padding:5px;font-size:9px">
                            <table style="border: 0px;padding:0px">
                                <tr style="border: 0px;padding:0px">
                                    <td style="border: 0px;padding:0px;font-size:9px"><b>Total</b></td>
                                    <td style="border: 0px;padding:0px;font-size:9px;text-align:right"><b> Rs</b></td>
                                </tr>
                            </table>
                        </td>
 
                        <td style="padding:5px;font-size:9px;text-align:right">
                            <b>{{number_format($data['fees'])}}</b>
                        </td>
                        <td style="padding:5px;font-size:9px;text-align:right">
                            <b>{{number_format($data['travel'])}}</b>

                        </td>
                   
                    </tr>
                    <tr  >  
                        <td  colspan="7" style="border-bottom: 0px;border-top: 0px"></td>
                        <td colspan="4" style="padding:5px;font-size:9px">
                            <table style="border: 0px;padding:0px">
                                <tr style="border: 0px;padding:0px">
                                    <td style="border: 0px;padding:0px;font-size:9px">
                                        <b>Total Amount 
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rs.</b>
                                        
                                    </td>
                                    <td style="border: 0px;padding:0px;font-size:9px;text-align:right"><b> {{number_format($data['travel']+$data['fees'])}}</b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @if($data['isstax']==1)

                    <tr  >  

                        <td  colspan="7" style="border-bottom: 0px;border-top: 0px"></td>
                        <td colspan="4" style="padding:5px;font-size:9px">

                            <table style="border: 0px;padding:0px">
                                <tr style="border: 0px;padding:0px">
                                    <td style="border: 0px;padding:0px;font-size:9px">
                                        <b>Plus GST {{intval($data['rate'])}}% on Total Fee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rs.</b>
                                        
                                    </td>
                                    <td style="border: 0px;padding:0px;font-size:9px;text-align:right"><b> {{number_format($data['tax'])}}</b></td>
                                </tr>
                            </table>

                          
                        </td>
                    </tr>
                    @endif

                    <tr  >  

                        <td  colspan="7" style="border-top: 0px" ></td>
                        <td colspan="4" style="padding:5px;font-size:9px">
                       
                            <table style="border: 0px;padding:0px">
                                <tr style="border: 0px;padding:0px">
                                    <td style="border: 0px;padding:0px;font-size:9px">
                                        <b>Total Payable  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rs.</b>
                                        
                                    </td>
                                    <td style="border: 0px;padding:0px;font-size:9px;text-align:right">
                                        @if($data['isstax']==1)

                                        <b>{{number_format($data['tax']+$data['travel']+$data['fees'])}}</b></td>
                                        @else
                                        <b>{{number_format($data['travel']+$data['fees'])}}</b></td>

                                        @endif

                                    </tr>
                            </table>

                        </td>
                    
                    </tr>
                    
                    

        </table>

        <div class="box box1" style="font-size:11x;width:70%;overflow:hidden;">
           <div style="margin-top: 10px">

                Please acknowledge Receipt <br>
                Thanking You 



           </div>
           
           @if($data['isstamp']==1)
           <div style="position: absolute; z-index:1;margin-top:-100px">
            <img src="images/prismstamp.png" 
                 style="width: 40mm; height: 40mm;" />
        </div>
         <div style="width:40%;position:absolute;z-index:0;margin-top:-28px">
            
             <hr style="height: 2px">
             <b>Prism Surveyors (Pvt) Ltd.</b>
 
         </div>
            @else

            <div style="width:40%;position:absolute;z-index:0;margin-top:50px">    
               
                <hr style="height: 2px">
                <b>Prism Surveyors (Pvt) Ltd.</b>
    
            </div>
           @endif
                

           
           
        </div>
        
        <div class="box box2" style="font-size:11x;width:30%">
            <div class="row">

                <p class="details-box">NTN No : 2734165-8 <br>
                <b>Accepted Methods of Payment</b><br>
                P/O in the name of "Prism Surveyors (Pvt) Ltd
                </p>

            </div>
        </div>
    </div>
</body>
</html>
