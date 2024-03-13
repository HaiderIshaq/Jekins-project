@extends('layouts.app') @section('content')
<title>
    @section('title','KGT ERP | Dashboard')
</title>
<style>
    .red {
        color: red !important;
        font-weight: bold
        /* background: red !important */
    }
    .green {
        color:  green !important;
        font-weight: bold

        /* background: green !important */
    }
    .btn{
            line-height: 1;
    }
    .ac-btn{
        background: green;
        font-size: 13px;
        border: green
    }

    /* .table .thead-dark th{
        font-style: 9px !important
    }
    .table .thead-dark td{
        font-style: 9px !important
    } */

</style>
<!-- <div class="row clearfix progress-box">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                    <div class="project-info clearfix">
                        <div class="project-info-left">
                            <div class="icon box-shadow bg-blue text-white">
                                <i class="fa fa-briefcase"></i>
                            </div>
                        </div>
                        <div class="project-info-right">
                            <span class="no text-blue weight-500 font-24">40</span>
                            <p class="weight-400 font-18">My Earnings</p>
                        </div>
                    </div>
                    <div class="project-info-progress">
                        <div class="row clearfix">
                            <div class="col-sm-6 text-muted weight-500">Target</div>
                            <div class="col-sm-6 text-right weight-500 font-14 text-muted">40</div>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                    <div class="project-info clearfix">
                        <div class="project-info-left">
                            <div class="icon box-shadow bg-light-green text-white">
                                <i class="fa fa-handshake-o"></i>
                            </div>
                        </div>
                        <div class="project-info-right">
                            <span class="no text-light-green weight-500 font-24">50</span>
                            <p class="weight-400 font-18">Business Captured</p>
                        </div>
                    </div>
                    <div class="project-info-progress">
                        <div class="row clearfix">
                            <div class="col-sm-6 text-muted weight-500">Target</div>
                            <div class="col-sm-6 text-right weight-500 font-14 text-muted">50</div>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-light-green progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                    <div class="project-info clearfix">
                        <div class="project-info-left">
                            <div class="icon box-shadow bg-light-orange text-white">
                                <i class="fa fa-list-alt"></i>
                            </div>
                        </div>
                        <div class="project-info-right">
                            <span class="no text-light-orange weight-500 font-24">2 Lakhs</span>
                            <p class="weight-400 font-18">Projects Complete</p>
                        </div>
                    </div>
                    <div class="project-info-progress">
                        <div class="row clearfix">
                            <div class="col-sm-6 text-muted weight-500">Review</div>
                            <div class="col-sm-6 text-right weight-500 font-14 text-muted">Good</div>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-light-orange progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 margin-5 height-100-p">
                    <div class="project-info clearfix">
                        <div class="project-info-left">
                            <div class="icon box-shadow bg-light-purple text-white">
                                <i class="fa fa-podcast"></i>
                            </div>
                        </div>
                        <div class="project-info-right">
                            <span class="no text-light-purple weight-500 font-24">5.1 Lakhs</span>
                            <p class="weight-400 font-18">Pending Business</p>
                        </div>
                    </div>
                    <div class="project-info-progress">
                        <div class="row clearfix">
                            <div class="col-sm-6 text-muted weight-500">Review</div>
                            <div class="col-sm-6 text-right weight-500 font-14 text-muted">Average</div>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-light-purple progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
