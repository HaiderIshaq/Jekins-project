@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Address Verification')
</title>

        <div id="app">
            <verification
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
           ></verification>
        </div>


@endsection



