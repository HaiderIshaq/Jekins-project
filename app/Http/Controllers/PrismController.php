<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SaleTax;
use App\Bill_Ibr;
use App\Log;
use App\Supervision;
use App\Prism;
use App\Inspection;
use DataTables;
use PDF;
use Illuminate\Support\Facades\Storage;
use File;
use ZipArchive;
use Carbon\Carbon;



class PrismController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");
    }
    public function index(Request $request)
    {

        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Supervision::getUserCompany($uid, $token);
        return view('Prism.create', compact('user'));
        // return view('Prism.create');
    }

    public function NoLossReport(Request $request, $id)
    {
        return Prism::NoLossReport($id);
    }

    public function updatePrismLetterData(Request $request, $id)
    {
        Prism::updatePrismLetterData($request, $id);
    }

    public function getPartialData(Request $request, $id)
    {
        // Prism::getPartialData($request, $id);

        return DB::table('prism_letters')->select('*')->get();
    }



    public function downloadZip($id)
    {
        $zip = new ZipArchive;
   
        $fileName = 'Assets-'.$id.'.zip';
   
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $path='Reports/Prism/'.$id.'/Assets';
            $files = File::files(public_path($path));
   
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
             
            $zip->close();
        }
    
        return response()->download(public_path($fileName));
    }

    public function downloadDocuments($id)
    {
        $zip = new ZipArchive;
   
        $fileName = 'Documents-'.$id.'.zip';
   
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $path='Reports/Prism/'.$id.'/Documents';
            $files = File::files(public_path($path));
   
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
             
            $zip->close();
        }
    
        return response()->download(public_path($fileName));
    }

    public function create(Request $request)
    {


        // Supervision::storeSupervision($request);
        // $cjob = Supervision::getLatestJob($request);
        // $cid = $cjob->id;
        // Supervision::addCommonJob($request, $cid);
        // Supervision::updateJobID($request, $cid);
        // Supervision::makeLog($request, $cid);

        return view('Prism.create');
    }

    public function getInsurers()
    {
        $insurers = DB::table('prism_insurers')
            ->select('*')
            ->get();

        return $insurers;
    }

    public function getAccessories()
    {
        $accrssories = DB::table('prism_accessories_list')
            ->select('*')
            ->get();

        return $accrssories;
    }
    public function gePrismTypes()
    {
        $types = DB::table('prism_surveys_types')
            ->select('*')
            ->get();

        return $types;
    }

    public function getIntimatingPerson()
    {
        $persons = DB::table('prism_intimation_persons')
            ->select('*')
            ->get();

        return $persons;
    }

    public function getVehicles()
    {
        $vehicles = DB::table('prism_vehicles')
            ->select('*')
            ->get();

        return $vehicles;
    }

    public function getInsurerBranch($id)
    {
        return DB::table('prism_insurer_branches')
            ->where('insurer_id', $id)
            ->select('*')
            ->get();
    }

    public function getAccessoriesRecs($id)
    {
        return DB::table('prism_surveys_accessories')
            ->where('job_id', $id)
            ->select('*')
            ->get();
    }

    public function getAccessoriesToBeRepaired($id)
    {
        return DB::table('prism_survey_assets_to_be_repaired')
            ->where('job_id', $id)
            ->select('*')
            ->get();
    }
    public function getAccessoriesToBeDismantle($id)
    {
        return DB::table('prism_survey_assets_to_be_dismantle')
            ->where('job_id', $id)
            ->select('*')
            ->get();
    }

    public function getAccessoriesToBeReplaced($id)
    {
        return DB::table('prism_survey_assets_to_be_replaced')
            ->where('job_id', $id)
            ->select('*')
            ->get();
    }
    public function getModes($id)
    {
        return DB::table('prism_survey_mode')
            ->where('survey_type', $id)
            ->select('*')
            ->get();
    }

    public function getItems($id)
    {
        return DB::table('prism_survey_items')
            ->where('mode_id', $id)
            ->select('*')
            ->get();
    }

    public function addBranch(Request $request)
    {
        

        DB::table('prism_insurer_branches')->insert(
            [
                'insurer_id' => $request->branch_bank_id,
                'city' => $request->branch_city_id,
                'code' => $request->branch_code,
                'name' => $request->branch_name,
                'address' => $request->branch_address,
                'phone' => $request->branch_phone
                
            ]
        );
    }

    public function getInsurerBranchById($id)
    {
        return DB::table('prism_insurer_branches')
            ->where('id', $id)
            ->select('*')
            ->get();
    }


    
    public function getAssets($id)
    {
        return DB::table('prism_survey_assets')
            ->where('job_id', $id)
            ->select('*')
            ->get();
    }

    public function updateToBeRepaired(Request $request){

        Prism::updateToBeRepaired($request);
        // return $request->recs;
    }

    public function changeName(Request $request){

        Prism::updateAccessoryName($request);
    }

    public function changeValuesBeReplaced(Request $request){

        Prism::changeValuesBeReplaced($request);
    }
    public function changeValuesBeDismantle(Request $request){

        Prism::changeValuesBeDismantle($request);
    }
    public function changeAccessoriesToBeRepaired(Request $request){

        Prism::changeAccessoriesToBeRepaired($request);
    }
    public function changeAccessoriesToBeDismantle(Request $request){

        Prism::changeAccessoriesToBeDismantle($request);
    }
    public function changeAccessoriesToBeReplaced(Request $request){

        Prism::changeAccessoriesToBeReplaced($request);
    }

    public function changeAssetTitle(Request $request,$id){

        Prism::changeAssetTitle($request,$id);
    }

    public function SalesTaxInvoice($id)
     {
        $data=Prism::getBillData($id);

        $total= $data['scharges']+$data['tx'];
        $rec=[
            'job_id'=>$data['job_number'],
            'loss_no'=>$data['loss_no'],
            'stamp'=>$data['stamp'],
            'is_takaful'=>$data['is_takaful'],
            'bill_date'=>date_format(date_create($data['bill_date']),'F d,Y'),
            'ntn'=>$data['ntn'],
            'ntn_of_insured'=>$data['ntn_of_insured'],
            // 'service_charges'=>$data['service_charges,
            'insurer_name'=>$data['insurer_name'],
            'insurer_branch_name'=>$data['insurer_branch_name'],
            'service_charges'=>$data['service_charges'],
            'rate'=>intval($data['st_rate']),
            'tax'=>number_format($data['tx']),
            'total_amount'=>number_format($total),
            'total_amount_text'=>strtoupper(Inspection::convertNumberToWord(intval((int)$total))."only"),
 
            
        ];

        // return $data;
        $pdf=PDF::loadView('Prism/Report/Partial/salestaxinvoice', $rec);

        if($data['letter_head']==1)
        {
            $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
            $tplIdx = $pdf->getMpdf()->ImportPage(1);
            $pdf->getMpdf()->UseTemplate($tplIdx);
    
        }
        return $pdf->stream($data['job_number'].'_Stax_invoice.pdf','I');
     }


    public function changeType(Request $request){
        
        Prism::updateAccessoryType($request);
    }
   
    public function deleteAccessory($id){
        
        Prism::deleteAccessory($id);
    }

    public function deleteAccessoryToBeRepaired($id){
        
        Prism::deleteAccessoryToBeRepaired($id);
    }

    public function deleteAccessoryToBeDismantle($id){
        
        Prism::deleteAccessoryToBeDismantle($id);
    }

    public function deleteAccessoryToBeReplaced($id){
        
        Prism::deleteAccessoryToBeReplaced($id);
    }
    public function deleteAsset($id){
        
        Prism::deleteAsset($id);
    }

    public function addAccessory(Request $request){
        
        Prism::addAccessory($request);
    }

    public function addToBeRepaired(Request $request){
        
        Prism::addToBeRepaired($request);
    }
    // public function addToBeReplaced(Request $request){
        
    //     Prism::addToBeReplaced($request);
    // }
    // public function addToBeDismantle(Request $request){
        
    //     Prism::addToBeDismantle($request);
    // }

    public function uploadAssets(Request $request){
        
        // Prism::addAccessory($request);
        Prism::uploadAssets($request);

    }
   
    public function getPrismSurveyors()
    {
        return DB::table('users')
            ->leftJoin('c_region','users.region','=','c_region.reg_id')
            ->leftJoin('c_city','c_region.reg_city_id','=','c_city.city_id')
            ->where('users.service', 'Prism')
            ->where('users.role', 4)
            ->select(
                'c_city.city_name',
                'users.name',
                'users.id',
                'users.region',
                )
            ->get();
    }
   
    public function gePrismJobData($id)
    {
        
        return Prism::gePrismJobData($id);
    }

    public function intimating(Request $request)
    {


        // Supervision::storeSupervision($request);
        // $cjob = Supervision::getLatestJob($request);
        // $cid = $cjob->id;
        // Supervision::addCommonJob($request, $cid);
        // Supervision::updateJobID($request, $cid);
        // Supervision::makeLog($request, $cid);

        return view('Prism.PrismIntimating');
    }

    public function duplicateJob($id)
    {
        Prism::duplicatestoreVerification($id);

        $cjob = Prism::getLatestJob();
        $cid = $cjob->id;
        $cj=Prism::addCommonJobDuplicate($cid,$id);
        Prism::updateJobIDDuplicate($cid,$id);
        
        $survey=DB::table('prism_surveys')->where('job_id',$id)
        ->select('*')
        ->get();

        $sid=DB::table('prism_surveys')->insertGetId([
            'job_id'=>$cid,
            'surveyor'=>$survey[0]->surveyor,
            'travelling_expenses'=>$survey[0]->travelling_expenses,
            'report_date'=>$survey[0]->report_date,
            'report_date'=>$survey[0]->report_date,
            'time_of_inspection'=>$survey[0]->time_of_inspection,
            'date_of_inspection'=>$survey[0]->date_of_inspection,
            'place_of_survey'=>$survey[0]->place_of_survey,
            're_inspecton_date'=>$survey[0]->re_inspecton_date,
            'pay_to'=>$survey[0]->pay_to,
            'place_of_loss'=>$survey[0]->place_of_loss,
            'date_of_loss'=>$survey[0]->date_of_loss,
            'time_of_loss'=>$survey[0]->time_of_loss,
            'circumstances'=>$survey[0]->circumstances
        ]);
        Prism::makeLog($cid);

        $job=DB::table('prism_jobs')->where('id',$id)
        ->select('survey_type')
        ->get();

        if($job[0]->survey_type==6 || $job[0]->survey_type==8 ){

            $vsurvey=DB::table('prism_survey_vehicles')->where('job_id',$id)
            ->select('*')
            ->get();

            $accessories=DB::table('prism_surveys_accessories')->where('job_id',$id)
            ->select('*')
            ->get();

            foreach($accessories as $item)
            {
                DB::table('prism_surveys_accessories')->insert([
                    'job_id'=>$cid,
                    'name'=>$item->name,
                    'type'=>$item->type
                ]);

            }

            $dismantle=DB::table('prism_survey_assets_to_be_dismantle')->where('job_id',$id)
            ->select('*')
            ->get();

            foreach($dismantle as $item)
            {
                DB::table('prism_survey_assets_to_be_dismantle')->insert([
                    'job_id'=>$cid,
                    // 'name'=>$item->name,
                    'title'=>$item->title,
                    'amount'=>$item->amount,
                    'disc'=>$item->disc,
                    'dep'=>$item->dep,
                    'salvage'=>$item->salvage,
                    'gst'=>$item->gst,
                    'total'=>$item->total
                ]);

            }

            $replaced=DB::table('prism_survey_assets_to_be_replaced')->where('job_id',$id)
            ->select('*')
            ->get();

            foreach($replaced as $item)
            {
                DB::table('prism_survey_assets_to_be_replaced')->insert([
                    'job_id'=>$cid,
                    // 'name'=>$item->name,
                    'title'=>$item->title,
                    'amount'=>$item->amount,
                    'disc'=>$item->disc,
                    'dep'=>$item->dep,
                    'salvage'=>$item->salvage,
                    'gst'=>$item->gst,
                    'total'=>$item->total
                ]);

            }

            $repaired=DB::table('prism_survey_assets_to_be_repaired')->where('job_id',$id)
            ->select('*')
            ->get();

            foreach($repaired as $item)
            {
                DB::table('prism_survey_assets_to_be_repaired')->insert([
                    'job_id'=>$cid,
                    'title'=>$item->title
                ]);

            }


    
            DB::table('prism_survey_vehicles')->insert([
                'job_id'=>$cid,
                'survey_id'=>$sid,
                'reg_no'=>$vsurvey[0]->reg_no,
                'manufacture'=>$vsurvey[0]->manufacture,
                'manufacture_date'=>$vsurvey[0]->manufacture_date,
                'manufacture_date'=>$vsurvey[0]->manufacture_date,
                'reg_date'=>$vsurvey[0]->reg_date,
                'make'=>$vsurvey[0]->make,
                'make'=>$vsurvey[0]->make,
                'model'=>$vsurvey[0]->model,
                'horse_power'=>$vsurvey[0]->horse_power,
                'horse_power'=>$vsurvey[0]->horse_power,
                'variant'=>$vsurvey[0]->variant,
                'engine_no'=>$vsurvey[0]->engine_no,
                'chassis_no'=>$vsurvey[0]->chassis_no,
                'engine_capacity'=>$vsurvey[0]->engine_capacity,
                'seating'=>$vsurvey[0]->seating,
                'is_paper_available'=>$vsurvey[0]->is_paper_available,
                'color'=>$vsurvey[0]->color,
                'odometer'=>$vsurvey[0]->odometer,
                'body_type'=>$vsurvey[0]->body_type,
                'select_type_one'=>$vsurvey[0]->select_type_one,
                'select_type_two'=>$vsurvey[0]->select_type_two,
                'value'=>$vsurvey[0]->value,
                'copy_of_reg_book'=>$vsurvey[0]->copy_of_reg_book,
                'brand_new_vehicle'=>$vsurvey[0]->brand_new_vehicle,
                'copy_of_cnic_insured'=>$vsurvey[0]->copy_of_cnic_insured,
                'copy_of_import_documents'=>$vsurvey[0]->copy_of_import_documents,
                'bill_of_entry'=>$vsurvey[0]->bill_of_entry,
                'dents_one'=>$vsurvey[0]->dents_one,
                'dents_two'=>$vsurvey[0]->dents_two,
                'dents_three'=>$vsurvey[0]->dents_three,
                'dents_four'=>$vsurvey[0]->dents_four,
                'dents_five'=>$vsurvey[0]->dents_five,
                'dents_remarks'=>$vsurvey[0]->dents_remarks,
                'to_be_repaired_labour'=>$vsurvey[0]->to_be_repaired_labour,
                'to_be_repaired_assessed'=>$vsurvey[0]->to_be_repaired_assessed,
                'to_be_repaired_is_stax'=>$vsurvey[0]->to_be_repaired_is_stax,
                'to_be_repaired_tax_rate'=>$vsurvey[0]->to_be_repaired_tax_rate,
                'to_be_repaired_sales_reg'=>$vsurvey[0]->to_be_repaired_sales_reg,
                'to_be_repaired_tax'=>$vsurvey[0]->to_be_repaired_tax,
                'name_of_driver'=>$vsurvey[0]->name_of_driver,
                'age_of_driver'=>$vsurvey[0]->age_of_driver,
                'license_no'=>$vsurvey[0]->license_no,
                'issued_on'=>$vsurvey[0]->issued_on,
                'expired_on'=>$vsurvey[0]->expired_on
            ]);

        }

        return $cj;

    }

    public function addPrismJob(Request $request)
    {
        Prism::storeVerification($request);
        $cjob = Prism::getLatestJob($request);
        $cid = $cjob->id;
        Prism::addCommonJob($request, $cid);
        Prism::updateJobID($request, $cid);
        // Verification::addSurveys($request, $cid);
        // Verification::addDetails($request, $cid);
        // Prism::addSurvey($request,$cid);
        $id=DB::table('prism_surveys')->insertGetId([
            'job_id'=>$cid
        ]);
        Prism::makeLog($request, $cid);

        if($request->survey_type==6 || $request->survey_type==8 ){
            // Prism::addSurveyVehicle($request,$cid);

            DB::table('prism_survey_vehicles')->insert([
                'job_id'=>$cid,
                'survey_id'=>$id,
                'engine_no'=>$request->engine_no,
                'reg_no'=>$request->reg_no,
                'make'=>$request->make,
                'model'=>$request->model,
                'chassis_no'=>$request->chassis_no,
                'engine_capacity'=>$request->engine_capcity
            ]);

        }

        // echo 'working';

        // return $job;
    }

    public function printPrismReport(Request $request,$id)
    {   
        $job=DB::table('prism_jobs')
        ->where('id',$id)
        ->select('survey_type','report_print_type','job_id')
        ->get();
        
        $lump=DB::table('prism_survey_vehicles')
        ->where('job_id',$id)
        ->select('lumpsum')
        ->get();

        if($job[0]->survey_type==8)
        {
            
            // $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));        

            // Prism::getPrismReport($id,$pdf);
            
            // return $pdf->Output($job[0]->job_id.'.pdf', 'I');

            return Prism::preInsuranceReport($id);


                        
        }
        else{

            //Partial Loss Report
            if($job[0]->report_print_type=="Preliminary Report")
            {
                return Prism::PreliminaryReport($id,1);

            }
            else if($job[0]->report_print_type=="Calculation Sheet")
            {
                return Prism::calculationReport($id,1);

            }
            else if($job[0]->report_print_type=="Final Report"){
                if($lump[0]->lumpsum>0){
                    return Prism::LumpsumReport($id,1);
                }
                else{
                    return Prism::partialLossReport($id,1);

                }


            }
            else if($job[0]->report_print_type=="Complete Set")
            {


                if($lump[0]->lumpsum>0){
                     Prism::LumpsumReport($id,0);
                }
                else{
                     Prism::partialLossReport($id,0);

                }

                Prism::calculationReport($id,0);

                
               $pdf = new \setasign\Fpdi\Fpdi();

                $pageCount1=$pdf->setSourceFile('Reports/Prism/'.$id.'/final.pdf');


               for ($pageNo1 = 1; $pageNo1 <= $pageCount1; $pageNo1++) {

                    $pdf->AddPage();
                    $tplIdx=$pdf->importPage($pageNo1);
                    $pdf->useTemplate($tplIdx);

                }

               File::delete('Reports/Prism/'.$id.'/final.pdf');


               $pageCount1=$pdf->setSourceFile('Reports/Prism/'.$id.'/calculation.pdf');


              for ($pageNo1 = 1; $pageNo1 <= $pageCount1; $pageNo1++) {

                   $pdf->AddPage();
                   $tplIdx=$pdf->importPage($pageNo1);
                   $pdf->useTemplate($tplIdx);

               }

              File::delete('Reports/Prism/'.$id.'/final.pdf');


                return $pdf->Output();


            }




        }

    }


    public function printInvoice($id)
    {
        $data=Prism::getBillData($id);

        if($data['survey_type']==8 || $data['survey_type']==6 ){

            $pdf=PDF::loadView('Prism/billinvoice',compact('data'));

        }
        else{
            $pdf=PDF::loadView('Prism/billinvoicenon',compact('data'));

        }

        if($data['letter_head']==1)
        {
            $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
            $tplIdx = $pdf->getMpdf()->ImportPage(1);
            $pdf->getMpdf()->UseTemplate($tplIdx);
    
        }

        



         $pdf->stream($data['job_number'].'_Bill.pdf','I');

    }
    // public function printInvoice($id)
    // {

    //     $dat=Prism::getBillData($id);

    //     $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

    //     if($dat[0]->survey_type==8)
    //     {
    //         if($dat[0]->letter_head==1)
    //         {
    //             $pdf->setSourceFile("src/reportformat/prism/billformat.pdf");
    
    //         }
    //         else {
    
    //             $pdf->setSourceFile("src/reportformat/prism/billformatnoletterhead.pdf");
    
    //         }
    //     }

    //     else{
    //         if($dat[0]->letter_head==1)
    //         {
    //             $pdf->setSourceFile("src/reportformat/prism/billformatpartialLoss.pdf");
    
    //         }
    //         else {
    
    //             $pdf->setSourceFile("src/reportformat/prism/billformatnoletterheadPartialLoss.pdf");
    
    //         }
    //     }

    //     if($dat[0]->survey_type==8)
    //     {
    //         Prism::getBill($dat[0],$pdf,$dat[0]->stamp,1);

    //     }
    //     else{
    //         Prism::getBillForPartialLoss($dat[0],$pdf,$dat[0]->stamp,1);

    //     }


        

    //     $pdf->Output();
        

    // }


    public function printPrismReportsByInvoice(Request $request,$id)
    {

        
        $jobs=Prism::getBillsDataForInvoice($id);
        
        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));


        foreach($jobs as  $key =>$item)
        {
            
            Prism::getPrismReportBulk($item->jid,$pdf,$request);
        }

       return $pdf->Output();


    }

    public function updateInvoiceBranch(Request $request)
    {

    //    return $request->all();


    $bills=DB::table('bill')
        ->where('bill.invoice_id',$request->invoice_id)
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->select('bill.id','bill.bill_date','bill.bill_number','prism_insurers.prefix','bill.bill_id','bill.service_charges','bill.tax','bill.total_amount')
        ->get();


        foreach($bills as  $key =>$item)
        {
            $invid='PRM/MTR/'.$item->prefix.'/'.$request->insurer_branch.'/'.date_format(date_create($item->bill_date),'m').'/'.date_format(date_create($item->bill_date),'Y');

            
            DB::table('prism_jobs')
            ->where('id',$item->bill_id)
            ->update([
                'insurer_branch'=>$request->insurer_branch
            ]);

            
            DB::table('bill')
            ->where('id',$item->id)
            ->update([
                'invoice_id'=>$invid
            ]);

        }


    }
    public function shiftBills()
    {

        $invid="PRM/MTR/AIC/30/10/2022";
        $prefix="AICT";
        $insurer=13;
        $branch=30;
        $regprefix='KHI';
        $year=2022;
        // $insurer=;

        $bills=DB::table('bill')
        ->where('bill.invoice_id',$invid)
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->select('bill.id','bill.bill_date','bill.bill_number','prism_jobs.jid','prism_insurers.prefix','bill.bill_id','bill.service_charges','bill.tax','bill.total_amount')
        ->get();


        foreach($bills as  $key =>$item)
        {

            // $invid="PRM/MTR/AIC/30/10/2022";
            $inv='PRM/MTR/'.$prefix.'/'.$branch.'/'.date_format(date_create($item->bill_date),'m').'/'.date_format(date_create($item->bill_date),'Y');
            $jid='PRM/MTR/'.$regprefix.'/'.$prefix.'/'.$item->jid.'/'.$year;
            // echo $jid."<br>";


                DB::table('c_jobs')
            ->where('job_id',$item->bill_number)
            ->update([
                'job_id'=>$jid,
                'insurer'=>$insurer,
                'insurer_branch'=>$branch
            ]);

            
            DB::table('bill')
            ->where('id',$item->id)
            ->update([
                'bill_number'=>$jid,
                'job_number'=>$jid,
                'invoice_id'=>$inv
            ]);


            DB::table('prism_jobs')
            ->where('id',$item->bill_id)
            ->update([
                'insurer'=>$insurer,
                'insurer_branch'=>$branch,
                'job_id'=>$jid
            ]);


        }
    }


    public function updateStaxInvoice(Request $request)
    {

        $stax= $request->newStax;        
        $invoiceid=$request->invoice_id;        
        
        $bills=DB::table('bill')
        ->where('invoice_id',$invoiceid)
        ->select('id','bill_number','service_charges','tax','total_amount')
        ->get();

        foreach($bills as  $key =>$item)
        {
            
            DB::table('prism_jobs')
            ->where('job_id',$item->bill_number)
            ->update([
                'sale_tax_rate'=>$stax
            ]);

            $rec=DB::table('prism_jobs')
            ->where('job_id',$item->bill_number)
            ->select('service_charges','travelling')
            ->get();


            if($request->is_on_total==true)
            {
                $totalamnt=$rec[0]->service_charges+$rec[0]->travelling;
                // $tax=
                DB::table('bill')
                ->where('bill_number',$item->bill_number)
                ->update([
                    'tax'=>$totalamnt*($stax/100),
                    'service_charges'=>$rec[0]->service_charges,
                    'other_charges'=>$rec[0]->travelling,
                    'total_amount'=>$rec[0]->service_charges+($totalamnt*($stax/100))+$rec[0]->travelling
                ]);
            }
            else{
                DB::table('bill')
                ->where('bill_number',$item->bill_number)
                ->update([
                    'tax'=>$rec[0]->service_charges*($stax/100),
                    'service_charges'=>$rec[0]->service_charges,
                    'other_charges'=>$rec[0]->travelling,
                    'total_amount'=>$rec[0]->service_charges+($rec[0]->service_charges*($stax/100))+$rec[0]->travelling
                ]);
            }



            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = "Invoice No: ".$invoiceid." Stax Updated to " . $stax . "%" ;
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Prism';
            $log->save();
    


            // echo $job->service_charges;
        }


    }

    public function printPrismBillsByInvoice(Request $request,$id)
    {

        
        $jobs=Prism::getBillsDataForInvoice($id);

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));
        
        if($request->isletter==1)
        {
            $pdf->setSourceFile("src/reportformat/prism/billformat.pdf");
        }
        else{
            $pdf->setSourceFile("src/reportformat/prism/billformatnoletterhead.pdf");
        }


        foreach($jobs as  $key =>$item)
        {
            if($request->isstamp==1)
            {
                if($request->stax==1)
                {
                    Prism::getBill($item,$pdf,1,1);

                }
                else{
                    Prism::getBill($item,$pdf,1,0);

                }

            }

            else{
                if($request->stax==1)
                {
                    Prism::getBill($item,$pdf,0,1);

                }
                else{
                Prism::getBill($item,$pdf,0,0);

                }

            }

        }
        
        $pdf->Output();
        

    }




    public function printPrismInvoice(Request $request,$id)
    {    
        // echo $request->stax;        
        $invoiceid=$id;



        $insurer=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_insurer_branches','prism_jobs.insurer_branch','=','prism_insurer_branches.id')
        ->where('bill.invoice_id','=',$invoiceid)
        ->select('prism_insurers.name as insurer_name','prism_insurer_branches.name as insurer_branch_name')
        ->groupBy('prism_insurer_branches.name')
        ->get();


        

        $jobs=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->leftJoin('prism_surveys','bill.bill_id','=','prism_surveys.job_id')
        ->leftJoin('prism_survey_vehicles','bill.bill_id','=','prism_survey_vehicles.job_id')
        ->leftJoin('sales_tax','prism_jobs.region','=','sales_tax.region')
        ->where('bill.invoice_id','=',$invoiceid)
        ->select(
            'prism_jobs.jid as id',
            'prism_jobs.name_of_insured',
            'prism_survey_vehicles.reg_no',
            'prism_survey_vehicles.make',
            'prism_survey_vehicles.engine_no',
            'prism_survey_vehicles.chassis_no',
            'prism_jobs.service_charges',
            'prism_jobs.travelling',
            'prism_surveys.date_of_inspection',
            'prism_surveys.place_of_survey',
            'prism_jobs.sale_tax_rate as rate',
            'bill.tax',
            'bill.bill_date'
            )
        ->orderBy('prism_surveys.date_of_inspection','asc')
        ->get();

        $date = Carbon::createFromFormat('Y-m-d', $jobs[0]->bill_date)
        ->endOfMonth()
        ->format('d-m-Y');

        // $month='2022-7-6';
        $fee=0;
        $travel=0;
        $tax=0;
        foreach ($jobs as $value) {
            # code...
            $fee+=$value->service_charges;
            $travel+=$value->travelling;
            $tax+=$value->tax;
        }

        $data=[
            'invoice'=>$invoiceid,
            'dated'=>$date,
            'fees'=>$fee,
            'travel'=>$travel,
            'isletter'=>$request->isletter,
            'tax'=>$tax,
            'rate'=>$jobs[0]->rate,
            'isstax'=>$request->stax,
            'isstamp'=>$request->isstamp,
            'insurer'=>$insurer[0]->insurer_name,
            'insurer_branch'=>$insurer[0]->insurer_branch_name,
            'jobs'=>$jobs,

        ];


        // $pdf=PDF::loadView('Prism/Report/invoice', compact('data'));
        Storage::disk('dir')->delete('Reports/Prism/invoice.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));        
        
        $mpdf=PDF::loadView('Prism/Report/invoice', compact('data'));
        $mpdf->shrink_tables_to_fit = 1;
        $path='Reports/Prism/invoice.pdf';
        $mpdf->save($path);

        $pageCount = $pdf->setSourceFile('Reports/Prism/invoice.pdf');

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        
            $pdf->setSourceFile('Reports/Prism/invoice.pdf');
            $pdf->AddPage();
            $tplIdx=$pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx);
            if($request->isletter==1)
            {
                $pdf->setSourceFile('src/reportformat/prism/letterhead.pdf');
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx);


            }

            // if($pageNo==$pageCount)
            // {
            //     if($data['isstamp']==1)
            //     {
            //         $pdf->Image('images/prismstamp.png', 0, 110, 50, '', '', '', '', false, 300);

            //     }
                
            // }


            if($pageNo!=1)
            {
                $pdf->SetFont('Arial','BU',11);
                $pdf->SetXY(70, 30);
                $pdf->Write(0, 'Invoice No. '. $data['invoice']);
    
            }




        }


        return $pdf->Output();


    }

    public function addJobByPerson(Request $request)
    {
        $reg=Prism::storeVerificationByIntimating($request);
        $cjob = Prism::getLatestJob($request);
        $cid = $cjob->id;

        $rc=DB::table('prism_jobs')
        ->where('region',$reg)
        ->select('id','jid')
        ->orderBy('jid', 'desc')
        ->get();

        $ji=0;
        if(count($rc)>0){
            $i=$rc[0]->jid+1;
            $ji=$i;
            
        }
        else{
            $ji=1;

        }

        $job=Prism::addCommonJobByPerson($request, $cid,$ji);
        Prism::updateJobIDByPerson($request, $cid,$ji);
        Prism::addSurveyVehicle($request,$cid);

        return $job;
      
    }


    public function getMake($id)
    {
        $job=DB::table('prism_vehicles')
        ->where('prism_vehicles.id','=',$id)
        ->select(
            'prism_vehicles.manufacture'
            )
        ->get();

        echo $job[0]->manufacture; 
    }

    public function updatePrismJob(Request $request, $id)
    {
        Prism::updatePrismJob($request, $id);
        Prism::updateLocalJob($request, $id);
    }


    public function cancelVerification(Request $request, $id)
    {
        Prism::cancelVerification($request, $id);
    }

    public function getBillsOfInvoicePrism(Request $request)
    {
        return Prism::getBillsOfInvoice($request);
    }
    public function holdVerification(Request $request, $id)
    {
        Prism::holdVerification($request, $id);
    }
    public function getholdVerification(Request $request, $id)
    {
        return DB::table('prism_jobs')
        ->where('id', $id)
        ->select(
            'hold_remarks',
            'hold',
            'cancelled',
            )
        ->get();
    }

    public function getToBeRepairedDetails(Request $request, $id)
    {
        return DB::table('prism_survey_vehicles')
        ->where('job_id', $id)
        ->select(
            'to_be_repaired_labour',
            'to_be_repaired_assessed',
            'to_be_repaired_is_stax',
            'to_be_repaired_tax_rate',
            'lumpsum',
            'to_be_replaced_tax'
            )
        ->get();
    }



    public function getCancelVerificationprism(Request $request, $id)
    {
        return DB::table('prism_jobs')
        ->where('id', $id)
        ->select(
            'cancelled_remarks',
            'cancelled'
            )
        ->get();
    }

    public function uploadFinal(Request $request)
    {
        $file = $request->file('myfile');
        $filext = $request->file('myfile')->extension();


        if ($filext != "pdf") {
            return response()->json('Unsupported');
        } else {

            $id = $request->job_id;
            $filename = Prism::uploadFinal($request, $id, $file);
            return response()->json($filename);
        }
    }

    public function getFinalReport($id)
    {
        $file = Prism::getFinalReport($id);
        return $file;
    }




    public function uploadDocuments(Request $request)
    {

        Prism::uploadDocuments($request);
    }

    public function updateLetterHead(Request $request,$id)
    {
        $job=DB::table('prism_jobs')
        ->where('id', $id)
        ->update(['letter_head' => $request->letter_head]);
        
        return $job;
    }

    public function updateStamp(Request $request,$id)
    {
        $job=DB::table('prism_jobs')
        ->where('id', $id)
        ->update(['stamp' => $request->stamp]);
        
        return $job;
    }

    public function updateIsImages(Request $request,$id)
    {
        $job=DB::table('prism_jobs')
        ->where('id', $id)
        ->update(['is_images' => $request->is_images]);
        
        return $job;
    }

    public function updatePartRates(Request $request,$id)
    {
        $job=DB::table('prism_jobs')
        ->where('id', $id)
        ->update(['part_rates' => $request->part_rates]);
        
        return $job;
    }
    public function updateReportType(Request $request,$id)
    {
        $job=DB::table('prism_jobs')
        ->where('id', $id)
        ->update(['report_print_type' => $request->type]);
        
        return $job;
    }

    public function getFilesPrism($id)
    {

        $files = [];
        $filesInFolder = \File::files('Reports/Prism/' . $id.'/Documents');
        foreach ($filesInFolder as $path) {

            $file = pathinfo($path);
            array_push($files, $file['filename'] . "." . $file['extension']);
        }
        if ($files == []) {
            return 'No Files';
        } else {
            return $files;
        }
    }

    public function printBill(Request $request,$id)
    {

        // return $request->job_id;


            // echo 'pre';

            $bill = Bill_Ibr::where('job_number', '=', $request->job_id)->first();
            $bill->bill_number = $request->job_id;
            $bill->job_number = $request->job_id;
            $bill->bill_date = date('Y-m-d');
            $bill->discount = '0';
            $bill->recievable = $request->region;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            // $bill->bank = $request->bankID;
            $bill->company = 6;
            // $bill->branch = $request->branch;
            $bill->status = 'Receivable';
            $bill->service = 'Prism';
            // $bill->atten =  $request->insurer;

            if($request->type=='Pre-Insurance')
            {
                $bill->invoice_id = 'PRM' .'/MTR/'.$request->insurer_prefix.'/'.$request->insurer_branch.'/'.date('m').'/'.date('Y');

            }
            else{
                $bill->invoice_id = '';

            }
    
            // DB::table('prism_jobs')->where('prism_jobs.job_id',$request->job_id)->update([
    
            // ]);
            $job=DB::table('prism_jobs')
            ->where('prism_jobs.job_id',$request->job_id)
            ->leftJoin('sales_tax','prism_jobs.region','=','sales_tax.region')
            ->select('sales_tax.rate')
            ->get();

            if($request->is_sales_tax==true)
            {
                
                
                $strate= $request->tax_rate / 100;
                $tax=$request->service_charges * $strate;
        
              
            }
            else{
                
                $strate= $job[0]->rate / 100;
                $tax=$request->service_charges * $strate; 
            }

            if($request->type=="Pre-Insurance")
            {
                $bill->total_amount = $request->service_charges + $request->travelling + $tax;
                $bill->service_charges = $request->service_charges;
                $bill->other_charges = $request->travelling;
                $bill->tax = $tax;
             
            }

            else{
                $bill->total_amount = $request->service_charges + $request->snap_charges + $request->extra_visit +$request->re_inspection_charges + $request->travelling + $tax;
                $bill->service_charges = $request->service_charges;
                $bill->other_charges =  $request->snap_charges + $request->extra_visit +$request->re_inspection_charges + $request->travelling;
                
                $bill->tax = $tax;
             
            }


           
            $bill->save();
    

       


    }


    public function updateBill(Request $request,$id)
    {
        $strate= $request->taxrate / 100;
        $tax=$request->newcharges * $strate;

        $bill = Bill_Ibr::where('job_number', '=', $request->billnumber)->first();
        // $bill->recievable=$request->region;
        $bill->service_charges=$request->newcharges;
        $bill->other_charges=$request->newchargestravel;
        $bill->total_amount=$request->newcharges+$request->newchargestravel+$tax;
        $bill->tax=$tax;
        $bill->save();

        DB::table('prism_jobs')->where('job_id',$request->billnumber)->update([
            'service_charges'=>$request->newcharges,
            'travelling'=>$request->newchargestravel
        ]);
        DB::table('prism_surveys')->where('job_id',$request->jid)->update([
            'place_of_survey'=>$request->newplaceofsurvey
        ]);

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Bill No : " . $request->billnumber . " Was Changed" ;
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Prism';
        $log->save();

        $data=[
            'tax'=>$tax,
            'total'=>$request->newcharges+$request->newchargestravel+$tax
        ];
        return response()->json($data);

        // echo $request->taxrate;

    }


    public function prismInvoices(Request $request)
    {
        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Prism::getUserCompany($uid, $token);
        return view('Prism.invoices', compact('user'));
    }
    
    public function getPrismStats(Request $request)
    {
        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Prism::getUserCompany($uid, $token);
        return view('Prism.stats', compact('user'));
    }


    public function getInvoices(Request $request){

        $insurer=$request->insurer_name;
        $year=$request->year;
        $month=$request->month;
        $recs = DB::select('call GetPrismInvoices(?,?,?)', array($year,$insurer,$month));
        return $recs;

        // echo $year."," .$insurer."," .$month;

     }

     public function getSurveyStats(Request $request){
        
        $recs = DB::select('call GetPrismJobBySurveyor()');
        return $recs;

     }


     public function getSurveyStatsbyRegion($id){
        
        if($id==0)
        {
            $recs = DB::select('call GetPrismJobBySurveyor()');

        }
        else{

            $recs = DB::select('call GetPrismJobBySurveyorRegionWise(?)',array($id));

        }
        return $recs;

     }
     public function getsurveysBySurveyor($id){


        $recs=DB::table('prism_surveys')
        ->where('prism_surveys.surveyor',$id)
        ->where('prism_jobs.is_completed',0)
        ->leftJoin('prism_jobs','prism_surveys.job_id','=','prism_jobs.id')
        ->leftJoin('c_jobs','prism_jobs.job_id','=','c_jobs.job_id')
        ->select(
            'prism_surveys.id',
            'prism_jobs.job_id',
            'c_jobs.id as common_id',
            'prism_surveys.conducted_on',
            'prism_surveys.status',
            'prism_surveys.remarks',
            'prism_jobs.name_of_insured',
            'prism_jobs.contact_person',
            )
        ->get();

        return $recs;


     }

     public function getsurveyorsregions(){


        $recs=DB::table('users')
        ->where('users.service',"Prism")
        ->where('users.role',4)
        ->leftJoin('c_region','users.region','=','c_region.reg_id')
        ->leftJoin('c_city','c_region.reg_city_id','=','c_city.city_id')
        ->select(
            'users.region',
            'c_city.city_name',
            )
        ->groupBy('users.region')
        ->get();

        return $recs;


     }

     public function updateReplacedControl(Request $request)
     {
        DB::table('prism_survey_vehicles')
            ->where('job_id',$request->job_id)
            ->update([
                'lumpsum'=>$request->lumpsum,       
                'to_be_replaced_tax'=>$request->is_tax==true?1:0
            ]);
     }
     public function updateDismantle(Request $request,$id)
     {
        $recs=$request->recs;

        foreach($recs as $rec)
        {

            // echo $rec['id']."<br>";

            $discounted=($rec['disc'] / 100)*$rec['amount'];
            $deped=($rec['dep'] / 100)*$rec['amount'];
            $salvage=($rec['salvage'] / 100)*$rec['amount'];
            $gst=($rec['gst'] / 100)*$rec['amount'];
            $final=$rec['amount']-$discounted-$deped-$salvage+$gst;
    
            DB::table('prism_survey_assets_to_be_dismantle')
            ->where('id',$rec['id'])
            ->update([
                'title'=>$rec['name'],       
                'amount'=>$rec['amount'],       
                'disc'=>$rec['disc'],       
                'dep'=>$rec['dep'],       
                'salvage'=>$rec['salvage'],       
                'gst'=>$rec['gst'],       
                'total'=>$final,       
            ]);

        }
     }

     public function updateReplcaed(Request $request,$id)
     {
        $recs=$request->recs;

        foreach($recs as $rec)
        {

            // echo $rec['id']."<br>";

            $discounted=($rec['disc'] / 100)*$rec['amount'];
            $deped=($rec['dep'] / 100)*$rec['amount'];
            $salvage=($rec['salvage'] / 100)*$rec['amount'];
            $gst=($rec['gst'] / 100)*$rec['amount'];
            $final=$rec['amount']-$discounted-$deped-$salvage+$gst;
            
            DB::table('prism_survey_assets_to_be_replaced')
            ->where('id',$rec['id'])
            ->update([
                'title'=>$rec['name'],       
                'amount'=>$rec['amount'],       
                'disc'=>$rec['disc'],       
                'dep'=>$rec['dep'],       
                'salvage'=>$rec['salvage'],       
                'gst'=>$rec['gst'],       
                'total'=>$final,       
            ]);

        }
     }
     public function addToBeReplaced($id)
     {
        // return $request->recs;
        $id=DB::table('prism_survey_assets_to_be_replaced')
        ->insertGetId([
            'job_id'=>$id       
        ]);

        return $id;
     }
     public function addToBeDismantle($id)
     {
        // return $request->recs;
        $id=DB::table('prism_survey_assets_to_be_dismantle')
        ->insertGetId([
            'job_id'=>$id       
        ]);

        return $id;
     }
}
