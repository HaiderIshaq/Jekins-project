<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Banker Dashboard</title>

    

   

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
  <style>
      

        .badge {
            width: 100px !important;
            padding: 6px !important;
            height: 25px !important;
        
        }
        .font-weight-bold {
            font-weight: 600 !important;
            }


            a.text-success:hover,
            a.text-success:focus {
            color: #24a46d !important;
            }

            .text-warning {
            color: #fb6340 !important;
            }

            a.text-warning:hover,
            a.text-warning:focus {
            color: #fa3a0e !important;
            }

            .text-danger {
            color: #f5365c !important;
            }

            a.text-danger:hover,
            a.text-danger:focus {
            color: #ec0c38 !important;
            }

            .text-white {
            color: #fff !important;
            }

            a.text-white:hover,
            a.text-white:focus {
            color: #e6e6e6 !important;
            }

            .text-muted {
            color: #8898aa !important;
            }

            @media print {
            *,
            *::before,
            *::after {
                box-shadow: none !important;
                text-shadow: none !important;
            }
            
            a:not(.btn) {
                text-decoration: underline;
            }
            
            
            
            
            
            
            }

            /* figcaption,
            main {
            display: block;
            } */


            .bg-yellow {
            background-color: #ffd600 !important;
            }






            .icon {
            width: 3rem;
            height: 3rem;
            }

            .icon i {
            font-size: 2.25rem;
            }

            .icon-shape {
            display: inline-flex;
            padding: 12px;
            text-align: center;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            }
    </style>

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');

        #myTable_length{
            padding-bottom:20px
        }
        body {
            font-family: 'Nunito', sans-serif;
            /* font-family: 'Poppins', sans-serif; */
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .navbar-custom {
            padding: 0 24px;
            background-color: #fff;
            -webkit-box-shadow: 0 0 35px 0 rgb(154 161 171 / 15%);
            box-shadow: 0 0 35px 0 rgb(154 161 171 / 15%);
            min-height: 65px;
            position: fixed;
            
            top: 0;
            right: 0;
            z-index: 1001;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: none;
            box-shadow: 0px 1px 7px -3px #e9ecef;
            border-radius: .25rem;
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.5rem 1.5rem;
        }

        .divider {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .btn-toggle {

            color: #f8f9fa !important;
        }

        .btn-toggle-nav a {
            font-weight: 200;
            color: white;
        }

        .btn-toggle-nav a:hover,
        .btn-toggle-nav a:focus {
            background-color: #ffffff !important;
        }

        .btn-toggle::before {
            content: none !important
        }

        .btn-toggle:hover,
        .btn-toggle:focus {
            color: rgba(0, 0, 0, .85) !important;
            background-color: white !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #2f991e;
            border-color: #2f991e;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: white
        }

        a:hover {
            text-decoration: none;
            color: black
        }

        .btn-primary:hover {
            color: #fff;
            background-color: white;
            background-color: #1e790f;
            border-color: #1e790f;

            border-color: white;
        }

        .dropdown-toggle::after {
            color: black
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
  
    <!-- Custom styles for this template -->
</head>

<body>
        <div class="container-fluid" >
            <div class="row header">
                <div class="navbar-custom">

                    <div class="row mt-3">
                        <div class="col-md-11 pb-4 ">
                        
                        <img src="{{url('/').'/images/'.'logo.png'}}" style="height:50px;width:260px"  >
                        </div>
                        <div class="col-md-1 col-sm-4">
                            <div class="dropdown mt-4">
                          
                                <a href="#" class="d-flex align-items-center  text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                               
                                    <strong style="color:black">{{Auth::user()->name}}  </strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                    <li><a class="dropdown-item" >Profile</a></li>
                                    <li><a class="dropdown-item"   onclick="event.preventDefault();
						 	        document.getElementById('logout-form').submit();">Sign out</a></li>
                                </ul>

                                <form id="logout-form" action="{{route('logout')}}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
                <div class="container-fluid">
                <h2 class="mb-5 text-white"></h2>
                <div class="header-body">
                    <div class="row">
                    <!-- <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0" style="background-color: azure;">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">New Jobs</h5>
                                <span class="h2 font-weight-bold mb-0">0</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 0%</span>
                            <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0" style="background-color: azure;">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Pending</h5>
                                <span class="h2 font-weight-bold mb-0">0</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>0%</span>
                            <span class="text-nowrap">Since last week</span>
                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0" style="background-color: azure;">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Done</h5>
                                <span class="h2 font-weight-bold mb-0">0</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                <i class="fas fa-users"></i>
                                </div>
                            </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 0%</span>
                            <span class="text-nowrap">Since yesterday</span>
                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0" style="background-color: azure;">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Percentage</h5>
                                <span class="h2 font-weight-bold mb-0">0%</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                <i class="fas fa-percent"></i>
                                </div>
                            </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>0%</span>
                            <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                        </div>
                    </div> -->
                    </div>
                </div>
                </div>
            </div>
            
            <div class="row" >
                <div class="col-md-12 mt-4" style="padding:0px 50px 40px 50px">

                
                <table id="myTable" class="table table-striped" >
                    <thead style="background-color:#131e22;">
                        
                            <th style="color:white !important" scope="col">Job</th>
                            <th style="color:white !important" scope="col">Taken On</th>
                            <th style="color:white !important" scope="col">Completed On</th>
                            <th style="color:white !important" scope="col">Product</th>
                            <th style="color:white !important" scope="col">Applicant Name</th>
                            <th style="color:white !important" scope="col">Region</th>
                            <th style="color:white !important" scope="col">Status</th>
                            <th style="color:white !important" scope="col">Action</th>
                        
                    </thead>
                    <tbody>
                    </tbody>
                </table>



                </div>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
        <script  type="text/javascript">
  
  $(function(){
         $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:"/getBankersData",
        columns: [
            {data: 'job_id', name: 'job_id'},
            {data: 'taken_on', name: 'taken_on'},
            {data: 'completed_on', name: 'completed_on'},
            {data: 'product_type', name: 'product_type'},
            {data: 'applicant_name', name: 'applicant_name'},
            {data: 'region', name: 'region'},
            {
                "mData": "status",
                "mRender": function (data, type, row) {
                    if(data=='1')
                    {
                        return "<span class='badge bg-success' style='margin-top:10px'>Completed</span>";

                    }
                    else if(data=='2'){
                        return "<span class='badge bg-info' style='color:black;margin-top:10px' >Delayed</span>";

                    }
                    else if(data=='3'){
                        return "<span class='badge bg-danger' style='margin-top:10px' >Cancalled</span>";

                    }
                    else{
                        return "<span class='badge bg-warning' style='color:black;margin-top:10px'>Active</span>";

                    }
                }
            },
            {data: 'action', name: 'action'}
        ],


        // buttons: [
        //     {
        //         extend:'pdf',
        //         title: 'Data export',
        //         exportOptions: {
        //             columns: [ 0,1,2,3,4,5,6,7]
        //         }

        //     }
        // ],
        order: [[0,'desc']]



    });



    });

   

</script>
        
</body>
</html>