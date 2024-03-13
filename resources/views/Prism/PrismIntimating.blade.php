@extends('layouts.app')


<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

@section('content')
<title>
@section('title','KGT ERP | Prism Surveyors (Pvt) Ltd.')
</title>
        
        <div id="app">
            <prism-intimating
            {{-- usercompany="{{$user[0]}}"
            usertoken="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}" --}}
           ></prism-intimating>
        </div>
        
@endsection



   