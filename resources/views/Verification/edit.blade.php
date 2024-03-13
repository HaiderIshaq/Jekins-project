@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Verification Edit ')
</title>

<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fcfdff;
    background-color: #007bff;
}

</style>


        <div id="app">
                <verification-edit

                id="{{$data[1]}}"
                jobid="{{$data[0]}}"
                usertoken="{{$data[4]}}"
                common="{{$data[2]}}"
                cmpny="{{$data[3]}}"

                ></verification-edit>
                <!-- <geolocate></geolocate> -->
        </div>



@endsection
