@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Clearing')

        <style>
        hr{
       background-color: rgb(39, 81, 41);
        }
        </style>

</title>

        <div id="app">
            <clearing
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
           ></clearing>

        </div>


@endsection



