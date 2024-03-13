@extends('layouts.app')

@section('content')
<title>
@section('title','KGT Business Solution | Debt Collection')
</title>

<style>
.badge{
    font-size: 15px;
    margin-top:8px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
<a href="/home" class="btn btn-primary">Back</a>
<a href="/debtCreate"><button class="btn btn-success"><i class="fa fa-plus pr-2"></i>New Debt Collection Job</button></a>

      
<table class="table display" id="myTable1" style="width:100%" style="width:100%" >
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Type</th>
            <th scope="col">Client</th>      
            <th scope="col">Client Company </th>
            <th scope="col">Amount</th>
            <th scope="col">Debtor Company</th>
            <th scope="col">Country</th>
            <th scope="col">Added</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>


        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script  type="text/javascript">
    $(function(){
         $('#myTable1').DataTable({
        processing: true,
        // serverSide: true,
        
        "scrollX": true,
        ajax:"/getDebtData",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'type', name: 'type'},
            {data: 'client_name', name: 'client_name'},
            {data: 'company_name', name: 'company_name'},
            {data: 'amount', name: 'amount'},
            {data: 'debtor_company_name' , name: 'debtor_company_name'},
            {data: 'country_name', name: 'country_name'},
            {data: 'created_at', name: 'created_at'},
            {
                "mData": "status",
                "mRender": function (data, type, row) {
                    if(data=="Running")
                    {
                        return "<span class='badge badge-warning'>"+ data + "</span>";
                    }
                    else{
                        return "<span class='badge badge-success'>"+ data + "</span>";
                    }
                }
            },
            {data: 'action', name: 'action'}
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend:'pdf',
                title: 'Data export',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7,8,9]
                }
                
            }
        ],
        order: [[0,'desc']]
       
       
    
    });

   

    });
</script>
        
@endsection
