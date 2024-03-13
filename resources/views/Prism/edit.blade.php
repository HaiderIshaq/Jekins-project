@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Prism Surveyors Edit ')
</title>
        
<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fcfdff;
    background-color: #007bff;
}

</style>


        <div id="app">
                <prism-intimating

                  id="{{$data[1]}}"
                jobid="{{$data[0]}}" 
                usertoken="{{$data[4]}}" 
                common="{{$data[2]}}"
                cmpny="{{$data[3]}}"  
                 
                ></prism-intimating>
        </div>
       

        
@endsection