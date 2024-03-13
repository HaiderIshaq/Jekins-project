@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Debt Collection')
</title>

        <div id="app">
             <debt-edit 
             id="{{$data[0]}}"
               ></debt-edit>
        </div>

        
@endsection


