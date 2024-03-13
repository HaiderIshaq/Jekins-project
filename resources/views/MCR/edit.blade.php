@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | MCR Edit ')
</title>
        
<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fcfdff;
    background-color: #007bff;
}

hr{
       background-color: rgb(39, 81, 41);
        }

</style>


        
        <div id="app">
            <mcr-edit
            usercompany="1"
            usertoken="1"
            usercompanyname="1"
            usercompanyprefix="1"
           ></mcr-edit>
           
        </div>
       

        
@endsection