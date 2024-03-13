@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Inspection')
</title>
        
        <div id="app">
            <inspection
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
           ></inspection>
        </div>

        
@endsection



   