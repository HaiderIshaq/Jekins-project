@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Income Estimation Edit ')
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
            <ie-edit
            id="{{$data[1]}}"
            jobid="{{$data[0]}}" 
            usertoken="{{$data[4]}}" 
            common="{{$data[2]}}"
            cmpny="{{$data[3]}}" 
           ></ie-edit>

        </div>



@endsection