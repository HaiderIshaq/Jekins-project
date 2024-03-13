@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Inspection Edit ')
</title>
        
<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fcfdff;
    background-color: #007bff;
}

</style>


        <div id="app">
                <inspection-edit

                id="{{$data[1]}}"
                jobid="{{$data[0]}}" 
                usertoken="{{$data[4]}}" 
                common="{{$data[2]}}"
                cmpny="{{$data[3]}}" 
                
                ></inspection-edit>
        </div>
       

        
@endsection