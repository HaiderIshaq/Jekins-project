@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Post/Edit Receipts')
</title>


    <div id="app">
        <billing-edit
            usercompany="{{$data[0]}}"
            useregion="{{$data[2]}}"
            usercompanyname="{{$data[1]->company_name}}"
            usercompanyprefix="{{$data[1]->company_prefix}}"
            useregionname="{{$data[3]}}"
            useregionprefix="{{$data[4]}}"
            jobid="{{$data[5]}}"
          ></billing-edit>


    </div>




@endsection
