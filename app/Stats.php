<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class Stats extends Model
{

    public static function getopening($date,$reg,$service,$discountamount){


        $recs=DB::Select('call GetOpeningList(?,?,?)',array($date,$reg,$service));

        $items=collect([]);

        $count=0;
        $total=0;
        $discount=0;
        $tax=0;
        $servicech=0;
        foreach($recs as $rec)
        {
            if($rec->bill_id!=0)
            {
                $items->push(abs($rec->bill_id));


            }
        }
        $items->all();


        $bills=collect();
        foreach($items as $item)
        {
            $bl=DB::table('bill')->where('id',$item)->select('*')->get();
            // $bills->push([
            //     'bill_id'=>$bl[0]->bill_number,
            //     'total_amount'=>$bl[0]->total_amount,
            //     // 'discount'=>$bl[0]->discount,
            //     'status'=>$bl[0]->status
            // ]);

            $total+=$bl[0]->total_amount;
            $discount+=$bl[0]->discount;
            $tax+=$bl[0]->tax;
            // $count+=1;
            
        }

        // return $total+$discountamount;
        // $final=(($total-$tax)+$discount)+$tax;
 
        // return $final-$discount;
        return $total;

        // return $total;

        // return $items;

        // $bills->all();

        // echo  $total."|".$discount;
        // if($discountamount==0)
        // {
            
        //    return $total;

        // }

        // else{

        //     return  $total+$discount;

        // }

        // ret
    }
    public static function getOutstandingByService($service,$reg){

         $rec=DB::table('bill')
         ->where('service',$service)
         ->where('recievable',$reg)
         ->where('status','Receivable')
         ->select(
            DB::raw('sum(bill.total_amount) as total')
        )->get();

        return $rec[0]->total;

    }
    public static function getBilling($service,$from,$to,$reg){

         $rec=DB::table('bill')
         ->where('service',$service)
         ->where('recievable',$reg)
         ->whereBetween('bill_date', [$from, $to])
        ->whereIn('status',['Receivable','Pending','Paid','Written'])
         ->select(
            DB::raw('sum(bill.total_amount) as total')
        )->get();

        return $rec[0]->total;

    }

    

  


    public static function getbalance($date,$reg,$service,$discountamount){


        $recs=DB::Select('call GetOpeningList(?,?,?)',array($date,$reg,$service));

        $items=collect([]);

        $count=0;
        $total=0;
        $discount=0;
        $tax=0;
        $service=0;
        foreach($recs as $rec)
        {
            if($rec->bill_id!=0)
            {
                $items->push(abs($rec->bill_id));


            }
        }
        $items->all();


        $bills=collect();
        
        foreach($items as $item)
        {
            $bl=DB::table('bill')->where('id',$item)->select('*')->get();
            // $bills->push([
            //     'bill_id'=>$bl[0]->bill_number,
            //     'total_amount'=>$bl[0]->total_amount,
            //     // 'discount'=>$bl[0]->discount,
            //     'status'=>$bl[0]->status
            // ]);

            $total+=$bl[0]->total_amount;
            $discount+=$bl[0]->discount;
            $tax+=$bl[0]->tax;
            // echo $bl[0]->id."<br>";
            
            
        }

        // $total=$total+$discount;
        // $service=$total-$tax;
        // $final=(($total-$tax)+$discount)+$tax;

        // return $final-$discount;
        return $total;

        // $bills->all();

        // return $total+$discount;

        // if($discountamount==0)
        // {
            
        //    echo $total."|".$discount;
            // echo $total."|".$discount;
        // }

        // else{

            // return  $total-$discount;
            // echo $total."|".$discount;

        // }
    }

    public static function getRegions($cat)
    {
        $regions=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
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

        return $items;



    }
    public static function getStatsByRegion($service,$from,$to,$cat,$reg){
    
        
        $stat=new Stats;
        $stats = $stat->getStatsByRegionData($service,$from,$to,$cat,$reg);

        $recived= $stats[0]->Received - $stats[0]->Excess;


        $curr=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->where('bill.service','=',$service)
        ->where('prism_jobs.type','=',$cat)
        ->where('prism_jobs.region','=',$reg)
        ->whereIn('bill.status',['Receivable','Pending'])
        ->select(
            DB::raw('sum(bill.total_amount) as total')
        )
        ->get();

        if($to==date('Y-m-d'))
        {

            $open=$curr[0]->total+$recived + $stats[0]->Deduction + $stats[0]->Discount - $stats[0]->Billed;
            $balance=$open + $stats[0]->Billed - $recived - $stats[0]->Deduction - $stats[0]->Discount;

        }

        else{

            $date = Carbon::createFromFormat('Y-m-d', $to);
            $daysToAdd = 0;
            $tddate = $date->addDays($daysToAdd);
    

            // $dummstat = DB::select('call GetStatsByRegionSpec(?,?,?,?,?)', array($service, $tddate, date('Y-m-d'), $stat->region_id,$cat));
            $dummstat = $stat->getStatsByRegionData($service,$tddate,date('Y-m-d'),$cat,$reg);
            
            $rec=$dummstat[0]->Received - $dummstat[0]->Excess;
            $i=$curr[0]->total+ $rec + $dummstat[0]->Deduction + $dummstat[0]->Discount - $dummstat[0]->Billed;
            
            $open=$i+$recived + $stats[0]->Deduction + $stats[0]->Discount - $stats[0]->Billed;
            $balance=$open + $stats[0]->Billed - $recived - $stats[0]->Deduction - $stats[0]->Discount;


        }

        $data=[

            'By' => $stats[0]->Region,
            'Opening' => $open,
            'Billed' => $stats[0]->Billed,
            'Received' => $recived,
            'Deduction' => $stats[0]->Deduction,
            'Discount' => $stats[0]->Discount,
            'WrittenOff' => $stats[0]->WrittenOff,
            'Excess' => $stats[0]->Excess,
            'OldDebt' => $stats[0]->OldDebt,
            'Balance' =>$balance,
            'IncomeTax' => $stats[0]->IncomeTax,
            'WithHold' => $stats[0]->WithHold,  
            'Payable' => $stats[0]->Payable,
            'BankCharges' => $stats[0]->BankCharges
        ];

        return $data;
    
    
    }


    public static function getStatsByRegionData($service,$from,$to,$cat,$reg){

     
            $data=DB::table('bill')
            ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
            ->leftJoin('c_region','prism_jobs.region','=','c_region.reg_id')
            ->leftJoin('c_city','c_region.reg_city_id','=','c_city.city_id')
            ->leftJoin('receipts','bill.receipt_id','=','receipts.id')
            ->where('bill.service',$service)
            ->where('prism_jobs.region',$reg)
            ->where('prism_jobs.type',$cat)
            ->select(
                'c_city.city_name as Region',            
                'prism_jobs.region as region_id',
                DB::raw('SUM(CASE WHEN bill.bill_date BETWEEN "'.$from.'" and "'.$to.'" and bill.status IN ("Receivable","Pending","Paid","Written")  THEN bill.total_amount+bill.discount ELSE 0 END) as Billed'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.net_amount ELSE 0 END) as Received'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.deduction ELSE 0 END) as Deduction'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.excess ELSE 0 END) as Excess'),            
                DB::raw('SUM(CASE WHEN  bill.updated_at BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.discount ELSE 0 END) as Discount'),            
                DB::raw('SUM(CASE WHEN bill.is_old_debt=1  THEN bill.total_amount ELSE 0 END) as OldDebt'),            
                DB::raw('SUM(CASE WHEN bill.status="Written" AND bill.updated_at BETWEEN "'.$from.'" and "'.$to.'" THEN bill.total_amount ELSE 0 END) as WrittenOff'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.itax ELSE 0 END) as IncomeTax'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"   THEN bill.stax_whld ELSE 0 END) as "WithHold"'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.stax_payable ELSE 0 END) as "Payable"'),           
                DB::raw(' SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.bank_charges ELSE 0 END) as BankCharges'),           
                DB::raw(' SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.excess ELSE 0 END) as Extra')           
            )
            ->groupBy('prism_jobs.region')
            ->get();
      

        return $data;
    }
    public static function getInsurers($cat)
    {
        $regions=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
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

        return $items;



    }
    public static function getStatsByInsurer($service,$from,$to,$cat,$ins){
    
        
        $stat=new Stats;
        $stats = $stat->getStatsByInsurerData($service,$from,$to,$cat,$ins);

        $recived=$stats[0]->Received- $stats[0]->Excess;


        $curr=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->where('bill.service','=',$service)
        ->where('prism_jobs.type','=',$cat)
        ->where('prism_jobs.insurer','=',$ins)
        ->whereIn('bill.status',['Receivable','Pending'])
        ->select(
            DB::raw('sum(bill.total_amount) as total')
        )
        ->get();

        if($to==date('Y-m-d'))
        {

            $open=$curr[0]->total+$recived + $stats[0]->Deduction + $stats[0]->Discount - $stats[0]->Billed;
            $balance=$open + $stats[0]->Billed - $recived - $stats[0]->Deduction - $stats[0]->Discount;

        }

        else{

            $date = Carbon::createFromFormat('Y-m-d', $to);
            $daysToAdd = 0;
            $tddate = $date->addDays($daysToAdd);
    

            // $dummstat = DB::select('call GetStatsByRegionSpec(?,?,?,?,?)', array($service, $tddate, date('Y-m-d'), $stat->region_id,$cat));
            $dummstat = $stat->getStatsByInsurerData($service,$tddate,date('Y-m-d'),$cat,$ins);
            
            $rec=$dummstat[0]->Received - $dummstat[0]->Excess;
            $i=$curr[0]->total+ $rec + $dummstat[0]->Deduction + $dummstat[0]->Discount - $dummstat[0]->Billed;
            
            $open=$i+$recived + $stats[0]->Deduction + $stats[0]->Discount - $stats[0]->Billed;
            $balance=$open + $stats[0]->Billed - $recived - $stats[0]->Deduction - $stats[0]->Discount;


        }

        $data=[

            'By' => $stats[0]->Region,
            'Opening' => $open,
            'Billed' => $stats[0]->Billed,
            'Received' => $recived,
            'Deduction' => $stats[0]->Deduction,
            'Discount' => $stats[0]->Discount,
            'WrittenOff' => $stats[0]->WrittenOff,
            'Excess' => $stats[0]->Excess,
            'OldDebt' => $stats[0]->OldDebt,
            'Balance' =>$balance,
            'IncomeTax' => $stats[0]->IncomeTax,
            'WithHold' => $stats[0]->WithHold,  
            'Payable' => $stats[0]->Payable,
            'BankCharges' => $stats[0]->BankCharges
        ];

        return $data;
    
    
    }
    public static function getStatsByInsurerData($service,$from,$to,$cat,$ins){

     
            $data=DB::table('bill')
            ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
            ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
            ->leftJoin('receipts','bill.receipt_id','=','receipts.id')
            ->where('bill.service',$service)
            ->where('prism_jobs.insurer',$ins)
            ->where('prism_jobs.type',$cat)
            ->select(
                'prism_insurers.name as Region',            
                'prism_jobs.insurer as region_id',
                DB::raw('SUM(CASE WHEN bill.bill_date BETWEEN "'.$from.'" and "'.$to.'" and bill.status IN ("Receivable","Pending","Paid","Written")  THEN bill.total_amount+bill.discount ELSE 0 END) as Billed'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.net_amount ELSE 0 END) as Received'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.deduction ELSE 0 END) as Deduction'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.excess ELSE 0 END) as Excess'),            
                DB::raw('SUM(CASE WHEN  bill.updated_at BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.discount ELSE 0 END) as Discount'),            
                DB::raw('SUM(CASE WHEN bill.is_old_debt=1  THEN bill.total_amount ELSE 0 END) as OldDebt'),            
                DB::raw('SUM(CASE WHEN bill.status="Written" AND bill.updated_at BETWEEN "'.$from.'" and "'.$to.'" THEN bill.total_amount ELSE 0 END) as WrittenOff'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.itax ELSE 0 END) as IncomeTax'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"   THEN bill.stax_whld ELSE 0 END) as "WithHold"'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.stax_payable ELSE 0 END) as "Payable"'),           
                DB::raw(' SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.bank_charges ELSE 0 END) as BankCharges'),           
                DB::raw(' SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.excess ELSE 0 END) as Extra')           
            )
            ->groupBy('prism_jobs.insurer')
            ->get();
      

        return $data;
    }

    public static function getNull()
    {
        return DB::table('prism_jobs')
        ->select(
            DB::raw('GROUP_CONCAT(DISTINCT id)')
        )
        ->groupBy('is_completed')
        ->get();

    }
    public static function getCategories()
    {
        $regions=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
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

        return $items;



    }
    public static function getStatsByCategories($service,$from,$to,$ins){
    
        
        $stat=new Stats;
        $stats = $stat->getStatsByCategoriesData($service,$from,$to,$ins);

        $recived=$stats[0]->Received- $stats[0]->Excess;


        $curr=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->where('bill.service','=',$service)
        ->where('prism_jobs.survey_type','=',$ins)
        ->whereIn('bill.status',['Receivable','Pending'])
        ->select(
            DB::raw('sum(bill.total_amount) as total')
        )
        ->get();

        if($to==date('Y-m-d'))
        {

            $open=$curr[0]->total+$recived + $stats[0]->Deduction + $stats[0]->Discount - $stats[0]->Billed;
            $balance=$open + $stats[0]->Billed - $recived - $stats[0]->Deduction - $stats[0]->Discount;

        }

        else{

            $date = Carbon::createFromFormat('Y-m-d', $to);
            $daysToAdd = 0;
            $tddate = $date->addDays($daysToAdd);
    

            // $dummstat = DB::select('call GetStatsByRegionSpec(?,?,?,?,?)', array($service, $tddate, date('Y-m-d'), $stat->region_id,$cat));
            $dummstat = $stat->getStatsByCategoriesData($service,$tddate,date('Y-m-d'),$ins);
            
            $rec=$dummstat[0]->Received - $dummstat[0]->Excess;
            $i=$curr[0]->total+ $rec + $dummstat[0]->Deduction + $dummstat[0]->Discount - $dummstat[0]->Billed;
            
            $open=$i+$recived + $stats[0]->Deduction + $stats[0]->Discount - $stats[0]->Billed;
            $balance=$open + $stats[0]->Billed - $recived - $stats[0]->Deduction - $stats[0]->Discount;


        }

        $data=[

            'By' => $stats[0]->Region,
            'Opening' => $open,
            'Billed' => $stats[0]->Billed,
            'Received' => $recived,
            'Deduction' => $stats[0]->Deduction,
            'Discount' => $stats[0]->Discount,
            'WrittenOff' => $stats[0]->WrittenOff,
            'Excess' => $stats[0]->Excess,
            'OldDebt' => $stats[0]->OldDebt,
            'Balance' =>$balance,
            'IncomeTax' => $stats[0]->IncomeTax,
            'WithHold' => $stats[0]->WithHold,  
            'Payable' => $stats[0]->Payable,
            'BankCharges' => $stats[0]->BankCharges
        ];

        return $data;
    
    
    }
    public static function getStatsByCategoriesData($service,$from,$to,$ins){

     
            $data=DB::table('bill')
            ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
            ->leftJoin('prism_surveys_types','prism_jobs.survey_type','=','prism_surveys_types.id')
            ->leftJoin('receipts','bill.receipt_id','=','receipts.id')
            ->where('bill.service',$service)
            ->where('prism_jobs.survey_type',$ins)
            ->select(
                'prism_surveys_types.name as Region',            
                'prism_jobs.insurer as region_id',
                DB::raw('SUM(CASE WHEN bill.bill_date BETWEEN "'.$from.'" and "'.$to.'" and bill.status IN ("Receivable","Pending","Paid","Written")  THEN bill.total_amount+bill.discount ELSE 0 END) as Billed'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.net_amount ELSE 0 END) as Received'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.deduction ELSE 0 END) as Deduction'),            
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.excess ELSE 0 END) as Excess'),            
                DB::raw('SUM(CASE WHEN  bill.updated_at BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.discount ELSE 0 END) as Discount'),            
                DB::raw('SUM(CASE WHEN bill.is_old_debt=1  THEN bill.total_amount ELSE 0 END) as OldDebt'),            
                DB::raw('SUM(CASE WHEN bill.status="Written" AND bill.updated_at BETWEEN "'.$from.'" and "'.$to.'" THEN bill.total_amount ELSE 0 END) as WrittenOff'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.itax ELSE 0 END) as IncomeTax'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"   THEN bill.stax_whld ELSE 0 END) as "WithHold"'),           
                DB::raw('SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.stax_payable ELSE 0 END) as "Payable"'),           
                DB::raw(' SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.bank_charges ELSE 0 END) as BankCharges'),           
                DB::raw(' SUM(CASE WHEN bill.status="Paid" AND receipts.receipt_date BETWEEN "'.$from.'" and "'.$to.'"  THEN bill.excess ELSE 0 END) as Extra')           
            )
            ->groupBy('prism_jobs.survey_type')
            ->get();
      

        return $data;
    }




    public static function getSitesByRegionData($service,$from,$to,$cat,$reg){

     
            $data=DB::table('prism_jobs')
            ->leftJoin('c_region','prism_jobs.region','=','c_region.reg_id')
            ->leftJoin('c_city','c_region.reg_city_id','=','c_city.city_id')
            ->where('prism_jobs.region',$reg)
            // ->where('bill.recievable',$reg)
            ->where('prism_jobs.type',$cat)
            ->select(
                'c_city.city_name',            
                'prism_jobs.region as region_id',
                DB::raw('COUNT(CASE WHEN prism_jobs.created_at BETWEEN "'.$from.'" and "'.$to.'"  THEN prism_jobs.id END) as added'),            
                DB::raw('COUNT(CASE WHEN prism_jobs.cancelled_date  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=3 THEN prism_jobs.id END) as cancelled'),
                DB::raw('COUNT(CASE WHEN prism_jobs.completed_on  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=1 THEN prism_jobs.id END) as closed'),
                DB::raw('COUNT(CASE WHEN prism_jobs.hold_date  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=2 THEN prism_jobs.id END) as hold')            
             )
            ->groupBy('prism_jobs.region')
            ->get();
      

        return $data;
    }

    public static function getSitesByRegion($service,$from,$to,$cat,$reg){
    
        
        $stat=new Stats;
        $stats = $stat->getSitesByRegionData($service,$from,$to,$cat,$reg);

        $currjob=DB::table('prism_jobs')
        ->where('region',$reg)
        ->where('is_completed',0)
        ->where('type',$cat)
        ->select(
            DB::raw('count(id) as active')
        )
        ->get();

        if($to==date('Y-m-d'))
        {
            $open=$currjob[0]->active+$stats[0]->hold+$stats[0]->cancelled+$stats[0]->closed-$stats[0]->added;
            $balance=$open+$stats[0]->added-$stats[0]->closed-$stats[0]->cancelled-$stats[0]->hold;

        }

        else{

            $date = Carbon::createFromFormat('Y-m-d', $to);
            $daysToAdd = 0;
            $tddate = $date->addDays($daysToAdd);
    

            $dummstat = $stat->getSitesByRegionData($service,$tddate,date('Y-m-d'),$cat,$reg);
            // $dummstat = DB::select('call GetSitesByRegionSpec(?,?,?,?)', array($tddate, date('Y-m-d'), $service,$stat->region_id));

            $i=$currjob[0]->active+$dummstat[0]->hold+$dummstat[0]->cancelled+$dummstat[0]->closed  -$dummstat[0]->added;

            $open=$i+$stats[0]->hold+$stats[0]->cancelled+$stats[0]->closed-$stats[0]->added;
            $balance=$open+$stats[0]->added-$stats[0]->closed-$stats[0]->cancelled-$stats[0]->hold;

        }

        $data=[
                'Region' => $stats[0]->city_name,
                'Opening' => $open,
                'Added' => $stats[0]->added,
                'Closed' => $stats[0]->closed,
                'Cancelled' => $stats[0]->cancelled,
                'Hold' => $stats[0]->hold,
                'Balance' => $balance,
                'No' => 0


        ];

        return $data;
    
    
    }


    public static function getSitesByInsurerData($service,$from,$to,$cat,$reg){

     
        $data=DB::table('prism_jobs')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->where('prism_jobs.insurer',$reg)
        // ->where('bill.recievable',$reg)
        ->where('prism_jobs.type',$cat)
        ->select(
            'prism_insurers.name as city_name',            
            'prism_jobs.insurer as region_id',
            DB::raw('COUNT(CASE WHEN prism_jobs.created_at BETWEEN "'.$from.'" and "'.$to.'"  THEN prism_jobs.id END) as added'),            
            DB::raw('COUNT(CASE WHEN prism_jobs.cancelled_date  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=3 THEN prism_jobs.id END) as cancelled'),
            DB::raw('COUNT(CASE WHEN prism_jobs.completed_on  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=1 THEN prism_jobs.id END) as closed'),
            DB::raw('COUNT(CASE WHEN prism_jobs.hold_date  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=2 THEN prism_jobs.id END) as hold')            
         )
        ->groupBy('prism_jobs.insurer')
        ->get();
  

     return $data;
    }

    public static function getSitesByInsurer($service,$from,$to,$cat,$reg){

    
        $stat=new Stats;
        $stats = $stat->getSitesByInsurerData($service,$from,$to,$cat,$reg);

        $currjob=DB::table('prism_jobs')
        ->where('insurer',$reg)
        ->where('is_completed',0)
        ->where('type',$cat)
        ->select(
            DB::raw('count(id) as active')
        )
        ->get();

        if($to==date('Y-m-d'))
        {
            $open=$currjob[0]->active+$stats[0]->hold+$stats[0]->cancelled+$stats[0]->closed-$stats[0]->added;
            $balance=$open+$stats[0]->added-$stats[0]->closed-$stats[0]->cancelled-$stats[0]->hold;

        }

        else{

            $date = Carbon::createFromFormat('Y-m-d', $to);
            $daysToAdd = 0;
            $tddate = $date->addDays($daysToAdd);


            $dummstat = $stat->getSitesByInsurerData($service,$tddate,date('Y-m-d'),$cat,$reg);
            // $dummstat = DB::select('call GetSitesByRegionSpec(?,?,?,?)', array($tddate, date('Y-m-d'), $service,$stat->region_id));

            $i=$currjob[0]->active+$dummstat[0]->hold+$dummstat[0]->cancelled+$dummstat[0]->closed  -$dummstat[0]->added;

            $open=$i+$stats[0]->hold+$stats[0]->cancelled+$stats[0]->closed-$stats[0]->added;
            $balance=$open+$stats[0]->added-$stats[0]->closed-$stats[0]->cancelled-$stats[0]->hold;

        }

        $data=[
                'Region' => $stats[0]->city_name,
                'Opening' => $open,
                'Added' => $stats[0]->added,
                'Closed' => $stats[0]->closed,
                'Cancelled' => $stats[0]->cancelled,
                'Hold' => $stats[0]->hold,
                'Balance' => $balance,
                'No' => 0


        ];

        return $data;


    }


    public static function getSitesByCategoryData($service,$from,$to,$cat,$reg){

     
        $data=DB::table('prism_jobs')
        ->leftJoin('prism_surveys_types','prism_jobs.survey_type','=','prism_surveys_types.id')
        ->where('prism_jobs.survey_type',$reg)
        // ->where('bill.recievable',$reg)
        // ->where('prism_jobs.type',$cat)
        ->select(
            'prism_surveys_types.name as city_name',            
            'prism_jobs.survey_type as region_id',
            DB::raw('COUNT(CASE WHEN prism_jobs.created_at BETWEEN "'.$from.'" and "'.$to.'"  THEN prism_jobs.id END) as added'),            
            DB::raw('COUNT(CASE WHEN prism_jobs.cancelled_date  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=3 THEN prism_jobs.id END) as cancelled'),
            DB::raw('COUNT(CASE WHEN prism_jobs.completed_on  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=1 THEN prism_jobs.id END) as closed'),
            DB::raw('COUNT(CASE WHEN prism_jobs.hold_date  between "'.$from.'" and "'.$to.'" and prism_jobs.is_completed=2 THEN prism_jobs.id END) as hold')            
         )
        ->groupBy('prism_jobs.survey_type')
        ->get();
  

     return $data;
    }

    public static function getSitesByCategory($service,$from,$to,$cat,$reg){

    
        $stat=new Stats;
        $stats = $stat->getSitesByCategoryData($service,$from,$to,$cat,$reg);

        $currjob=DB::table('prism_jobs')
        ->where('survey_type',$reg)
        ->where('is_completed',0)
        // ->where('type',$cat)
        ->select(
            DB::raw('count(id) as active')
        )
        ->get();

        if($to==date('Y-m-d'))
        {
            $open=$currjob[0]->active+$stats[0]->hold+$stats[0]->cancelled+$stats[0]->closed-$stats[0]->added;
            $balance=$open+$stats[0]->added-$stats[0]->closed-$stats[0]->cancelled-$stats[0]->hold;

        }

        else{

            $date = Carbon::createFromFormat('Y-m-d', $to);
            $daysToAdd = 0;
            $tddate = $date->addDays($daysToAdd);


            $dummstat = $stat->getSitesByCategoryData($service,$tddate,date('Y-m-d'),$cat,$reg);
            // $dummstat = DB::select('call GetSitesByRegionSpec(?,?,?,?)', array($tddate, date('Y-m-d'), $service,$stat->region_id));

            $i=$currjob[0]->active+$dummstat[0]->hold+$dummstat[0]->cancelled+$dummstat[0]->closed  -$dummstat[0]->added;

            $open=$i+$stats[0]->hold+$stats[0]->cancelled+$stats[0]->closed-$stats[0]->added;
            $balance=$open+$stats[0]->added-$stats[0]->closed-$stats[0]->cancelled-$stats[0]->hold;

        }

        $data=[
                'Region' => $stats[0]->city_name,
                'Opening' => $open,
                'Added' => $stats[0]->added,
                'Closed' => $stats[0]->closed,
                'Cancelled' => $stats[0]->cancelled,
                'Hold' => $stats[0]->hold,
                'Balance' => $balance,
                'No' => 0


        ];

        return $data;


    }



    


    

}
