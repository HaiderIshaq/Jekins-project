<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Job;
use App\Log;
use Image;
use PDF;
use File;
use App\Company;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class Prism extends Model
{
    protected $table = 'prism_jobs';

    public static function duplicatestoreVerification($id)
    {
        $job=DB::table('prism_jobs')->where('id',$id)->select('*')->get();

        $val = new Prism;

        // $val->request_date=date("Y/m/d");
        $val->region = $job[0]->region;
        $val->company = $job[0]->company;
        $val->type = $job[0]->type;
        $val->intimating_person = $job[0]->intimating_person;
        $val->requested_date = $job[0]->requested_date;
        $val->requested_time = $job[0]->requested_time;
        $val->underwriter = $job[0]->underwriter;
        $val->development_officer = $job[0]->development_officer;
        $val->survey_item = $job[0]->survey_item;
        $val->branch_conducting = $job[0]->branch_conducting;
        $val->recovery_branch = $job[0]->recovery_branch;
        $val->insurer = $job[0]->insurer;
        $val->is_completed = 0;
        $val->insurer_branch = $job[0]->insurer_branch;
        $val->insurer_billing_address = $job[0]->insurer_billing_address;
        $val->insurer_conc_officer = $job[0]->insurer_conc_officer;
        $val->insurer_designation = $job[0]->insurer_designation;
        $val->insurer_phone = $job[0]->insurer_phone;
        $val->insurer_email = $job[0]->insurer_email;
        $val->insurer_letter_no = $job[0]->insurer_letter_no;
        $val->insurer_letter_date = $job[0]->insurer_letter_date;
        $val->survey_type = $job[0]->survey_type;
        $val->survey_mode = $job[0]->survey_mode;
        $val->survey_mode_other = $job[0]->survey_mode_other;
        $val->survey_item = $job[0]->survey_item;
        $val->survey_item_other = $job[0]->survey_item_other;
        $val->tracking_id = $job[0]->tracking_id;
        $val->name_of_insured = $job[0]->name_of_insured;
        $val->address = $job[0]->address;
        $val->nic_of_insured = $job[0]->nic_of_insured;
        $val->ntn_of_insured = $job[0]->ntn_of_insured;
        $val->contact_person = $job[0]->contact_person;
        $val->c_no_of_insured = $job[0]->c_no_of_insured;
        $val->contact_nos= $job[0]->contact_nos;
        $val->service = $job[0]->service;
        $val->policy_no = $job[0]->policy_no;
        $val->endors_no = $job[0]->endors_no;
        $val->validity_from = $job[0]->validity_from;
        $val->validity_to = $job[0]->validity_to;
        $val->loss_no = $job[0]->loss_no;
        $val->nature_of_loss = $job[0]->nature_of_loss;
        $val->sum_insured = $job[0]->sum_insured;
        $val->market_value = $job[0]->market_value;
        $val->is_takaful = $job[0]->is_takaful;
        $val->ts_details = $job[0]->ts_details;
        $val->workshop = $job[0]->workshop;
        $val->is_tax = $job[0]->is_tax == true ? '1' : '0';
        $val->service_charges = $job[0]->service_charges;
        $val->snaps = $job[0]->snaps;
        $val->re_inspection_charges = $job[0]->re_inspection_charges;
        $val->extra_visit = $job[0]->extra_visit;
        $val->travelling = $job[0]->travelling;
        $val->os_certification = $job[0]->os_certification;
        $val->ts_details = $job[0]->ts_details;
        $val->created_by = $job[0]->created_by;
        $val->updated_by = $job[0]->updated_by;

        $val->save();

       
    }

    public static function NoLossReport($id)
    {
        
        // return $data;

        $db=DB::table('prism_jobs')
        ->where('id',$id)
        ->select('letter_head','job_id','is_images')
        ->get();

        $pr=new Prism;
        $data=$pr->getPrismPartialReportData($id);

        $pdf = null;
        $letter =$db[0]->letter_head==0?false:true;
        $isimages =$db[0]->is_images==0?false:true;
        

                $pdfPages = [
                    'Prism/Report/Partial/NoLoss',
                   
                ];
        


        // Loop all views
        foreach ($pdfPages as  $key=> $view) {


            // If not yet defined, set the first page
            
            if (is_null($pdf)) {
                $pdf = PDF::loadView($view, $data);

                if($letter==true)
                {
                    // if($stamp==true)
                    // {
                    //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                    // }
                    // $pdf->getMpdf()->Image('images/prismstamp.png',50,150, 170, 100, 'png', '', false);

                    $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                    $tplIdx = $pdf->getMpdf()->ImportPage(1);
                    $pdf->getMpdf()->UseTemplate($tplIdx);

                }
                



                
                continue;
            
            }
        
            // Add another page and add HTML from view to this

            // if($stamp==true)
            // {
             
            // }
            $pdf->getMpdf()->AddPage();
            

            if($letter==true)
            {

                // if($stamp==true)
                // {
                //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                // }

                $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                $tplIdx = $pdf->getMpdf()->ImportPage(1);
                $pdf->getMpdf()->UseTemplate($tplIdx);
                
              
            }

            $pdf->getMpdf()->WriteHTML((string)view($view, $data));
     
        }
        
         return $pdf->stream($db[0]->job_id.'.pdf', 'I');   
    }

    public static function updatePrismLetterData($request, $id)
    {
        $record = DB::table('prism_letters')->where('job_id', $id)->select('*')->get();

        if(count($record)>0)
        {   
            $job = DB::table('prism_letters')->where('job_id', $id)->update([
                'to_is' => $request->to_is,
                'date' => $request->date,
                'address' => $request->address,
                'subject' => $request->subject,
                'text_of_letter' => $request->text_of_letter,
                'cc_one' => $request->cc_one,
                'cc_two' => $request->cc_two,
                'cc_three' => $request->cc_three,
                'cc_four' => $request->cc_four,
                'cc_five' => $request->cc_five,

            ]);
        }
        else{

            $job = DB::table('prism_letters')->insert([
                'job_id' => $id,
                'to_is' => $request->to_is,
                'date' => $request->date,
                'address' => $request->address,
                'subject' => $request->subject,
                'text_of_letter' => $request->text_of_letter,
                'cc_one' => $request->cc_one,
                'cc_two' => $request->cc_two,
                'cc_three' => $request->cc_three,
                'cc_four' => $request->cc_four,
                'cc_five' => $request->cc_five,

            ]);

        }
        
            

        }
    public static function storeVerification($request)
    {

        $val = new Prism;

        // $val->request_date=date("Y/m/d");
        $val->region = $request->regional_id;
        $val->company = $request->job_by;
        $val->type = $request->survey_type_is;
        $val->branch_conducting = $request->regional_id;
        $val->recovery_branch = $request->regional_id;
        $val->insurer = $request->insurer_id;
        $val->insurer_branch = $request->insurer_branch_id;
        $val->insurer_billing_address = $request->insurer_address;
        $val->insurer_conc_officer = $request->insurer_conc_officer;
        $val->insurer_designation = $request->insurer_designation;
        $val->insurer_phone = $request->insurer_phone;
        $val->insurer_email = $request->insurer_email;
        $val->insurer_letter_no = $request->insurer_letter;
        $val->insurer_letter_date = $request->insurer_date;
        $val->survey_type = $request->survey_type;
        $val->survey_mode = $request->survey_mode;
        $val->survey_mode_other = $request->survey_mode_other;
        $val->survey_item = $request->survey_item;
        $val->survey_item_other = $request->survey_item_other;
        $val->tracking_id = $request->tracking_id;
        $val->name_of_insured = $request->name_of_insured;
        $val->address = $request->surveyAddress;
        $val->nic_of_insured = $request->nic_of_insured;
        $val->ntn_of_insured = $request->ntn_of_insured;
        $val->contact_person = $request->contact_person;
        $val->service = $request->survey_service;
        $val->policy_no = $request->survey_policy_no;
        $val->endors_no = $request->survey_endr_no;
        $val->validity_from = $request->validity_from;
        $val->validity_to = $request->validity_to;
        $val->loss_no = $request->loss;
        $val->is_completed =0;
        $val->nature_of_loss = $request->loss_no_due_to;
        $val->workshop = $request->workshop;
        $val->is_tax = $request->is_sales_tax == true ? '1' : '0';
        $val->service_charges = $request->service_charges;
        $val->snaps = $request->snap_charges;
        $val->re_inspection_charges = $request->re_inspection;
        $val->extra_visit = $request->extra_visit;
        $val->travelling = $request->travling_charges;
        $val->os_certification = $request->os_certificate;
        $val->ts_details = $request->ts_details;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();

       
    }

    public static function updateAccessoryName($request)
    {
        DB::table('prism_surveys_accessories')
        ->where('id',$request->id)
        ->update([
            'name'=>$request->name,         
        ]);
    }
    public static function changeValuesBeReplaced($request)
    {   
        
        $db=DB::table('prism_survey_assets_to_be_replaced');
        $db->where('id',$request->id);
        if($request->type=="Amount")
        {
            $db->update([
                'amount'=>$request->name         
            ]);
        }
        else if($request->type=="Disc")
        {
            $db->update([
                'disc'=>$request->name         
            ]);
        }
        else if($request->type=="Dep")
        {
            $db->update([
                'dep'=>$request->name         
            ]);
        }
        else if($request->type=="Salvage")
        {
            $db->update([
                'salvage'=>$request->name         
            ]);
        }
        else if($request->type=="Gst")
        {
            $db->update([
                'gst'=>$request->name         
            ]);
        }

        $rec=DB::table('prism_survey_assets_to_be_replaced')
        ->where('id',$request->id)
        ->select('*')
        ->get();

        $discounted=$rec[0]->amount-(($rec[0]->disc / 100)*$rec[0]->amount);
        $deped=$discounted-(($rec[0]->dep / 100)*$discounted);
        $salvage=$deped-(($rec[0]->salvage / 100)*$deped);
        $final=$salvage+(($rec[0]->gst / 100)*$salvage);

        DB::table('prism_survey_assets_to_be_replaced')
        ->where('id',$request->id)
        ->update([
            'total'=>$final
        ]);


    }
    public static function changeValuesBeDismantle($request)
    {   
        // if()
        $db=DB::table('prism_survey_assets_to_be_dismantle');
        $db->where('id',$request->id);
        if($request->type=="Amount")
        {
            $db->update([
                'amount'=>$request->name         
            ]);
        }
        else if($request->type=="Disc")
        {
            $db->update([
                'disc'=>$request->name         
            ]);
        }
        else if($request->type=="Dep")
        {
            $db->update([
                'dep'=>$request->name         
            ]);
        }
        else if($request->type=="Salvage")
        {
            $db->update([
                'salvage'=>$request->name         
            ]);
        }
        else if($request->type=="Gst")
        {
            $db->update([
                'gst'=>$request->name         
            ]);
        }

    }
    public static function changeAccessoriesToBeRepaired($request)
    {
        DB::table('prism_survey_assets_to_be_repaired')
        ->where('id',$request->id)
        ->update([
            'title'=>$request->name,         
        ]);
    }
    public static function changeAccessoriesToBeDismantle($request)
    {
        DB::table('prism_survey_assets_to_be_dismantle')
        ->where('id',$request->id)
        ->update([
            'title'=>$request->name,         
        ]);
    }
    public static function changeAccessoriesToBeReplaced($request)
    {
        DB::table('prism_survey_assets_to_be_replaced')
        ->where('id',$request->id)
        ->update([
            'title'=>$request->name,         
        ]);
    }

    public static function changeAssetTitle($request,$id)
    {
        DB::table('prism_survey_assets')
        ->where('id',$id)
        ->update([
            'title'=>$request->title,         
        ]);
    }
    
    public static function updateAccessoryType($request)
    {
        DB::table('prism_surveys_accessories')
        ->where('id',$request->id)
        ->update([
            'type'=>$request->name,         
        ]);
    }
    public static function updateToBeRepaired($request)
    {
        $staxrate=0;
        if($request->is_stax==true){
            
            
            
            // $job=DB::table('sales_tax')
            // ->where('id',$request->sale_reg)
            // ->select('sales_tax.rate','sales_tax.region')
            // ->get();
            
            $staxrate=$request->sale_tax_rate;
            $strate= $request->sale_tax_rate / 100;
            $tax=$request->assessed * $strate;
    
        }

        else{

            $job=DB::table('prism_jobs')
            ->where('prism_jobs.id',$request->job_id)
            ->leftJoin('sales_tax','prism_jobs.region','=','sales_tax.region')
            ->select('sales_tax.rate','sales_tax.region')
            ->get();

            $staxrate=$job[0]->rate;
            $strate= $job[0]->rate / 100;
            $tax=$request->assessed * $strate;
    
        }

        DB::table('prism_survey_vehicles')
        ->where('job_id',$request->job_id)
        ->update([
            'to_be_repaired_labour'=>$request->labour,         
            'to_be_repaired_assessed'=>$request->assessed,         
            // 'to_be_repaired_sales_reg'=>$job[0]->region,         
            'to_be_repaired_is_stax'=>$request->is_stax==true?1:0,        
            'to_be_repaired_tax'=>$tax,        
            'to_be_repaired_tax_rate'=>$staxrate        
            // 'to_be_repaired_sales_reg'=>$request->name,         
        ]);

        $items=$request->recs;

        foreach($items as $item)
        {
            DB::table('prism_survey_assets_to_be_repaired')
            ->where('id',$item['id'])
            ->update([
                'title'=>$item['name']      
            ]); 
        }
    }
    public static function  deleteAccessory($id)
    {
         DB::table('prism_surveys_accessories')->where('id', $id)->delete();
        // $file = DB::table('verification_survey_images')->where('id', $id)->delete();

        // Storage::disk('dir')->delete($sur[0]->path);
    }

    public static function  deleteAccessoryToBeRepaired($id)
    {
         DB::table('prism_survey_assets_to_be_repaired')->where('id', $id)->delete();
        // $file = DB::table('verification_survey_images')->where('id', $id)->delete();

        // Storage::disk('dir')->delete($sur[0]->path);
    }
    public static function  deleteAccessoryToBeReplaced($id)
    {
         DB::table('prism_survey_assets_to_be_replaced')->where('id', $id)->delete();
        // $file = DB::table('verification_survey_images')->where('id', $id)->delete();

        // Storage::disk('dir')->delete($sur[0]->path);
    }
    public static function  deleteAccessoryToBeDismantle($id)
    {
         DB::table('prism_survey_assets_to_be_dismantle')->where('id', $id)->delete();
        // $file = DB::table('verification_survey_images')->where('id', $id)->delete();

        // Storage::disk('dir')->delete($sur[0]->path);
    }

    public static function getBillData($id)
    {
        $db=DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_surveys_types','prism_jobs.survey_type','=','prism_surveys_types.id')
        ->leftJoin('prism_survey_vehicles','bill.bill_id','=','prism_survey_vehicles.job_id')
        ->leftJoin('prism_insurer_branches','prism_jobs.insurer_branch','=','prism_insurer_branches.id')
        ->leftJoin('c_city','prism_insurer_branches.city','=','c_city.city_id')
        ->leftJoin('sales_tax','prism_jobs.region','=','sales_tax.region')
        ->where('bill.bill_id',$id)
        ->where('bill.service','Prism')
        ->select(
            'bill.job_number',
            'bill.bill_date',
            'prism_insurers.name as insurer_name',
            'prism_insurers.ntn as ntn',
            'prism_surveys_types.name as survey_type_name',
            'prism_insurer_branches.name as insurer_branch_name',
            'c_city.city_name',
            DB::raw("Date_format(bill.bill_date,'%d-%b-%Y') as dated"),
            'prism_jobs.name_of_insured',
            'prism_jobs.tracking_id as app_id',
            'prism_jobs.loss_no',
            'prism_jobs.type',
            'prism_jobs.is_takaful',
            'prism_jobs.survey_mode',
            'prism_jobs.survey_type',
            'prism_jobs.validity_from',
            'prism_jobs.validity_to',
            'prism_jobs.ntn_of_insured',
            'prism_jobs.re_inspection_charges',
            'prism_jobs.snaps',
            'prism_jobs.extra_visit',
            'prism_jobs.policy_no',
            DB::raw("Date_format(prism_jobs.validity_from,'%d-%b-%Y') as validity_from"),
            DB::raw("Date_format(prism_jobs.validity_to,'%d-%b-%Y') as validity_to"),
            'prism_jobs.address',
            'prism_jobs.contact_person',
            'prism_survey_vehicles.reg_no',
            'prism_jobs.survey_item',
            'prism_survey_vehicles.make',
            'prism_survey_vehicles.manufacture',
            'prism_survey_vehicles.engine_capacity',
            'prism_survey_vehicles.model',
            'prism_survey_vehicles.horse_power',
            'prism_survey_vehicles.engine_no',
            'prism_survey_vehicles.chassis_no',
            'prism_jobs.service_charges',
            'prism_jobs.travelling',
            'prism_jobs.ts_details',
            'prism_jobs.letter_head',
            'prism_jobs.stamp',
            'bill.tax',
            'prism_jobs.sale_tax_rate as rate',
            'bill.total_amount',
            


            )
        ->get();

        $recs=[
            'job_number'=>$db[0]->job_number,
            'insurer_name'=>$db[0]->insurer_name,
            'bill_date'=>$db[0]->bill_date,
            'insurer_branch_name'=>$db[0]->insurer_branch_name,
            'ntn'=>$db[0]->ntn,
            'is_takaful'=>$db[0]->is_takaful,
            'city_name'=>$db[0]->city_name,
            'survey_type'=>$db[0]->survey_type,
            'survey_type_name'=>$db[0]->survey_type_name,
            // 'city_name'=>$db[0]->city_name,
            'dated'=>$db[0]->dated,
            'validity_from'=>date_format(date_create($db[0]->validity_from),'d-M-Y'),
            'validity_to'=>date_format(date_create($db[0]->validity_to),'d-M-Y'),
            'name_of_insured'=>$db[0]->name_of_insured,
            'address'=>$db[0]->address,
            'contact_person'=>$db[0]->contact_person,
            'reg_no'=>$db[0]->reg_no,
            'survey_item'=>$db[0]->survey_item,
            'main_type'=>$db[0]->type,
            'survey_mode'=>$db[0]->survey_mode,
            'loss_no'=>$db[0]->loss_no,
            'policy_no'=>$db[0]->policy_no,
            'ntn_of_insured'=>$db[0]->ntn_of_insured,
            'make'=>$db[0]->make,
            'model'=>$db[0]->model,
            'engine_no'=>$db[0]->engine_no,
            'engine_capacity'=>$db[0]->engine_capacity,
            'horse_power'=>$db[0]->horse_power,
            'chassis_no'=>$db[0]->chassis_no,
            'service_charges'=>number_format($db[0]->service_charges),
            'scharges'=>$db[0]->service_charges,
            'tx'=>$db[0]->tax,
            'snaps'=>number_format($db[0]->snaps),
            're_inspection_charges'=>number_format($db[0]->re_inspection_charges),
            'extra_visit'=>number_format($db[0]->extra_visit),
            'travelling'=>number_format($db[0]->travelling),
            'ts_details'=>$db[0]->ts_details,
            'tax'=>number_format($db[0]->tax),
            'st_rate'=>intval(($db[0]->tax/$db[0]->service_charges)*100),
            'letter_head'=>$db[0]->letter_head,
            'stamp'=>$db[0]->stamp,
            'total_amount_text'=>Inspection::convertNumberToWord(round($db[0]->total_amount)),
            'total_amount'=>number_format($db[0]->total_amount),
        ];
        return $recs;
    }
    public static function getBillsDataForInvoice($id)
    {
        return DB::table('bill')
        ->leftJoin('prism_jobs','bill.bill_id','=','prism_jobs.id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_survey_vehicles','bill.bill_id','=','prism_survey_vehicles.job_id')
        ->leftJoin('prism_insurer_branches','prism_jobs.insurer_branch','=','prism_insurer_branches.id')
        ->leftJoin('c_city','prism_insurer_branches.city','=','c_city.city_id')
        ->leftJoin('sales_tax','prism_jobs.region','=','sales_tax.region')
        ->where('bill.invoice_id',$id)
        ->where('bill.service','Prism')
        ->select(
            'bill.job_number',
            // 'bill.bill_date',
            'prism_insurers.name as insurer_name',
            'c_city.city_name',
            DB::raw("Date_format(bill.bill_date,'%d-%b-%Y') as dated"),
            'prism_jobs.id as jid',
            'prism_jobs.name_of_insured',
            'prism_jobs.address',
            'prism_jobs.letter_head',
            'prism_jobs.stamp',
            'prism_jobs.is_images',
            'prism_jobs.contact_person',
            'prism_survey_vehicles.reg_no',
            'prism_jobs.survey_item',
            'prism_survey_vehicles.make',
            'prism_survey_vehicles.manufacture',
            'prism_survey_vehicles.model',
            'prism_survey_vehicles.horse_power',
            'prism_survey_vehicles.engine_no',
            'prism_survey_vehicles.chassis_no',
            'prism_jobs.service_charges',
            'prism_jobs.travelling',
            'bill.tax',
            'prism_jobs.sale_tax_rate as rate',
            'bill.total_amount'
            )
        ->get();
    }

    public static function getPrismReport($id,$pdf)
    {
        $prism= new Prism;
     
        $data=$prism->getPrismDataForReport($id);

        if($data['letter_head']==1){

        $pdf->setSourceFile("src/reportformat/prism/prismreportformat.pdf");

        }

        else{

        $pdf->setSourceFile("src/reportformat/prism/prismreportformatnoletterhead.pdf");

        }


        $prism->reportPageOne($data,$pdf);

        $prism->reportPageTwo($data,$pdf,0);

        if($data['is_images']==1)
        {
           $prism->reportImagesPage($pdf,$id,$data['letter_head']==1?true:false);

        }

    }

    public static function getPrismReportBulk($id,$pdf,$request)
    {
        $prism= new Prism;
        
        
        $data=$prism->getPrismDataForReport($id);

        if($request->isletter==1)
        {
            $pdf->setSourceFile("src/reportformat/prism/prismreportformat.pdf");

        }
        else{
            $pdf->setSourceFile("src/reportformat/prism/prismreportformatnoletterhead.pdf");

        }

        $prism->reportPageOne($data,$pdf);

        if($request->isstamp==1)
        {

            $prism->reportPageTwo($data,$pdf,1);

        }

        else{

            $prism->reportPageTwo($data,$pdf,0);

        }


    }

    public static function reportImagesPage($pdf,$id,$isletterhead)
    {
        
        $imgs=DB::table('prism_survey_assets')
        ->where('job_id',$id)
        ->where('title','!=','Video')
        ->select('*')
        ->get();

        $count=count($imgs);

        if($count>0)
        {

            $mpdf=PDF::loadView('Prism/Report/imagepage',compact('imgs'));
            $path='Reports/Prism/'.$id . '/Assets/' . 'imgpage.pdf';
            $mpdf->save($path);

            $pageCount = $pdf->setSourceFile('Reports/Prism/' . $id . '/Assets/imgpage.pdf');

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            
                $pdf->setSourceFile('Reports/Prism/' . $id . '/Assets/imgpage.pdf');
                $pdf->AddPage();
                $tplIdx=$pdf->importPage($pageNo);
                $pdf->useTemplate($tplIdx);
                if($isletterhead==true)
                {
                    $pdf->setSourceFile('src/reportformat/prism/letterhead.pdf');
                    $tplIdx = $pdf->importPage(1);
                    $pdf->useTemplate($tplIdx);
    
                }
 
            }


            Storage::disk('dir')->delete($path);
        }

        

    }

    public static function reportPageone($data,$pdf)
    {
        
        $pdf->AddPage();
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        //  $pdf->SetFont('Helvetica');
        $pdf->SetFont('Helvetica','B',10);
        $pdf->SetXY(70, 35);
        $pdf->Write(0, $data['job_id']);

        $pdf->SetFont('Helvetica','B',10);
        $pdf->SetXY(165, 35);
        $pdf->Write(0, $data['dated']);

        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 72);
        $pdf->Write(0, $data['insurer_name']);

        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 77);
        if($data['development_officer']!=null)
        {

            $pdf->MultiCell(70,4, $data['insurer_branch'].', C/O '.$data['development_officer']);

        }
        else{

            $pdf->MultiCell(70,4, $data['insurer_branch']);

        }
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 82);
        $pdf->Write(0, $data['billing_address']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 87);
        $pdf->Write(0, $data['underwriter']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 93);
        $pdf->Write(0, $data['requested_date']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(165 , 93);
        $pdf->Write(0, $data['requested_time']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 98);
        $pdf->Write(0, $data['name_of_insured']);  

        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 104);
        $pdf->Write(0, $data['conatact_insured']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 109);
        $pdf->Write(0, $data['insured_address']);

        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 119);
        $pdf->Write(0, $data['contact_person']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 125);
        $pdf->Write(0, $data['contact_number']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 131);
        $pdf->Write(0, $data['nic_of_insured']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 148);
        $pdf->Write(0, $data['manufacture']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 153);
        $pdf->Write(0, $data['make']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 159);
        $pdf->Write(0, $data['engine_capacity']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 164);
        $pdf->Write(0, $data['variant']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 170);
        $pdf->Write(0, $data['reg_no']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 175);
        $pdf->Write(0, $data['reg_date']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 180);
        $pdf->Write(0, $data['manufacturing_year']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 186);
        $pdf->Write(0, $data['engine_no']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 192);
        $pdf->Write(0, $data['chassis_no']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 197);
        $pdf->Write(0, $data['seating']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 203);
        $pdf->Write(0, $data['color']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 209);
        $pdf->Write(0, $data['odometer']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 215);
        $pdf->Write(0, $data['body_type']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 220);
        $pdf->Write(0, $data['choice_one']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 226);
        $pdf->Write(0, $data['choice_two']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 240);
        $pdf->Multicell(100,4, $data['factory_fitted_accessories']);
        
        if($data['letter_head']==1)
        {
            $pdf->SetFont('Helvetica','',10);
            $pdf->SetXY(95, 248.5);
        
            $pdf->MultiCell(80,4, $data['additional_accessories']);

        }
        else{
            $pdf->SetFont('Helvetica','',10);
            $pdf->SetXY(95, 249.5);
        
            $pdf->MultiCell(80,4, $data['additional_accessories']);

        }

        
    }

    public static function LumpsumReport($id,$ptype)
    {
        



        $db=DB::table('prism_jobs')
        ->where('id',$id)
        ->select('letter_head','job_id','is_images')
        ->get();

        $pr=new Prism;
        $data=$pr->getPrismPartialReportData($id);

        $pdf = null;
        $letter =$db[0]->letter_head==0?false:true;
        $isimages =$db[0]->is_images==0?false:true;
        

        
        if(count($data['repairedAndReplaced']) <= 17)
        {
            $pdfPages = [
                'Prism/Report/Partial/lumpsumReport1',
                'Prism/Report/Partial/lumpsumReport2'
            ];
        }

        else{
            $pdfPages = [
                'Prism/Report/Partial/lumpsumReport1',
                'Prism/Report/Partial/lumpsumReportitems',
                'Prism/Report/Partial/lumpsumReportfinal'
            ];
        }




        // Loop all views
        foreach ($pdfPages as  $key=> $view) {


            // If not yet defined, set the first page
            
            if (is_null($pdf)) {
                $pdf = PDF::loadView($view, $data);



                
                continue;
            
            }
        
            $pdf->getMpdf()->AddPage('P','','','','','','',35,'','','');
            

            $pdf->getMpdf()->WriteHTML((string)view($view, $data));
     
        }
        
        //  return $pdf->stream($db[0]->job_id.'.pdf', 'F');   
        
        
        $pdf->getMpdf()->Output('Reports/Prism/'.$id.'/lumpsum.pdf','F');

        $pdf = new \setasign\Fpdi\Fpdi();

        $pageCount1=$pdf->setSourceFile('Reports/Prism/'.$id.'/lumpsum.pdf');

        for ($pageNo1 = 1; $pageNo1 <= $pageCount1; $pageNo1++) {

            $pdf->setSourceFile('Reports/Prism/'.$id.'/lumpsum.pdf');
            $pdf->AddPage();
            $tplIdx=$pdf->importPage($pageNo1);
            $pdf->useTemplate($tplIdx);


            if($letter==true)
            {
                $pdf->setSourceFile('src/reportformat/prism/letterhead.pdf');
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx);

            }
                

        }
      
        if($ptype==1)
        {
            return $pdf->Output();

        }
        else{

            $pdf->Output('Reports/Prism/'.$id.'/final.pdf','F');

        }
    //    File::delete('Reports/Prism/'.$id.'/lumpsum.pdf');

        
    
    }

    public static function calculationReport($id,$ptype)
    {
        
        // return $data;

        $db=DB::table('prism_jobs')
        ->where('id',$id)
        ->select('letter_head','job_id','is_images')
        ->get();

        $pr=new Prism;
        $data=$pr->getPrismPartialReportData($id);

        $pdf = null;
        $letter =$db[0]->letter_head==0?false:true;
        $isimages =$db[0]->is_images==0?false:true;
        

        // if()
        $pdfPages = [
            'Prism/Report/calculation',
        ];


        // Loop all views
        foreach ($pdfPages as  $key=> $view) {


            // If not yet defined, set the first page
            
            if (is_null($pdf)) {
                $pdf = PDF::loadView($view, $data);

                if($letter==true)
                {
                    // if($stamp==true)
                    // {
                    //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                    // }
                    // $pdf->getMpdf()->Image('images/prismstamp.png',50,150, 170, 100, 'png', '', false);

                    $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                    $tplIdx = $pdf->getMpdf()->ImportPage(1);
                    $pdf->getMpdf()->UseTemplate($tplIdx);

                }
                



                
                continue;
            
            }
        
            // Add another page and add HTML from view to this

            // if($stamp==true)
            // {
             
            // }
            $pdf->getMpdf()->AddPage();
            

            if($letter==true)
            {

                // if($stamp==true)
                // {
                //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                // }

                $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                $tplIdx = $pdf->getMpdf()->ImportPage(1);
                $pdf->getMpdf()->UseTemplate($tplIdx);
                
              
            }

            $pdf->getMpdf()->WriteHTML((string)view($view, $data));
     
        }
        
    
         if($ptype==1)
         {
            //  return $pdf->Output();
             return $pdf->stream($db[0]->job_id.'.pdf', 'I');   
 
         }
         else{
 
            $pdf->getMpdf()->Output('Reports/Prism/'.$id.'/calculation.pdf','F');
 
         }
    
        }



    public static function getPartialData($id){

        return DB::table('prism_jobs')
        ->leftJoin('prism_surveys','prism_jobs.id','=','prism_surveys.job_id')
        ->leftJoin('c_region', 'prism_jobs.region', '=', 'c_region.reg_id')
        ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_insurer_branches','prism_jobs.insurer_branch','=','prism_insurer_branches.id')
        ->leftJoin('prism_survey_vehicles','prism_jobs.id','=','prism_survey_vehicles.job_id')
        ->leftJoin('prism_letters','prism_jobs.id','=','prism_letters.job_id')
        ->where('prism_jobs.id', $id)
        ->select(
        'prism_jobs.job_id',
        'prism_jobs.requested_date',
        'prism_jobs.name_of_insured',
        'prism_jobs.address',
        'prism_jobs.stamp',
        'prism_jobs.part_rates',
        'prism_jobs.is_takaful',
        'prism_jobs.workshop',
        'prism_jobs.policy_no',
        'prism_jobs.loss_no',
        'prism_jobs.tracking_id',
        'prism_jobs.endors_no',
        'prism_jobs.validity_from',
        'prism_jobs.validity_to',
        'prism_jobs.sum_insured',
        'prism_insurers.name as insurer_name',
        'prism_insurer_branches.name as insurer_branch_name',
        'prism_survey_vehicles.make',
        'prism_survey_vehicles.model',
        'prism_survey_vehicles.manufacture',
        'prism_survey_vehicles.reg_no',
        'prism_survey_vehicles.color',
        'prism_survey_vehicles.chassis_no',
        'prism_survey_vehicles.engine_no',
        'prism_survey_vehicles.horse_power',
        'prism_survey_vehicles.engine_capacity',
        'prism_survey_vehicles.odometer',
        'prism_survey_vehicles.name_of_driver',
        'prism_survey_vehicles.license_no',
        'prism_survey_vehicles.issued_on',
        'prism_survey_vehicles.age_of_driver',
        'prism_survey_vehicles.to_be_repaired_labour',
        'prism_survey_vehicles.to_be_repaired_assessed',
        'prism_survey_vehicles.to_be_repaired_tax',
        'prism_survey_vehicles.to_be_repaired_tax_rate',
        'prism_survey_vehicles.to_be_replaced_tax',
        'prism_survey_vehicles.lumpsum',
        'prism_survey_vehicles.to_be_replaced_tax',
        'prism_survey_vehicles.expired_on',
        'prism_survey_vehicles.dents_remarks',
        'prism_jobs.nature_of_loss',
        'prism_surveys.date_of_loss',
        'prism_surveys.time_of_loss',
        'prism_surveys.place_of_loss',
        'prism_surveys.pay_to',
        'prism_surveys.report_date',
        'prism_surveys.re_inspecton_date',
        'prism_surveys.date_of_inspection',
        'prism_surveys.place_of_survey',
        'prism_surveys.circumstances',
        'prism_jobs.requested_date',
        'region.city_name as region_name',
        'prism_letters.text_of_letter'
        // 'prism_insurers.',
        
    
        )
        
        ->get();

    }
    public static function getImages($id)
    {
        return DB::table('prism_survey_assets')
        ->where('job_id',$id)
        ->where('title','!=','Video')
        ->select('*')
        ->get(); 
    }
    public static function getRepaired($id)
    {
        return DB::table('prism_survey_assets_to_be_repaired')
        ->where('job_id',$id)
        ->select('*')
        ->get();
    }

    public static function getReplaced($id)
    {
        return DB::table('prism_survey_assets_to_be_replaced')
        ->where('job_id',$id)
        ->select('*')
        ->get();
    }

    public static function getDismantle($id)
    {
        return DB::table('prism_survey_assets_to_be_dismantle')
        ->where('job_id',$id)
        ->select('*')
        ->get();
    }

    public static function getCalculations($replaced,$dismantle,$istax)
    {

        $costofreplaced=0;
        // $tot=0;
        $costofdismantle=0;
        $discounted=0;        
        $deped=0;        
        $salvage=0;        
        $gst=0;        
        $final=0;
                
        foreach($replaced as $rec)
        {
            $costofreplaced+=$rec->amount;
            $discounted+=($rec->amount*$rec->disc)/100;
            $deped+=($rec->amount*$rec->dep)/100;
            $salvage+=($rec->amount*$rec->salvage)/100;
            
            if($istax==1)
            {
                $dep=($rec->amount*$rec->dep)/100;
                $dis=($rec->amount*$rec->disc)/100;
                $t=$rec->amount-($dep+$dis);
                $gst+=($t*$rec->gst)/100;

            }
            else{

                $gst+=($rec->amount*$rec->gst)/100;

            }
        }

        foreach($dismantle as $rec)
        {
            $costofdismantle+=$rec->amount;
            $discounted+=($rec->amount*$rec->disc)/100;
            $deped+=($rec->amount*$rec->dep)/100;
            $salvage+=($rec->amount*$rec->salvage)/100;
            
            if($istax==1)
            {
                $dep=($rec->amount*$rec->dep)/100;
                $dis=($rec->amount*$rec->disc)/100;
                $t=$rec->amount-($dep+$dis);
                $gst+=($t*$rec->gst)/100;

            }
            else{

                $gst+=($rec->amount*$rec->gst)/100;

            }
        
        }


        if($istax==1)
        {
            $tot=$costofreplaced+$costofdismantle;
            $final=$tot-$discounted-$deped+$gst-$salvage;
        }
        else{
            $tot=$costofreplaced+$costofdismantle;
            $final=$tot-$discounted-$deped-$salvage+$gst;
        }

        
        $data=[
            'costofreplaced'=>$costofreplaced,
            'costofdismantle'=>$costofdismantle,
            'totalcostofparts'=>$tot,
            'discounted'=>$discounted,
            'deped'=>$deped,
            'salvage'=>$salvage,
            'gst'=>$gst,
            'final'=>$final
        ];

        return $data;
    }
    public static function getRepairedAndReplaced($id)
    {        
        $recs = DB::select('call getLumpsumData(?)', array($id));
        return $recs;    
    }


    public static function getPrismPartialReportData($id)
    {
        $prism=new Prism();
        $imgs=$prism->getImages($id);
        $data=$prism->getPartialData($id);

        $repairedAndReplaced=$prism->getRepairedAndReplaced($id);

        $repaired=$prism->getRepaired($id);
        $dismantle=$prism->getDismantle($id);
        $replaced=$prism->getReplaced($id);
        
        

        $calculations=$prism->getCalculations($replaced,$dismantle,$data[0]->to_be_replaced_tax);
        // $calculations=$prism->getCalculations($replaced,$dismantle,0);

        $prdas=false;
        $number = count($repaired);
        if ($number % 2 == 0) {
        // ge "It's even";
            $prdas=false;
            
        }
        else{
            $prdas=true;

        }
        $pldas=false;
        $numberv = count($replaced);
        if ($numberv % 2 == 0) {
        // print "It's even";
            $pldas=false;
            
        }
        else{
            $pldas=true;

        }



        $payto='';
        if($data[0]->pay_to=='Insured')
        {
            $payto='Pay Amount to '.$data[0]->name_of_insured;
        }
        else if($data[0]->pay_to=='Workshop')
        {
            $payto='Pay Amount to '.$data[0]->workshop;

        }
        else if($data[0]->pay_to=='Supplier & Workshop')
        {
            $payto='Pay Amount to '.$data[0]->workshop;

        }
        else if($data[0]->pay_to=='No Loss / No Claim')
        {
            $payto='No Loss / No Claim';

        }
        else{
            $payto='Pay Amount to';

        }

        if($data[0]->to_be_replaced_tax==1)
        {
            if($calculations['totalcostofparts']==0)
            {
                $ttal=0;
                $gstrate=0;
            }
            else{
                $ttal=$calculations['totalcostofparts']-($calculations['deped']+$calculations['discounted']);
                $gstrate=intval(($calculations['gst']/$ttal)*100);
            }

        }
        else{
            if($calculations['totalcostofparts']==0)
            {
                $gstrate=0;

            }
            else{
                $gstrate=intval(($calculations['gst']/$calculations['totalcostofparts'])*100);
            }
            // $gstrate=0;
            
        }

        $recs=[

            'job_id'=>$data[0]->job_id,
            'requested_date'=>date_format(date_create($data[0]->requested_date),'d-M-Y'),
            'report_date'=>date_format(date_create($data[0]->report_date),'F d, Y'),
            're_date'=>$data[0]->re_inspecton_date,
            're_inspection_date'=>date_format(date_create($data[0]->re_inspecton_date),'d-M-Y'),
            'name_of_insured'=>$data[0]->name_of_insured,
            'address'=>$data[0]->address,
            'text_of_letter'=>$data[0]->text_of_letter,
            'region_name'=>$data[0]->region_name,
            'is_takaful'=>$data[0]->is_takaful,
            'policy_no'=>$data[0]->policy_no,
            'loss_no'=>$data[0]->loss_no,
            'tracking_id'=>$data[0]->tracking_id,
            'validity_from'=>date_format(date_create($data[0]->validity_from),'d-M-Y'),
            'validity_to'=>date_format(date_create($data[0]->validity_to),'d-M-Y'),
            'sum_insured'=>$data[0]->sum_insured,
            'insurer_name'=>$data[0]->insurer_name,
            'insurer_branch_name'=>$data[0]->insurer_branch_name,
            'workshop'=>$data[0]->workshop,
            'make'=>$data[0]->make,
            'manufacture'=>$data[0]->manufacture,
            'model'=>$data[0]->model,
            'reg_no'=>$data[0]->reg_no,
            'color'=>$data[0]->color,
            'chassis_no'=>$data[0]->chassis_no,
            'engine_no'=>$data[0]->engine_no,
            'horse_power'=>$data[0]->horse_power,
            'engine_capacity'=>$data[0]->engine_capacity,
            'odometer'=>$data[0]->odometer,
            'name_of_driver'=>$data[0]->name_of_driver,
            'license_no'=>$data[0]->license_no,
            'age_of_driver'=>$data[0]->age_of_driver,
            'endors_no'=>$data[0]->endors_no,
            'issued_on'=>date_format(date_create($data[0]->issued_on ),'d-M-Y'),
            'expired_on'=>date_format(date_create($data[0]->expired_on),'d-M-Y'),
            'nature_of_loss'=>$data[0]->nature_of_loss,
            'date_of_loss'=>date_format(date_create($data[0]->date_of_loss),'d-M-Y'),
            'time_of_loss'=>date_format(date_create($data[0]->time_of_loss),'h:i A'),
            'place_of_loss'=>$data[0]->place_of_loss,
            'date_of_inspection'=>date_format(date_create($data[0]->date_of_inspection),'d-M-Y'),
            'place_of_survey'=>$data[0]->place_of_survey,
            'circumstances'=>$data[0]->circumstances,
            'dents_remarks'=>$data[0]->dents_remarks,
            'lumpsum'=>number_format($data[0]->lumpsum),
            'lumpsumWords'=>ucwords(Inspection::convertNumberToWord($data[0]->lumpsum)),
            // 'requested_date'=>$data[0]->requested_date,
            'repaired_labour'=>number_format($data[0]->to_be_repaired_labour),
            'repaired_assesed'=>number_format($data[0]->to_be_repaired_assessed),
            'repaired_assesed_tax'=>number_format($data[0]->to_be_repaired_tax),
            'repaired_assesed_tax_rate'=>number_format($data[0]->to_be_repaired_tax_rate),
            'costofparts'=>number_format($calculations['costofreplaced']),
            'costofdismantle'=>number_format($calculations['costofdismantle']),
            'totalcostofparts'=>$calculations['totalcostofparts'],
            'stamp'=>$data[0]->stamp==0?false:true,
            'part_rates'=>$data[0]->part_rates==0?false:true,
            'imgs'=>$imgs,
            'repaired'=>$repaired,
            'replaced'=>$replaced,
            'dismantle'=>$dismantle,
            'repairedAndReplaced'=>$repairedAndReplaced,
            'totalparts'=>count($repaired)+count($replaced)+count($dismantle),
            'prdas'=>$prdas,    
            'pldas'=>$pldas,
            'totalbefore'=>number_format($calculations['final']),
            'discount'=>count($replaced)>0?number_format($calculations['discounted']):'0',
            'is_to_be_replaced_tax'=>$data[0]->to_be_replaced_tax,
            'discountrate'=>$calculations['totalcostofparts']==0?0:intval(($calculations['discounted']/$calculations['totalcostofparts'])*100),
            'deped'=>count($replaced)>0?number_format($calculations['deped']):'0',
            'depedrate'=>$calculations['totalcostofparts']==0?0:intval(($calculations['deped']/$calculations['totalcostofparts'])*100), 
            'salvage'=>count($replaced)>0?number_format($calculations['salvage']):'0',
            'salvagerate'=>$calculations['totalcostofparts']==0?0:intval(($calculations['salvage']/$calculations['totalcostofparts'])*100),
            'gstax'=>count($replaced)>0?number_format($calculations['gst']):'0',
            'gstaxrate'=>$gstrate,
            'payto'=>ucwords($payto),
            'finallabour'=>$data[0]->to_be_repaired_assessed+$data[0]->to_be_repaired_tax,
            'finalamount'=>intval($data[0]->to_be_repaired_assessed+$data[0]->to_be_repaired_tax+$calculations['final'])
        ];

        return $recs;

    }


    public static function preInsuranceReport($id)
    {
        
        // return $data;

        $db=DB::table('prism_jobs')
        ->where('id',$id)
        ->select('letter_head','job_id','is_images')
        ->get();

        $pr=new Prism;
        $data=$pr->getPrismDataForReport($id);

        $pdf = null;
        $letter =$db[0]->letter_head==0?false:true;
        $isimages =$db[0]->is_images==0?false:true;
        


        if($isimages==true)
        {
            $pdfPages = [
                'Prism/Report/Pre/first',
                'Prism/Report/Pre/second',
                'Prism/Report/imagepage'
            ];
        }
        else{

            $pdfPages = [
                'Prism/Report/Pre/first',
                'Prism/Report/Pre/second'
            ];
        }


        // Loop all views
        foreach ($pdfPages as  $key=> $view) {


            // If not yet defined, set the first page
            
            if (is_null($pdf)) {
                $pdf = PDF::loadView($view, $data);
                
                if($letter==true)
                {
                    // if($stamp==true)
                    // {
                    //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                    // }
                    // $pdf->getMpdf()->Image('images/prismstamp.png',50,150, 170, 100, 'png', '', false);

                    $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                    $tplIdx = $pdf->getMpdf()->ImportPage(1);
                    $pdf->getMpdf()->UseTemplate($tplIdx);

                }
                



                
                continue;
            
            }
        
            // Add another page and add HTML from view to this

            // if($stamp==true)
            // {
             
            // }
            $pdf->getMpdf()->AddPage();
            

            if($letter==true)
            {

                // if($stamp==true)
                // {
                //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                // }

                $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                $tplIdx = $pdf->getMpdf()->ImportPage(1);
                $pdf->getMpdf()->UseTemplate($tplIdx);
                
              
            }

            $pdf->getMpdf()->WriteHTML((string)view($view, $data));
     
        }
        
         return $pdf->stream($db[0]->job_id.'.pdf', 'I');   




        
    }
    public static function partialLossReport($id,$ptype)
    {
        
        // return $data;

        $db=DB::table('prism_jobs')
        ->where('id',$id)
        ->select('letter_head','job_id','is_images')
        ->get();

        $pr=new Prism;
        $data=$pr->getPrismPartialReportData($id);

        $pdf = null;
        $letter =$db[0]->letter_head==0?false:true;
        $isimages =$db[0]->is_images==0?false:true;
        

        if($isimages==true)
        {
            if($data['totalparts']<=10)
            {
                $pdfPages = [
                    'Prism/Report/Partial/firstpage',
                    'Prism/Report/Partial/second',
                    // 'Prism/Report/Partial/third',
                    'Prism/Report/imagepage'
                ];
            }
            else{
                $pdfPages = [
                    'Prism/Report/Partial/firstpage',
                    'Prism/Report/Partial/second',
                    'Prism/Report/Partial/third',
                    'Prism/Report/imagepage'
                ];
            }
           
        }
        else{

            if($data['totalparts']<=10)
            {
                $pdfPages = [
                    'Prism/Report/Partial/firstpage',
                    'Prism/Report/Partial/second',
                    // 'Prism/Report/Partial/third'
                ];
            }

            else{
                $pdfPages = [
                    'Prism/Report/Partial/firstpage',
                    'Prism/Report/Partial/second',
                    'Prism/Report/Partial/third'
                ];
            }


        }


        // Loop all views
        foreach ($pdfPages as  $key=> $view) {


            // If not yet defined, set the first page
            
            if (is_null($pdf)) {
                $pdf = PDF::loadView($view, $data);

                if($letter==true)
                {
                    // if($stamp==true)
                    // {
                    //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                    // }
                    // $pdf->getMpdf()->Image('images/prismstamp.png',50,150, 170, 100, 'png', '', false);

                    $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                    $tplIdx = $pdf->getMpdf()->ImportPage(1);
                    $pdf->getMpdf()->UseTemplate($tplIdx);

                }
                



                
                continue;
            
            }
        
            // Add another page and add HTML from view to this

            // if($stamp==true)
            // {
             
            // }
            $pdf->getMpdf()->AddPage();
            

            if($letter==true)
            {

                // if($stamp==true)
                // {
                //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                // }

                $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                $tplIdx = $pdf->getMpdf()->ImportPage(1);
                $pdf->getMpdf()->UseTemplate($tplIdx);
                
              
            }

            $pdf->getMpdf()->WriteHTML((string)view($view, $data));
     
        }

        if($ptype==1)
        {
            return $pdf->stream($db[0]->job_id.'.pdf', 'I');   

        }
        else{

            $pdf->getMpdf()->Output('Reports/Prism/'.$id.'/final.pdf','F');

        }
    }
    public static function PreliminaryReport($id,$ptype)
    {
        
        // return $data;

        $db=DB::table('prism_jobs')
        ->where('id',$id)
        ->select('letter_head','job_id','is_images')
        ->get();

        $pr=new Prism;
        $data=$pr->getPrismPartialReportData($id);

        $pdf = null;
        $letter =$db[0]->letter_head==0?false:true;
        $isimages =$db[0]->is_images==0?false:true;
        

        // if()
        if(count($data['dismantle'])+count($data['replaced'])<23)
        {

        $pdfPages = [
            'Prism/Report/Partial/preliminaryReport',
            'Prism/Report/Partial/preliminaryReport2'
        ];

        }   
        else{

            $pdfPages = [
                'Prism/Report/Partial/preliminaryReport',
                'Prism/Report/Partial/preliminaryReport2',
                'Prism/Report/Partial/preliminaryReport3'
            ];
            
        }


        // Loop all views
        foreach ($pdfPages as  $key=> $view) {


            // If not yet defined, set the first page
            
            if (is_null($pdf)) {
                $pdf = PDF::loadView($view, $data);

                if($letter==true)
                {
                    // if($stamp==true)
                    // {
                    //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                    // }
                    // $pdf->getMpdf()->Image('images/prismstamp.png',50,150, 170, 100, 'png', '', false);

                    $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                    $tplIdx = $pdf->getMpdf()->ImportPage(1);
                    $pdf->getMpdf()->UseTemplate($tplIdx);

                }
                



                
                continue;
            
            }
        
            // Add another page and add HTML from view to this

            // if($stamp==true)
            // {
             
            // }
            $pdf->getMpdf()->AddPage();
            

            if($letter==true)
            {

                // if($stamp==true)
                // {
                //     $pdf->getMpdf()->Image('images/prismstamp.png', 130, 200, 80, 80, 'png', '', true, false);

                // }

                $pagecount = $pdf->getMpdf()->SetSourceFile('src/reportformat/prism/letterhead.pdf');
                $tplIdx = $pdf->getMpdf()->ImportPage(1);
                $pdf->getMpdf()->UseTemplate($tplIdx);
                
              
            }

            $pdf->getMpdf()->WriteHTML((string)view($view, $data));
     
        }

        if($ptype==1)
        {
         return $pdf->stream($db[0]->job_id.'.pdf', 'I');   

        }
        else{

            $pdf->getMpdf()->Output('Reports/Prism/'.$id.'/plr.pdf','F');

        }
    }




    public static function reportPageTwo($data,$pdf,$isbulk)
    {
        
        $pdf->AddPage();
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 0, 0);

        //  $pdf->SetFont('Helvetica');
        $pdf->SetFont('Helvetica','B',10);
        $pdf->SetXY(70, 35);
        $pdf->Write(0, $data['job_id']);

        $pdf->SetFont('Helvetica','B',10);
        $pdf->SetXY(165, 35);
        $pdf->Write(0, $data['dated']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 56);
        $pdf->Write(0, $data['damages']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 62);
        $pdf->Write(0, $data['missing_items']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 67);
        $pdf->Write(0, $data['altrations']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 83);
        $pdf->Write(0, "RS." .$data['value']."/=");
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 89);
        $pdf->Write(0, $data['additional_value']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 104);
        $pdf->Write(0, $data['surveyor_name']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 109);
        $pdf->Write(0, $data['place_of_survey']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(95, 115);
        $pdf->Write(0, $data['date_of_inspection']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(165, 115.8);
        $pdf->Write(0, $data['time_of_inspection']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(108, 131.7);
        $pdf->Write(0, $data['copy_of_reg_book']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(108, 136);
        $pdf->Write(0, $data['brand_new_vehicle']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(108, 140.8);
        $pdf->Write(0, $data['copy_of_cnic_insured']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(108, 146);
        $pdf->Write(0, $data['copy_of_import_documents']);
        
        $pdf->SetFont('Helvetica','',10);
        $pdf->SetXY(108, 151);
        $pdf->Write(0, $data['bill_of_entry']);
     

        // $pdf->Image('images/prismstamp.png', 23, 210, 50, '', '', 'http://www.tcpdf.org', '', false, 300);

        if($isbulk==1)
        {
            $pdf->Image('images/prismstamp.png', 0, 170, 100, '', '', '', '', false, 300);

        }
        else{

            if($data['stamp']==1)
            {
        
                $pdf->Image('images/prismstamp.png', 0, 170, 100, '', '', '', '', false, 300);
    
            }
        }

   
    }


    public static function getPrismDataForReport($id)
    {
        $prism= new Prism;

        $recs=$prism->getReportData($id);
        $additional=$prism->getReportDataNonFactoryFitted($id);
        $factory=$prism->getReportDataFactoryFitted($id);
        $sur=$prism->getSurveyDetails($id);
        $vehicle=$prism->getVehicleDetails($id);
        // $imgs=DB::table('prism_surve')
        $data=[
            'job_id'=>$recs[0]->job_id,
            'dated'=>date_format(date_create($sur[0]->report_date),'d/m/Y'),
            'insurer_name'=>$recs[0]->insurer_name,
            'insurer_branch'=>$recs[0]->insurer_branch,
            'billing_address'=>$recs[0]->billing_address,
            'conc_officer'=>$recs[0]->conc_officer,
            'intimating_person'=>$recs[0]->intimating_person,
            'underwriter'=>$recs[0]->underwriter,
            'development_officer'=>$recs[0]->development_officer,
            'requested_date'=>date_format(date_create($recs[0]->requested_date),'d-m-Y'),
            'requested_time'=>date_format(date_create($recs[0]->requested_time),'h:i A'),
            'name_of_insured'=>$recs[0]->name_of_insured,
            'conatact_insured'=>$recs[0]->c_no_of_insured,
            'insured_address'=>$recs[0]->address,
            'contact_person'=>$recs[0]->contact_person,
            'contact_number'=>$recs[0]->contact_nos,
            'nic_of_insured'=>$recs[0]->nic_of_insured,
            'manufacture'=>$vehicle[0]->manufacture,
            'make'=>$vehicle[0]->make,
            'remarks'=>$vehicle[0]->remarks,
            'horse_power'=>$vehicle[0]->horse_power,
            'engine_capacity'=>strtoupper($vehicle[0]->engine_capacity),
            'variant'=>$vehicle[0]->variant,
            'reg_no'=>$vehicle[0]->reg_no,
            'reg_date'=>date_format(date_create($vehicle[0]->reg_date),'Y'),
            'manufacturing_year'=>$vehicle[0]->model,
            'engine_no'=>$vehicle[0]->engine_no,
            'chassis_no'=>$vehicle[0]->chassis_no,
            'seating'=>$vehicle[0]->seating,
            'color'=>$vehicle[0]->color,
            'odometer'=>$vehicle[0]->odometer,
            'body_type'=>ucwords($vehicle[0]->body_type),
            'choice_one'=>ucwords($vehicle[0]->choice_one),
            'choice_two'=>ucwords($vehicle[0]->choice_two),
            'damages'=>$vehicle[0]->damages,
            'missing_items'=>$vehicle[0]->missing_items,
            'altrations'=>$vehicle[0]->altrations,
            'factory_fitted_accessories'=>$factory,
            'additional_accessories'=>$additional,
            'value'=>number_format($vehicle[0]->value),
            'additional_value'=>number_format($vehicle[0]->additional_value),
            'surveyor_name'=>$sur[0]->surveyor_name,
            'place_of_survey'=>$sur[0]->place_of_survey,
            'date_of_inspection'=>date_format(date_create($sur[0]->date_of_inspection),'d-M-Y'),
            'time_of_inspection'=>date_format(date_create($sur[0]->time_of_inspection),'h:i A'),
            'copy_of_reg_book'=>$vehicle[0]->copy_of_reg_book==0?'No':'Yes',
            'brand_new_vehicle'=>$vehicle[0]->brand_new_vehicle==0?'No':'Yes',
            'copy_of_cnic_insured'=>$vehicle[0]->brand_new_vehicle==0?'No':'Yes',
            'copy_of_import_documents'=>$vehicle[0]->copy_of_import_documents==0?'No':'Yes',
            'bill_of_entry'=>$vehicle[0]->bill_of_entry==0?'No':'Yes',
            'letter_head'=>$recs[0]->letter_head,
            'stamp'=>$recs[0]->stamp,
            'is_images'=>$recs[0]->is_images,
            'part_rates'=>$recs[0]->part_rates,

        
        ];

        return $data;


    }

    public static function getBillForPartialLoss($data,$pdf,$stamp,$isstax)
    {
        $rec=[
            'job_number'=>$data->job_number,
            'insurer_name'=>$data->insurer_name,
            'city_name'=>$data->city_name,
            'dated'=>$data->dated,
            'name_of_insured'=>$data->name_of_insured,
            'address'=>$data->address,
            'loss_no'=>$data->loss_no,
            'tracking_id'=>$data->app_id,
            'contact_person'=>$data->contact_person,
            'policy_no'=>$data->policy_no,
            'validity_from'=>$data->validity_from,
            'validity_to'=>$data->validity_to,
            'reg_no'=>$data->reg_no,
            'survey_item'=>ucwords($data->survey_item),
            'make'=>$data->make,
            'manufacture'=>$data->manufacture,
            'model'=>$data->model,
            'stamp'=>$stamp,
            'horse_power'=>$data->horse_power,
            'engine_no'=>$data->engine_no,
            'sales_tax_rate'=>$data->rate,
            'chassis_no'=>$data->chassis_no,
            're_inspection_charges'=>$data->re_inspection_charges,
            'service_charges'=>number_format($data->service_charges),
            'travelling'=>number_format($data->travelling),
            'tax'=>number_format($data->tax),
            'total_amount'=>$isstax==1?number_format($data->total_amount):number_format($data->service_charges+$data->travelling),
            'total_amount_text'=>$isstax==1?strtoupper(Inspection::convertNumberToWord($data->total_amount)."only"):strtoupper(Inspection::convertNumberToWord($data->service_charges+$data->travelling)."only"),
        ];

        $pdf->AddPage();
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        //  $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(15, 65);
        $pdf->Write(0, 'M/s. '.$rec['insurer_name']);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(15, 70);
        $pdf->Write(0, $rec['city_name']);

 
        $pdf->SetFont('Arial','',10);
         $pdf->SetXY(28, 80);
         $pdf->Write(0, $rec['job_number']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetXY(174, 80);
         $pdf->Write(0, $rec['dated']);

         $pdf->SetFont('Arial','B',10);
         $pdf->SetXY(70, 97.5);
         $pdf->MultiCell(60,4,$rec['name_of_insured']);


         $pdf->SetFont('Arial','B',10);
         $pdf->SetXY(70, 102);
         $pdf->MultiCell(60,4,$rec['loss_no']);

         $pdf->SetFont('Arial','B',10);
         $pdf->SetXY(70, 106);
         $pdf->MultiCell(60,4,$rec['loss_no']);


        //  $pdf->SetFont('Arial','B',10);
        //  $pdf->SetFontSize(10);
        //  // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->SetXY(70,107);
        //  $pdf->MultiCell(60,4,$rec['tracking_id']);

         $pdf->SetFont('Arial','B',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,113);
         $pdf->Write(0, $rec['policy_no']);


         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,118);
         $pdf->Write(0, $rec['validity_from']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(110,118);
         $pdf->Write(0, $rec['validity_to']." :");

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,134);
         $pdf->Write(0, $rec['reg_no']);


         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,143);
         $pdf->Write(0, $rec['engine_no']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,148);
         $pdf->Write(0, $rec['chassis_no']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(130,139);
         $pdf->Write(0, $rec['model']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(130,143.5);
         $pdf->Write(0, $rec['horse_power']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(165,171);
         $pdf->Write(0, $rec['service_charges']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(165,175);
         $pdf->Write(0, $rec['re_inspection_charges']);
        
         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(165,179);
         $pdf->Write(0, $rec['re_inspection_charges']);


         if($isstax==1)
         {
            $pdf->SetFont('Arial','',10);
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(165,188);
            $pdf->Write(0, $rec['tax']);
        
            $pdf->SetFont('Arial','',10);
            $pdf->SetFontSize(9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(37,188);
            $pdf->Write(0, 'SalesTax@ '.$rec['sales_tax_rate'].'% on Professional Fee');
        
         }
         
    
        //  $pdf->SetFont('Arial','',10);
        //  $pdf->SetFontSize(10);
        //  // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->SetXY(165,188);
        //  $pdf->Write(0, $rec['total_amount']);
    
    
         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(37.5,199);
         $pdf->Write(0, $rec['total_amount_text']);
    
         $pdf->SetFont('Arial','B',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(165,199);
         $pdf->Write(0, $rec['total_amount']);


        if($rec['stamp']==1)
        {
             $pdf->Image('images/prismstamp.png', 0, 180, 80, '', '', '', '', false, 300);

        }

    }

    public static function getBill($data,$pdf,$stamp,$isstax)
    {
        $rec=[
            'job_number'=>$data->job_number,
            'insurer_name'=>$data->insurer_name,
            'city_name'=>$data->city_name,
            'dated'=>$data->dated,
            'name_of_insured'=>$data->name_of_insured,
            'address'=>$data->address,
            'contact_person'=>$data->contact_person,
            'reg_no'=>$data->reg_no,
            'survey_item'=>ucwords($data->survey_item),
            'make'=>$data->make,
            'manufacture'=>$data->manufacture,
            'model'=>$data->model,
            'stamp'=>$stamp,
            'horse_power'=>$data->horse_power,
            'engine_no'=>$data->engine_no,
            'sales_tax_rate'=>$data->rate,
            'chassis_no'=>$data->chassis_no,
            'service_charges'=>number_format($data->service_charges),
            'travelling'=>number_format($data->travelling),
            'tax'=>number_format($data->tax),
            'total_amount'=>$isstax==1?number_format($data->total_amount):number_format($data->service_charges+$data->travelling),
            'total_amount_text'=>$isstax==1?strtoupper(Inspection::convertNumberToWord($data->total_amount)."only"):strtoupper(Inspection::convertNumberToWord($data->service_charges+$data->travelling)."only"),
        ];

        $pdf->AddPage();
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        //  $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(15, 65);
        $pdf->Write(0, 'M/s. '.$rec['insurer_name']);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(15, 70);
        $pdf->Write(0, $rec['city_name']);

 
        $pdf->SetFont('Arial','',10);
         $pdf->SetXY(28, 80);
         $pdf->Write(0, $rec['job_number']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetXY(174, 80);
         $pdf->Write(0, $rec['dated']);

         $pdf->SetFont('Arial','B',10);
         $pdf->SetXY(70, 97.5);

         $pdf->MultiCell(60,4,$rec['name_of_insured']);


         $pdf->SetFont('Arial','B',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,107);
         $pdf->MultiCell(60,4,$rec['address']);

         $pdf->SetFont('Arial','B',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,118.7);
         $pdf->Write(0, $rec['contact_person']);


         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,134);
         $pdf->Write(0, $rec['reg_no']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(37,139);
         $pdf->Write(0, $rec['survey_item']." :");

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,139);
         $pdf->Write(0, $rec['make']);


         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,143);
         $pdf->Write(0, $rec['engine_no']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(70,148);
         $pdf->Write(0, $rec['chassis_no']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(130,139);
         $pdf->Write(0, $rec['model']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(130,143.5);
         $pdf->Write(0, $rec['horse_power']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(165,179);
         $pdf->Write(0, $rec['service_charges']);

         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(165,183);
         $pdf->Write(0, $rec['travelling']);


         if($isstax==1)
         {
            $pdf->SetFont('Arial','',10);
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(165,188);
            $pdf->Write(0, $rec['tax']);
        
            $pdf->SetFont('Arial','',10);
            $pdf->SetFontSize(9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(37,188);
            $pdf->Write(0, 'SalesTax@ '.$rec['sales_tax_rate'].'% on Professional Fee');
        
         }
         
    
        //  $pdf->SetFont('Arial','',10);
        //  $pdf->SetFontSize(10);
        //  // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->SetXY(165,188);
        //  $pdf->Write(0, $rec['total_amount']);
    
    
         $pdf->SetFont('Arial','',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(37.5,199);
         $pdf->Write(0, $rec['total_amount_text']);
    
         $pdf->SetFont('Arial','B',10);
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(165,199);
         $pdf->Write(0, $rec['total_amount']);


        if($rec['stamp']==1)
        {
             $pdf->Image('images/prismstamp.png', 0, 180, 80, '', '', '', '', false, 300);

        }

    }


    public static function uploadDocuments($request)
    {
        $files = $request->file('files');
        $id = $request->job_id;

        foreach ($files as $file) {

            $originalName = $file->getClientOriginalName();
            $filename = Storage::disk('dir')->putFileAs('Reports/Prism/'.$id.'/Documents', $file, $originalName);
        }


        $jid = $request->jid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $jid . " documents uploaded";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Prism';
        $log->save();
    }

    public static function  deleteAsset($id)
    {
        $file =DB::table('prism_survey_assets')
        ->where('id', $id)
        ->select('*')
        ->get();

        Storage::disk('dir')->delete($file[0]->path);

         DB::table('prism_survey_assets')->where('id', $id)->delete();
        // $file = DB::table('prism_survey_assets')->where('id', $id)->select('path')->get();

    }

    public static function uploadAssets($request)
    {
        $file = $request->file('file');
        $id = $request->jid;
        $type = $request->type;

        $fname = str_random(28);
        $filename = Storage::disk('dir')->putFileAs('Reports/Prism/'.$id.'/Assets', $file, $fname .'.'. $file->getClientOriginalExtension());

        $job = DB::table('prism_survey_assets')->insert([
            'job_id' => $id,
            'title' => $type,
            'path' =>  $filename
            // 'created' =>  $filename,

        ]);



        $jid = $request->jid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job Id:" . $jid . " Asset uploaded";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Prism';
        $log->save();
    }


    public static function addAccessory($request)
    {
        DB::table('prism_surveys_accessories')
        ->insert([
            'job_id'=>$request->job_id,         
            'name'=>'',         
            'type'=>''         
        ]);
    }

    public static function addToBeRepaired($request)
    {
        DB::table('prism_survey_assets_to_be_repaired')
        ->insert([
            'job_id'=>$request->job_id,         
            'title'=>''         
        ]);
    }

    public static function addToBeDismantle($request)
    {
        DB::table('prism_survey_assets_to_be_dismantle')
        ->insert([
            'job_id'=>$request->job_id,         
            'title'=>''         
        ]);
    }

    public static function addToBeReplaced($request)
    {
        DB::table('prism_survey_assets_to_be_replaced')
        ->insert([
            'job_id'=>$request->job_id,         
            'title'=>''         
        ]);
    }

    public static function getReportData($id)
    {
        
        $data = DB::table('prism_jobs')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_intimation_persons','prism_jobs.intimating_person','=','prism_intimation_persons.id')
        ->leftJoin('prism_insurer_branches','prism_jobs.insurer_branch','=','prism_insurer_branches.id')
        ->leftJoin('prism_survey_vehicles','prism_jobs.job_id','=','prism_survey_vehicles.job_id')
        ->where('prism_jobs.id', $id)
        ->select(
            'prism_jobs.job_id',
            'prism_insurers.name as insurer_name',
            'prism_insurer_branches.name as insurer_branch',
            'prism_jobs.underwriter',
            'prism_jobs.development_officer',
            'prism_jobs.insurer_billing_address as billing_address',
            'prism_jobs.insurer_conc_officer as conc_officer',
            'prism_jobs.requested_date',
            'prism_jobs.requested_time',
            'prism_jobs.name_of_insured',
            'prism_jobs.c_no_of_insured',
            'prism_intimation_persons.name as intimating_person',
            'prism_jobs.address',
            'prism_jobs.contact_person',
            'prism_jobs.contact_nos',
            'prism_jobs.nic_of_insured',
            'prism_jobs.letter_head',
            'prism_jobs.stamp',
            'prism_jobs.is_images',
            'prism_jobs.part_rates'
            )
        ->get();

        return $data;

    }

    public static function getVehicleDetails($id)
    {
        
        $data = DB::table('prism_survey_vehicles')
        ->where('prism_survey_vehicles.job_id','=', $id)
        ->select(
            'prism_survey_vehicles.manufacture',
            'prism_survey_vehicles.make',
            'prism_survey_vehicles.horse_power',
            'prism_survey_vehicles.engine_capacity',
            'prism_survey_vehicles.variant',
            'prism_survey_vehicles.reg_no',
            'prism_survey_vehicles.reg_date',
            'prism_survey_vehicles.model',
            'prism_survey_vehicles.engine_no',
            'prism_survey_vehicles.chassis_no',
            'prism_survey_vehicles.seating',
            'prism_survey_vehicles.color',
            'prism_survey_vehicles.odometer',
            'prism_survey_vehicles.body_type',
            'prism_survey_vehicles.select_type_one as choice_one',
            'prism_survey_vehicles.select_type_two as choice_two',
            'prism_survey_vehicles.dents_one as damages',
            'prism_survey_vehicles.dents_two as missing_items',
            'prism_survey_vehicles.dents_three as altrations',
            'prism_survey_vehicles.dents_remarks as remarks',
            'prism_survey_vehicles.value',
            'prism_survey_vehicles.additional_value',
            'prism_survey_vehicles.copy_of_reg_book',
            'prism_survey_vehicles.brand_new_vehicle',
            'prism_survey_vehicles.copy_of_cnic_insured',
            'prism_survey_vehicles.copy_of_import_documents',
            'prism_survey_vehicles.bill_of_entry'
            )
        ->get();
        return $data;
        }
    public static function getSurveyDetails($id)
    {
        
        $data = DB::table('prism_surveys')
        ->leftJoin('users','prism_surveys.surveyor','=','users.id')
        ->where('prism_surveys.job_id','=', $id)
        ->select(
            'users.name as surveyor_name',
            'prism_surveys.place_of_survey',
            'prism_surveys.date_of_inspection',
            'prism_surveys.time_of_inspection',
            'prism_surveys.report_date'
            )
        ->get();
        return $data;
        }
    public static function getReportDataFactoryFitted($id)
    {
        
        $data = DB::table('prism_surveys_accessories')
        ->where('prism_surveys_accessories.job_id','=', $id)
        ->where('prism_surveys_accessories.type','=','Factory Fitted')
        ->select(
            'prism_surveys_accessories.name'
            )
        ->get();

        if(count($data)>0){
            
            $recs=collect();
    
            foreach($data as $rec)
            {
                if($rec->name!="" || $rec->name!=null )
                {
                    $recs->push(
                        $rec->name
                    );
                }
    
            }
    
            $recs->all();
    
            return $recs->implode(', ');
     
            }
            else{
                return 'Nil';
    
            }
    
    }

    public static function getReportDataNonFactoryFitted($id)
    {
        
        $data = DB::table('prism_surveys_accessories')
        ->where('prism_surveys_accessories.job_id','=', $id)
        ->where('prism_surveys_accessories.type','!=','Factory Fitted')
        ->select(
            'prism_surveys_accessories.name'
            )
        ->get();

        if(count($data)>0){
            
        $recs=collect();

        foreach($data as $rec)
        {
            if($rec->name!="" || $rec->name!=null )
            {
                $recs->push(
                    $rec->name
                );
            }

        }

        $recs->all();

        return $recs->implode(', ');
 
        }
        else{
            return 'Nil';

        }


    }

    public static function storeVerificationByIntimating($request)
    {

        $val = new Prism;
        $inti = DB::table('prism_intimation_persons')
        ->where('id', $request->person)
        ->select('*')
        ->get();

        $insurer = DB::table('prism_insurer_branches')
        ->where('id', $inti[0]->branch)
        ->select('*')
        ->get();

        

        // $val->request_date=date("Y/m/d");
        $val->region = $inti[0]->region;
        $val->company = 6;
        $val->type = "Motor";
        $val->branch_conducting = $inti[0]->operational;
        $val->underwriter = $inti[0]->underwriter;
        $val->recovery_branch = $inti[0]->recovery;
        $val->insurer = $inti[0]->insurer_id;
        $val->insurer_branch = $inti[0]->branch;
        $val->intimating_person = $inti[0]->id;
        $val->insurer_billing_address = $insurer[0]->address;
        $val->survey_type = 8;
        $val->is_completed = 0;
        $val->survey_mode = "Pre-Insurance";
        $val->insurer_phone = $insurer[0]->phone;
        $val->name_of_insured = $request->name_of_insured;
        $val->c_no_of_insured = $request->c_no_of_insured;
        $val->contact_nos = $request->c_no_of_insured;
        $val->contact_person = $request->contact_person;
        $val->address = $request->location;
        // $val->insurer_email = $request->insurer_email;
        // $val->insurer_letter_no = $request->insurer_letter;
        $val->insurer_letter_date = date('Y-m-d');
       
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();

        return $inti[0]->region;
    }

  
    public static function holdVerification($request, $id)
    {
        $ishold = $request->is_hold;


        if ($ishold == true) {
            $ibr = Prism::where('id', $id)->first();
            $ibr->cancelled = 0;
            $ibr->is_completed = 2;
            $ibr->hold = $request->is_hold == true ? '1' : '0';
            $ibr->hold_remarks = $request->remarks;
            $ibr->hold_date = date('y-m-d');
            $ibr->save();

            $com_id = $request->commonId;
            $comJob = Job::where('id', $com_id)->first();


            $comJob->status = '2';

            $comJob->save();

            $myid = $request->jobid;
            // $bill = Bill_Ibr::where('job_number', '=', $myid)
            //     ->first();



            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $myid . " was holded";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Prism';
            $log->save();
        } else {
            $ibr = Prism::where('id', $id)->first();
            $ibr->cancelled = 0;
            $ibr->is_completed = 0;
            $ibr->hold = $request->is_hold == true ? '1' : '0';
            $ibr->hold_remarks = '';
            $ibr->hold_date = '';
            $ibr->save();

            $com_id = $request->commonId;
            $comJob = Job::where('id', $com_id)->first();


            $comJob->status = '0';

            $comJob->save();

            $myid = $request->jobid;
            // $bill = Bill_Ibr::where('job_number', '=', $myid)
            //     ->first();



            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $myid . " was resumed";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Prism';
            $log->save();
        }
    }

    public static function cancelVerification($request, $id)
    {

        $ibr = Prism::where('id', $id)->first();
        $ibr->cancelled = 1;
        $ibr->is_completed = 3;
        $ibr->hold = 0;
        $ibr->cancelled_remarks = $request->remarks;
        $ibr->cancelled_date = date('y-m-d');
        $ibr->save();

        $com_id = $request->commonId;
        $comJob = Job::where('id', $com_id)->first();


        $comJob->status = '3';

        $comJob->save();

        $myid = $request->jobid;
        $bill = Bill_Ibr::where('job_number', '=', $myid)->first();
        if ($bill !== null) {

            $bill->status = 'Cancelled';
            $bill->invoice_id = '';
            $bill->save();
        }

        $survey = DB::table('prism_surveys')->where('job_id', $id)->update([
            'status'=>3
        ]);
        // $survey->status = 3;
        // $survey->save();



        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $myid . " was cancelled";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Prism';
        $log->save();
    }

    public static function getLatestJob()
    {
        $cjob = DB::table('prism_jobs')->latest('id', 'desc')->first();
        Storage::disk('dir')->makeDirectory('Reports/Prism/' . $cjob->id . '/Report');
        // Storage::disk('dir')->makeDirectory('Reports/Prism/' . $cjob->id . '/Survey');
        // Storage::disk('dir')->makeDirectory('Reports/Valuation/' . $cjob->id.'/Images');
        return $cjob;
    }

    public static function makeLog($cid)
    {

        $log = new Log;
        // $log->user_id = $request->user()->id;
        $log->activity = "Job No:" . $cid . " Was Added";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Prism';
        $log->save();
    }


    public static function updateJobIDByPerson($request, $cid,$jid)
    {

       
       
        $inti = DB::table('prism_intimation_persons')
        ->where('id', $request->person)
        ->select('*')
        ->get();

        $reg = DB::table('c_region')
        ->where('reg_id', $inti[0]->region)
        ->select('*')
        ->get();

        $insurer = DB::table('prism_insurers')
        ->where('id', $inti[0]->insurer_id)
        ->select('*')
        ->get();
      
        $val1 = Prism::findOrFail($cid);

        $val1->jid =$jid;
        $val1->job_id ="PRM" . '/' . "MTR" . '/' . $reg[0]->reg_prefix . '/' . $insurer[0]->prefix . '/' . $jid . '/' . date('Y');
       
        $val1->save();
    }

    public static function addCommonJobByPerson($request, $cid,$jid)
    {

       
       
        $inti = DB::table('prism_intimation_persons')
        ->where('id', $request->person)
        ->select('*')
        ->get();

        $reg = DB::table('c_region')
        ->where('reg_id', $inti[0]->region)
        ->select('*')
        ->get();

        $insurer = DB::table('prism_insurers')
        ->where('id', $inti[0]->insurer_id)
        ->select('*')
        ->get();

        $job = new Job;
      
            $job->job_id = "PRM" . '/' . "MTR" . '/' . $reg[0]->reg_prefix . '/' . $insurer[0]->prefix . '/' . $jid . '/' . date('Y');


            $bill = new Bill_Ibr;
            $bill->bill_number =  "PRM" . '/' . "MTR" . '/' . $reg[0]->reg_prefix . '/' . $insurer[0]->prefix . '/' . $jid . '/' . date('Y');
            $bill->job_number =  "PRM" . '/' . "MTR" . '/' . $reg[0]->reg_prefix . '/' . $insurer[0]->prefix . '/' . $jid . '/' . date('Y');
            $bill->total_amount = '0';
            $bill->tax = '0';
            $bill->bill_id =$cid;
            $bill->bill_date = date("Y/m/d");
            $bill->discount = '0';
            $bill->recievable = $reg[0]->reg_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            // $bill->bank = $request->bank_id;
            $bill->company = 6;
            // $bill->branch = $request->branch_id;
            // $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Prism';
            $bill->save();


        
        $job->taken_on = date('Y/m/d');
        $job->company_id =6;
        $job->region_id = $inti[0]->region;
        $job->service = "Prism";
        $job->insurer = $inti[0]->insurer_id;
        $job->insurer_branch = $inti[0]->branch;
        $job->remarks = "";
        $job->status = "0";
        $job->save();

        echo $job->id;
    }
    public static function addCommonJobDuplicate($cid,$jid)
    {
        $j=DB::table('prism_jobs')
        ->leftJoin('c_region','prism_jobs.region','=','c_region.reg_id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_surveys_types','prism_jobs.survey_type','=','prism_surveys_types.id')
        ->where('prism_jobs.id',$jid)
        ->select(
            'prism_jobs.region',
            'prism_jobs.company',
            'prism_jobs.insurer',
            'prism_jobs.insurer_branch',
            'c_region.reg_prefix',
            'prism_insurers.prefix',
            'prism_surveys_types.prefix as type_prefix')
        ->get();

        $cmp = 'PRM';
        $reg = $j[0]->reg_prefix;
        // $typ = $request->survey_type_is;
        // $bnk = $request->bank_prefix;
        $insurerPrefix = $j[0]->prefix;
        $surveyPrefix = $j[0]->type_prefix;
       
        $rc=DB::table('prism_jobs')
        ->where('region',$j[0]->region)
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



        $job = new Job;
      
            $job->job_id = $cmp . '/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');




        
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($j[0]->company);
        $job->region_id = $j[0]->region;
        $job->service = "Prism";
        $job->insurer = $j[0]->insurer;
        $job->insurer_branch = $j[0]->insurer_branch;
        $job->remarks = "";
        $job->status = "0";
        $job->save();

        
        $bill = new Bill_Ibr;
        $bill->bill_number =  $cmp . '/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');
        $bill->job_number =  $cmp . '/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');
        $bill->total_amount = '0';
        $bill->bill_id =$cid;

        $bill->tax = '0';
        $bill->bill_date = date("Y/m/d");
        $bill->discount = '0';
        $bill->recievable = $j[0]->region;
        $bill->old_debt = '0';
        $bill->cancalled = '0';
        // $bill->bank = $request->bank_id;
        $bill->company = 6;
        // $bill->branch = $request->branch_id;
        // $bill->customer = $request->customer_id;
        $bill->status = 'In Progress';
        $bill->service = 'Prism';
        $bill->save();

        echo $job->id;


    }

    public static function addCommonJob($request, $cid)
    {
   
        $cmp = 'PRM';
        $reg = $request->regional_prefix;
        // $typ = $request->survey_type_is;
        $bnk = $request->bank_prefix;
        $insurerPrefix = $request->insuer_prefix;
        $surveyPrefix = $request->survey_type_prefix;
       
        $rc=DB::table('prism_jobs')
        ->where('region',$request->regional_id)
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



        $job = new Job;
      
            $job->job_id = $cmp . '/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');




        
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);
        $job->region_id = $request->regional_id;
        $job->service = "Prism";
        $job->insurer = $request->insurer_id;
        $job->insurer_branch = $request->insurer_branch_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();

        
        $bill = new Bill_Ibr;
        $bill->bill_number =  $cmp . '/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');
        $bill->job_number =  $cmp . '/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');
        $bill->total_amount = '0';
        $bill->bill_id =$cid;

        $bill->tax = '0';
        $bill->bill_date = date("Y/m/d");
        $bill->discount = '0';
        $bill->recievable = $request->regional_id;
        $bill->old_debt = '0';
        $bill->cancalled = '0';
        // $bill->bank = $request->bank_id;
        $bill->company = 6;
        // $bill->branch = $request->branch_id;
        // $bill->customer = $request->customer_id;
        $bill->status = 'In Progress';
        $bill->service = 'Prism';
        $bill->save();

        echo $job->id;



    }

    public static function addSurveyVehicle($request,$cid)
    {
        $make='';
        if($request->vehicle!=0)
        {
            $vehicle = DB::table('prism_vehicles')
            ->where('id', $request->vehicle)
            ->select('*')
            ->get();

            $make=$vehicle[0]->make;
    
        }

        else{

            $make=$request->vehicle_other;

        }

        $id=DB::table('prism_surveys')->insertGetId([
            'job_id'=>$cid,
            'place_of_survey'=>$request->location,
            'surveyor'=>$request->surveyor
        ]);

        DB::table('prism_survey_vehicles')->insert([
            'job_id'=>$cid,
            'survey_id'=>$id,
            'make'=>$make,
            'reg_no'=>$request->reg_no,
            'engine_no'=>$request->engine_no,
            'chassis_no'=>$request->chassis_no,
            'manufacture'=>$request->manufacture,
            'variant'=>$request->vehicle==0?'':$vehicle[0]->variant,
            'horse_power'=>$request->vehicle==0?'':$vehicle[0]->horse_power,
            'seating'=>$request->vehicle==0?'':$vehicle[0]->cubic_capacity,
            'body_type'=>$request->vehicle==0?'':$vehicle[0]->body_type,
            'select_type_one'=>$request->vehicle==0?'':strtolower($vehicle[0]->select_type_one),
            'select_type_two'=>$request->vehicle==0?'':strtolower($vehicle[0]->select_type_two),
        ]);

        // DB::table('prism_surveys')->where('id',$id)->update([
        //     // 'job_id'=>$cid,
        //     // 'place_of_survey'=>$request->location,
        //     'surveyor'=>$request->surveyor,
            
        // ]);

    }

    public static function addSurvey($request,$cid)
    {


        $id=DB::table('prism_surveys')->insertGetId([
            'job_id'=>$cid
        ]);




    }

    public static function updateJobIDDuplicate($cid,$jid)
    {

        $j=DB::table('prism_jobs')
        ->leftJoin('c_region','prism_jobs.region','=','c_region.reg_id')
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_surveys_types','prism_jobs.survey_type','=','prism_surveys_types.id')
        ->where('prism_jobs.id',$jid)
        ->select(
            'prism_jobs.region',
            'prism_jobs.company',
            'prism_jobs.insurer',
            'prism_jobs.insurer_branch',
            'c_region.reg_prefix',
            'prism_insurers.prefix',
            'prism_surveys_types.prefix as type_prefix')
        ->get();

        $cmp ='PRM';
        $reg = $j[0]->reg_prefix;
        // $typ = $request->survey_type_is;
        // $bnk = $request->bank_prefix;
        $insurerPrefix = $j[0]->prefix;
        $surveyPrefix = $j[0]->type_prefix;
        

        $val1 = Prism::findOrFail($cid);

        $rc=DB::table('prism_jobs')
        ->where('region',$j[0]->region)
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

        $val1->jid =$ji;
        $val1->job_id = 'PRM/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');
       
        $val1->save();
    }

    public static function updateJobID($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        // $typ = $request->survey_type_is;
        $bnk = $request->bank_prefix;
        $insurerPrefix = $request->insuer_prefix;
        $surveyPrefix = $request->survey_type_prefix;
        

        $val1 = Prism::findOrFail($cid);

        $rc=DB::table('prism_jobs')
        ->where('region',$request->regional_id)
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

        $val1->jid =$ji;
        $val1->job_id = 'PRM/' . $surveyPrefix . '/' . $reg . '/' . $insurerPrefix . '/' . $ji . '/' . date('Y');
       
        $val1->save();
    }


    public static function gePrismJobData($id)
    {   
        $data=DB::table('prism_jobs')
        ->leftJoin('c_company','prism_jobs.company','=','c_company.company_id')
        ->leftJoin('c_region', 'prism_jobs.region', '=', 'c_region.reg_id')
        ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
        ->leftJoin('c_region AS branch_conduct', 'prism_jobs.branch_conducting', '=', 'branch_conduct.reg_id')
        ->leftJoin('c_city AS branch_conduct_city', 'branch_conduct.reg_city_id', '=', 'branch_conduct_city.city_id')
        ->leftJoin('c_region AS recovery_branch', 'prism_jobs.recovery_branch', '=', 'recovery_branch.reg_id')
        ->leftJoin('c_city AS recovery_branch_city', 'recovery_branch.reg_city_id', '=', 'recovery_branch_city.city_id')
        ->leftJoin('prism_surveys_types', 'prism_jobs.survey_type', '=', 'prism_surveys_types.id')
        ->leftJoin('prism_insurers', 'prism_jobs.insurer', '=', 'prism_insurers.id')
        ->leftJoin('prism_insurer_branches', 'prism_jobs.insurer_branch', '=', 'prism_insurer_branches.id')
        ->leftJoin('prism_letters','prism_jobs.id','=','prism_letters.job_id')
        ->where('prism_jobs.id', $id)
        ->select(
            'prism_jobs.*',
            'c_company.company_name',
            'region.city_name as region_name',
            'branch_conduct_city.city_name as branch_conduct_city',
            'recovery_branch_city.city_name as recovery_branch_city',
            'prism_surveys_types.name as survey_type_name',
            'prism_insurers.name as insurer_name',
            'prism_insurers.prefix as insurer_prefix',
            'prism_insurer_branches.name as insurer_branch_name',
            'prism_letters.text_of_letter'
            )
        ->get();

        $psurveys=DB::table('prism_surveys')
        ->leftJoin('users','prism_surveys.surveyor','=','users.id')
        ->where('prism_surveys.job_id', $id)
        ->select(
            'prism_surveys.*',
            'users.name as surveyor_name'
            )
        ->get();

        if($data[0]->survey_type==8 || $data[0]->survey_type==6)
        {
            $vehicleofsurveys=DB::table('prism_survey_vehicles')
            // ->leftJoin('users','prism_survey_vehicles.survey_id ','=','users.id')
            ->where('prism_survey_vehicles.job_id', $id)
            ->select(
                'prism_survey_vehicles.*'
                // ,
                // 'users.name as surveyor_name'
                )
            ->get();
    
    
    
            $recs=collect();
            $recs->push([
                'requested_date'=>$data[0]->requested_date,
                'requested_time'=>$data[0]->requested_time,
                'jid'=>$data[0]->jid,
                'is_completed'=>$data[0]->is_completed,
                'is_takaful'=>$data[0]->is_takaful,
                'delivered_on'=>$data[0]->delivered_on,
                'company'=>$data[0]->company,
                'company_name'=>$data[0]->company_name,
                'region'=>$data[0]->region,
                'region_name'=>$data[0]->region_name,
                'branch_conducting'=>$data[0]->branch_conducting,
                'branch_conduct_city'=>$data[0]->branch_conduct_city,
                'recovery_branch'=>$data[0]->recovery_branch,
                'recovery_branch_city'=>$data[0]->recovery_branch_city,
                // 
                'underwriter'=>$data[0]->underwriter,
                'development_officer'=>$data[0]->development_officer,
                'survey_type'=>$data[0]->survey_type,
                'survey_type_name'=>$data[0]->survey_type_name,
                'survey_mode'=>$data[0]->survey_mode,
                'survey_item'=>$data[0]->survey_item,
                'survey_mode_other'=>$data[0]->survey_mode_other,
                'survey_item_other'=>$data[0]->survey_item_other,
                'tracking_id'=>$data[0]->tracking_id,
                'name_of_insured'=>$data[0]->name_of_insured,
                'address'=>$data[0]->address,
                'nic_of_insured'=>$data[0]->nic_of_insured,
                'ntn_of_insured'=>$data[0]->ntn_of_insured,
                'c_no_of_insured'=>$data[0]->c_no_of_insured,
                'contact_person'=>$data[0]->contact_person,
                'contact_nos'=>$data[0]->contact_nos,
                'service'=>$data[0]->service,
                'policy_no'=>$data[0]->policy_no,
                'endors_no'=>$data[0]->endors_no,
                'validity_from'=>$data[0]->validity_from,
                'validity_to'=>$data[0]->validity_to,
                'loss_no'=>$data[0]->loss_no,
                'nature_of_loss'=>$data[0]->nature_of_loss,
                'market_value'=>$data[0]->market_value,
                'workshop'=>$data[0]->workshop,
                'service_charges'=>$data[0]->service_charges,
                'snaps'=>$data[0]->snaps,
                're_inspection_charges'=>$data[0]->re_inspection_charges,
                'ts_details'=>$data[0]->ts_details,
                'extra_visit'=>$data[0]->extra_visit,
                'is_tax'=>$data[0]->is_tax,
                'travelling'=>$data[0]->travelling,
                'sum_insured'=>$data[0]->sum_insured,
                'surveyor_id'=>$psurveys[0]->surveyor,
                'surveyor_name'=>$psurveys[0]->surveyor_name,
                'travelling_expenses'=>$psurveys[0]->travelling_expenses,
                'report_date'=>$psurveys[0]->report_date,
                'survey_status'=>$psurveys[0]->status,
                'survey_cordinates'=>$psurveys[0]->gps_cordinates,
                'survey_location'=>$psurveys[0]->gps_location,
                'survey_remakrs'=>$psurveys[0]->remarks,
                'date_of_inspection'=>$psurveys[0]->date_of_inspection,
                'time_of_inspection'=>$psurveys[0]->time_of_inspection,
                'place_of_survey'=>$psurveys[0]->place_of_survey,
                're_inspecton_date'=>$psurveys[0]->re_inspecton_date,
                'pay_to'=>$psurveys[0]->pay_to,
                'place_of_loss'=>$psurveys[0]->place_of_loss,
                'date_of_loss'=>$psurveys[0]->date_of_loss,
                'time_of_loss'=>$psurveys[0]->time_of_loss,
                'circumstances'=>$psurveys[0]->circumstances,
                'conducted_on'=>$psurveys[0]->conducted_on==''?'':date_format(date_create($psurveys[0]->conducted_on),'d-M-Y H:i:s'),
                // 
                'dents_one'=>$vehicleofsurveys[0]->dents_one,
                'dents_two'=>$vehicleofsurveys[0]->dents_two,
                'dents_three'=>$vehicleofsurveys[0]->dents_three,
                'dents_four'=>$vehicleofsurveys[0]->dents_four,
                'dents_five'=>$vehicleofsurveys[0]->dents_five,
                'dents_remarks'=>$vehicleofsurveys[0]->dents_remarks,
                // 
                'reg_no'=>$vehicleofsurveys[0]->reg_no,
                'reg_date'=>$vehicleofsurveys[0]->reg_date,
                'manufacture'=>$vehicleofsurveys[0]->manufacture,
                'make'=>$vehicleofsurveys[0]->make,
                'model'=>$vehicleofsurveys[0]->model,
                'variant'=>$vehicleofsurveys[0]->variant,
                'engine_no'=>$vehicleofsurveys[0]->engine_no,
                'chassis_no'=>$vehicleofsurveys[0]->chassis_no,
                'engine_capacity'=>$vehicleofsurveys[0]->engine_capacity,
                'seating'=>$vehicleofsurveys[0]->seating,
                'is_paper_available'=>$vehicleofsurveys[0]->is_paper_available,
                'color'=>$vehicleofsurveys[0]->color,
                'odometer'=>$vehicleofsurveys[0]->odometer,
                'body_type'=>$vehicleofsurveys[0]->body_type,
                'select_type_one'=>$vehicleofsurveys[0]->select_type_one,
                'select_type_two'=>$vehicleofsurveys[0]->select_type_two,
                'additional_value'=>$vehicleofsurveys[0]->additional_value,
                'value'=>$vehicleofsurveys[0]->value,
                'copy_of_reg_book'=>$vehicleofsurveys[0]->copy_of_reg_book,
                'brand_new_vehicle'=>$vehicleofsurveys[0]->brand_new_vehicle,
                'copy_of_cnic_insured'=>$vehicleofsurveys[0]->copy_of_cnic_insured,
                'copy_of_import_documents'=>$vehicleofsurveys[0]->copy_of_import_documents,
                'bill_of_entry'=>$vehicleofsurveys[0]->bill_of_entry,
                'name_of_driver'=>$vehicleofsurveys[0]->name_of_driver,
                'age_of_driver'=>$vehicleofsurveys[0]->age_of_driver,
                'license_no'=>$vehicleofsurveys[0]->license_no,
                'issued_on'=>$vehicleofsurveys[0]->issued_on,
                'expired_on'=>$vehicleofsurveys[0]->expired_on,
                // 
                'insurer'=>$data[0]->insurer,
                'insurer_branch'=>$data[0]->insurer_branch,
                'insurer_name'=>$data[0]->insurer_name,
                'insurer_prefix'=>$data[0]->insurer_prefix,
                'insurer_branch_name'=>$data[0]->insurer_branch_name,
                'insurer_billing_address'=>$data[0]->insurer_billing_address,
                'insurer_designation'=>$data[0]->insurer_designation,
                'insurer_phone'=>$data[0]->insurer_phone,
                'insurer_email'=>$data[0]->insurer_email,
                'insurer_letter_no'=>$data[0]->insurer_letter_no,
                'insurer_letter_date'=>$data[0]->insurer_letter_date,
                'letter_head'=>$data[0]->letter_head,
                'stamp'=>$data[0]->stamp,
                'is_images'=>$data[0]->is_images,
                'part_rates'=>$data[0]->part_rates,
                'text_of_letter'=>$data[0]->text_of_letter,
    
            ]);
    
    
            $recs->all();
        }
        else{
    
    
    
            $recs=collect();
            $recs->push([
                'requested_date'=>$data[0]->requested_date,
                'requested_time'=>$data[0]->requested_time,
                'is_completed'=>$data[0]->is_completed,
                'is_takaful'=>$data[0]->is_takaful,
                'delivered_on'=>$data[0]->delivered_on,
                'company'=>$data[0]->company,
                'company_name'=>$data[0]->company_name,
                'region'=>$data[0]->region,
                'region_name'=>$data[0]->region_name,
                'branch_conducting'=>$data[0]->branch_conducting,
                'branch_conduct_city'=>$data[0]->branch_conduct_city,
                'recovery_branch'=>$data[0]->recovery_branch,
                'recovery_branch_city'=>$data[0]->recovery_branch_city,
                // 
                'underwriter'=>$data[0]->underwriter,
                'development_officer'=>$data[0]->development_officer,
                'survey_type'=>$data[0]->survey_type,
                'survey_type_name'=>$data[0]->survey_type_name,
                'survey_mode'=>$data[0]->survey_mode,
                'survey_item'=>$data[0]->survey_item,
                'survey_mode_other'=>$data[0]->survey_mode_other,
                'survey_item_other'=>$data[0]->survey_item_other,
                'tracking_id'=>$data[0]->tracking_id,
                'name_of_insured'=>$data[0]->name_of_insured,
                'address'=>$data[0]->address,
                'nic_of_insured'=>$data[0]->nic_of_insured,
                'ntn_of_insured'=>$data[0]->ntn_of_insured,
                'c_no_of_insured'=>$data[0]->c_no_of_insured,
                'contact_person'=>$data[0]->contact_person,
                'contact_nos'=>$data[0]->contact_nos,
                'service'=>$data[0]->service,
                'policy_no'=>$data[0]->policy_no,
                'endors_no'=>$data[0]->endors_no,
                'ts_details'=>$data[0]->ts_details,
                'validity_from'=>$data[0]->validity_from,
                'validity_to'=>$data[0]->validity_to,
                'loss_no'=>$data[0]->loss_no,
                'nature_of_loss'=>$data[0]->nature_of_loss,
                'market_value'=>$data[0]->market_value,
                'workshop'=>$data[0]->workshop,
                'service_charges'=>$data[0]->service_charges,
                'snaps'=>$data[0]->snaps,
                're_inspection_charges'=>$data[0]->re_inspection_charges,
                'extra_visit'=>$data[0]->extra_visit,
                'is_tax'=>$data[0]->is_tax,
                'travelling'=>$data[0]->travelling,
                'sum_insured'=>$data[0]->sum_insured,
                'surveyor_id'=>$psurveys[0]->surveyor,
                'surveyor_name'=>$psurveys[0]->surveyor_name,
                'travelling_expenses'=>$psurveys[0]->travelling_expenses,
                'report_date'=>$psurveys[0]->report_date,
                'survey_status'=>$psurveys[0]->status,
                'survey_cordinates'=>$psurveys[0]->gps_cordinates,
                'survey_location'=>$psurveys[0]->gps_location,
                'survey_remakrs'=>$psurveys[0]->remarks,
                'date_of_inspection'=>$psurveys[0]->date_of_inspection,
                'time_of_inspection'=>$psurveys[0]->time_of_inspection,
                'place_of_survey'=>$psurveys[0]->place_of_survey,
                're_inspecton_date'=>$psurveys[0]->re_inspecton_date,
                'pay_to'=>$psurveys[0]->pay_to,
                'place_of_loss'=>$psurveys[0]->place_of_loss,
                'date_of_loss'=>$psurveys[0]->date_of_loss,
                'time_of_loss'=>$psurveys[0]->time_of_loss,
                'circumstances'=>$psurveys[0]->circumstances,
                'conducted_on'=>$psurveys[0]->conducted_on==''?'':date_format(date_create($psurveys[0]->conducted_on),'d-M-Y H:i:s'),
                'insurer'=>$data[0]->insurer,
                'insurer_branch'=>$data[0]->insurer_branch,
                'insurer_name'=>$data[0]->insurer_name,
                'insurer_prefix'=>$data[0]->insurer_prefix,
                'insurer_branch_name'=>$data[0]->insurer_branch_name,
                'insurer_billing_address'=>$data[0]->insurer_billing_address,
                'insurer_designation'=>$data[0]->insurer_designation,
                'insurer_phone'=>$data[0]->insurer_phone,
                'insurer_email'=>$data[0]->insurer_email,
                'insurer_letter_no'=>$data[0]->insurer_letter_no,
                'insurer_letter_date'=>$data[0]->insurer_letter_date,
                'letter_head'=>$data[0]->letter_head,
                'stamp'=>$data[0]->stamp,
                'is_images'=>$data[0]->is_images,
                'part_rates'=>$data[0]->part_rates,
                'text_of_letter'=>$data[0]->text_of_letter,
            ]);
    
    
            $recs->all();
        }

       
        return $recs;
    }

    public static function getFinalReport($id)
    {
        $myFile = '/Reports/Prism/' . $id . '/Report/final.pdf';
        $file = Storage::disk('dir')->exists($myFile);
        if ($file) {
            return $myFile;
        } else {
            $val = Prism::where('id', $id)->first();
            $val->final_draft = "";
            $val->save();
            return 'File does not exists';
        }
    }

    public static function uploadFinal($request, $id, $file)
    {

        $filename = Storage::disk('dir')->putFileAs('Reports/Prism/' . $id . '/Report', $file, 'final.pdf');

        $path = '/Reports/Prism/' . $id . '/Report/final.pdf';
        $exists = Storage::disk('dir')->exists($path);
        if ($exists) {
            $jid = $request->jid;
            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $jid . " final document uploaded";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Prism';
            $log->save();

            $ibr = Prism::where('id', $id)->first();
            $ibr->final_draft = 'Reports/Prism/' . $id . '/Report/final.pdf';
            $ibr->save();


            return $path;
        } else {
            return false;
        }
    }

    

    public static function addImage($request, $id)
    {

        // $sur=DB::table('prism_surveys')->where('job_id',$id)->select('*')->get();


        $files = $request->file('image');

        foreach($files as $file)
        {
            // echo $file."<br>";
            // return $file;Fff

            $fname = str_random(28);

            $path = Storage::disk('dir')->putFileAs('Reports/Prism/'.$id.'/Assets', $file, $fname . ".".$file->getClientOriginalExtension());
    

            $img = Image::make($path);
            // $height = Image::make($path)->height();
            // $width = Image::make($path)->width();

            // $heightper=intval((90 / 100) * $height);

            // $widthper=intval((65 / 100) * $width);

            // $cordinates=$sur[0]->gps_cordinates;
            // $img->blur(15);
            // $img->text($request->taken_on, 15, $heightper, function($font) {
            // // $img->text($request->taken_on, 1120, 746, function($font) {
            //     $font->file(public_path('ffont/roboto.ttf'));
            //     $font->size(30);
            //     $font->color('#fdf6e3');

            //     // $font->angle(45);
            // });

            // if($sur[0]->gps_location!=null)
            // {
            //     $img->text($sur[0]->gps_location, 15, $heightper+30, function($font) {
            //         $font->file(public_path('ffont/roboto.ttf'));
            //         $font->size(30);
            //         $font->color('#FFFFFF');
            //     });            
            // }

            // if($sur[0]->gps_cordinates!=null)
            // {
            //     $img->text($sur[0]->gps_cordinates, 15, $heightper+60, function($font) {
            //         $font->file(public_path('ffont/roboto.ttf'));
            //         $font->size(30);
            //         $font->color('#FFFFFF');
            //     });
                
            // }


            $img->save($path);


            $img= DB::table('prism_survey_assets')->insert([
                'path' => $path,
                'job_id' => $id,
                'title' => $fname.".".$file->getClientOriginalExtension(),
                'taken_at' => $request->taken_on,
                'location' => $request->location,
                'asset_type' => 'app-image',
                'cordinates' => $request->cordinates
                
            ]);


        }

        
        

         return response()->json([
            "success" => true
            // "height" => $height,
            // // "heightper" =>$heightper,
            // "width" => $width,
            // // "widthper" => $widthper,
            // "imagepath" => url('/')."/".$path,
        ]);
        


    }
    public static function getAccessoriesForApp($id,$type)
    {

        $recs=DB::table('prism_surveys_accessories')
        ->where('job_id',$id)
        ->where('type',$type)
        ->select('name')
        ->get();

        $items=collect();

        foreach($recs as $item)
        {
            $items->push($item->name);
        }

        $items->all();

        

        return $items;
        

    }

    public static function addAccessoriesForApp($rec,$id,$type)
    {

        if($rec!="")
        {
            $not = array_map('trim', explode(',', $rec));
    
            foreach($not as $item)
            {
                DB::table('prism_surveys_accessories')
                ->where('')
                ->insert([
                    'job_id'=>$id,
                    'name'=>$item,
                    'type'=>$type,
                ]);
            }
        }
       
    }

    public static function updatePrismJob($request, $id)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = Prism::where('id', $id)->first();

        $ibr->requested_date = $request->requested_date;
        $ibr->requested_time = $request->requested_time;
        $ibr->delivered_on = $request->delivered_on;
        $ibr->is_takaful = $request->is_takaful == true ? 1 : 0;
        $ibr->is_completed = $request->is_completed == true ? 1 : 0;
        $ibr->is_tax = $request->is_sales_tax == true ? 1 : 0;

        if ($request->is_completed == true) {
            $ibr->completed_on = date('Y-m-d');

            $job=DB::table('prism_jobs')
            ->where('prism_jobs.id',$id)
            ->leftJoin('sales_tax','prism_jobs.region','=','sales_tax.region')
            ->select('sales_tax.rate')
            ->get();
    
            $ibr->sale_tax_rate = $job[0]->rate;
        }

        $ibr->company = $request->job_by;
        // $ibr->region = $request->regional_id;

        $ibr->branch_conducting = $request->branch_conducting;
        $ibr->recovery_branch = $request->recovery_branch;

        $ibr->underwriter = $request->underwriter;
        $ibr->development_officer = $request->development_officer;
        $ibr->survey_type = $request->survey_type;


         $ibr->survey_mode = $request->survey_mode;
         $ibr->survey_mode_other = $request->survey_mode_other;
         $ibr->survey_item = $request->survey_item;
         $ibr->survey_item_other = $request->survey_item_other;

        $ibr->tracking_id = $request->tracking_id;
        $ibr->name_of_insured = $request->name_of_insured;
        $ibr->address = $request->address;
        $ibr->nic_of_insured = $request->nic_of_insured;
        $ibr->ntn_of_insured = $request->ntn_of_insured;
        $ibr->c_no_of_insured = $request->c_no_of_insured;
        $ibr->contact_person = $request->contact_person;
        $ibr->contact_nos = $request->contact_nos;
        $ibr->service = $request->service;
        $ibr->policy_no = $request->policy_no;
        $ibr->endors_no = $request->endors_no;
        $ibr->validity_from = $request->validity_from;
        $ibr->validity_to = $request->validity_to;
        $ibr->loss_no = $request->loss_no;
        $ibr->nature_of_loss = $request->nature_of_loss;
        $ibr->market_value = $request->market_value;
        $ibr->workshop = $request->workshop;
        $ibr->sum_insured = $request->sum_insured;
        // $ibr->dents_one = $request->dents_one;
        // $ibr->dents_two = $request->dents_two;
        // $ibr->dents_three = $request->dents_three;
        // $ibr->dents_four = $request->dents_four;
        // $ibr->dents_five = $request->dents_five;
        // $ibr->dents_remarks = $request->dents_re
         $ibr->insurer = $request->insurer_id;
         $ibr->insurer_branch = $request->insurer_branch_id;
         $ibr->insurer_billing_address = $request->insurer_address;
         $ibr->insurer_designation = $request->insurer_designation;
         $ibr->insurer_phone = $request->insurer_phone;
         $ibr->insurer_email = $request->insurer_email;
         $ibr->insurer_letter_no = $request->insurer_letter;
         $ibr->insurer_letter_date = $request->insurer_date;
         $ibr->insurer_conc_officer = $request->insurer_conc_officer;
         $ibr->service_charges = $request->service_charges;
         $ibr->travelling = $request->travelling;
         $ibr->snaps = $request->snap_charges;
         $ibr->re_inspection_charges = $request->re_inspection_charges;
         $ibr->extra_visit = $request->extra_visit;
         $ibr->ts_details = $request->ts_details;
         $ibr->letter_head = $request->letter_head == true ? 1 : 0;
         $ibr->stamp = $request->stamp == true ? 1 : 0;
         $ibr->is_images = $request->is_images == true ? 1 : 0;
         $ibr->part_rates = $request->part_rates == true ? 1 : 0;
 
        
       
        $ibr->save();

        DB::table('prism_surveys')
        ->where('job_id',$id)
        ->update([
            'surveyor'=>$request->surveyor,
            'travelling_expenses'=>$request->travelling_expenses,
            'report_date'=>$request->report_date,
            'date_of_inspection'=>$request->date_of_inspection,
            'time_of_inspection'=>$request->time_of_inspection,
            'place_of_survey'=>$request->place_of_survey,
            're_inspecton_date'=>$request->re_inspecton_date,
            'pay_to' => $request->pay_to,
            'place_of_loss' => $request->place_of_loss,
            'date_of_loss' => $request->date_of_loss,
            'time_of_loss' => $request->time_of_loss,
            'circumstances' => $request->circumstances
        ]);

        DB::table('prism_survey_vehicles')
        ->where('job_id',$id)
        ->update([
            'reg_no'=>$request->reg_no,
            'reg_date'=>$request->reg_date,
            'manufacture'=>$request->manufacture,
            'make'=>$request->make,
            'model'=>$request->model,
            'variant'=>$request->variant,
            'engine_no'=>$request->engine_no,
            'chassis_no'=>$request->chassis_no,
            'engine_capacity'=>$request->engine_capacity,
            'seating'=>$request->seating,
            'is_paper_available'=>$request->is_paper_available,
            'color'=>$request->color,
            'odometer'=>$request->odometer,
            'body_type'=>$request->body_type,
            'select_type_one'=>$request->select_type_one,
            'select_type_two'=>$request->select_type_two,
            'additional_value'=>$request->additional_value,
            'value'=>$request->value,
            'copy_of_reg_book'=>$request->copy_of_reg_book,
            'brand_new_vehicle'=>$request->brand_new_vehicle,
            'copy_of_cnic_insured'=>$request->copy_of_cnic_insured,
            'copy_of_import_documents'=>$request->copy_of_import_documents,
            'bill_of_entry'=>$request->bill_of_entry,
            'dents_one'=>$request->dents_one,
            'dents_two'=>$request->dents_two,
            'dents_three'=>$request->dents_three,
            'dents_four'=>$request->dents_four,
            'dents_five'=>$request->dents_five,
            'dents_remarks'=>$request->dents_remarks,
            'name_of_driver'=>$request->name_of_driver,
            'age_of_driver'=>$request->age_of_driver,
            'license_no'=>$request->license_no,
            'issued_on'=>$request->issued_on,
            'expired_on'=>$request->expired_on
            // 
                    
        ]);
        
        // DB::table('prism_insurer_branches')
        // ->where('job_id',$id)
        // ->update([
        //     'surveyor'=>$request->surveyor,
        //     'travelling_expenses'=>$request->travelling_expenses,
        //     'report_date'=>$request->report_date,
        //     'date_of_inspection'=>$request->date_of_inspection,
        //     'time_of_inspection'=>$request->time_of_inspection,
        //     'place_of_survey'=>$request->place_of_survey,
        //     're_inspecton_date'=>$request->re_inspecton_date,
        // ]);
        
        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No: " . $jid . " Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Prism';
        $log->save();

        


    }

    public static function updateLocalJob($request, $id)
    {

        $com_id = $request->commonId;

        $job=DB::table('prism_jobs')->where('prism_jobs.id',$id)
        ->leftJoin('prism_insurers','prism_jobs.insurer','=','prism_insurers.id')
        ->leftJoin('prism_surveys_types','prism_jobs.survey_type','=','prism_surveys_types.id')
        ->leftJoin('c_region','prism_jobs.region','=','c_region.reg_id')
        ->select('prism_jobs.*','prism_insurers.prefix as ins_prefix','prism_surveys_types.prefix as type_prefix','c_region.reg_prefix')->get();
        
        $jid="PRM" . '/' . $job[0]->type_prefix . '/' . $job[0]->reg_prefix . '/' .  $job[0]->ins_prefix . '/' . $job[0]->jid . '/' . date_format(date_create($job[0]->created_at),'Y');

        DB::table('prism_jobs')->where('id',$id)->update([
            'job_id'=>$jid
        ]);

        if($request->is_completed==true)
        {
            DB::table('bill')->where('bill_id',$id)->update([

                'bill_number'=>$jid,
                'job_number'=>$jid
            ]);
        }

        else{
            DB::table('bill')->where('bill_id',$id)->update([

                'bill_number'=>$jid,
                'job_number'=>$jid,
                'invoice_id'=>'',
                'status'=>'In Progress'
            ]);
        }

        $comJob = Job::where('id', $com_id)->first();
    

            $comJob->job_id=$jid;
        if ($request->is_completed == true) {
            $comJob->status = '1';
            
        } else {
            $comJob->status = '0';
        }

        $comJob->save();
    }

    public static function getBillsOfInvoice($request)
    {
        return DB::table('bill')
        ->where('bill.invoice_id','=',$request->id)
        ->where('bill.service','Prism')
        ->leftJoin('prism_jobs','bill.bill_number','=','prism_jobs.job_id')
        ->leftJoin('prism_survey_vehicles','prism_jobs.id','=','prism_survey_vehicles.job_id')
        ->leftJoin('prism_intimation_persons','prism_jobs.intimating_person','=','prism_intimation_persons.id')
        ->leftJoin('prism_surveys','prism_jobs.id','=','prism_surveys.job_id')
        ->select(
            'bill.id',
            'prism_jobs.id as job_id',
            'bill.bill_number',
            'prism_jobs.address as owner_address',
            'prism_jobs.policy_no',
            'prism_survey_vehicles.chassis_no',
            'prism_survey_vehicles.engine_no',
            'prism_survey_vehicles.reg_no',
            'prism_surveys.place_of_survey',
            'prism_jobs.service_charges',
            'prism_jobs.travelling',
            'bill.tax',
            // DB::raw('(bill.tax / prism_jobs.service_charges) * 100 as rate'),
            'prism_jobs.sale_tax_rate as rate',
            'bill.total_amount'
            
            )
        // ->groupBy('bill.id')
        ->get();
    }


    public static function getUserCompany($id, $token)
    {

        $rec = Company::where('company_id', $id)
            ->select('*')
            ->get();
        $user = [
            $id,
            $rec[0],
            $token
        ];
        return $user;
    }
}