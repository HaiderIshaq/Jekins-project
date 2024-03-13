@extends('layouts.app')

@section('content')
<title>
@section('title','KGT Traders | Verification To Do')
</title>

<style>
.badge{
    font-size: 15px;
    margin-top:8px
}
.card-header{
    font-size: 15px;
}

.badge {
    font-size: 13px;
    margin-top: 0px;
}
.img-cont{
    display: block;
    margin-left: 6px;
    margin-right: auto;
    width: 100%;
    margin-top: 25px;}

    @media (max-width: 1024px) {
        .img-cont{  
        width: 50%;
    margin-bottom: 15px;
    margin-left: 0%;
    margin-top:15px;
   
}
    }
</style>

<div class="container-fluid pt-4 pb-4" id="app">


<h3><b>Verification To Do</b></h3>

<div class="main-cont row" style="padding:10px 30px 30px 30px;">
  
<a href="/verification-perfoma">


</a>
    <div class="col-xs-4 col-md-6 col-lg-4 col-sm-12 col-xs-12 ">

        <div class="card mt-3 mb-3">
            <div class="card-header" style="font-size:15px">
                <span> <b>Job Id :</b>  KGT/VER/KHI/HBL/6/2021</span>
            </div>
            <!-- <h5 class="card-header"></h5> -->
            <div class="card-body">
               <div class="row">
                  
                   <div class=" col-lg-12  col-xl-7 col-md-12 col-sm-12  col-xs-12" style="font-size:14px">
                       <span class="pb-2"><b>Client Name : </b> <i>Javed Iqbal</i> </span>
                        <br>
                       <span  class="pb-2"><b>Client CNIC : </b> 42101-46958301-9 </span><br>
                       <span  class="pb-2"><b>Client Phone : </b> 0321-5265652 </span><br>
                       <span  class="pb-2"><b>Assigned On: </b> <i>27-11-2021</i> </span><br>
                       <span  class="pb-2"><b>Priority: </b> <i><span class="badge badge-danger">Urgent</span></i> </span><br>
                        
                      <a href="/verification-perfoma">
                      <button class="btn btn-primary mt-2">Edit </button>
                      </a>
                   </div>

                   <div class="col-lg-12  col-xl-3 col-md-12 col-sm-12  col-xs-12 "  style="justify-content:center;">

                        <div class="img-cont">
                            <img class="logo-style" style="" src="images/bankslogo/hbl.png" alt="">

                        </div>
                    </div>
               </div>
            </div>
        </div>

    </div>
  
    

</div>
<!-- <table class="table display" id="myTable1" style="width:100%" style="width:100%" >
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Job_Id</th>
            <th scope="col">Taken_on</th>
            <th scope="col">Region</th>
            <th scope="col">Service</th>
            <th scope="col">Bank</th>
            <th scope="col">Customer</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table> -->


        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script  type="text/javascript">
    // $(function(){
    //      $('#myTable1').DataTable({
    //     processing: true,
    //     // serverSide: true,

    //     "scrollX": true,
    //     ajax:"/verification",
    //     columns: [
    //         {data: 'id', name: 'id'},
    //         {data: 'job_id', name: 'job_id'},
    //         {data: 'taken_on', name: 'taken_on'},
    //         {data: 'city_name', name: 'city_name'},
    //         {data: 'service', name: 'service'},
    //         {data: 'bank_name', name: 'bank_name'},
    //         {data: 'cust_name', name: 'cust_name'},
    //         {
    //             "mData": "status",
    //             "mRender": function (data, type, row) {
    //                 if(data=='1')
    //                 {
    //                     return "<span class='badge badge-success'>Completed</span>";

    //                 }
    //                 else if(data=='2'){
    //                     return "<span class='badge badge-info'>Delayed</span>";

    //                 }
    //                 else if(data=='3'){
    //                     return "<span class='badge badge-danger'>Cancalled</span>";

    //                 }
    //                 else{
    //                     return "<span class='badge badge-warning'>Active</span>";

    //                 }
    //             }
    //         },
    //         {data: 'action', name: 'action'}
    //     ],


    //     buttons: [
    //         {
    //             extend:'pdf',
    //             title: 'Data export',
    //             exportOptions: {
    //                 columns: [ 0,1,2,3,4,5,6,7]
    //             }

    //         }
    //     ],
    //     order: [[0,'desc']]



    // });



    // });
</script>

@endsection