<div class="button-group">
    <div class="row justify-content-md-center pb-3 ">
        <!-- <div class=" pr-1 pb-2">
                    <a href="#"><button class="btn btn-primary job-button pt-2 pb-2 "  >
                     <i class="fa fa-plus-circle fa-2x text-white " style="font-size:0.9em" > </i><span style="font-size:14px" class="text-white ml-2 " >Muccadum</span></button></a>
                </div> -->
        <!--
                <div class=" pr-1 pb-2" >
                <a href="#"><button class="btn job-button job-button2 btn-primary pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white  " style="font-size:0.9em"  > </i><span style="font-size:15px" class="text-white ml-2" >Supervision</span>
                    </button></a>
                </div>

                <div class="pr-1 pb-2">
                <a href="#"> <button class="btn btn-primary job-button job-button3 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Clearing</span>
                    </button></a>
                </div>



                <div class="pr-1 pb-2" >
                <a href="/valuation"><button class="btn btn-primary job-button job-button5 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Valuation</span>
                    </button></a>
                </div>

                <div class=" pr-1 pb-2" >
                <a href="#"><button class="btn btn-primary pt-2 job-button job-button6 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >BIR</span>
                    </button></a>
                </div>
                <div class="pr-1 pb-2" >
                <a href="/Ibr"><button class="btn btn-primary pt-2 job-button job-button7 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >IBR</span>
                    </button></a>
                </div>
                <div class="pr-1 pb-2" >
                <a href="#"><button class="btn btn-primary pt-2 job-button job-button8 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >I/E</span>
                    </button></a>
                </div>
                <div class="pr-1 pb-2" >
                <a href="#"><button class="btn btn-primary pt-2 job-button job-button9 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >LCR</span>
                    </button></a>
                </div>
                <div class="pr-1 pb-2" >
                <a href="#"><button class="btn btn-primary pt-2 job-button job-button10 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >MCR</span>
                    </button></a>
                </div>
                <div class="pr-1 pb-2" >
                <a href="#"><button class="btn btn-primary pt-2 job-button job-button11 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >MVR</span>
                    </button></a>
                </div>

            -->





        <!-- <div class="col-md-2 pt-3 pb-3" style="border:2px solid black;border-radius:10px "></div> -->
        
        <!--<div class="pr-1 pb-2">
            <a href="/ibrCreate"><button class="btn btn-primary job-button job-button6 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >IBR</span>
                    </button></a>
        </div>-->
        <!--<div class="pr-1 pb-2">
            <a href="/inspectionCreate"><button class="btn btn-primary job-button job-button4 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Inspection</span>
                    </button></a>
        </div>-->
        <div class="pr-1 pb-2">
            <a href="/prismCreate">
                <button class="btn btn-primary job-button job-button4 pt-2 pb-2">
                    <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Insurance survey</span>
                </button>
            </a>
        </div>
        <div class="pr-1 pb-2">
           
              <div id="app">
                <prism-vehicle
                usercompany="{{$user[0]}}"
                usertoken="{{$user[2]}}"
                usercompanyname="{{$user[1]->company_name}}"
                usercompanyprefix="{{$user[1]->company_prefix}}" 
                ></prism-vehicle>
              </div>
           
        </div> 
        
        <!-- <div class="pr-1 pb-2">
            <a href="/valuationCreate"><button class="btn btn-primary job-button job-button2 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Valuation</span>
                    </button></a>
        </div>
        <div class="pr-1 pb-2">
            <a href="/MuccaduumCreate"><button class="btn btn-primary job-button job-button1 pt-2 pb-2">
                       <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Muccadum</span>
                    </button></a>
        </div>
        <div class="pr-1 pb-2">
            <a href="/supervisionCreate"><button class="btn btn-primary job-button job-button2 pt-2 pb-2">
                        <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Supervision</span>
                    </button></a>
        </div>
        <div class="pr-1 pb-2">
            <a href="/legalCreate"><button class="btn btn-primary job-button job-button4 pt-2 pb-2">
                        <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Legal Services</span>
                    </button></a>
        </div> -->

    </div>
    <!-- <div class=" row justify-content-md-center pb-3">

        <div class="pr-1 pb-2">
            <a href="/ClearingCreate"><button class="btn btn-primary job-button job-button4 pt-2 pb-2">
                        <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Clearing</span>
                    </button></a>
        </div>

        <div class="pr-1 pb-2">
            <a href="/birCreate"><button class="btn btn-primary job-button job-button3 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >BIR</span>
                    </button></a>
        </div>
        <div class="pr-1 pb-2">
            <a href="/ieCreate"><button class="btn btn-primary job-button job-button1 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >I/E</span>
                    </button></a>
        </div>

        <div class="pr-1 pb-2">
            <a href="/lcrCreate"><button class="btn btn-primary job-button job-button2 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >LCR</span>
                    </button></a>
        </div>

        <div class="pr-1 pb-2">
            <a href="/mvrCreate"><button class="btn btn-primary job-button job-button4 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >MVR</span>
                    </button></a>
        </div>

        <div class="pr-1 pb-2">
            <a href="/mcrCreate"><button class="btn btn-primary job-button job-button2 pt-2 pb-2">
                     <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >MCR</span>
                    </button></a>
        </div>


    </div> -->
</div>

<div class="container-fluid bg-white box-shadow pt-4 pb-4" id="app">
    <div class="table-responsive">
        <table class="table display" id="myTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Job_Id</th>
                    <th scope="col">Taken_on</th>
                    <th scope="col">Region </th>
                    <th scope="col">Insurer</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Insured</th>
                    <th scope="col">Category</th>
                    <th scope="col">Mode</th>
                    <th scope="col">Reg No</th>
                    <th scope="col">Make</th>
                    <th scope="col">Status</th>
                    <th scope="col">Surveyor</th>
                    <th scope="col">Model</th>
                    <th scope="col">Engine No</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script type="text/javascript">
    $(function() {
        var table = $('#myTable').DataTable({

            processing: true,
            // serverSide: true,
            ajax: "{{ '/home'}}",
            columns: [
                {
                data: 'id',
                name: 'id'  
                // "render": function(data,type,row,meta) { // render event defines the markup of the cell text 
                //             var a = '<a href='+'edit/'row.id+'>' + row.id +'</a>'; // row object contains the row data
                //             return a;
                //         }
            },
             {
                data: 'job_id',
                name: 'job_id'
            }, {
                data: 'taken_on',
                name: 'taken_on'
            }, {
                data: 'region',
                name: 'region'
            }, {
                data: 'insurer_name',
                name: 'insurer_name'
            }, {
                data: 'insurer_branch',
                name: 'insurer_branch'
            }, {
                data: 'name_of_insured',
                name: 'name_of_insured'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'survey_mode',
                name: 'survey_mode'
            },
            {
                data: 'reg_no',
                name: 'reg_no'
            },
            {
                data: 'make',
                name: 'make'
            },
            {
                data: 'survey_status',
                name: 'survey_status',
                visible:false,
                searchable: false
            },
            {
                data: 'surveyor',
                name: 'surveyor',
                visible:false,
                searchable: false
            },
            {
                data: 'model',
                name: 'model'
            },
            {
                data: 'engine_no',
                name: 'engine_no'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }],

            order: [
                [11, 'asc']
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                if(aData['surveyor']!==null)
                {
                    if (aData['survey_status'] == 0) {

                        $(nRow).addClass('red');

                        }
                        else if(aData['survey_status'] == 1)
                        {
                        $(nRow).addClass('green');

                        }
                }
 
            }

        });



    });
</script>

@endsection
