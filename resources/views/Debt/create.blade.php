@extends('layouts.app')

@section('content')
<title>
@section('title','KGT Business Solution | Debt Collection')
</title>
        
        <div id="app">
             <debt  usercompany="{{$user[0]}}" usercompanyname="{{$user[1]->company_name}}" usercompanyprefix="{{$user[1]->company_prefix}}"></debt>
                  
        </div>

        
@endsection



   