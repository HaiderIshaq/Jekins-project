@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | IBR')
</title>
        
        <div id="app">
             <ibr  usercompany="{{$user[0]}}" usercompanyname="{{$user[1]->company_name}}" usercompanyprefix="{{$user[1]->company_prefix}}"></ibr>
                  
        </div>

        
@endsection



   