<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Exports\InvoiceExport;
use App\Exports\InvoiceExportSNBL;
use App\Verification;
use App\VerificationMezzan;
use App\VerificationSoneri;
use App\VerificationHMBL;
use App\VerificationFHM;
use App\VerificationHMM;
use App\VerificationDIB;
use App\VerificationNBR;
use App\VerificationTrelis;
use App\Verificationdata;
use App\Bill_Ibr;
use DataTables;
use Illuminate\Support\Str;
use App\Log;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use MPDF;
use Carbon\Carbon;


class VerificationsController extends Controller
{
    public function verificationCreate(Request $request)
    {
        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Verification::getUserCompany($uid, $token);
        return view('Verification.create', compact('user'));
    }
    public function verifications(Request $request)
    {
        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Verification::getUserCompany($uid, $token);
        return view('Verification.verifications', compact('user'));
    }
    public function verificationInvoices(Request $request)
    {
        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Verification::getUserCompany($uid, $token);
        return view('Verification.invoices', compact('user'));
    }
    public function perfoma(Request $request)
    {
        $uid = 1;
        $token = $request->session()->get('token');
        $user = Verification::getUserCompany($uid, $token);
        return view('Verification.perfoma', compact('user'));
    }

    public function addJob(Request $request)
    {
        Verification::storeVerification($request);
        $cjob = Verification::getLatestJob($request);
        $cid = $cjob->id;
        Verification::addCommonJob($request, $cid);
        Verification::updateJobID($request, $cid);
        Verification::addSurveys($request, $cid);
        Verification::addDetails($request, $cid);
        Verification::makeLog($request, $cid);
    }

    public function getVerificationJob($id)
    {
        $jobDetails = Verification::getJobById($id);
        return $jobDetails;
    }

    public function getQCOfficers()
    {
        $records = Verification::getqcOfficers();
        return $records;
    }
    public function getSurveyors()
    {
        $records = Verification::getSurveyors();
        return $records;
    }
    public function getSurveyImages($id)
    {
        $records = Verification::getSurveyImages($id);
        return $records;
    }

    public function deleteSurveyImage($id)
    {
        // $image = $request->image;
         Verification::deleteSurveyImage($id);
    }
    public function rotateImage(Request $request)
    {
        // $image = $request->image;
         Verification::rotateImage($request);
    }

    public function orderImage(Request $request)
    {
        // $image = $request->image;
         Verification::orderImage($request);
    }
    public function getVerificationChargesTotal(Request $request)
    {
        // $image = $request->image;
      // $image = $request->image;
      $bill=DB::table('bill')
      ->where('job_number',$request->jid)
      ->select('status')
      ->get();
      if($bill[0]->status=="Receivable")
      {
          $recs= Verification::getVerificationBill($request);
          echo $recs[0]->total_amount;
      }
      else{
          $recs= Verification::getVerificationChargesTotal($request);
          echo $recs[0]->total_charges;
      }
        
    }
    public function checkSurveys(Request $request){
        
        $id=$request->jid;
        $surveys=DB::table('verification_surveys')
        ->where('job_id',$id)
        ->where('status',0)
        ->select('*')
        ->get();

        $active=count($surveys);

        echo $active;

        // dd($surveys);
    }
    public function getVerificationBill(Request $request)
    {
        // $image = $request->image;
        $bill=DB::table('bill')
        ->where('job_number','=',$request->id)
        ->select('status')
        ->get();
        if($bill->status=="Receivable")
        {
            $recs= Verification::getVerificationBill($request);
            echo $recs[0]->total_amount;
        }
        else{
            $recs= Verification::getVerificationBill($request);
            echo $recs[0]->total_amount;
        }
      
        
    }
    public function getVerificationSnapCharges(Request $request)
    {
         $snaps= DB::table('verification_survey_images')
        // ->where('survey_id', '=',$request->id)
        ->leftJoin('verification_surveys', 'verification_survey_images.survey_id', '=', 'verification_surveys.id')
        ->select('verification_survey_images.id','verification_survey_images.path','verification_surveys.job_id')
        ->where('verification_surveys.job_id', '=',$request->id)
        ->get();
        $snapscharges=0;
        
        $bank=$request->bank_id;
        if(count($snaps)>0)
        {
            if($bank=="22")
            {
                $snapscharges=0;

            }
            else{
                $snapscharges=100;

            }

        }
        else{
            $snapscharges=0;

        }               
        
        echo $snapscharges;
    }
    public function uploadSurveyimages(Request $request)
    {
        Verification::uploadSurveyimages($request);
    }
    public function getVerificationDetails($id)
    {
        $jobDetails = Verification::getDetailsById($id);
        return $jobDetails;
    }

    public function updateVerification(Request $request, $id)
    {
        Verification::updateVerification($request, $id);
        Verification::updateLocalJob($request, $id);
    }

    public function cancelVerification(Request $request, $id)
    {
        Verification::cancelVerification($request, $id);
    }
    public function holdVerification(Request $request, $id)
    {
        Verification::holdVerification($request, $id);
    }

    public function getAtten($id)
    {
        $recs = DB::table('c_atten')
        ->where('bank_id', $id)        
        ->select(
            '*'
            )
        ->get();

        return $recs;
    }

    public function getInvoiceDetails($id){

        $bill=DB::table('bill')
        ->leftJoin('c_atten','bill.atten','=','c_atten.id')
        ->leftJoin('c_bank','bill.bank','=','c_bank.bank_id')
        ->where('bill.invoice_id',$id)
        ->select('bill.bank','bill.bill_date','c_bank.bank_code','c_atten.name')
        ->groupBy('bill.id')
        ->get();

        if($bill[0]->bank==5)
        {
            
            Verification::invoiceDetails($id,$bill);
        }

        else if($bill[0]->bank==17)
        {
            
            $date=date_format(date_create($bill[0]->bill_date),'F-Y');
            return Excel::download(new InvoiceExportSNBL($id,$bill[0]->bank_code,$date), 'invoices.xlsx');
        }

        else{
            $date=date_format(date_create($bill[0]->bill_date),'F-Y');
            return Excel::download(new InvoiceExport($id,$bill[0]->bank_code,$date), 'invoices.xlsx');

        }
      
    }
    public function updateType(Request $request,$id)
    {
        $job = DB::table('verification_jobs')
        ->where('id',$id)
        ->update([
            'product_type'=>$request->product_type
        ]);

        return $job;

    }
    public function updateVerificationServiceCharges(Request $request,$id){

        Verification::updateServiceCharges($request,$id);
        Verification::updateSnapCharges($request,$id);
        Verification::updateTotalCharges($request,$id);


    }

