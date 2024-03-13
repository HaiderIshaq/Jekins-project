@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Logs')
</title>



<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
      
        <table class="table display"  id="myTable" >
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">User </th>
            <th scope="col">Activity</th>      
            <th scope="col">Service</th>      
            <th scope="col">Date</th>
            <th scope="col">Time </th>

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
        serverSide: true,
        bAutoWidth: false, 
  aoColumns : [
    { sWidth: '8%' },
    { sWidth: '10%' },
    { sWidth: '30%' },
    { sWidth: '10%' },
    { sWidth: '10%' }
  ],
        ajax: "/logs",
        columns: [
            {data: 'log_id', name: 'log_id'},
            {data: 'name', name: 'name'},
            {data: 'activity', name: 'activity'},
            {data: 'service', name: 'service'},
            {data: 'date', name: 'date'},
            {data: 'time', name: 'time'}
        ],
        order: [[0,'desc']]
       
       
    
    });

   

    });
</script>
        
@endsection
