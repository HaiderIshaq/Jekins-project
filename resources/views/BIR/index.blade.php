@extends('layouts.app')

@section('content')
<title>
@section('title','KGT Traders | BIR')
</title>

<style>
.badge{
    font-size: 15px;
    margin-top:8px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
<a href="/home" class="btn btn-primary">Back</a>
<a href="/birCreate"><button class="btn btn-success"><i class="fa fa-plus pr-2"></i>New BIR</button></a>
{{-- <a href="/mis"><button class="btn btn-warning">MIS</button></a> --}}


<table class="table display" id="myTable1" style="width:100%" style="width:100%" >
        {{-- <thead class="thead-dark">
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
        </thead> --}}
        <tbody>
        </tbody>
        </table>


        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

{{--
<script  type="text/javascript">
    $(function(){
         $('#myTable1').DataTable({
        processing: true,
        // serverSide: true,

        "scrollX": true,
        ajax:"/inspection",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'job_id', name: 'job_id'},
            {data: 'taken_on', name: 'taken_on'},
            {data: 'city_name', name: 'city_name'},
            {data: 'service', name: 'service'},
            {data: 'bank_name', name: 'bank_name'},
            {data: 'cust_name', name: 'cust_name'},
            {
                "mData": "status",
                "mRender": function (data, type, row) {
                    if(data=='1')
                    {
                        return "<span class='badge badge-success'>Completed</span>";

                    }
                    else if(data=='2'){
                        return "<span class='badge badge-info'>Delayed</span>";

                    }
                    else if(data=='3'){
                        return "<span class='badge badge-danger'>Cancalled</span>";

                    }
                    else{
                        return "<span class='badge badge-warning'>Active</span>";

                    }
                }
            },
            {data: 'action', name: 'action'}
        ],


        buttons: [
            {
                extend:'pdf',
                title: 'Data export',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7]
                }

            }
        ],
        order: [[0,'desc']]



    });



    });
</script> --}}

@endsection