    public function updateAttention(Request $request,$id){

        // Verification::updateServiceCharges($request,$id);
        // Verification::updateSnapCharges($request,$id);
        // Verification::updateTotalCharges($request,$id);
        // echo $id;

        // echo $id;
        // echo $request->jid;
        Verification::updateAttentionandcharges($request,$request->jid,$id);


    }

    public function verification(Request $request)
    {
        if ($request->ajax()) {
                $jobs = DB::table('verification_jobs_all')
            ->select(
                'id',
                'job_id',
                'taken_on',
                'status',
                'bank_name',
                'cust_name',
                'city',
                'area'
            )
            ->get();
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }

        return view('Verification.index');

    

      

    }
    public function uploadJobsinbulk(Request $request)
    {

        $billid = Verification::getLatestJob($request);

        $theArray = Excel::toCollection('',$request->file('myfile'));
       
        $proType=$request->product_type;
        $bankID=$request->bank_id;

        
        if($proType=="Auto")
        {   
            if($bankID==9){
                return Verification::verticalAutoFormatBislami($request,$theArray,$billid);

            }
            else if($bankID==17){
                return Verification::verticalAutoFormatSoneri($request,$theArray,$billid);

            }

            else if($bankID==5){
                return VerificationMezzan::verticalAutoFormatMezzan($request,$theArray,$billid);

            }

            else if($bankID==10){
                return VerificationMezzan::verticalAutoFormatMezzan($request,$theArray,$billid);

            }
            else if($bankID==12){
                return VerificationHMBL::verticalHomeFormatHMBL($request,$theArray,$billid);

            }
            else if($bankID==20){
                return VerificationFHM::verticalAutoFormatMezzan($request,$theArray,$billid,'Auto');

            }
            else if($bankID==21){
                return VerificationHMM::verticalAutoFormatMezzan($request,$theArray,$billid,'Auto');

            }

            else if($bankID==15){
                return VerificationNBR::verticalAutoFormatMezzan($request,$theArray,$billid,'Auto');

            }

            else if($bankID==22){
                return VerificationTrelis::verticalAutoFormatMezzan($request,$theArray,$billid,'Auto');

            }
            
         }

         else if($proType=="Home"){
             
            if($bankID==9){
                return Verification::verticalHomeFormatBislami($request,$theArray);


            }
            else if($bankID==17){
                return Verification::verticalHomeFormatSoneri($request,$theArray,$billid);

            }
            else if($bankID==12){
                return VerificationHMBL::verticalHomeFormatHMBL($request,$theArray,$billid);

            }

            else if($bankID==20){
                return VerificationFHM::verticalAutoFormatMezzan($request,$theArray,$billid,'Home');

            }
            else if($bankID==21){
                return VerificationHMM::verticalAutoFormatMezzan($request,$theArray,$billid,'Home');

            }
            else if($bankID==15){
                return VerificationNBR::verticalAutoFormatMezzan($request,$theArray,$billid,'Home');

            }
            else if($bankID==22){
                return VerificationTrelis::verticalAutoFormatMezzan($request,$theArray,$billid,'Home');

            }
            else if($bankID==10){
                // return VerificationMezzan::verticalAutoFormatMezzan($request,$theArray,$billid,'Home');
                return VerificationFHM::verticalAutoFormatMezzan($request,$theArray,$billid,'Home');

            }
            
        }

     }

     public function addSurvey(Request $request){

        Verification::addSurvey($request);
    

     }
     public function updateSurvey(Request $request){

        Verification::updateSurvey($request);
    
     }
     public function cancelSurvey(Request $request){

        Verification::cancelSurvey($request);
    
     }
     public function clearSurvey(Request $request){

        Verification::clearSurvey($request);
    
     }
     public function completeSurvey(Request $request){

        Verification::completeSurvey($request);

        // echo $request->sercharges;

      
    
     }

