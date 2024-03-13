@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | IBR Progress')
</title>
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
<a href="/Ibr" class="btn btn-primary">Back</a>
     
<table class="table display" id="myTable" >
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Job</th>
            <th scope="col">User</th>      
            <th scope="col">Message</th>
            <th scope="col">Date</th>
            <th scope="col">Activity </th>
            <th scope="col">Client</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>


        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script  type="text/javascript">
    $(function(){
        var table =$('#myTable').DataTable({
        processing: true,
        // serverSide: true,
        ajax:"/ibrProgress",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'job_id', name: 'job_id'},
            {data: 'name', name: 'name'},
            {data: 'message', name: 'message'},
            {data: 'date', name: 'date'},
            {data: 'activity', name: 'activity'},
            {data: 'client', name: 'client'}
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend:'pdf',
                title: 'Data export'
               
            }
        ],
        order: [[0,'desc']]
       
       
    
    });

   

    });
</script>

        
@endsection


