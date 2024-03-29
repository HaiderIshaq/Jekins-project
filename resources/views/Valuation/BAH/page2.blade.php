<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Documnt</title>
    </head>
<style>
 .head2{position:relative;left:560px} 
 body{background:none;
    font-family: 'Roboto', sans-serif;}



    table {
  border-collapse: collapse;
  font-size:13px
}

table, th, td {
  border: 1px solid black;
}


div.box{
   float:left;
   width:50%;
  
}

div.box1{
    width:70%
}

div.box2{
    width:30%;
}
.container{
    width:90%
}
p{
    font-size:12px
}
span{
    font-size:12px

}

th, td {
  padding:7px 12px 7px 12px !important;
}

@page {
	
     
    margin-top: 13%; 
    margin-bottom:8%
   
       
    }


</style>
<body>
<div class="container" style="margin:0px 0px 0px 25px">
  

    
      <div class="row" style="width:100%;margin-left:40px">
        <div class="box box1" >
          <p style="font-size:17px">Ref: - {{$job_id}}</p>
        </div>
        <div class="box box2" style="text-align:right" >
          <p style="font-size:17px">{{$delivery_date}}</p>
        </div>

      </div>
   
   <p  style="font-size:22px;text-decoration:underline;text-align:center;margin-left:50px"><b>VALUATION REPORT</b></p>
   <p  style="font-size:13px;text-align:center;margin-left:50px"><b>Sub: <span style="text-decoration:underline;">VEHICLE APPRAISAL REPORT <br>
   “{{$carName}} ({{$manufacturing_year}})”</span></b></p>
   
   <p style="line-height:1.2;width:100%;margin-left:30px;font-size:13px">K.G. Traders upon Emailed instructions of the <b>{{$bank_name}} </b> conducted valuation of a Locally
Manufactured {{$carName}} ({{$manufacturing_year}})
</p>
   <div class="row" style="margin:25px 0px 0px 30px">
        <table style="width:100%">
            <tr>
                <td style="width:30%">Request Reference </td>
                <td style="width:70%">Email Dated : {{$reference_date}}</td>
            </tr>
            <tr>
                <td>Name of Bank </td>
                <td>{{$bank_name}}</td>
            </tr>
            <tr>
                <td>Concerned Branch </td>
                <td>{{$branch_name}}</td>
            </tr>
            <tr>
                <td>Account</td>
                <td>{{$account}}.</td>
            </tr>
           
            <tr>
                <td>Place of Inspection </td>
                <td>{{$place_of_inspection}}</td>
            </tr>
            <tr>
                <td>Date of Inspection </td>
                <td>{{$visit_date}}</td>
            </tr>
            <tr>
                <td>Representative Name</td>
                <td>{{$representative}}</td>
            </tr>
            <tr>
                <td>Type of Asset </td>
                <td>{{$carName}} ({{$manufacturing_year}})</td>
            </tr>
            <tr>
                <td>Title of Ownership  </td>
                <td>{{$title_of_ownership}}</td>
            </tr>
           
           
        </table>
        
   </div>
    <br>
    <div class="row" style="width:100%;margin-left:40px">
        <div class="box box1" >
            <p style="font-size:13px;text-decoration:underline"><b>Appraised Value:</b></p>

        </div>
        <div class="box box2" style="text-align:right" >
            <p style="font-size:13px"><b>Rs.{{$market_value}}</b></p>
        </div>
  
    </div>

    <div class="row" style="width:100%;margin-left:40px">
        <div class="box box1" >
            <p style="font-size:13px;text-decoration:underline"><b>Forced Sale Value:</b></p>

        </div>
        <div class="box box2" style="text-align:right" >
            <p style="font-size:13px"><b>Rs. {{$fsv}}</b></p>
        </div>
  
    </div>

    <div class="row">
        <p style="line-height:1.2;width:100%;margin-left:30px;font-size:13px">This certificate is based on approximately estimated value, which has been calculated and evaluated to the
        best of our professional knowledge and belief, information furnished by owner/representative, prevailing
        condition of the Asset/Vehicle, market inquiries from various car dealers, it is beyond the scope of our
        services to scrutinize and ascertain the ownership of the asset.
        </p>
        <p style="line-height:1.2;width:100%;margin-left:30px;font-size:13px;"> <b>This report consists of Three (06) Pages along-with photographs and is issued without Prejudice,
        Obligation or any Legal Binding on us.</b></p><br><br>
    </div>

    <div class="row" >
        <div class="box" style="text-align:left">
          <h5 style="margin-left:30px"><b>SURVEYOR</b></h5>
        </div>
        <div class="box" style="text-align:right">
          <h5><b>FOR K.G. TRADERS (Pvt.) LTD.</b></h5>
        </div>
    </div>

      

   <!-- <div class="row" style="margin-left:30px">


        <table >
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
            <tr>
                <td>Applicant’s Name</td>
                <td>Aamir Ameer Pathan (STAFF)</td>
            </tr>
           
            
        </table>
   </div> -->
   
    

</div>
</body>
</html>