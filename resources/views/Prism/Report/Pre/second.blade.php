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

    @if($stamp==true)
    <div style="position: absolute; left:8%; right: 0; top: 68%; bottom: 0;">

        <img src="images/prismstamp.png" 
             style="width: 55mm; height: 55mm; margin: 0;" />
    </div>
    @endif
    <div style="position: absolute; left:10%; right: 0; top: 73%; bottom: 0;">
        <h4 style="text-align:center">ISSUED WITHOUT PREJUDICE</h4>
        <div style="font-size: 14px; font-weight:500;border-top:2px solid  black;width:35%;margin-top:110px">
            <span >For &nbsp; &nbsp; Prism Surveyors (Pvt) Ltd.</span>

        </div>

    </div>

    <div >
        <div class="container" style="width:90%;margin-left:35px;padding-top:80px;padding-bottom:10px">
            <div class="row" style="border: 1.5px solid blue;padding:2px">
                <!-- <img style="padding-right:40px" src="images/kgtlogo.png" height="130" width="130" alt="" > -->
                <div class="box box1" style="border: 1.5px solid blue;">
                    <div style="padding: 5px">
                        <span style="font-size:15px">
                            <b>Motor Report No.</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$job_id}}</span>
    
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

        </div>
        <div class="container" style="width:90%;margin-left:35px;">
            <div class="row">
                <h4 style="text-decoration:underline;">BODY OBSERVATIONS: </h4>
            </div>
            <div class="row" style="">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Damages / Scratches</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <span> {{$damages==null?'Nill':$damages}}</span>
                </div>
            </div>
            <div class="row" style="margin-top:5px ">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Missing Factory Fitted Items :</b>
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <span style="line-height: 1px"> {{$missing_items==null?'Nill':$missing_items}}</span>
                </div>
            </div>
            <div class="row" style="margin-top:5px ">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Any Other Alterations :</b>
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <span style="line-height: 1px"> {{$altrations==null?'Nill':$altrations}}</span>
                </div>
            </div>
        
            
        </div>
        <div class="container" style="width:90%;margin-left:35px;">
            <div class="row">
                <h4 style="text-decoration:underline;">INSURED ESTIMATE VALUES (I.E.V):</h4>
            </div>
            <div class="row" style="">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Vehicle Value</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <span>{{$value==0?'Nill':'Rs. '.$value.'/=' }} </span>
                </div>
            </div>
            <div class="row" style="margin-top:5px">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Value of Additional Accessorie</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <span>{{$additional_value==0?'Nill':'Rs. '.$additional_value.'/=' }} </span>
                </div>
            </div>
        </div>
        <div class="container" style="width:90%;margin-left:35px;">
            <div class="row">
                <h4 style="text-decoration:underline;">SURVEYOR DETAILS: </h4>
            </div>
            <div class="row" style="">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Name of Surveyor: </b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <span> {{$surveyor_name}}</span>
                </div>
            </div>
            <div class="row" style="margin-top:5px">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Place of Inspection</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <span>{{$place_of_survey}}</span>
                </div>
            </div>

            <div class="row" style="margin-top:5px ">
                <div class="box" style="width: 40%;font-size:13px">
                    <b>Date & Time of Inspection: </b>
                </div>
                <div class="box" style="width: 60%;font-size:13px">
                     <div class="row">
                        <div class="box" style="width: 50%;font-size:13px">
                            {{$date_of_inspection}}
                        </div>
                        <div class="box" style="width: 50%;font-size:13px">
                           <b> Timing:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$time_of_inspection}}
                        </div>
                     </div>
                </div>
            </div>
           
        </div>
        {{--  --}}
        <div class="container" style="width:90%;margin-left:35px;">
            <div class="row">
                <h3 style="text-decoration:underline;">RECEIVING OF IMPORTANT DOCUMENTS:</h3>
            </div>
            <div class="row" style="">
                <div class="box" style="width: 50%;font-size:13px">
                    <b>Copy of Reg-Book (Existing Owner)</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 50%;font-size:13px">
                     <span> {{$copy_of_reg_book}}</span>
                </div>
            </div>
            <div class="row" style="margin-top:5px">
                <div class="box" style="width: 50%;font-size:13px">
                    <b>Brand New Vehicle Copy of Sale Invo</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 50%;font-size:13px">
                     <span> {{$brand_new_vehicle}}</span>
                </div>
            </div>

            <div class="row" style="">
                <div class="box" style="width: 50%;font-size:13px">
                    <b>Copy of CNIC of Insured</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 50%;font-size:13px">
                     <span> {{$copy_of_cnic_insured}}</span>
                </div>
            </div>
            <div class="row" style="margin-top:5px">
                <div class="box" style="width: 50%;font-size:13px">
                    <b>Copy of Import Documents</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 50%;font-size:13px">
                     <span> {{$copy_of_import_documents}}</span>
                </div>
            </div>

            <div class="row" style="margin-top:5px">
                <div class="box" style="width: 50%;font-size:13px">
                    <b>Bill of Entry, Bill of Lading,<br>
                        Importers Invoice</b> <b style="position:absolute;right:10px">:</b> 
                </div>
                <div class="box" style="width: 50%;font-size:13px">
                     <span> {{$bill_of_entry}}</span>
                </div>
            </div>

            @if($remarks!='')
            <div class="row" style="margin-top:5px ">
                <div class="box" style="width: 50%;font-size:13px">
                    <b>Remarks :</b>
                </div>
                <div class="box" style="width: 46%;font-size:13px">
                     <span style="line-height: 1px">{{$remarks}}</span>
                </div>
            </div>
           
           @endif
            
        </div>

    </div>

    {{-- Second Page End --}}
    

</body>
</html>
