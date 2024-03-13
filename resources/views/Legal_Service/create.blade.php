@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Legal Service')
</title>
        
        <div id="app">
            <legal-service
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
           ></legal-service>
        </div>

        
@endsection



   