     public function getSurveys($id){

        $surveys = DB::table('verification_surveys')
        ->where('job_id', $id)
        ->select('*')
        ->get();

        return $surveys;

     }
     public function getInvoices(Request $request){

        $bank=$request->bank;
        $year=$request->year;
        $month=$request->month;
        $recs = DB::select('call GetVerificationInvoices(?,?,?)', array($bank, $year, $month));
        return $recs;

        // echo $year .$bank.$month;

     }
     public function getSurveysData($id){

        $surveys = DB::table('verification_surveys')
        ->where('verification_surveys.id', $id)
        ->leftJoin('users as surveyor', 'verification_surveys.surveyor', '=', 'surveyor.id')
        ->leftJoin('c_region', 'surveyor.region', '=', 'c_region.reg_id')
        ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
        ->leftJoin('users as surveyor_report', 'verification_surveys.surveyor_on_report', '=', 'surveyor_report.id')
        ->leftJoin('c_region as r', 'surveyor_report.region', '=', 'r.reg_id')
        ->leftJoin('c_city AS region_on', 'r.reg_city_id', '=', 'region_on.city_id')
        ->leftJoin('c_city AS city', 'verification_surveys.city', '=', 'city.city_id')
        ->select(
            'verification_surveys.type',
            'verification_surveys.city',
            'verification_surveys.longitude',
            'verification_surveys.latitiude',
            'verification_surveys.address',
            'verification_surveys.surveyor_billing',
            'verification_surveys.status',
            'verification_surveys.surveyor',
            'verification_surveys.area',
            'verification_surveys.total_charges',
            'verification_surveys.salary_slip',
            'verification_surveys.is_employee',
            'verification_surveys.surveyor_on_report',
            'surveyor.name AS surveyor_name',
            'surveyor_report.name AS surveyor_on_report_name',
            'region.city_name AS region',
            'region_on.city_name AS region_two',
            'city.city_name AS survey_city',
            DB::raw("DATE_FORMAT(verification_surveys.conducted_on, '%d-%b-%Y %h:%i') as formatted_date")

            
            )
        ->get();

      
        return $surveys;

     }
     public function getDocumentsList(){

        $documents = DB::table('verification_documents')
        ->select('*')
        ->get();

        return $documents;

     }

     
     public function surveyReport(Request $request,$id)
     {  

            $survey = DB::table('verification_surveys')
            ->where('verification_surveys.id', $id)
            ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
            ->leftJoin('verification_jobs', 'verification_surveys.job_id', '=', 'verification_jobs.id')
            ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('users', 'verification_surveys.surveyor', '=', 'users.id')
            ->leftJoin('qc_officers', 'verification_jobs.qc_officer', '=', 'qc_officers.id')
            ->select(
                'verification_jobs.product_type',
                'verification_jobs.job_id',
                'verification_jobs.id',
                'users.name as surveyor',
                'qc_officers.name as qc_officer_name',
                'verification_jobs.product_sub_type',
                'verification_jobs.product_type',
                'verification_jobs.ref_Id',
                'verification_jobs.inquiry_no',
                'verification_surveys.type',
                'verification_surveys.team_lead',
                'verification_surveys.id as sid',
                'c_bank.bank_name',
                'verification_jobs.bank_id as bank_id',
                'verification_job_details.applicant_name',
                'verification_job_details.applicant_contact',
                'verification_job_details.applicant_cnic',
                'verification_job_details.applicant_designation',
                'verification_job_details.applicant_business_name',
                'verification_surveys.address as main_address',
                'verification_surveys.landmark',
                'verification_surveys.conducted_on',
                'verification_surveys.longitude',
                'verification_surveys.salary_slip',
                'verification_surveys.latitiude',
                'verification_surveys.gps_url',
                'verification_surveys.res_applicant_is_available',
                'verification_surveys.res_name_of_person_met',
                'verification_surveys.res_nic_of_person_met',
                'verification_surveys.res_relationship_with_applicant',
                'verification_surveys.res_rel_phone',
                'verification_surveys.res_rel_cell',
                'verification_surveys.res_original_nic_seen',
                'verification_surveys.is_employee',
                'verification_surveys.res_cnic_of_applicant',
                'verification_surveys.res_is_address_correct',
                'verification_surveys.res_correct_address',
                'verification_surveys.res_applicant_live_here',
                'verification_surveys.res_living_since',
                'verification_surveys.res_permanent_address',
                'verification_surveys.res_name_plate_affixed',
                'verification_surveys.res_applicant_is',
                'verification_surveys.res_residence_type',
                'verification_surveys.res_residence_is',
                'verification_surveys.res_residence_is_other',
                'verification_surveys.res_other_residence_type',
                'verification_surveys.res_monthly_rent',
                'verification_surveys.res_rent_deed_verified',
                'verification_surveys.res_residence_utilization',
                'verification_surveys.res_residence_area_size',
                'verification_surveys.res_residence_area_unit',
                'verification_surveys.res_neighboorhood_is',
                'verification_surveys.res_area_access',
                'verification_surveys.res_belongs_to',
                'verification_surveys.res_repossession',
                'verification_surveys.res_neigh_one_name',
                'verification_surveys.res_neigh_one_address',
                'verification_surveys.res_neigh_one_knows_applicant',
                'verification_surveys.res_neigh_one_knows_applicant_since',
                'verification_surveys.res_neigh_one_comments',
                'verification_surveys.res_neigh_two_name',
                'verification_surveys.res_neigh_two_address',
                'verification_surveys.res_neigh_two_knows_applicant',
                'verification_surveys.res_neigh_two_knows_applicant_since',
                'verification_surveys.res_neigh_two_comments',
                'verification_surveys.outcome_comments',
                'verification_surveys.outcome_remarks',
                'verification_surveys.outcome_report_status',
                'verification_surveys.wp_is_applicant_available',
                'verification_surveys.wp_name_of_person_met',
                'verification_surveys.wp_is_address_correct',
                'verification_surveys.wp_correct_address',
                'verification_surveys.wp_establish_time',
                'verification_surveys.wp_working_here_since',
                'verification_surveys.wp_does_applicant_works_here',
                'verification_surveys.wp_new_address',
                'verification_surveys.wp_ohr_date_of_joining',
                'verification_surveys.wp_reson_of_non_ava',
                'verification_surveys.wp_nic_of_person_met',
                'verification_surveys.wp_original_nic_seen',
                'verification_surveys.wp_cnic_of_applicant',
                'verification_surveys.wp_business_type',
                'verification_surveys.wp_other_business_type',
                'verification_surveys.wp_permisses_is',
                'verification_surveys.wp_other_permisses_is',
                'verification_surveys.wp_business_nature',
                'verification_surveys.wp_other_business_nature',
                'verification_surveys.wp_business_legal_activity',
                'verification_surveys.wp_area_unit',
                'verification_surveys.wp_area_size',
                'verification_surveys.wp_business_activity',
                'verification_surveys.wp_name_plate_affixed',
                'verification_surveys.wp_no_of_employees',
                'verification_surveys.wp_established_since',
                'verification_surveys.wp_business_line',
                'verification_surveys.wp_is_government_employee',
                'verification_surveys.mc_one_person_met',
                'verification_surveys.mc_one_addrees',
                'verification_surveys.mc_one_knows_applicant',
                'verification_surveys.mc_one_knows_applicant_since',
                'verification_surveys.mc_one_neighbor_comments',
                'verification_surveys.mc_one_business_established_since',
                'verification_surveys.mc_two_knows_applicant',
                'verification_surveys.mc_two_knows_applicant_since',
                'verification_surveys.mc_two_applicant_salary',
                'verification_surveys.mc_two_neighbor_comments',
                'verification_surveys.mc_two_business_established_since',
                'verification_surveys.mc_two_addrees',
                'verification_surveys.mc_two_person_met',
                'verification_surveys.wp_ohr_name_of_person_met',
                'verification_surveys.wp_ohr_knows_applicant',
                'verification_surveys.wp_ohr_employment_status',
                'verification_surveys.wp_ohr_date_of_joining',
                'verification_surveys.wp_premissi_rent',
                'verification_surveys.wp_ss_slip_verified',
                'verification_surveys.wp_ss_gross_salary',
                'verification_surveys.wp_ss_net_salary',
                'verification_surveys.wp_ss_report_status',
                'verification_surveys.wp_ss_comments',
                'verification_jobs.conid',
                'verification_job_details.applicant_father',
                'verification_job_details.applicant_dob',
                'verification_job_details.applicant_res_phone',
                'verification_job_details.applicant_work_phone',
                'verification_surveys.res_residence_area_details',
                'verification_surveys.res_residence_condition',
                'verification_surveys.res_residence_area_condition',
                'verification_surveys.wp_ohr_verifier_designation',
                'verification_surveys.wp_ohr_applicant_designation',
                'verification_surveys.mc_one_applicant_nature_of_job',
                'verification_surveys.mc_two_applicant_nature_of_job',
                'verification_surveys.mc_one_applicant_salary',
                'verification_surveys.mc_two_applicant_salary',
                'verification_surveys.mc_one_applicant_designation',
                'verification_surveys.mc_one_applicant_emp_status',
                'verification_surveys.mc_two_applicant_designation',
                'verification_surveys.mc_two_applicant_emp_status',
                'verification_surveys.mc_one_designation_of_met_person',
                'verification_surveys.mc_two_designation_of_met_person',
                'verification_surveys.wp_ss_officer_contact',
                'verification_surveys.res_does_know_applicant',
                'verification_surveys.res_know_how'



                )
            ->get();


            $appinfo = DB::table('verification_job_details')
            ->where('verification_job_details.job_id', $survey[0]->conid)
             ->select('*')
            ->get();

            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));
                

                if($survey[0]->bank_id==17)
                {
                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,VerificationSoneri::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,VerificationSoneri::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }
                }
                else if($survey[0]->bank_id==9){

                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,Verification::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,Verification::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }

                }
                else if($survey[0]->bank_id==5){

                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,VerificationMezzan::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,VerificationMezzan::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }

                }
                else if($survey[0]->bank_id==10){

                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,VerificationDIB::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,VerificationDIB::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }

                }
                else if($survey[0]->bank_id==21){

                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,VerificationHMM::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,VerificationHMM::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }

                }
                else if($survey[0]->bank_id==15){

                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,VerificationNBR::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,VerificationNBR::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }

                }
                else if($survey[0]->bank_id==12){

                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,VerificationHMBL::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,VerificationHMBL::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Salary Slip" || $survey[0]->type=="Bank Statement" )
                    {
                        $pdf->Write(0,VerificationHMBL::salaryslipReport($request,$pdf,$survey[0],$appinfo));

                    }
                 

                }

                else if($survey[0]->bank_id==20){

                    if($survey[0]->type=="Workplace")
                    {
                        $pdf->Write(0,VerificationFHM::getworkplaceReport($request,$pdf,$survey[0],$appinfo));

                    }
                    else if($survey[0]->type=="Residence")
                    {
                        $pdf->Write(0,VerificationFHM::getresidenceReport($request,$pdf,$survey[0],$appinfo));

                    }

                }

                $pdf->Output();


          

     }

     public function getBankersData(Request $request){

        if ($request->ajax()) {
            // $jobs = DB::table('verification_jobs')
            // // ->where('verification_surveys.id', $id)
            // ->leftJoin('verification_job_details', 'verification_jobs.id', '=', 'verification_job_details.job_id')
            // ->leftJoin('c_region', 'verification_jobs.region_id', '=', 'c_region.reg_id')
            // ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            // ->select(
            //     'verification_jobs.id',
            //     'verification_jobs.job_id',
            //     'verification_jobs.product_type',
            //     'verification_jobs.completed',
            //     'verification_jobs.created_at',
            //     'verification_job_details.applicant_name',
            //    'region.city_name AS region',


            //     )
            // ->get();
            // return Datatables::of($jobs)
            //     ->addIndexColumn()
            //     ->addColumn('action', '<a href="/finalverificationreport/{{$id}}" target="_blank" class="btn btn-sm btn-primary">View</a>')
            //     ->rawColumns(['action'])
            //     ->editColumn('taken_on', function ($jobs) {
            //         return date('d-M-Y', strtotime($jobs->created_at));
            //     })->make(true);

            if($request->user()->banker_region==0)
            {
                $jobs = DB::table('c_jobs')
                ->where('c_jobs.service', 'Verification')
                ->where('verification_jobs.bank_id', $request->user()->bank_id)
                ->leftJoin('verification_jobs', 'c_jobs.job_id', '=', 'verification_jobs.job_id')
                ->leftJoin('verification_job_details', 'verification_jobs.id', '=', 'verification_job_details.job_id')
                ->leftJoin('c_region', 'verification_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
                ->select(
                    'verification_jobs.id',
                    'verification_jobs.job_id',
                    'verification_jobs.product_type',
                    'c_jobs.status',
                    'verification_jobs.created_at',
                    'verification_jobs.completed_on',
                    'verification_job_details.applicant_name',
                   'region.city_name AS region',
    
    
                    )
                ->get();
            }
            else{
                $jobs = DB::table('c_jobs')
                ->where('c_jobs.service', 'Verification')
                ->where('verification_jobs.bank_id', $request->user()->bank_id)
                ->where('verification_jobs.region_id', $request->user()->banker_region)
                ->leftJoin('verification_jobs', 'c_jobs.job_id', '=', 'verification_jobs.job_id')
                ->leftJoin('verification_job_details', 'verification_jobs.id', '=', 'verification_job_details.job_id')
                ->leftJoin('c_region', 'verification_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
                ->select(
                    'verification_jobs.id',
                    'verification_jobs.job_id',
                    'verification_jobs.product_type',
                    'c_jobs.status',
                    'verification_jobs.created_at',
                    'verification_jobs.completed_on',
                    'verification_job_details.applicant_name',
                   'region.city_name AS region',
    
    
                    )
                ->get();
            }
           
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/finalverificationreport/{{$id}}" target="_blank" class="btn btn-sm btn-primary">View</a>')
                ->rawColumns(['action'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->created_at));
                })->editColumn('completed_on', function ($jobs) {
                    if($jobs->completed_on!=null){
                        return date('d-M-Y', strtotime($jobs->completed_on));

                    }
                })->make(true);

            
        }

        

          

     }

     public function getBillsOfInvoice(Request $request){

        return Verification::getBillsOfInvoice($request);
        // echo $request->id;
     }


     public function printInvoice($id){

        $bill=DB::table('bill')
        ->select('bank')
        ->where('invoice_id',$id)
        ->groupBy('bank')
        ->get();

        if($bill[0]->bank==20)
        {
            Verification::printInvoiceFHM($id);

        }
        else if($bill[0]->bank==21)
        {
            Verification::printInvoiceHMM($id);

        }
        else if($bill[0]->bank==22)
        {
            Verification::printInvoiceTrelis($id);

        }
        else if($bill[0]->bank==10)
        {
            Verification::printInvoiceDIB($id);

        }
        else{
        Verification::printInvoice($id);

        }

       

     }


     public function finalReport(Request $request,$id)
     {  

            $surveys= DB::table('verification_surveys')
           ->where('verification_surveys.job_id', $id)
           ->whereIn('verification_surveys.status', [0,1,3])
            ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
            ->leftJoin('verification_jobs', 'verification_surveys.job_id', '=', 'verification_jobs.id')
            ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('users', 'verification_surveys.surveyor', '=', 'users.id')
            ->leftJoin('qc_officers', 'verification_jobs.qc_officer', '=', 'qc_officers.id')
            ->select(
                'verification_jobs.product_type',
                'verification_jobs.job_id',
                'verification_jobs.id',
                'users.name as surveyor',
                'qc_officers.name as qc_officer_name',
                'verification_jobs.product_sub_type',
                'verification_jobs.product_type',
                'verification_jobs.ref_Id',
                'verification_jobs.inquiry_no',
                'verification_surveys.type',
                'verification_surveys.team_lead',
                'verification_surveys.id as sid',
                'c_bank.bank_name',
                'verification_jobs.bank_id as bank_id',
                'verification_job_details.applicant_name',
                'verification_job_details.applicant_contact',
                'verification_job_details.applicant_cnic',
                'verification_job_details.applicant_designation',
                'verification_job_details.applicant_business_name',
                'verification_surveys.address as main_address',
                'verification_surveys.landmark',
                'verification_surveys.conducted_on',
                'verification_surveys.longitude',
                'verification_surveys.salary_slip',
                'verification_surveys.latitiude',
                'verification_surveys.gps_url',
                'verification_surveys.res_applicant_is_available',
                'verification_surveys.res_name_of_person_met',
                'verification_surveys.res_nic_of_person_met',
                'verification_surveys.res_relationship_with_applicant',
                'verification_surveys.res_rel_phone',
                'verification_surveys.res_rel_cell',
                'verification_surveys.res_original_nic_seen',
                'verification_surveys.is_employee',
                'verification_surveys.res_cnic_of_applicant',
                'verification_surveys.res_is_address_correct',
                'verification_surveys.res_correct_address',
                'verification_surveys.res_applicant_live_here',
                'verification_surveys.res_living_since',
                'verification_surveys.res_permanent_address',
                'verification_surveys.res_name_plate_affixed',
                'verification_surveys.res_applicant_is',
                'verification_surveys.res_residence_type',
                'verification_surveys.res_residence_is',
                'verification_surveys.res_residence_is_other',
                'verification_surveys.res_other_residence_type',
                'verification_surveys.res_monthly_rent',
                'verification_surveys.res_rent_deed_verified',
                'verification_surveys.res_residence_utilization',
                'verification_surveys.res_residence_area_size',
                'verification_surveys.res_residence_area_unit',
                'verification_surveys.res_neighboorhood_is',
                'verification_surveys.res_area_access',
                'verification_surveys.res_belongs_to',
                'verification_surveys.res_repossession',
                'verification_surveys.res_neigh_one_name',
                'verification_surveys.res_neigh_one_address',
                'verification_surveys.res_neigh_one_knows_applicant',
                'verification_surveys.res_neigh_one_knows_applicant_since',
                'verification_surveys.res_neigh_one_comments',
                'verification_surveys.res_neigh_two_name',
                'verification_surveys.res_neigh_two_address',
                'verification_surveys.res_neigh_two_knows_applicant',
                'verification_surveys.res_neigh_two_knows_applicant_since',
                'verification_surveys.res_neigh_two_comments',
                'verification_surveys.outcome_comments',
                'verification_surveys.outcome_remarks',
                'verification_surveys.outcome_report_status',
                'verification_surveys.wp_is_applicant_available',
                'verification_surveys.wp_name_of_person_met',
                'verification_surveys.wp_is_address_correct',
                'verification_surveys.wp_correct_address',
                'verification_surveys.wp_establish_time',
                'verification_surveys.wp_working_here_since',
                'verification_surveys.wp_does_applicant_works_here',
                'verification_surveys.wp_new_address',
                'verification_surveys.wp_ohr_date_of_joining',
                'verification_surveys.wp_reson_of_non_ava',
                'verification_surveys.wp_nic_of_person_met',
                'verification_surveys.wp_original_nic_seen',
                'verification_surveys.wp_cnic_of_applicant',
                'verification_surveys.wp_business_type',
                'verification_surveys.wp_other_business_type',
                'verification_surveys.wp_permisses_is',
                'verification_surveys.wp_other_permisses_is',
                'verification_surveys.wp_business_nature',
                'verification_surveys.wp_other_business_nature',
                'verification_surveys.wp_business_legal_activity',
                'verification_surveys.wp_area_unit',
                'verification_surveys.wp_area_size',
                'verification_surveys.wp_business_activity',
                'verification_surveys.wp_name_plate_affixed',
                'verification_surveys.wp_no_of_employees',
                'verification_surveys.wp_established_since',
                'verification_surveys.wp_business_line',
                'verification_surveys.wp_is_government_employee',
                'verification_surveys.mc_one_person_met',
                'verification_surveys.mc_one_addrees',
                'verification_surveys.mc_one_knows_applicant',
                'verification_surveys.mc_one_knows_applicant_since',
                'verification_surveys.mc_one_neighbor_comments',
                'verification_surveys.mc_one_business_established_since',
                'verification_surveys.mc_two_knows_applicant',
                'verification_surveys.mc_two_knows_applicant_since',
                'verification_surveys.mc_two_applicant_salary',
                'verification_surveys.mc_two_neighbor_comments',
                'verification_surveys.mc_two_business_established_since',
                'verification_surveys.mc_two_addrees',
                'verification_surveys.mc_two_person_met',
                'verification_surveys.wp_ohr_name_of_person_met',
                'verification_surveys.wp_ohr_knows_applicant',
                'verification_surveys.wp_ohr_employment_status',
                'verification_surveys.wp_ohr_date_of_joining',
                'verification_surveys.wp_premissi_rent',
                'verification_surveys.wp_ss_slip_verified',
                'verification_surveys.wp_ss_gross_salary',
                'verification_surveys.wp_ss_net_salary',
                'verification_surveys.wp_ss_report_status',
                'verification_surveys.wp_ss_comments',
                'verification_jobs.conid',
                'verification_job_details.applicant_father',
                'verification_job_details.applicant_dob',
                'verification_job_details.applicant_res_phone',
                'verification_job_details.applicant_work_phone',
                'verification_surveys.res_residence_area_details',
                'verification_surveys.res_residence_condition',
                'verification_surveys.res_residence_area_condition',
                'verification_surveys.wp_ohr_verifier_designation',
                'verification_surveys.wp_ohr_applicant_designation',
                'verification_surveys.mc_one_applicant_nature_of_job',
                'verification_surveys.mc_two_applicant_nature_of_job',
                'verification_surveys.mc_one_applicant_salary',
                'verification_surveys.mc_two_applicant_salary',
                'verification_surveys.mc_one_applicant_designation',
                'verification_surveys.mc_one_applicant_emp_status',
                'verification_surveys.mc_two_applicant_designation',
                'verification_surveys.mc_two_applicant_emp_status',
                'verification_surveys.mc_one_designation_of_met_person',
                'verification_surveys.mc_two_designation_of_met_person',
                'verification_surveys.wp_ss_officer_contact',
                'verification_surveys.res_does_know_applicant',
                'verification_surveys.res_know_how'

            
                )
            ->get();

         

            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));



            foreach($surveys as  $key =>$item)
            {

                $appinfo = DB::table('verification_job_details')
                ->where('verification_job_details.job_id',$item->conid)
                ->select('*')
                ->get();

                if($item->bank_id==17)
                {

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,VerificationSoneri::getworkplaceReport($request,$pdf,$item,$appinfo));
    
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationSoneri::getresidenceReport($request,$pdf,$item,$appinfo));
        
                    }
                }
                else if($item->bank_id==9){

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,Verification::getworkplaceReport($request,$pdf,$item,$appinfo));
    
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,Verification::getresidenceReport($request,$pdf,$item,$appinfo));
        
                    }



                }
                else if($item->bank_id==20){

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,VerificationFHM::getworkplaceReport($request,$pdf,$item,$appinfo));
    
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationFHM::getresidenceReport($request,$pdf,$item,$appinfo));
        
                    }



                }
                else if($item->bank_id==15){

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,VerificationNBR::getworkplaceReport($request,$pdf,$item,$appinfo));
    
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationNBR::getresidenceReport($request,$pdf,$item,$appinfo));
        
                    }



                }
                else if($item->bank_id==5){

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,VerificationMezzan::getworkplaceReportFinal($request,$pdf,$item,$appinfo));
 
                          
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationMezzan::getresidenceReportFinal($request,$pdf,$item,$appinfo));
                        
                    }




                }
                else if($item->bank_id==10){

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,VerificationDIB::getworkplaceReportFinal($request,$pdf,$item,$appinfo));
 
                          
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationDIB::getresidenceReportFinal($request,$pdf,$item,$appinfo));
                        
                    }




                }
                else if($item->bank_id==21){

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,VerificationHMM::getworkplaceReportFinal($request,$pdf,$item,$appinfo));
 
                          
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationHMM::getresidenceReportFinal($request,$pdf,$item,$appinfo));
                        
                    }




                }

                else if($item->bank_id==12)
                {

                    if($item->type=="Workplace")
                    {
                           $pdf->Write(0,VerificationHMBL::getworkplaceReport($request,$pdf,$item,$appinfo));
    
        
                    }
                    else if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationHMBL::getresidenceReport($request,$pdf,$item,$appinfo));
        
                    }
                    else if($item->type=="Salary Slip" || $item->type=="Bank Statement")
                    {
                      $pdf->Write(0,VerificationHMBL::salaryslipReport($request,$pdf,$item,$appinfo));
        
                    }
                }


              
               


            }
            foreach($surveys as  $key =>$item)
            {

                if($item->bank_id==5)
                {
                    if($item->type=="Residence")
                    {
                      $pdf->Write(0,VerificationMezzan::getImagesPageFinal($request,$pdf,$item,$appinfo,"Residence"));
                        
                    }
                    else if($item->type=="Workplace")
                    {
                      $pdf->Write(0,VerificationMezzan::getImagesPageFinal($request,$pdf,$item,$appinfo,"Workplace / Business"));
                        
                    }


                }

                // else if($item->bank_id==10) {
                //     if($item->type=="Residence")
                //     {
                //       $pdf->Write(0,VerificationDIB::getImagesPageFinal($request,$pdf,$item,$appinfo,"Residence"));
                        
                //     }
                //     else if($item->type=="Workplace")
                //     {
                //       $pdf->Write(0,VerificationDIB::getImagesPageFinal($request,$pdf,$item,$appinfo,"Workplace / Business"));
                        
                //     }
                // }

            }
          
            $pdf->Output();


     }
     

    

    public function printBill(Request $request)
    {

        $jobid = $request->jobid;
        $sales = $request->sales;
        $id = $request->id;
        $branchid = $request->branch;
        $bankid = $request->bankID;
       
        $companyid = $request->companyID;
        $attende = $request->atten;

       $bankprefix = DB::table('c_bank')
            ->where('bank_id', $bankid)
            ->select('bank_code')
            ->get();

        // $reportDetails = DB::table('verification_jobs')
        //     ->where('id', $id)
        //     ->select('bill_date')
        //     ->get();

        $servicecharges = DB::select('call GetVerificationtotalBill(?)', array($id));


              

                $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
                $bill->bill_number = $request->jobid;
                $bill->job_number = $request->jobid;
                $bill->bill_date = date('Y-m-d');
                $bill->discount = '0';
                $bill->recievable = $request->region;
                $bill->old_debt = '0';
                $bill->cancalled = '0';
                $bill->bank = $request->bankID;
                $bill->company = $request->companyID;
                $bill->branch = $request->branch;
                $bill->status = 'Receivable';
                $bill->service = 'Verification';
                $bill->atten =  $attende;
                $bill->invoice_id = 'KGT' .'/VER/'.$bankprefix[0]->bank_code.'/'.$attende.'/'.date('m').'/'.date('Y');

                if($request->bankID==17)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    $rate = $sale_reg[0]->rate / 100;
                    $srate = $sale_reg[0]->rate;
                    $stax = $servicecharges[0]->total * $rate;
                   
                    $bill->tax = $stax;
                    $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;
                   

                }

                else if($request->bankID==5)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    $rate = $sale_reg[0]->rate / 100;
                    $srate = $sale_reg[0]->rate;
                    $stax = $servicecharges[0]->total * $rate;
                   
                    $bill->tax = $stax;
                    $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;
                   

                }

                else if($request->bankID==20)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    $rate = $sale_reg[0]->rate / 100;
                    $srate = $sale_reg[0]->rate;
                    $stax = $servicecharges[0]->total * $rate;
                   
                    $bill->tax = $stax;
                    $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;
                   

                }

                
                else if($request->bankID==21)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    $rate = $sale_reg[0]->rate / 100;
                    $srate = $sale_reg[0]->rate;
                    $stax = $servicecharges[0]->total * $rate;
                   
                    $bill->tax = $stax;
                    $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;
                   

                }

                else if($request->bankID==15)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    $rate = $sale_reg[0]->rate / 100;
                    $srate = $sale_reg[0]->rate;
                    $stax = $servicecharges[0]->total * $rate;
                   
                    $bill->tax = $stax;
                    $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;
                   

                }

                else if($request->bankID==12)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    $rate = $sale_reg[0]->rate / 100;
                    $srate = $sale_reg[0]->rate;
                    $stax = $servicecharges[0]->total * $rate;
                   
                    $bill->tax = $stax;
                    $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;
                   

                }

                else if($request->bankID==22)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    // $rate = $sale_reg[0]->rate / 100;
                    // $srate = $sale_reg[0]->rate;
                    // $stax = 3500 * $rate;
                   
                    // $bill->tax = $stax;
                    // $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    // $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;

                    
                    $bill->tax = 0;
                    $bill->total_amount = 3500;
                    $bill->service_charges =3500;
                   

                }

                else if($request->bankID==10)
                {
                    
                    $attenis = DB::table('c_atten')
                    ->where('id', $attende)
                    ->select('sale_reg')
                    ->get();
        
                    $sale_reg = DB::table('sales_tax')
                    ->where('region',$attenis[0]->sale_reg)
                    ->select('rate')
                    ->get();

                    
                    // $rate = $sale_reg[0]->rate / 100;
                    // $srate = $sale_reg[0]->rate;
                    // $stax = 3500 * $rate;
                   
                    // $bill->tax = $stax;
                    // $bill->total_amount = $servicecharges[0]->total+$stax==''?0:$servicecharges[0]->total+$stax;
                    // $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;

                    
                    $bill->tax = 0;
                    $bill->total_amount = 5500;
                    $bill->service_charges =5500;
                   

                }

                else{


                    $bill->tax = '0';
                    $bill->total_amount = $servicecharges[0]->total==''?0:$servicecharges[0]->total;
                    $bill->service_charges =$servicecharges[0]->total==''?0:$servicecharges[0]->total;
                }
                $bill->save();
             
                    
            



            //       $bi = DB::table('bill')
            //         ->where('bank',$bankid)
            //         ->where('service','Verification')
            //         ->where('atten','=',$attende)
            //         ->whereYear('bill_date', '=', date('Y'))
            //         ->whereMonth('bill_date', '=', date('m'))
            //         ->select('*')
            //         ->get();

            //         dd($bi);

            // if($bi=='' || $bi==[] || $bi==null)
            // {

                    
            //    echo rand(2,50);
            //    echo 'not found';

            // }

            // else{

                

            //     $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
            //     $bill->invoice_id =$bi[0]->invoice_id;
            //     $bill->save();

                
               
            

            // }
        // echo $attende;
        
            
        //     $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
        //     $bill->bill_number = $request->jobid;
        //     $bill->job_number = $request->jobid;
        //     $bill->total_amount = $request->service;
        //     $bill->tax = '0';
        //     $bill->discount = '0';
        //     $bill->recievable = $request->region;
        //     $bill->old_debt = '0';
        //     $bill->cancalled = '0';
        //     $bill->bank = $request->bankID;
        //     $bill->company = $request->companyID;
        //     $bill->branch = $request->branch;
        //     // $bill->customer = $request->customerIs;
        //     $bill->status = 'Receivable';
        //     $bill->service = 'Verification';
        //     $bill->save();


        //     $log = new Log;
        //     $log->user_id = $request->user()->id;
        //     $log->activity = $request->jobid . " Bill Was Updated";
        //     $log->date = date('Y/m/d');
        //     $log->time = date("h:i:sa");
        //     $log->service = 'Verification|Livestock';
        //     $log->save();



        // if (empty($bill)) {

        //     $scharges = $request->service == '' ? 0 : $request->service;
        //     $stotal = $scharges;
        //     $srate = 0;
        //     if ($request->sales == null) {
        //         $stax = 0;
        //     } else {
        //         $sale_reg = DB::table('sales_tax')
        //             ->where('region', $request->sales)
        //             ->select('rate')
        //             ->get();
        //         $rate = $sale_reg[0]->rate / 100;
        //         $srate = $sale_reg[0]->rate;
        //         $stax = $stotal * $rate;
        //     }


        //     $total = $stotal + $stax;
        //     $vletter = $request->vendorletter;

        //     $date = date_create($request->bank_date);
        //     $bankDate = date_format($date, "d-M-Y");


        //     $givenby = $request->givenby;

        //     if ($givenby == 'Bank') {
        //         $branchRegion = DB::table('c_branch')
        //             ->where('c_branch.branch_id', $branchid)
        //             ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
        //             ->select('c_city.city_name')
        //             ->get();

        //         $data = [

        //             $request->bank,
        //             $request->address,
        //             $request->jobid,
        //             // $request->company_address,
        //             $request->bank_letter,
        //             $bankDate,
        //             'Verification',
        //             $total,
        //             $request->customer,
        //             $request->vendor,
        //             $request->customerAddress,
        //             $request->vendorAddress,
        //             '',



        //         ];
        //     } else {
        //         $branchRegion = DB::table('c_branch')
        //             ->where('c_branch.branch_id', $branchid)
        //             ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
        //             ->select('c_city.city_name')
        //             ->get();

        //         $data = [

        //             $request->bank,
        //             $request->address,
        //             $request->jobid,
        //             // $request->company_address,
        //             $request->bank_letter,
        //             $bankDate,
        //             'Verification',
        //             $total,
        //             $request->customer,
        //             $request->vendor,
        //             $request->customerAddress,
        //             $request->vendorAddress,
        //             '',



        //         ];
        //     }



        //     $id = $request->id;

        //     $giver = $request->givenby;

        //     $bill = new Bill_Ibr;
        //     $bill->bill_number = $data[2];
        //     $bill->job_number = $data[2];
        //     $bill->bill_date = $reportDetails[0]->bill_date;
        //     $bill->total_amount = $total;
        //     $bill->tax = $stax;
        //     $bill->discount = '0';
        //     $bill->recievable = $request->region;
        //     $bill->old_debt = '0';
        //     $bill->cancalled = '0';
        //     $bill->bank = $request->bankID;
        //     $bill->company = $request->companyID;
        //     $bill->branch = $request->branch;
        //     $bill->customer = $request->customerIs;
        //     $bill->status = 'Receivable';
        //     $bill->service = 'Verification';
        //     $bill->save();


        //     $log = new Log;
        //     $log->user_id = $request->user()->id;
        //     $log->activity = $data[3] . " Bill Was generated";
        //     $log->date = date('Y/m/d');
        //     $log->time = date("h:i:sa");
        //     $log->service = 'Verification|Livestock';
        //     $log->save();


        //     $billData = Verification::getJobByIdForBill($id, $request->jobid);

        //     $tonumber = Verification::convertNumberToWord($total);


        //     $date = date_create($billData['bill'][0]->bill_date);
        //     $billDate = date_format($date, "d-M-Y");

        //     $date1 = date_create($billData['job'][0]->bank_letter_date);
        //     $bankDate = date_format($date1, "d M, Y");

        //     if ($givenby == 'Bank') {
        //         $data = [
        //             $billData['bill'][0]->job_number,
        //             $billDate,
        //             $billData['job'][0]->given_by,
        //             $billData['job'][0]->bank_name,
        //             $billData['job'][0]->bank_address,
        //             $billData['job'][0]->cust_name,
        //             $billData['job'][0]->customer_address,
        //             $billData['job'][0]->bank_letter,
        //             $bankDate,
        //             $tonumber,
        //             $total,
        //             $billData['job'][0]->name,
        //             $billData['job'][0]->byvendor_address,
        //             $branchRegion[0]->city_name,
        //             $scharges,
        //             '',
        //             $stotal,
        //             $srate,
        //             $stax,

        //         ];
        //     } else {
        //         $data = [
        //             $billData['bill'][0]->job_number,
        //             $billDate,
        //             $billData['job'][0]->given_by,
        //             $billData['job'][0]->bank_name,
        //             $billData['job'][0]->bank_address,
        //             $billData['job'][0]->cust_name,
        //             $billData['job'][0]->customer_address,
        //             $billData['job'][0]->bank_letter,
        //             $bankDate,
        //             $tonumber,
        //             $total,
        //             $billData['job'][0]->name,
        //             $billData['job'][0]->byvendor_address,
        //             '',
        //             $scharges,
        //             '',
        //             $stotal,
        //             $srate,
        //             $stax,

        //         ];
        //     }

        //     $pdf1 = PDF::loadView('Verification/verinvoice', compact('data'));
        //     $pdf1->save('Reports/Verification/' . $id . '/invoice.pdf');
        //     $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        //     $pdf->AddPage();
        //     $pdf->setSourceFile("Reports/Verification/$id/invoice.pdf");
        //     $tplIdx = $pdf->importPage(1);
        //     $pdf->useTemplate($tplIdx, 5, 5);
        //     $pdf = $pdf->Output();

        //     return $pdf;
        // } else {
        //     $scharges = $request->service == '' ? 0 : $request->service;
        //     $stotal = $scharges;
        //     $srate = 0;
        //     if ($request->sales == null) {
        //         $stax = 0;
        //     } else {
        //         $sale_reg = DB::table('sales_tax')
        //             ->where('region', $request->sales)
        //             ->select('rate')
        //             ->get();
        //         $rate = $sale_reg[0]->rate / 100;
        //         $srate = $sale_reg[0]->rate;
        //         $stax = $stotal * $rate;
        //     }


        //     $total = $stotal + $stax;

        //     $vletter = $request->vendorletter;
        //     $giver = $request->givenby;


        //     $id = $request->id;

        //     //File::delete('Reports/IBR/'.$id.'/bill.pdf');




        //     $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
        //     $bill->bill_number = $request->jobid;
        //     $bill->job_number = $request->jobid;
        //     $bill->bill_date = $reportDetails[0]->bill_date;;
        //     $bill->total_amount = $total;
        //     $bill->tax = $stax;
        //     $bill->discount = '0';
        //     $bill->recievable = $request->region;
        //     $bill->old_debt = '0';
        //     $bill->cancalled = '0';
        //     $bill->bank = $request->bankID;
        //     $bill->company = $request->companyID;
        //     $bill->branch = $request->branch;
        //     $bill->customer = $request->customerIs;
        //     $bill->status = 'Receivable';
        //     $bill->service = 'Verification';
        //     $bill->save();


        //     $log = new Log;
        //     $log->user_id = $request->user()->id;
        //     $log->activity = $request->jobid . " Bill Was Updated";
        //     $log->date = date('Y/m/d');
        //     $log->time = date("h:i:sa");
        //     $log->service = 'Verification|Livestock';
        //     $log->save();

        //     $billData = Verification::getJobByIdForBill($id, $request->jobid);

        //     $tonumber = Verification::convertNumberToWord($total);


        //     $date = date_create($billData['bill'][0]->bill_date);
        //     $billDate = date_format($date, "d-M-Y");

        //     $date1 = date_create($billData['job'][0]->bank_letter_date);
        //     $bankDate = date_format($date1, "d M, Y");

        //     $givenby = $billData['job'][0]->given_by;


        //     if ($givenby == 'Bank') {
        //         $branchRegion = DB::table('c_branch')
        //             ->where('c_branch.branch_id', $billData['bill'][0]->branch)
        //             ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
        //             ->select('c_city.city_name')
        //             ->get();


        //         $data = [
        //             $billData['bill'][0]->job_number,
        //             $billDate,
        //             $billData['job'][0]->given_by,
        //             $billData['job'][0]->bank_name,
        //             $billData['job'][0]->bank_address,
        //             $billData['job'][0]->cust_name,
        //             $billData['job'][0]->customer_address,
        //             $billData['job'][0]->bank_letter,
        //             $bankDate,
        //             $tonumber,
        //             $total,
        //             $billData['job'][0]->name,
        //             $billData['job'][0]->byvendor_address,
        //             $branchRegion[0]->city_name,
        //             $scharges,
        //             '',
        //             $stotal,
        //             $srate,
        //             $stax,



        //         ];
        //     } else {


        //         $data = [
        //             $billData['bill'][0]->job_number,
        //             $billDate,
        //             $billData['job'][0]->given_by,
        //             $billData['job'][0]->bank_name,
        //             $billData['job'][0]->bank_address,
        //             $billData['job'][0]->cust_name,
        //             $billData['job'][0]->customer_address,
        //             $billData['job'][0]->bank_letter,
        //             $bankDate,
        //             $tonumber,
        //             $total,
        //             $billData['job'][0]->name,
        //             $billData['job'][0]->byvendor_address,
        //             '',
        //             $scharges,
        //             '',
        //             $stotal,
        //             $srate,
        //             $stax,



        //         ];
        //     }

        //     $pdf1 = PDF::loadView('Verification/verinvoice', compact('data'));
        //     $pdf1->save('Reports/Verification/' . $id . '/invoice.pdf');
        //     $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        //     $pdf->AddPage();
        //     $pdf->setSourceFile("Reports/Verification/$id/invoice.pdf");
        //     $tplIdx = $pdf->importPage(1);
        //     $pdf->useTemplate($tplIdx, 5, 5);
        //     $pdf = $pdf->Output();

        //     return $pdf;
        //     dd($billData);
        // }
    }
}
