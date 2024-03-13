@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Prism Surveyors (Pvt) Ltd.')
</title>
        
        <div id="app">
            <prism
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}" 
           ></prism>
        </div>

        
@endsection



   