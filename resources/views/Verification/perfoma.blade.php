@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Address Verification Perfoma')
</title>

        <div id="app">
            <perfoma
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
           ></perfoma> 
        </div>


@endsection



