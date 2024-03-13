<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use File;
use Image;
use App\Change;
use App\Stats;

class ChangesController extends Controller
{

    public function compressFiles(){



        
        // $surveys=DB::table('verification_surveys')
        // ->where('status',1)
        // ->where('image1','!=','')
        // ->select('id','image1','job_id')
        // ->get();

        $id=1466;
        return redirect()->route("/compress/".$id);
        
        // foreach($surveys as $survey)
        // {

        //     Change::compressurvey($survey);
        //     // return back();

        // }



    
    }

    public function updateBills(){

        $bills=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->where('bill.status','Receivable')
        ->select(
            'prism_jobs.service_charges as bill_charges',
            'bill.total_amount',
            'bill.tax',
            'prism_jobs.snaps',
            'prism_jobs.re_inspection_charges',
            'prism_jobs.extra_visit',
            'prism_jobs.travelling',
            'bill.status',
        'bill.id','bill.bill_number')
        ->get();


        foreach($bills as $bill)
        {
                DB::table('bill')
                ->where('id',$bill->id)
                ->update([
                    'service_charges'=>$bill->bill_charges,
                    'other_charges'=>$bill->snaps+$bill->re_inspection_charges+$bill->extra_visit+$bill->travelling
                ]);

                echo  ($bill->bill_charges + $bill->tax + $bill->snaps + $bill->re_inspection_charges + $bill->extra_visit + $bill->travelling)-$bill->total_amount. " Bill: ".$bill->status." <br>";
        }
    
    }
    public function compress($jobid){

            Change::compressurvey($jobid);

    }

    
    public function reduceSize(){

        $surveys=DB::table('verification_surveys')
        ->where('status',1)
        ->where('image1','!=','')
        ->select('id','image1','job_id')
        ->get();
        
            $total=count($surveys);
            $filecount=0;
            $filesize=0;
            $nofilecount=0;
            foreach($surveys as $survey)
            {
                        $job_id=$survey->job_id;
                        $path='Reports/Verification/'.$job_id.'/Survey/'.$survey->id.'/images.pdf';
                        if (Storage::disk('dir')->exists($path)) {
                            $filesize+=number_format(Storage::disk('dir')->size($path) / 1048576,2);

                            File::delete($path);
                            // echo 'Img found '. $survey->id.' <br>';
                            $filecount+=1;


                        }
                        else{

                            // echo 'File not found of survey '.$survey->id."<br>";
                            
                            $nofilecount+=1;

                        }

            }

            echo 'Total: '.$total."<br>";
            echo 'Files Exist: '.$filecount."<br>";
            echo 'No File Exist: '.$nofilecount."<br>";
            echo 'Total: '.$filesize." MB<br>";

    }

    public function getStats()
    {

        return Stats::getbalance("2022-9-13",1,'Livestock',0)."<br>";
        // echo Stats::getbalance("2022-9-13",1,"Livestock",1,"2022-9-6")."<br>";
        // echo Stats::getbalance($date,1,'Verification');

        // date("Y-m-d", strtotime('+ '.daysToAdd , strtotime('2022-4-1')));

    }

    public function newStats(){
        
        $bills=DB::table('bill')
        ->leftJoin('receipts','bill.receipt_id','=','receipts.id')
        ->where('bill.recievable',1)
        // ->where('bill.service','Livestock')
        ->select('bill.id','bill.total_amount','bill.status','bill.updated_at','receipts.recieved_on','receipts.receipt_date')
        ->get();

        // return $bills;
        $total=0;
        foreach($bills as $bill)
        {   

            if($bill->status=="Receivable")
            {
                // echo $bill->bill_number.'|'.$bill->bill_date.'|'.$bill->opens_at."<br>";
                $total+=$bill->total_amount;
                DB::table('bill')->where('id',$bill->id)->update([
                    'opens_at'=>date('Y-m-d')
                ]);
            
            }

            else if($bill->status=="Pending")
            {
                // $total+=$bill->total_amount;
                DB::table('bill')->where('id',$bill->id)->update([
                    'opens_at'=>date('Y-m-d')
                ]);
            }

            else if($bill->status=="Paid")
            {
                // $total+=$bill->total_amount;
                DB::table('bill')->where('id',$bill->id)->update([
                    'opens_at'=>date('Y-m-d', strtotime('-1 day', strtotime($bill->receipt_date)))
                ]);
            }

            
            else if($bill->status=="Written")
            {
                // $total+=$bill->total_amount;
                DB::table('bill')->where('id',$bill->id)->update([
                    'opens_at'=>date('Y-m-d', strtotime('-1 day', strtotime($bill->updated_at)))
                ]);
            }
        }

        echo number_format($total);
    }


}
