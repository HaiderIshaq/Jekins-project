<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sales Tax Invoice Report</title>

</head>
<style media="print">
    /* cyrillic-ext */

    body{background:none;
    }

    span{
        font-size: 13px;
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
        font-size:13px;
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
    font-size:13px
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
    width:250px;padding:3px;height:20px;margin-bottom: 10px
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
    @if($stamp==true)
    <div style="position: absolute; left:10%; right: 0; top: 68%; bottom: 0;">
        <img src="images/prismstamp.png" 
             style="width: 50mm; height: 50mm; margin: 0;" />
    </div>
    @endif
    <div class="container-fluid" style="padding-top: 60px">
            <div>
                <h3 style="text-align:center">Sales Tax Invoice</h3>
            </div>
          
        </div>
        
        <div class="container"  style="margin:0 auto;width:90%;margin-top:8px; line-height:0.5px;">


        <!--  -->

            <div class="row" style="padding:5px 5px;width:100%">

                <div class="box-tab" style="width:40%;float: left;padding:5px">
                     <span><b>NTN</b></span>
                </div>

                <div class="box-tab" style="width:45%;float: left;padding:5px">
                    <span>2734165-8	
                    </span>
                </div>

            </div>
        </div>

        <div class="container"  style="margin:0 auto;width:90%;margin-top:0px; line-height:0.5px;">

            <div class="row" style="padding:5px 5px;width:100%">

                <div class="box-tab" style="width:40%;float: left;padding:5px">
                    <span><b>SST NO</b></span>
                </div>

                <div class="box-tab" style="width:45%;float: left;padding:5px">
                    <span>S-2734165-8	
                    </span>
                </div>

            </div>
        </div>

        <div class="container"  style="margin:0 auto;width:90%;margin-top:0px; line-height:0.5px;">

            <div class="row" style="padding:5px 5px;width:100%">

                <div class="box-tab" style="width:40%;float: left;padding:5px">
                    <span><b>DATE</b></span>
                </div>

                <div class="box-tab" style="width:45%;float: left;padding:5px">
                    <span>{{$bill_date}}</span>
                </div>


                </div>
            </div>
        </div>

        </div>

        <div class="container"  style="margin:0 auto;width:90%;margin-top:50px; line-height:0.5px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>INVOICE NO</b></span>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;padding:5px">
                        <span>{{$job_id}}</span>
                    </div>
                   
                   
                </div>
 
        </div>


        <div class="container"  style="margin:0 auto;width:90%;margin-top:50px; line-height:0.5px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>{{$is_takaful==0?'INSURANCE COMPANY':'TAKAFUL COMPANY'}}</b></span>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;padding:5px">
                        <span>{{$insurer_name}} <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> {{$insurer_branch_name}}</span> <br>

                    </div>
                   
                   
                </div>
 
        </div>
       
        
        <div class="container"  style="margin:0 auto;width:90%;margin-top:50px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>NTN <br> STRN</b></span>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;padding:5px">
                        <span>{{$ntn}}</span>
                    </div>
                   
                   
                </div>
 
        </div>
       
        
        <div class="container"  style="margin:0 auto;width:90%;margin-top:50px; line-height:0.5px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>Loss Number</b></span>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;padding:5px">
                        <span>{{$loss_no}}</span>
                    </div>
                   
                   
                </div>
 
        </div>
       
        <div class="container"  style="margin:0 auto;width:90%;margin-top:50px; line-height:0.5px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>Professional Fee</b></span>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;padding:5px">
                        <span>{{$service_charges}}</span>
                    </div>
                   
                   
                </div>
 
        </div>
       
        <div class="container"  style="margin:0 auto;width:90%;margin-top:50px; line-height:0.5px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>ADD {{$rate}}% SST</b></span>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;padding:5px">
                        <span>{{$tax}}</span>
                    </div>
                   
                   
                </div>
 
        </div>
       
        <div class="container"  style="margin:0 auto;width:90%;margin-top:50px; line-height:0.5px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>TOTAL AMOUNT</b></span>
                    </div>

                    <div class="box-tab" style="width:45%;float: left;padding:5px">
                        <span>{{$total_amount}}</span>
                    </div>
                                      
                </div>
 
        </div>
       
        <div class="container"  style="margin:0 auto;width:90%;margin-top:0px; line-height:0.5px;">
            
                <div class="row" style="padding:5px 5px;width:100%">
                    
                    <div class="box-tab" style="width:40%;float: left;padding:5px">
                        <span><b>AMOUNT IN WORDS</b></span>
                    </div>

                    <div class="box-tab" style="width:50%;float: left;padding:5px">
                        <span>{{$total_amount_text}}</span>
                    </div>
                   
                   
                </div>
 
        </div>
        <div class="container"  style="margin:0 auto;width:90%;margin-top:70px; line-height:0.5px;">
            <div class="row" style="padding:5px 5px;width:100%">

                <span class ="signature"><b>For Prism Surveyors (Pvt) Ltd.</b></span>   
            
            </div>
        
        </div>

    <div>

</body>
</html>
