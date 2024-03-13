<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inspection Report No : </title>

</head>
<style>
body{background:none;

}



.container{width:90%}
.container-fluid{width:100%}

table{
     width: 95%;

     border-collapse: collapse;

 }
 .myTable td,th{
     /* border:1px solid black; */
     border:1px solid black;
     font-size:13px;
     font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;

    }
tr.inner-table-row td{
    border-bottom: 1px solid black;
    padding-left:0px
}
div.box{
   float:left;
   width:50%;
   font-size:14px;


}

div.box1{
    width:70%
}

div.box2{
    width:30%
}
.details-box{
   border:1px solid black;
   font-size:16px;
   padding:5px 5px 5px 10px;

   margin-right:30px;

}
@page {
    margin-top: 4cm;

}

.footer{position:relative;
top:140px;
font-size:13px;
width:94%}
</style>
<body>
    <div class="container" style="padding-left:80px;padding-right:80px">
         <div class="row " style="padding-bottom:5px;">

            <div class="box box1">
                <span style="">Ref:   {{$data[0]}}</span>
            </div>
            <div class="box box2">
            <span >Dated:      {{$data[7]}}<span>
            </div>


          </div>
        <div class="row">
            <h4 style="text-decoration:underline;text-align:center;line-height:0.1;padding-right:30px"><b>LIVESTOCK/ANIMALS INSPECTION REPORT</b></h4>
            <h4 style="text-align:center;line-height:0.1;padding-right:30px"><b>(Region-{{$data[5]}})</b></h4>

        </div>

          <div class="row">
            <h4 style="line-height:0.1;padding-bottom:5px;"><b>BACKGROUND INFORMATION</b></h4>
          </div>

          <div class="row ">

              <table class="myTable"  style="border-top:1px solid black;">




                  <tr >
                      <td style="padding:5px 5px 5px  5px  ">Customer Name</td>
                      <td style="padding:5px  5px  5px  5px  "> {{ strtoupper($data[1])}}</td>
                  </tr>
                  <tr >
                      <td style="padding:5px  5px 5px  5px  ">Address of site </td>
                      <td style="padding:5px  5px  5px  5px  ">
                        {{ucwords($data[2])}}
                        @if($data[22] == 1)
                        <br>
                         {{ucwords($data[23])}}

                        @endif
                    </td>
                  </tr>
              </table>
          </div>
          <div class="row" style="margin-top:10px">
            <h4 style="line-height:0.1;"><b>INSPECTION</b></h4>
          </div>


          @if($data[24]==0 || $data[24]==null)
            <div class="row ">

                <table style="border-top:1px solid black;border-left:1px solid black;border-right:1px solid black">
                    <tr>
                            <td style="font-size:14px;width:100% ;padding:5px">
                            <b> Inspection Conducted by </b>

                            </td>
                    </tr>
                </table>
                <table class="myTable">


                        <tr >
                            <td style="padding:5px 5px 5px 5px;width:20%">  Name</td>
                            <td style="padding:5px 5px 5px 5px;width:80%">{{ucwords($data[8])}}</td>
                        </tr>
                        <tr >
                        <td style="padding:5px 5px 5px 5px;width:20%">Designation</td>
                        <td style="padding:5px 5px 5px 5px;width:80%"> Inspector</td>  </tr>
                        <tr >
                        <td style="padding:5px 5px 5px 5px;width:20%;">Date</td>
                        <td style="padding:5px 5px 5px 5px;width:80%;">{{$data[9]}}</td>
                        </tr>
                </table>


            </div>
          @elseif ($data[24]==1)
            <div class="row " style="width:98%">

                <div style="width:50%;float:left">
                        <table style="border-top:1px solid black;border-left:1px solid black;border-right:1px solid black">
                    <tr>
                            <td style="font-size:14px;width:100% ;padding:5px">
                            <b> Inspection Conducted by </b>

                            </td>
                    </tr>
                    </table>
                    <table class="myTable" >


                        <tr style="">
                            <td style="padding:5px 5px 5px 5px;width:20%;font-size:12px">  Name</td>
                            <td style="padding:5px 5px 5px 5px;width:65%;font-size:12px">{{ucwords($data[8])}}</td>
                        </tr>
                        <tr >
                        <td style="padding:5px 5px 5px 5px;width:20%;font-size:12px">Designation</td>
                        <td style="padding:5px 5px 5px 5px;width:65%;font-size:12px"> Inspector</td>  </tr>
                        <tr >
                        <td style="padding:5px 5px 5px 5px;width:20%;font-size:12px;">Date</td>
                        <td style="padding:5px 5px 5px 5px;width:65%;font-size:12px">{{$data[9]}}</td>
                        </tr>
                    </table>
                </div>
                <div style="width:50%;float:left">
                        <table style="border-top:1px solid black;border-left:1px solid black;border-right:1px solid black">
                    <tr>
                            <td style="font-size:14px;width:100% ;padding:5px">
                            <b>AFO Details </b>

                            </td>
                    </tr>
                    </table>
                    <table class="myTable" >


                        <tr style="">
                            <td style="padding:5px 5px 5px 5px;width:30%;font-size:12px">  Name</td>
                            <td style="padding:5px 5px 5px 5px;width:55%;font-size:12px">{{ucwords($data[25])}}</td>
                        </tr>
                        <tr >
                        <td style="padding:5px 5px 5px 5px;width:30%;font-size:12px">Contact</td>
                        <td style="padding:5px 5px 5px 5px;width:55%;font-size:12px"> {{$data[26]}}</td>  </tr>
                        <tr >
                        <td style="padding:5px 5px 5px 5px;width:30%;font-size:12px;">Branch Code</td>
                        <td style="padding:5px 5px 5px 5px;width:55%;font-size:12px">{{strtoupper($data[27])}}</td>
                        </tr>
                    </table>
                </div>



            </div>
          @endif







            <div class="row" style="margin-top:10px">
                <h4 style="line-height:0.1;text-transform:uppercase"><b>Details of Animals</b></h4>
            </div>
         <div class="row " style="height:480px" >
            <table  style="font-size:12px;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;border-bottom:none">
                   <tr>
                        <td style="text-align:center;font-size:16px;width:100% ">
                         <b>  Animals as per inspection report</b>

                        </td>
                   </tr>
                </table>
                <table id="myTable" style="font-size:12px;border-top:none;border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black">
                    <tr style="background-color:yellow">
                        <th>Description of <br> stocks</th>
                        <th>Age</th>
                        <th>Breed / Type</th>
                        <th>Quantity</th>
                        <th>Remarks (if any)</th>
                    </tr>

                    @foreach($data[10] as $detail)

                    <tr>
                        <th style="padding:5px;font-size:12px;">
                        @if($detail->description_of_stocks==null)

                                        -

                                        @else
                                        {{$detail->description_of_stocks}}

                                    @endif

                    </th>
                        <th style="font-size:12px;">


                            @foreach(json_decode($detail->breed) as $items => $key)

                                @if($loop->last)
                                <table style="padding:0px 0px 0px 0px;font-size:13px;">


                                    <tr>

                                        <td style="padding:5px">
                                        @if($key->age==null || $key->time==null)

                                           -

                                            @else
                                            {{$key->age}} {{$key->time}}

                                        @endif
                                        </td>


                                    </tr>
                                </table>
                                        @elseif($loop->remaining )

                                        <table style="padding:0px 0px 0px 0px;font-size:13px;">


                                        <tr  class="inner-table-row" >

                                        <td style="padding:5px">
                                        @if($key->age==null || $key->time==null)

                                        -

                                         @else
                                         {{$key->age}} {{$key->time}}

                                        @endif
                                        </td>


                                        </tr>
                                        </table>





                                        @elseif(!$loop->first)

                                        <table style="padding:0px 0px 0px 0px;font-size:13px;">


                                        <tr  class="inner-table-row" >

                                        <td style="padding:5px">
                                        @if($key->age==null || $key->time==null)

                                        -

                                         @else
                                         {{$key->age}} {{$key->time}}

                                        @endif
                                        </td>


                                        </tr>
                                        </table>
                                      @endif

                                @endforeach



                        </th>
                        <th style="padding:0px">




                            @foreach(json_decode($detail->breed) as $key)

                                    @if($loop->last)
                                    <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                      <tr style="padding:0px 0px 0px 0px" class=>

                                    <td style="padding:5px">
                                    @if($key->secondType==null)

                                        -

                                        @else
                                        {{$key->secondType}}


                                    @endif

                                    </td>


                                    </tr>
                                </table>

                                        @elseif($loop->remaining)
                                        <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                        <tr  class="inner-table-row" >

                                        <td style="padding:5px">


                                        @if($key->secondType==null)

                                        -

                                        @else
                                        {{$key->secondType}}


                                        @endif
                                        </td>


                                        </tr>
                                        </table>


                                        @elseif(!$loop->first)
                                        <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                        <tr  class="inner-table-row" >

                                        <td style="padding:5px">
                                        @if($key->secondType==null)

                                        -

                                        @else
                                        {{$key->secondType}}


                                    @endif
                                        </td>


                                        </tr>
                                        </table>

                                      @endif

                                @endforeach



                        </th>
                        <th style="padding:0px">





                        @foreach(json_decode($detail->breed) as $key)

                                        @if($loop->last)
                                        <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                        <tr style="padding:0px 0px 0px 0px" class=>

                                        <td style="padding:5px">
                                        @if($key->quantity==0)

                                        -

                                        @else
                                        {{$key->quantity}}


                                        @endif
                                        </td>


                                        </tr>
                                        </table>

                                            @elseif($loop->remaining)
                                            <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                            <tr  class="inner-table-row" >

                                            <td style="padding:5px">
                                            @if($key->quantity==0)

                                            -

                                            @else
                                            {{$key->quantity}}


                                            @endif
                                            </td>


                                            </tr>
                                            </table>


                                            @elseif(!$loop->first)
                                            <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                            <tr  class="inner-table-row" >

                                            <td style="padding:5px">
                                            @if($key->quantity==0)

                                            -

                                            @else
                                            {{$key->quantity}}


                                            @endif
                                            </td>


                                            </tr>
                                            </table>

                                        @endif

                                        @endforeach




                        </th>

                        <th style="padding:0px">





                        @foreach(json_decode($detail->breed) as $key)

                                        @if($loop->last)
                                        <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                        <tr style="padding:0px 0px 0px 0px" class=>

                                        <td style="padding:5px">
                                        @if($key->remarks==null)

                                        -

                                        @else
                                        {{$key->remarks}}


                                        @endif
                                        </td>


                                        </tr>
                                        </table>

                                            @elseif($loop->remaining)
                                            <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                            <tr  class="inner-table-row" >

                                            <td style="padding:5px">
                                            @if($key->remarks==null)

                                        -

                                        @else
                                        {{$key->remarks}}


                                        @endif
                                            </td>


                                            </tr>
                                            </table>


                                            @elseif(!$loop->first)
                                            <table style="padding:0px 0px 0px 0px;font-size:13px;">

                                            <tr  class="inner-table-row" >

                                            <td style="padding:5px">
                                            @if($key->remarks==null)

                                        -

                                        @else
                                        {{$key->remarks}}


                                        @endif
                                            </td>


                                            </tr>
                                            </table>

                                        @endif

                                        @endforeach




                        </th>

                </tr>


                    @endforeach

                <tr style="border:1px solid black">
                  <td style="text-align:left;padding:5px ;font-size:13px;border:1px solid black;text-align:center"><b>Total</b></td>
                      <td style="padding:5px ;font-size:13px;border:1px solid black;"></td>
                      <td style="padding:5px ;font-size:13px;border:1px solid black;"></td>
                      <td style="padding:5px ;text-align:center;font-size:13px;border:1px solid black;">
                        @foreach (json_decode($data[11]) as $record)
                           <b> {{ $record->total }}</b>
                        @endforeach
                      </td>
                      <td style="padding:5px ;font-size:13px;border-top:2px solid black;"></td>
                  </tr>

            </table>
            @if ($data[20]==1)

            <br>
            <div class="details-box" style="font-size:14px;padding:5px 15px 5px 15px">
                <div class="row">

                <p style="text-align:justify">
                <span ><b>Note</b></span> : {{$data[21]}}
                <g></g>
                </p>
            </div>
        </div>

            @endif


        </div>

        <!-- <div class="row " style="padding-bottom:5px;">

            <div class="box box1" style="width:70%">
                <span style="">Ref:   {{$data[0]}}</span>
            </div>
            <div class="box box2" style="width:30%">
            <span >Dated:      {{$data[7]}}<span>
            </div>


          </div> -->

        <div class="row "  >
        <h4 style=""><b>CONCLUSION / OBSERVATION / COMMENTS </b></h4>

                <div class="details-box">
                   <div class="row" style="font-size:14px;text-align:justify;padding-right:45px">
                       <p>During the farm visit it was observed that all animals were sighted as per follows : </p>
                       <ul>
                           <li>{{$data[18]}}</li>
                       </ul>
                   </div>
                    <div class="row" style="padding-bottom:5px;text-align:justify;padding-right:45px">
                        <b style="font-size:15px">Food Quality  &amp; Safety</b>
                        <p style="font-size:14px">Animal diet comprising of “dry grass, silage, wanda” is served through cemented channels / wooden carts by caretakers thrice a day  and food material/stock is stored separately within the premises.</p>
                    </div>
                    <div class="row" style="padding-bottom:5px;text-align:justify;padding-right:45px">
                        <b style="font-size:15px">Availability of Diagnostic Lab &amp; Veterinary:</b>
                        <p style="font-size:14px">There is no particular lab available at site however; it was informed that a consultant comes {{$data[16]}} for routine medical checkup of animals.</p>
                    </div>
                    <div class="row" style="padding-bottom:5px;text-align:justify;padding-right:45px">
                        <b style="font-size:15px">Security Arrangements:</b>
                        <p style="font-size:14px">{{$data[14]}} ({{$data[15]}}) caretakers are employed by customer to look after cleaning & preservation of animals.</p>
                    </div>

                    @foreach($data[12] as $remark)
                    <div class="row" style="padding-bottom:5px;font-size:14px">


                    <div class="box box1" style="width:30%" >
                        <b>{{$remark->title}} </b>:

                    </div>
                    <div class="box box2" style="width:25%" >
                    <b>[{{$remark->option_first_status == 1 ? '√' : 'x' }}] {{$remark->option_first_name}}</b>

                    </div>

                    <div class="box box3" style="width:35%">
                    <b>[{{$remark->option_second_status == 1 ? '√' : 'x' }}] {{$remark->option_second_name}}</b>

                    </div>
                    </div>
                    @endforeach


                </div>

                <div style="margin-top:10px">
                        @if($data[17]==1)
                        <div class="row" style="padding-bottom:10px;border-bottom:dotted 2px black;width:40%">

                            <img src="images/sign.png"   alt="">
                            <br></div>
                            @else

                            <div class="row" style="padding-bottom:100px;border-bottom:dotted 2px black;width:40%">

                            <br></div>
                            @endif

                    <div class="row" style="padding-bottom:5px;padding-top:10px;font-size:16px">Signature & Stamp;<br></div>
                    <div  class="row" style="padding-bottom:5px;font-size:14px">Authorized Signatory: &nbsp;&nbsp;&nbsp;&nbsp;Sunil Kumar<br></div>
                    <div  class="row" style="padding-bottom:5px;font-size:14px">Designation: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager Inspection<br></div>
                    <div  class="row" style="padding-bottom:5px;font-size:14px">Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data[7]}}</div>


                </div>

                <div class="row" style="border-bottom:solid 2px black;width:90%"><br></div>
                <div class="row" style="padding-bottom:10px;padding-top:10px;font-size:16px"><b>Acknowledged by Authorized signature(s) with company seal</b><br></div>



        </div>


    </div>

</body>
</html>
