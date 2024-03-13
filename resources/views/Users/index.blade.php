@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | User Manager')
</title>



<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
<a href="/usersCreate"><button class="btn btn-success"><i class="fa fa-plus pr-2"></i>Create New Users</button></a>
      
        <table class="table display"  id="myTable" >
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">User</th>
            <th scope="col">Email</th>      
            <th scope="col">Phone </th>
            <th scope="col">Company</th>
            <th scope="col">Region</th>
            <th scope="col">Designation</th>
            <th scope="col">Role</th>
            <th scope="col">Edit</th>
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
        ajax:"/users",
        columns: [
            {data: 'main_id', name: 'main_id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'company_name', name: 'company_name'},
            {data: 'city_name', name: 'city_name'},
            {data: 'designation', name: 'designation'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action1', orderable: false, searchable: false}

        ]
       
       
    
    });

   

    });
</script>
        
@endsection
