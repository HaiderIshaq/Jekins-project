@extends('layouts.app')

@section('content')
<title>
@section('title','KGT Traders | Livestock MIS')
</title>

<style>
.badge{
    font-size: 15px;
    margin-top:8px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
<a href="/home" class="btn btn-primary">Back</a>

<table class="table display" id="myTable1" style="width:100%" style="width:100%" >
        <thead class="thead-dark">
            <tr>
                <th scope="col">Job_Id</th>
                <th scope="col">Bill Date</th>
                <th scope="col">Bank Code</th>
                <th scope="col">Bank Address</th>
                <th scope="col">Customer</th>
                <th scope="col">Customer CNIC</th>
                <th scope="col">Imported</th>
                <th scope="col">Local</th>
                <th scope="col">Total</th>
                <th scope="col">Bill</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>


        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

{{--  <script  type="text/javascript">
    $(function(){
         $('#myTable1').DataTable({
        processing: true,
        // serverSide: true,

        "scrollX": true,
        ajax:"/getLivestockMis",
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
</script>  --}}
<script  type="text/javascript">
    $(function(){
         $('#myTable1').DataTable({
        processing: true,
        // serverSide: true,

        "scrollX": true,
        ajax:"/getLivestockMis",
        columns: [
            {data: 'job_id', name: 'job_id'},
            {data: 'bill_date', name: 'bill_date'},
            {data: 'bank_code', name: 'bank_code'},
            {data: 'bank_address', name: 'bank_address'},
            {data: 'cust_name', name: 'cust_name'},
            {data: 'customer_cnic', name: 'customer_cnic'},
            {data: 'Imported', name: 'Imported'},
            {data: 'Local', name: 'Local'},
            {data: 'Total', name: 'Total'},
            {data: 'total_bill', name: 'total_bill'}

        ],


        buttons: [
            {
                extend:'pdf',
                title: 'Data export',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7]
                }

            }
        ]



    });



    });
</script>
@endsection
