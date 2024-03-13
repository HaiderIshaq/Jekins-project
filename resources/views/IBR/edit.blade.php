@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | IBR')
</title>

        <div id="app">
             <ibr-edit id="{{$data[1]}}" jobid="{{$data[0]}}" common="{{$data[2]}}" cmpny="{{$data[3]}}" ></ibr-edit>
        </div>

        
@endsection


