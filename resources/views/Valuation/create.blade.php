@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Valuation')
</title>
        
        <div id="app">
             <valuation  
            usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
            >
            </valuation>
                  
        </div>

        
@endsection



   