@extends('layouts.app')

@section('content')
<title>
@section('title','KGT ERP | Billing ')
</title>


    <div id="app">
      <billing-prism
      usercompany="{{$user[0]}}"
      useregion="{{$user[2]}}"
      usercompanyname="{{$user[1]->company_name}}"
      usercompanyprefix="{{$user[1]->company_prefix}}"
      useregionname="{{$user[3]}}"
      useregionprefix="{{$user[4]}}"
    ></billing-prism>
        {{-- <billing
        usercompany="{{$user[0]}}"
        useregion="{{$user[2]}}"
        usercompanyname="{{$user[1]->company_name}}"
        usercompanyprefix="{{$user[1]->company_prefix}}"
        useregionname="{{$user[3]}}"
        useregionprefix="{{$user[4]}}"
      ></billing> --}}
        {{-- @if($user[5]=="Prism")
        <billing-prism
            usercompany="{{$user[0]}}"
            useregion="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
            useregionname="{{$user[3]}}"
            useregionprefix="{{$user[4]}}"
          ></billing-prism>
        @else
        <billing
            usercompany="{{$user[0]}}"
            useregion="{{$user[2]}}"
            usercompanyname="{{$user[1]->company_name}}"
            usercompanyprefix="{{$user[1]->company_prefix}}"
            useregionname="{{$user[3]}}"
            useregionprefix="{{$user[4]}}"
          ></billing>
          @endif --}}


    </div>




@endsection
