<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use DataTables;
use Carbon\Carbon;
use App\User;
use App\Stats;


class StatsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");
    }

    public function index()
    {
        return view('Stats.index');
    }


    public function testQuery(Request $request)
    {
        // return Stats::getSitesByRegionData('Prism','2022-11-2','2022-11-2','Motor',1);

        $invoices="PRM/22,PRM/33,PRM/64";
        $ids=explode(',', $invoices);

        return $ids;


    }
    public function getstats(Request $request)
    {

        $service = $request->service;
        $from_date = date('Y-m-d', strtotime($request->from));
        $to_date = date('Y-m-d', strtotime($request->to));
        $region = $request->region;
        $by = $request->statsby;
        $cat = $request->statsCat;

        $date = Carbon::createFromFormat('Y-m-d', $from_date);
        $daysToAdd = -1;
        $tdate = $date->addDays($daysToAdd);



        if ($by == "Region") {
            if ($region == 0) {

                // $stats = DB::select('call GetStatsByRegion(?,?,?,?)', array($service, $from_date, $to_date,$cat));

                $collection = collect([]);

                $regions=Stats::getRegions($cat);
                
                foreach ($regions as $reg) {

                $stats=Stats::getStatsByRegion($service,$from_date,$to_date,$cat,$reg);


                    $collection->push(
                        [
                            'By' => $stats['By'],
                            'Opening' => $stats['Opening'],
                            'Billed' => $stats['Billed'],
                            'Received' => $stats['Received'],
                            'Deduction' => $stats['Deduction'],
                            'Discount' => $stats['Discount'],
                            'WrittenOff' => $stats['WrittenOff'],
                            'Excess' => $stats['Excess'],
                            'OldDebt' => $stats['OldDebt'],
                            'Balance' =>$stats['Balance'],
                            'IncomeTax' => $stats['IncomeTax'],
                            'WithHold' => $stats['WithHold'],  
                            'Payable' => $stats['Payable'],
                            'BankCharges' => $stats['BankCharges']
                        ]
                    );



                }

                $collection->all();
                return $collection;
            } else {



                $collection = collect([]);


                $stats=Stats::getStatsByRegion($service,$from_date,$to_date,$cat,$region);


                    $collection->push(
                        [
                            'By' => $stats['By'],
                            'Opening' => $stats['Opening'],
                            'Billed' => $stats['Billed'],
                            'Received' => $stats['Received'],
                            'Deduction' => $stats['Deduction'],
                            'Discount' => $stats['Discount'],
                            'WrittenOff' => $stats['WrittenOff'],
                            'Excess' => $stats['Excess'],
                            'OldDebt' => $stats['OldDebt'],
                            'Balance' =>$stats['Balance'],
                            'IncomeTax' => $stats['IncomeTax'],
                            'WithHold' => $stats['WithHold'],  
                            'Payable' => $stats['Payable'],
                            'BankCharges' => $stats['BankCharges']
                        ]
                    );



            
                $collection->all();
                return $collection;


            }
        } else if($by == "Bank") {
            if ($region == 0) {

                $stats = DB::select('call GetStatsByBank(?,?,?)', array($service, $from_date, $to_date));

                $collection = collect([]);

                foreach ($stats as $stat) {

                    $recived=$stat->Received- $stat->Excess;


                    $curr=DB::table('bill')
                    ->where('service','=',$service)
                    ->where('bank','=',$stat->bank_id)
                    ->whereIn('status',['Receivable','Pending'])
                    ->select(
                        DB::raw('sum(total_amount) as total')
                    )
                    ->get();

                    if($to_date==date('Y-m-d'))
                    {
 
                        $open=$curr[0]->total+$recived + $stat->Deduction + $stat->Discount - $stat->Billed;
                        $balance=$open + $stat->Billed - $recived - $stat->Deduction - $stat->Discount;

                    }

                    else{

                        $date = Carbon::createFromFormat('Y-m-d', $to_date);
                        $daysToAdd = 0;
                        $tddate = $date->addDays($daysToAdd);
                

                        // $dummstat = DB::select('call GetStatsByRegion(?,?,?)', array($service, $tddate, date('Y-m-d')));
                        $dummstat = DB::select('call GetStatsByBankSpec(?,?,?,?)', array($service, $tddate, date('Y-m-d'), $stat->bank_id));
                        
                        $rec=$dummstat[0]->Received - $dummstat[0]->Excess;
                        $i=$curr[0]->total+ $rec + $dummstat[0]->Deduction + $dummstat[0]->Discount - $dummstat[0]->Billed;
                        
                        $open=$i+$recived + $stat->Deduction + $stat->Discount - $stat->Billed;
                        $balance=$open + $stat->Billed - $recived - $stat->Deduction - $stat->Discount;


                    }


  


                    
                    

                    $collection->push(
                        [
                            'By' => $stat->Bank,
                            'Opening' => $open,
                            'Billed' => $stat->Billed,
                            'Received' => $recived,
                            'Deduction' => $stat->Deduction,
                            'Discount' => $stat->Discount,
                            'WrittenOff' => $stat->WrittenOff,
                            'Excess' => $stat->Excess,
                            'OldDebt' => $stat->OldDebt,
                            'Balance' =>$balance,
                            'IncomeTax' => $stat->IncomeTax,
                            'WithHold' => $stat->WithHold,
                            'Payable' => $stat->Payable,
                            'BankCharges' => $stat->BankCharges
                        ]
                    );



                }

                $collection->all();
                return $collection;
            } else {
                $stats = DB::select('call 	GetStatsByRegionSpec(?,?,?,?)', array($service, $from_date, $to_date, $region));
            }



        } else if($by == "Customer") {
            if ($region == 0) {

                $stats = DB::select('call GetStatsByCustomers(?,?,?)', array($from_date, $to_date,$service));

                $collection = collect([]);

                foreach ($stats as $stat) {

                    $recived=$stat->Received- $stat->Excess;


                    $curr=DB::table('bill')
                    ->where('service','=',$service)
                    ->where('customer','=',$stat->customer_id)
                    ->whereIn('status',['Receivable','Pending'])
                    ->select(
                        DB::raw('sum(total_amount) as total')
                    )
                    ->get();

                    if($to_date==date('Y-m-d'))
                    {
 
                        $open=$curr[0]->total+$recived + $stat->Deduction + $stat->Discount - $stat->Billed;
                        $balance=$open + $stat->Billed - $recived - $stat->Deduction - $stat->Discount;

                    }

                    else{

                        $date = Carbon::createFromFormat('Y-m-d', $to_date);
                        $daysToAdd = 0;
                        $tddate = $date->addDays($daysToAdd);
                

                        // $dummstat = DB::select('call GetStatsByRegion(?,?,?)', array($service, $tddate, date('Y-m-d')));
                        $dummstat = DB::select('call GetStatsByCustomerSpec(?,?,?,?)', array($service, $tddate, date('Y-m-d'), $stat->customer_id));
                        
                        $rec=$dummstat[0]->Received - $dummstat[0]->Excess;
                        $i=$curr[0]->total+ $rec + $dummstat[0]->Deduction + $dummstat[0]->Discount - $dummstat[0]->Billed;
                        
                        $open=$i+$recived + $stat->Deduction + $stat->Discount - $stat->Billed;
                        $balance=$open + $stat->Billed - $recived - $stat->Deduction - $stat->Discount;


                    }


  


                    
                    

                    $collection->push(
                        [
                            'By' => $stat->Customer,
                            'Opening' => $open,
                            'Billed' => $stat->Billed,
                            'Received' => $recived,
                            'Deduction' => $stat->Deduction,
                            'Discount' => $stat->Discount,
                            'WrittenOff' => $stat->WrittenOff,
                            'Excess' => $stat->Excess,
                            'OldDebt' => $stat->OldDebt,
                            'Balance' =>$balance,
                            'IncomeTax' => $stat->IncomeTax,
                            'WithHold' => $stat->WithHold,
                            'Payable' => $stat->Payable,
                            'BankCharges' => $stat->BankCharges
                        ]
                    );



                }

                $collection->all();
                return $collection;
            } else {
                $stats = DB::select('call 	GetStatsByRegionSpec(?,?,?,?)', array($service, $from_date, $to_date, $region));
            }



        } else if($by == "City") {
            if ($region == 0) {

                $stats = DB::select('call GetStatsByAtten(?,?,?)', array($from_date, $to_date,$service));

                $collection = collect([]);

                foreach ($stats as $stat) {

                    $recived=$stat->Received- $stat->Excess;


                    $curr=DB::table('bill')
                    ->where('service','=',$service)
                    ->where('atten','=',$stat->atten_id)
                    ->whereIn('status',['Receivable','Pending'])
                    ->select(
                        DB::raw('sum(total_amount) as total')
                    )
                    ->get();

                    if($to_date==date('Y-m-d'))
                    {
 
                        $open=$curr[0]->total+$recived + $stat->Deduction + $stat->Discount - $stat->Billed;
                        $balance=$open + $stat->Billed - $recived - $stat->Deduction - $stat->Discount;

                    }

                    else{
                        

                        if($stat->atten_id!=null)
                        {
                            $date = Carbon::createFromFormat('Y-m-d', $to_date);
                            $daysToAdd = 0;
                            $tddate = $date->addDays($daysToAdd);
                    
    
                            // $dummstat = DB::select('call GetStatsByRegion(?,?,?)', array($service, $tddate, date('Y-m-d')));
                            $dummstat = DB::select('call GetStatsByAttenSpec(?,?,?,?)', array($service, $tddate, date('Y-m-d'), $stat->atten_id));
                            
                            // return $dummstat;
                            $rec=$dummstat[0]->Received - $dummstat[0]->Excess;
                            $i=$curr[0]->total+ $rec + $dummstat[0]->Deduction + $dummstat[0]->Discount - $dummstat[0]->Billed;
                            
                            $open=$i+$recived + $stat->Deduction + $stat->Discount - $stat->Billed;
                            $balance=$open + $stat->Billed - $recived - $stat->Deduction - $stat->Discount;
    
                        }


                    }

                    
                    if($stat->atten!=null)
                    {
                        $collection->push(
                            [
                                'By' => $stat->atten,
                                'Opening' => $open,
                                'Billed' => $stat->Billed,
                                'Received' => $recived,
                                'Deduction' => $stat->Deduction,
                                'Discount' => $stat->Discount,
                                'WrittenOff' => $stat->WrittenOff,
                                'Excess' => $stat->Excess,
                                'OldDebt' => $stat->OldDebt,
                                'Balance' =>$balance,
                                'IncomeTax' => $stat->IncomeTax,
                                'WithHold' => $stat->WithHold,
                                'Payable' => $stat->Payable,
                                'BankCharges' => $stat->BankCharges
                            ]
                        );
    
                    }

                   


                }

                $collection->all();
                return $collection;
            } else {
                $stats = DB::select('call 	GetStatsByRegionSpec(?,?,?,?)', array($service, $from_date, $to_date, $region));
            }



        } else if($by == "Insurer") {
            if ($region == 0) {

                // $stats = DB::select('call GetStatsByRegion(?,?,?,?)', array($service, $from_date, $to_date,$cat));

                $collection = collect([]);

                $insuers=Stats::getInsurers($cat);
                
                foreach ($insuers as $insuer) {

                $stats=Stats::getStatsByInsurer($service,$from_date,$to_date,$cat,$insuer);


                    $collection->push(
                        [
                            'By' => $stats['By'],
                            'Opening' => $stats['Opening'],
                            'Billed' => $stats['Billed'],
                            'Received' => $stats['Received'],
                            'Deduction' => $stats['Deduction'],
                            'Discount' => $stats['Discount'],
                            'WrittenOff' => $stats['WrittenOff'],
                            'Excess' => $stats['Excess'],
                            'OldDebt' => $stats['OldDebt'],
                            'Balance' =>$stats['Balance'],
                            'IncomeTax' => $stats['IncomeTax'],
                            'WithHold' => $stats['WithHold'],  
                            'Payable' => $stats['Payable'],
                            'BankCharges' => $stats['BankCharges']
                        ]
                    );



                }

                $collection->all();
                return $collection;
            } else {



                $collection = collect([]);


                $stats=Stats::getStatsByInsurer($service,$from_date,$to_date,$cat,$region);


                    $collection->push(
                        [
                            'By' => $stats['By'],
                            'Opening' => $stats['Opening'],
                            'Billed' => $stats['Billed'],
                            'Received' => $stats['Received'],
                            'Deduction' => $stats['Deduction'],
                            'Discount' => $stats['Discount'],
                            'WrittenOff' => $stats['WrittenOff'],
                            'Excess' => $stats['Excess'],
                            'OldDebt' => $stats['OldDebt'],
                            'Balance' =>$stats['Balance'],
                            'IncomeTax' => $stats['IncomeTax'],
                            'WithHold' => $stats['WithHold'],  
                            'Payable' => $stats['Payable'],
                            'BankCharges' => $stats['BankCharges']
                        ]
                    );



            
                $collection->all();
                return $collection;


            }



        } else if($by == "Category") {
            if ($region == 0) {

                // $stats = DB::select('call GetStatsByRegion(?,?,?,?)', array($service, $from_date, $to_date,$cat));

                $collection = collect([]);

                $insuers=Stats::getCategories();
                
                foreach ($insuers as $insuer) {

                $stats=Stats::getStatsByCategories($service,$from_date,$to_date,$insuer);


                    $collection->push(
                        [
                            'By' => $stats['By'],
                            'Opening' => $stats['Opening'],
                            'Billed' => $stats['Billed'],
                            'Received' => $stats['Received'],
                            'Deduction' => $stats['Deduction'],
                            'Discount' => $stats['Discount'],
                            'WrittenOff' => $stats['WrittenOff'],
                            'Excess' => $stats['Excess'],
                            'OldDebt' => $stats['OldDebt'],
                            'Balance' =>$stats['Balance'],
                            'IncomeTax' => $stats['IncomeTax'],
                            'WithHold' => $stats['WithHold'],  
                            'Payable' => $stats['Payable'],
                            'BankCharges' => $stats['BankCharges']
                        ]
                    );



                }

                $collection->all();
                return $collection;
            } else {



                $collection = collect([]);


                $stats=Stats::getStatsByInsurer($service,$from_date,$to_date,$cat,$region);


                    $collection->push(
                        [
                            'By' => $stats['By'],
                            'Opening' => $stats['Opening'],
                            'Billed' => $stats['Billed'],
                            'Received' => $stats['Received'],
                            'Deduction' => $stats['Deduction'],
                            'Discount' => $stats['Discount'],
                            'WrittenOff' => $stats['WrittenOff'],
                            'Excess' => $stats['Excess'],
                            'OldDebt' => $stats['OldDebt'],
                            'Balance' =>$stats['Balance'],
                            'IncomeTax' => $stats['IncomeTax'],
                            'WithHold' => $stats['WithHold'],  
                            'Payable' => $stats['Payable'],
                            'BankCharges' => $stats['BankCharges']
                        ]
                    );



            
                $collection->all();
                return $collection;


            }



         }

        return $stats;
    }

    public function getsitesstats(Request $request)
    {

        $service = $request->service;
        $from_date = date('Y-m-d', strtotime($request->from));
        $to_date = date('Y-m-d', strtotime($request->to));
        $region = $request->region;
        $by = $request->statsby;
        $cat = $request->statsCat;


        if ($by == "Region") {
            if ($region == 0) {

                $collection = collect([]);

                        $regions=DB::table('prism_jobs')
                        // ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
                        ->where('prism_jobs.type',$cat)
                        ->select('prism_jobs.region')
                        ->groupBy('prism_jobs.region')
                        ->get();
                        $items=collect([]);
                        
                        foreach($regions as $reg)
                        {

                            $items->push($reg->region);

                        }

                        $items->all();

                
                foreach ($items as $reg) {

                $stats=Stats::getSitesByRegion($service,$from_date,$to_date,$cat,$reg);


                    $collection->push(
                        [
                            'Region' => $stats['Region'],
                            'Opening' => $stats['Opening'],
                            'Added' => $stats['Added'],
                            'Closed' => $stats['Closed'],
                            'Cancelled' => $stats['Cancelled'],
                            'Hold' => $stats['Hold'],
                            'Balance' => $stats['Balance'],
                            'No' => $stats['No']
                        ]
                    );



                }

                $collection->all();
                return $collection;
            } else {


                $collection = collect([]);

                $stats=Stats::getSitesByRegion($service,$from_date,$to_date,$cat,$region);


                $collection->push(
                    [
                        'Region' => $stats['Region'],
                        'Opening' => $stats['Opening'],
                        'Added' => $stats['Added'],
                        'Closed' => $stats['Closed'],
                        'Cancelled' => $stats['Cancelled'],
                        'Hold' => $stats['Hold'],
                        'Balance' => $stats['Balance'],
                        'No' => $stats['No']
                    ]
                );

                return $collection;


                
            }
        } else if($by=="Bank") {

            if ($region == 0) {

                $stats = DB::select('call GetSitesByBank(?,?,?)', array($from_date,$to_date,$service));
                

                $collection = collect([]);

                foreach ($stats as $stat) {

                    $currjob=DB::table('c_jobs')
                    ->where('bank_id',$stat->bank_id)
                    ->where('status',0)
                    ->where('service',$service)
                    ->select(
                        DB::raw('count(id) as active')
                    )
                    ->get();

                    if($to_date==date('Y-m-d'))
                    {
                        $open=$currjob[0]->active+$stat->hold+$stat->cancelled+$stat->closed-$stat->added;
                        $balance=$open+$stat->added-$stat->closed-$stat->cancelled-$stat->hold;
    
                    }

                    else{

                        $date = Carbon::createFromFormat('Y-m-d', $to_date);
                        $daysToAdd = 0;
                        $tddate = $date->addDays($daysToAdd);
                

                        $dummstat = DB::select('call GetSitesByBankSpec(?,?,?,?)', array($tddate, date('Y-m-d'), $service,$stat->bank_id));
    
                        // $open=$i+$stat->hold+$stat->cancelled+$stat->closed-$stat->added;
                        $i=$currjob[0]->active+ $dummstat[0]->hold+$dummstat[0]->cancelled+$dummstat[0]->closed-$dummstat[0]->added;
  
                        // $rec=$dummstat[0]->Received - $dummstat[0]->Excess;
                        // $i=$curr[0]->total+ $rec + $dummstat[0]->Deduction + $dummstat[0]->Discount - $dummstat[0]->Billed;
                        
                        // $open=$i+$recived + $stat->Deduction + $stat->Discount - $stat->Billed;
                        // $balance=$open + $stat->Billed - $recived - $stat->Deduction - $stat->Discount;

                        $open=$i+$stat->hold+$stat->cancelled+$stat->closed-$stat->added;
                        $balance=$open+$stat->added-$stat->closed-$stat->cancelled-$stat->hold;
    
                    }

                    $collection->push(
                        [
                            'Region' => $stat->bank_name,
                            'Opening' => $open,
                            'Added' => $stat->added,
                            'Closed' => $stat->closed,
                            'Cancelled' => $stat->cancelled,
                            'Hold' => $stat->hold,
                            'Balance' => $balance,
                            'No' => 0


                        ]
                    );
                }

                $collection->all();
                return $collection;
            } else {
                $stats = DB::select('call GetSitesByBankSpec(?,?,?,?)', array($service, $from_date, $to_date, $region));
            }


        } else if($by=="Customer") {


            if ($region == 0) {

                $stats = DB::select('call GetSitesByRegion(?,?,?)', array($from_date,$to_date,$service));


                $collection = collect([]);

                foreach ($stats as $stat) {
                    $opening = DB::select('call	GetOpeningSite(?,?,?)', array($service, $stat->region_id, $from_date));
                    $balance = DB::select('call	GetBalanceSite(?,?,?)', array($service, $stat->region_id, $to_date));

                    $collection->push(
                        [
                            'Region' => $stat->city_name,
                            'Opening' => $opening[0]->Opening,
                            'Added' => $stat->added,
                            'Closed' => $stat->closed,
                            'Cancelled' => $stat->cancelled,
                            'Hold' => $stat->hold,
                            'Balance' => $balance[0]->Balance,
                            'No' => 0


                        ]
                    );
                }

                $collection->all();
                return $collection;
            } else {
                $stats = DB::select('call 	GetStatsByRegionSpec(?,?,?,?)', array($service, $from_date, $to_date, $region));
            }
        } else if($by=="City") {


            if ($region == 0) {

                $stats = DB::select('call GetSitesByRegion(?,?,?)', array($from_date,$to_date,$service));

                $collection = collect([]);

                foreach ($stats as $stat) {
                    $opening = DB::select('call	GetOpeningSite(?,?,?)', array($service, $stat->region_id, $from_date));
                    $balance = DB::select('call	GetBalanceSite(?,?,?)', array($service, $stat->region_id, $to_date));

                    $collection->push(
                        [
                            'Region' => $stat->city_name,
                            'Opening' => $opening[0]->Opening,
                            'Added' => $stat->added,
                            'Closed' => $stat->closed,
                            'Cancelled' => $stat->cancelled,
                            'Hold' => $stat->hold,
                            'Balance' => $balance[0]->Balance,
                            'No' => 0


                        ]
                    );
                }

                $collection->all();
                return $collection;
            } else {
                $stats = DB::select('call 	GetStatsByRegionSpec(?,?,?,?)', array($service, $from_date, $to_date, $region));
            }
        } else if($by=="Insurer") {

            $collection = collect([]);

            $regions=DB::table('prism_jobs')
            // ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
            ->where('prism_jobs.type',$cat)
            ->select('prism_jobs.insurer')
            ->groupBy('prism_jobs.insurer')
            ->get();

            $items=collect([]);
            
            foreach($regions as $reg)
            {

                $items->push($reg->insurer);

            }

            $items->all();

    
                foreach ($items as $reg) {

                $stats=Stats::getSitesByInsurer($service,$from_date,$to_date,$cat,$reg);


                    $collection->push(
                        [
                            'Region' => $stats['Region'],
                            'Opening' => $stats['Opening'],
                            'Added' => $stats['Added'],
                            'Closed' => $stats['Closed'],
                            'Cancelled' => $stats['Cancelled'],
                            'Hold' => $stats['Hold'],
                            'Balance' => $stats['Balance'],
                            'No' => $stats['No']
                        ]
                    );



                }

                $collection->all();
                return $collection;

        } else if($by=="Category") {

            $collection = collect([]);

            $regions=DB::table('prism_jobs')
            // ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
            // ->where('prism_jobs.type',$cat)
            ->select('prism_jobs.survey_type')
            ->groupBy('prism_jobs.survey_type')
            ->get();

            $items=collect([]);
            
            foreach($regions as $reg)
            {

                $items->push($reg->survey_type);

            }

            $items->all();

    
                foreach ($items as $reg) {

                $stats=Stats::getSitesByCategory($service,$from_date,$to_date,$cat,$reg);


                    $collection->push(
                        [
                            'Region' => $stats['Region'],
                            'Opening' => $stats['Opening'],
                            'Added' => $stats['Added'],
                            'Closed' => $stats['Closed'],
                            'Cancelled' => $stats['Cancelled'],
                            'Hold' => $stats['Hold'],
                            'Balance' => $stats['Balance'],
                            'No' => $stats['No']
                        ]
                    );



                }

                $collection->all();
                return $collection;

        }

        return $stats;
    }
    public function getaging(Request $request)
    {

        $service = $request->service;
        $region =  $request->region;
        $by = $request->statsby;


        if ($by == "Region") {
            if ($region == 0) {
                // $aging = DB::select('select * from get_aging');
                //  dd($aging);
                $aging = DB::select('call GetAging(?)', array($service));






            } else {
                // DB::select('select * from users where id = ?', [1])
                // $aging = DB::select('select * from get_aging where region_id = ?', [$region]);
                $aging = DB::select('call GetAging(?)', array($service));

            }
        }
        else if ($by == "Bank") {
            if ($region == 0) {
                // $aging = DB::select('select * from get_aging');
                //  dd($aging);
                $aging = DB::select('call GetAgingByBank(?)', array($service));






            } else {
                // DB::select('select * from users where id = ?', [1])
                // $aging = DB::select('select * from get_aging where region_id = ?', [$region]);
                $aging = DB::select('call GetAgingByBank(?)', array($service));

            }
        }
        else {

            if ($region == 0) {
                // $aging = DB::select('select * from get_aging');
                //  dd($aging);
                $aging = DB::select('call GetAging(?)', array($service));






            } else {
                // DB::select('select * from users where id = ?', [1])
                // $aging = DB::select('select * from get_aging where region_id = ?', [$region]);
                $aging = DB::select('call GetAging(?)', array($service));

            }


        }

        return $aging;
    }
    public function getBilling(Request $request){
        
        $region=DB::table('c_region')
        ->leftJoin('c_city','c_region.reg_city_id','c_city.city_id')
        ->select('c_city.city_name as region','c_region.reg_id')
        ->get();

        $service="Livestock";
        $from="2021-1-1";
        $to="2022-9-16";

        $recs=collect([]);

        foreach($region as $reg)
        {
            
            if($service=="Livestock")
            {
                $recs->push([
                    'Region'=>$reg->region,
                    'Livestock'=>intval(Stats::getBilling('Livestock',$from,$to,$reg->reg_id)),
                    'Verification'=>0
                ]);
            }
            else if("Verification")
            {
                $recs->push([
                    'Region'=>$reg->region,
                    'Livestock'=>0,
                    'Verification'=>intval(Stats::getBilling('Verification',$from,$to,$reg->reg_id))
                ]);
            }

        }
        $recs->all();

        return $recs;
    }

    public function getOutstanding(Request $request){
        
        $region=DB::table('c_region')
        ->leftJoin('c_city','c_region.reg_city_id','c_city.city_id')
        ->select('c_city.city_name as region','c_region.reg_id as reg_id')
        ->get();

        $service="Verification";
        $recs=collect([]);

        foreach($region as $reg)
        {
            
            if($service=="Livestock")
            {
                $recs->push([
                    'Region'=>$reg->region,
                    'Livestock'=>intval(Stats::getOutstandingByService('Livestock',$reg->reg_id)),
                    'Verification'=>0
                ]);
            }
            else if("Verification")
            {
                $recs->push([
                    'Region'=>$reg->region,
                    'Livestock'=>0,
                    'Verification'=>intval(Stats::getOutstandingByService('Verification',$reg->reg_id))
                ]);
            }

        }
        $recs->all();

        return $recs;
    }
    public function getOpening(Request $request)
    {

        // $service = $request->service;
        // $from = $request->from;
        // $region = $request->region;
        $service = "Livestock";
        $to = "2021-12-21";
        $region = 1;

        $stats = DB::table('stats_logs')
            ->where([
                ['service', '=', $service],
                ['region', '=', $region],
                ['date', '<', $to],
            ])
            ->get();



        return $stats;
        // return response()->json($stats);
    }
    public function getBalance(Request $request)
    {

        // $service = $request->service;
        // $from = $request->from;
        // $region = $request->region;
        $service = "Livestock";
        $to = "2021-12-21";
        $region = 1;

        $stats = DB::table('stats_logs')
            ->get();



        return $stats[0]->Balance;
    }
}
