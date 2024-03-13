@extends('layouts.app')

@section('content')
<title>
@section('title','KGT Traders | Prism Survey Stats')
</title>

<style>
.badge{
    font-size: 12px;
    margin-top:8px
}

#myTable1 td{
    font-size: 12px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
    <div id="app">
        <prism-stats

        usertoken="{{$user[2]}}" 

    ></prism-stats>

    </div>
</div>

@endsection