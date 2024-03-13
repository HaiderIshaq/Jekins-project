@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | BIR')

        <style>
        hr{
       background-color: rgb(39, 81, 41);
        }
        </style>

</title>

        <div id="app">
            <bir
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
           ></bir>

        </div>


@endsection



