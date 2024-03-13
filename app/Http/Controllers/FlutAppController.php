<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class FlutAppController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            $user = Auth::user();
            $token =  $user->createToken('KgtERP')->accessToken;
            
            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = "User Logged In";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = '';
            $log->save();
            
            return response()->json([
                "success" => true,
                "token" => $token,
                "username" => $user->name,
                "userid" => $user->id,
                // "user"=>$user
            ]);
        }
        else{
            return response()->json([
                "success" => false,
            ]);
        }


      
    }


    public function surveys($id)
    {

        if($id==42)
        {
            $job = DB::table('verification_surveys')
        ->whereIn('verification_surveys.status', [0, 3])
        ->where('verification_surveys.surveyor','!=', '')
        ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->leftJoin('verification_jobs', 'verification_surveys.job_id', '=', 'verification_jobs.id')
        ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
        // ->leftJoin('c_region', 'verification_surveys.city', '=', 'c_region.reg_id')
        ->leftJoin('c_city AS region', 'verification_surveys.city', '=', 'region.city_id')
        ->select(
            'verification_surveys.id as survey_id',
            'verification_job_details.applicant_name',
            'region.city_name AS region',
            'verification_surveys.type',
            'verification_job_details.applicant_contact',
            'c_bank.bank_icon',
            'verification_surveys.salary_slip as is_slip',
            'verification_surveys.is_employee as is_hr',
            DB::raw('CONCAT("https://kgterp.radiumpk.com/images/bankslogo/","",c_bank.bank_icon) AS bank_img')
        )
        ->get();
        }

        else{
            $job = DB::table('verification_surveys')
        ->where('verification_surveys.surveyor',$id)
        ->whereIn('verification_surveys.status', [0, 3])
        ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->leftJoin('verification_jobs', 'verification_surveys.job_id', '=', 'verification_jobs.id')
        ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
        // ->leftJoin('c_region', 'verification_surveys.city', '=', 'c_region.reg_id')
        ->leftJoin('c_city AS region', 'verification_surveys.city', '=', 'region.city_id')
        ->select(
            'verification_surveys.id as survey_id',
            'verification_job_details.applicant_name',
            'region.city_name AS region',
            'verification_surveys.type',
            'verification_job_details.applicant_contact',
            'c_bank.bank_icon',
            'verification_surveys.salary_slip as is_slip',
            'verification_surveys.is_employee as is_hr',
            DB::raw('CONCAT("https://kgterp.radiumpk.com/images/bankslogo/","",c_bank.bank_icon) AS bank_img')
        )
        ->get();
        }

        


        if(!$job->isEmpty())
        {
            $data=[
                "status"=>true,
                "error"=>'',
                "data"=>$job
            ];
           
        }
        else{
            $data=[
                "status"=>false,
                "error"=>'',
                "data"=>$job
            ];
        }
       

        return response()->json($data);


    }

    public function getResidenceProfile($id)
    {

        $job = DB::table('verification_surveys')
        ->where('id',$id)
        ->select(
            'res_applicant_is_available as applicant_is_avaliable',
            'res_name_of_person_met as name_of_person_met',
            'res_nic_of_person_met as nic_of_person_met',
            'res_does_know_applicant',
            'res_know_how',
            'res_relationship_with_applicant as relationship_with_applicant',
            'res_rel_phone as rel_phone',
            'res_rel_cell as rel_cell',
            'res_original_nic_seen as original_nic_seen',
            'res_cnic_of_applicant as cnic_of_applicant',
            'job_id',
            'res_is_address_correct as is_address_correct',
            'res_correct_address as correct_address',
            'res_applicant_live_here as does_applicant_live_here',
            'res_living_since as living_since',
            'res_permanent_address as permanent_address',
            'res_name_plate_affixed as is_name_plate',
            'res_residence_type as residence_type',
            'res_other_residence_type as other_residence_type',
            'res_residence_is as residence_is',
            'res_residence_is_other as residence_is_other',
            'res_applicant_is as applicant_is',
            'res_monthly_rent as monthly_rent',
            'res_rent_deed_verified as rent_deed_verified',
            'res_residence_utilization as residence_utilization',
            'res_residence_area_size as residence_area',
            'res_residence_area_unit as residence_area_unit',
            'res_residence_area_details as residence_area_details',
            'res_residence_area_condition as residence_condition',
            'res_residence_condition as area_condition',
            'res_neighboorhood_is as neighbourhood',
            'res_area_access as area_accessbility',
            'res_belongs_to as residents_belong_to',
            'res_repossession as repossession'
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }


    
    public function updateResidenceProfile(Request $request,$id){


        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'res_applicant_is_available' => $request->applicant_is_avaliable,
            'res_name_of_person_met' => $request->name_of_person_met,
            'res_nic_of_person_met' => $request->nic_of_person_met,
            'res_relationship_with_applicant' => $request->relationship_with_applicant,
            'res_rel_phone' => $request->rel_phone,
            'res_rel_cell' => $request->rel_cell,
            'res_original_nic_seen' => $request->original_nic_seen,
            'res_cnic_of_applicant' => $request->cnic_of_applicant,
            'res_is_address_correct' => $request->is_address_correct,
            'res_correct_address' => $request->correct_address,
            'res_applicant_live_here' => $request->does_applicant_live_here,
            'res_living_since' => $request->living_since,
            'res_permanent_address' => $request->permanent_address,
            'res_know_how' => $request->res_know_how,
            'res_does_know_applicant' => $request->res_does_know_applicant,
            'res_name_plate_affixed' => $request->is_name_plate,
            'res_residence_type' => $request->residence_type,
            'res_other_residence_type' => $request->other_residence_type,
            'res_residence_is' => $request->residence_is,
            'res_residence_is_other' => $request->residence_is_other,
            'res_applicant_is' => $request->applicant_is,
            'res_monthly_rent' => $request->monthly_rent,
            'res_rent_deed_verified' => $request->rent_deed_verified,
            'res_residence_utilization' => $request->residence_utilization,
            'res_residence_area_size' => $request->residence_area,
            'res_residence_area_unit' => $request->residence_area_unit,
            'res_residence_area_details' => $request->residence_area_details,
            'res_residence_area_condition' => $request->residence_condition,
            'res_residence_condition' => $request->area_condition,
            'res_neighboorhood_is' => $request->neighbourhood,
            'res_area_access' => $request->area_accessbility,
            'res_belongs_to' => $request->residents_belong_to,
            'res_repossession' => $request->repossession
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }

    public function getBusinessProfile($id)
    {

        $job = DB::table('verification_surveys')
        ->where('id',$id)
        ->select(
            'job_id',
            'wp_is_applicant_available',
            'is_employee',
            'wp_original_nic_seen',
            'wp_cnic_of_applicant',
            'wp_name_of_person_met',
            'wp_nic_of_person_met',
            'wp_res_phone',
            'wp_work_phone',
            'wp_reson_of_non_ava',
            'wp_is_address_correct',
            'wp_correct_address',
            'wp_does_applicant_works_here',
            'wp_new_address',
            'wp_working_here_since',
            'wp_name_plate_affixed',
            'wp_business_type',
            'wp_other_business_type',
            'wp_permisses_is',
            'wp_other_permisses_is',
            'wp_business_nature',
            'wp_other_business_nature',
            'wp_business_legal_activity',
            'wp_area_size',
            'wp_area_unit',
            'wp_area_details',
            'wp_business_activity',
            'wp_no_of_employees',
            'wp_established_since',
            'wp_business_line',
            'wp_establish_time',
            'wp_is_government_employee',
            'wp_premissi_rent'
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function getHRDetails($id)
    {

        $job = DB::table('verification_surveys')
        ->where('id',$id)
        ->select(
            'wp_ohr_name_of_person_met',
            'wp_ohr_knows_applicant',
            'wp_ohr_employment_status',
            'wp_ohr_date_of_joining',
            'wp_ohr_applicant_designation',
            'wp_ohr_verifier_name',
            'wp_ohr_verifier_designation',
            'wp_ohr_verifier_phone',
            'wp_ohr_verifier_mobile',
            'wp_ohr_verifier_email'
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function getSalaryDetails($id)
    {

        $job = DB::table('verification_surveys')
        ->where('id',$id)
        ->select(
            'wp_ss_is_provided',
            'wp_ss_if_pic_taken',
            'wp_ss_credentials_verified',
            'wp_ss_slip_verified',
            'wp_ss_slip_verified_from',
            'wp_ss_gross_salary',
            'wp_ss_net_salary',
            'wp_ss_officer_contact',
            'wp_ss_report_status',
            'wp_ss_comments',
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",wp_ss_image1) AS wp_ss_image1'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",wp_ss_image2) AS wp_ss_image2'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",wp_ss_image3) AS wp_ss_image3')
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function updateSalaryDetails(Request $request,$id){


        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'wp_ss_is_provided' => $request->wp_ss_is_provided,
            'wp_ss_if_pic_taken' => $request->wp_ss_if_pic_taken,
            'wp_ss_credentials_verified' => $request->wp_ss_credentials_verified,
            'wp_ss_slip_verified' => $request->wp_ss_slip_verified,
            'wp_ss_slip_verified_from' => $request->wp_ss_slip_verified_from,
            'wp_ss_gross_salary' => $request->wp_ss_gross_salary,
            'wp_ss_net_salary' => $request->wp_ss_net_salary,
            'wp_ss_officer_contact' => $request->wp_ss_officer_contact,
            'wp_ss_report_status' => $request->wp_ss_report_status,
            'wp_ss_comments' => $request->wp_ss_comments
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }
    public function updateBankStatement(Request $request,$id){


        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'bnkst_bank_name' => $request->bnkst_bank_name,
            'bnkst_branch' => $request->bnkst_branch,
            'bnkst_branch_address' => $request->bnkst_branch_address,
            'bnkst_landmark' => $request->bnkst_landmark,
            'bnkst_officer_name' => $request->bnkst_officer_name,
            'bnkst_officer_designation' => $request->bnkst_officer_designation,
            'bnkst_officer_mobile' => $request->bnkst_officer_mobile,
            'bnkst_account_no' => $request->bnkst_account_no,
            'bnkst_account_title' => $request->bnkst_account_title,
            'bnkst_is_account_active' => $request->bnkst_is_account_active,
            'bnkst_operating_since' => $request->bnkst_operating_since,
            'bnkst_document_stamped' => $request->bnkst_document_stamped,
            'longitude' => $request->longitude,
            'latitiude' => $request->latitiude
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }

    public function getBankStatement($id)
    {

        $job = DB::table('verification_surveys')
        ->where('id',$id)
        ->select(
            'bnkst_bank_name',
            'bnkst_branch',
            'bnkst_branch_address',
            'bnkst_landmark',
            'bnkst_officer_name',
            'bnkst_officer_designation',
            'bnkst_officer_mobile',
            'bnkst_account_no',
            'bnkst_account_title',
            'bnkst_is_account_active',
            'bnkst_operating_since',
            'bnkst_document_stamped',
            'longitude',
            'latitiude'
            
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }


    public function addsalaryimageone(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = "Salary_Image_1";

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['wp_ss_image1' => $path]);

       
             
        

         return response()->json([
            "success" => true,
            "imagepath" => url('/')."/".$path,
        ]);
        



    }
    public function addsalaryimagetwo(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = "Salary_Image_2";

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['wp_ss_image2' => $path]);

       
             
        

         return response()->json([
            "success" => true,
            "imagepath" => url('/')."/".$path,
        ]);
        



    }
    public function addsalaryimagethree(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = "Salary_Image_3";

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['wp_ss_image3' => $path]);

       
             
        

         return response()->json([
            "success" => true,
            "imagepath" => url('/')."/".$path,
        ]);
        



    }
    public function updateHRDetails(Request $request,$id){


        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'wp_ohr_name_of_person_met' => $request->wp_ohr_name_of_person_met,
            'wp_ohr_knows_applicant' => $request->wp_ohr_knows_applicant,
            'wp_ohr_employment_status' => $request->wp_ohr_employment_status,
            'wp_ohr_date_of_joining' => $request->wp_ohr_date_of_joining,
            'wp_ohr_applicant_designation' => $request->wp_ohr_applicant_designation,
            'wp_ohr_verifier_name' => $request->wp_ohr_verifier_name,
            'wp_ohr_verifier_designation' => $request->wp_ohr_verifier_designation,
            'wp_ohr_verifier_phone' => $request->wp_ohr_verifier_phone,
            'wp_ohr_verifier_mobile' => $request->wp_ohr_verifier_mobile,
            'wp_ohr_verifier_email' => $request->wp_ohr_verifier_email
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }

    public function updateWorkplaceProfile(Request $request,$id){


        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'wp_is_applicant_available' => $request->applicant_is_avaliable,
            'wp_original_nic_seen' => $request->nic_seen,
            'wp_cnic_of_applicant' => $request->cnic_of_applicant,
            'wp_name_of_person_met' => $request->name_of_person_met,
            'wp_nic_of_person_met' => $request->nic_of_person_met,
            'wp_res_phone' => $request->res_phone,
            'wp_work_phone' => $request->work_phone,
            'wp_reson_of_non_ava' => $request->reson_of_non_ava,
            'wp_is_address_correct' => $request->is_address_correct,
            'wp_correct_address' => $request->correct_address,
            'wp_does_applicant_works_here' => $request->does_applicant_works_here,
            'wp_new_address' => $request->new_address,
            'wp_working_here_since' => $request->working_here_since,
            'wp_name_plate_affixed' => $request->name_plate_affixed,
            'wp_business_type' => $request->business_type,
            'wp_other_business_type' => $request->other_business_type,
            'wp_permisses_is' => $request->permisses_is,
            'wp_other_permisses_is' => $request->other_permisses_is,
            'wp_business_nature' => $request->business_nature,
            'wp_other_business_nature' => $request->other_business_nature,
            'wp_business_legal_activity' => $request->business_legal_activity,
            'wp_area_size' => $request->area_size,
            'wp_area_unit' => $request->area_unit,
            'wp_area_details' => $request->area_details,
            'wp_business_activity' => $request->business_activity,
            'wp_no_of_employees' => $request->no_of_employees,
            'wp_established_since' => $request->established_since,
            'wp_business_line' => $request->business_line,
            'wp_establish_time' => $request->establish_time,
            'wp_is_government_employee' => $request->government_employee,
            'wp_premissi_rent' => $request->premissi_rent,
            
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }



    public function getMarketcheckone($id)
    {

        
        $job = DB::table('verification_surveys')
        ->where('verification_surveys.id',$id)
        // ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->select(
            'verification_surveys.mc_one_person_met',
            'verification_surveys.mc_one_addrees',
            'verification_surveys.mc_one_knows_applicant',
            'verification_surveys.mc_one_knows_applicant_since',
            'verification_surveys.mc_one_neighbor_comments',
            'verification_surveys.mc_one_business_established_since',
            'verification_surveys.mc_one_designation_of_met_person',
            'verification_surveys.mc_one_applicant_emp_status',
            'verification_surveys.mc_one_applicant_designation',
            'verification_surveys.mc_one_applicant_nature_of_job',
            'verification_surveys.mc_one_applicant_salary'
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function postMarketcheckone(Request $request,$id)
    {

        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'mc_one_person_met' => $request->mc_one_person_met,
            'mc_one_addrees' => $request->mc_one_addrees,
            'mc_one_knows_applicant' => $request->mc_one_knows_applicant,
            'mc_one_knows_applicant_since' => $request->mc_one_knows_applicant_since,
            'mc_one_neighbor_comments' => $request->mc_one_neighbor_comments,
            'mc_one_business_established_since' => $request->mc_one_business_established_since,
            'mc_one_designation_of_met_person' => $request->mc_one_designation_of_met_person,
            'mc_one_applicant_emp_status' => $request->mc_one_applicant_emp_status,
            'mc_one_applicant_designation' => $request->mc_one_applicant_designation,
            'mc_one_applicant_nature_of_job' => $request->mc_one_applicant_nature_of_job,
            'mc_one_applicant_salary' => $request->mc_one_applicant_salary
        ]);

        return response()->json([
            "success" => true
        ]);
        
        
    }


    public function getMarketchecktwo($id)
    {

        
        $job = DB::table('verification_surveys')
        ->where('verification_surveys.id',$id)
        // ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->select(
            'verification_surveys.mc_two_knows_applicant',
            'verification_surveys.mc_two_knows_applicant_since',
            'verification_surveys.mc_two_neighbor_comments',
            'verification_surveys.mc_two_business_established_since',
            'verification_surveys.mc_two_designation_of_met_person',
            'verification_surveys.mc_two_applicant_emp_status',
            'verification_surveys.mc_two_applicant_designation',
            'verification_surveys.mc_two_applicant_nature_of_job',
            'verification_surveys.mc_two_applicant_salary',
            'verification_surveys.mc_two_person_met',
            'verification_surveys.mc_two_addrees'
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function postMarketchecktwo(Request $request,$id)
    {

        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'mc_two_knows_applicant' => $request->mc_two_knows_applicant,
            'mc_two_knows_applicant_since' => $request->mc_two_knows_applicant_since,
            'mc_two_neighbor_comments' => $request->mc_two_neighbor_comments,
            'mc_two_business_established_since' => $request->mc_two_business_established_since,
            'mc_two_designation_of_met_person' => $request->mc_two_designation_of_met_person,
            'mc_two_applicant_emp_status' => $request->mc_two_applicant_emp_status,
            'mc_two_applicant_designation' => $request->mc_two_applicant_designation,
            'mc_two_applicant_nature_of_job' => $request->mc_two_applicant_nature_of_job,
            'mc_two_applicant_salary' => $request->mc_two_applicant_salary,
            'mc_two_person_met' => $request->mc_two_person_met,
            'mc_two_addrees' => $request->mc_two_addrees
        ]);

        return response()->json([
            "success" => true
        ]);
        
        
    }



    public function getApplicantDetails($id)
    {

        
        $job = DB::table('verification_surveys')
        ->where('verification_surveys.id',$id)
        ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->select(
            'verification_job_details.applicant_name',
            'verification_job_details.applicant_father',
            'verification_job_details.applicant_dob as dob',
            'verification_job_details.applicant_cnic',
            'verification_job_details.applicant_designation',
            'verification_job_details.applicant_business_name',
            'verification_job_details.applicant_res_phone as res_phone',
            'verification_job_details.applicant_work_phone as work_phone',
            'verification_job_details.applicant_contact as cell_phone',
            'verification_surveys.address as residence_address',
            'verification_surveys.landmark',
            'verification_surveys.longitude',
            'verification_surveys.latitiude',
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function getNeighboorOne($id)
    {

        
        $job = DB::table('verification_surveys')
        ->where('verification_surveys.id',$id)
        // ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->select(
            'verification_surveys.res_neigh_one_name as name',
            'verification_surveys.res_neigh_one_address as address',
            'verification_surveys.res_neigh_one_knows_applicant as knows_applicant',
            'verification_surveys.res_neigh_one_knows_applicant_since as knows_since',
            'verification_surveys.res_neigh_one_comments as comments'
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function postNeighboorOne(Request $request,$id)
    {

        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'res_neigh_one_name' => $request->name,
            'res_neigh_one_address' => $request->address,
            'res_neigh_one_knows_applicant' => $request->knows_applicant,
            'res_neigh_one_knows_applicant_since' => $request->knows_since,
            'res_neigh_one_comments' => $request->comments,
        ]);

        return response()->json([
            "success" => true
        ]);
        
        
    }
    public function getNeighboorTwo($id)
    {

        
        $job = DB::table('verification_surveys')
        ->where('verification_surveys.id',$id)
        // ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->select(
            'verification_surveys.res_neigh_two_name as name',
            'verification_surveys.res_neigh_two_address as address',
            'verification_surveys.res_neigh_two_knows_applicant as knows_applicant',
            'verification_surveys.res_neigh_two_knows_applicant_since as knows_since',
            'verification_surveys.res_neigh_two_comments as comments'
        )
        ->get();


        
        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function postNeighboorTwo(Request $request,$id)
    {

        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'res_neigh_two_name' => $request->name,
            'res_neigh_two_address' => $request->address,
            'res_neigh_two_knows_applicant' => $request->knows_applicant,
            'res_neigh_two_knows_applicant_since' => $request->knows_since,
            'res_neigh_two_comments' => $request->comments,
        ]);

        return response()->json([
            "success" => true
        ]);
        
        
    }

    public function getVerificationOutcome($id)
    {

        
        $job = DB::table('verification_surveys')
        ->where('verification_surveys.id',$id)
        // ->leftJoin('verification_job_details', 'verification_surveys.job_id', '=', 'verification_job_details.job_id')
        ->select(
            'verification_surveys.outcome_surveyor as surveyor',
            'verification_surveys.outcome_report_status as report_status',
            'verification_surveys.outcome_verification_status',
            'verification_surveys.outcome_comments as comments',
            'verification_surveys.outcome_remarks as remarks'
        )
        ->get();

        return response()->json([
            "status"=>true,
            "error"=>'',
            "data"=>$job
        ]);

        
    }

    public function postVerificationOutcome(Request $request,$id)
    {

        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'outcome_surveyor' => $request->surveyor,
            'outcome_report_status' => $request->report_status,
            'outcome_verification_status' => $request->verification_status,
            'outcome_comments' => $request->comments,
            'outcome_remarks' => $request->remarks
        ]);

        return response()->json([
            "success" => true
        ]);
        
        
    }



    

    public function getImages($id)
    {

        $job = DB::table('verification_surveys')
        ->where('id',$id)
        ->select(
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image1) AS image1'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image2) AS image2'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image3) AS image3'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image4) AS image4'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image5) AS image5'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image6) AS image6'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image7) AS image7'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image8) AS image8'),
            DB::raw('CONCAT("https://kgterp.radiumpk.com/","",image9) AS image9')
         
        )
        ->get();

        

        if(!$job->isEmpty())
        {
            $data=[
                "status"=>true,
                "error"=>'',
                "data"=>$job
            ];
           
        }
        else{
            $data=[
                "status"=>false,
                "error"=>'',
                "data"=>$job
            ];
        }
       

        return response()->json($data);


    }

    public function getList(){
        $data=[
            "status"=>true,
            "error"=>'',
            "data"=>[
                1,2,3,4,5
            ]
        ];

        return response()->json($data);

    }


    


    public function submitSurvey(Request $request,$id)
    {
        date_default_timezone_set("Asia/Karachi");
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'status' => 3,
            'conducted_on'=>date('Y-m-d H:i:s')
          
        ]);

        return response()->json([
            "success" => true
        ]);
        
    }

    public function submitApplicantDetails(Request $request,$id)
    {
        $job = DB::table('verification_surveys')
        ->where('id',$id)
        ->select('job_id')
        ->get();

        $det= DB::table('verification_job_details')
        ->where('job_id', $job[0]->job_id)
        ->update([
            'applicant_name' => $request->name,
            'applicant_father' => $request->father,
            'applicant_cnic' => $request->cnic,
            'applicant_dob' => $request->dob,
            'applicant_res_phone' => $request->res_phone,
            'applicant_work_phone' => $request->work_phone,
            'applicant_designation' => $request->designation,
            'applicant_business_name' => $request->business_name,
            'applicant_contact' => $request->cell,
          
        ]);
       
        $sur= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'address' =>  $request->address,
            'landmark' =>  $request->landmark,
            'longitude' =>  $request->longitude,
            'latitiude' =>  $request->latitiude,
          
        ]);

        return response()->json([
            "success" => true
        ]);
        
    }

    public function updateCordinates(Request $request,$id)
    {
        $sur= DB::table('verification_surveys')
        ->where('id', $id)
        ->update([
            'longitude' =>  $request->longitude,
            'latitiude' =>  $request->latitiude
        ]);

        return response()->json([
            "success" => true
        ]);
    }

    

    public function addImageone(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image1' => $path]);

       
             
        

         return response()->json([
            "success" => true,
            "imagepath" => url('/')."/".$path,
        ]);
        



    }
    public function addImagetwo(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);


        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image2' => $path]);

       




         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }
    public function addImagethree(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);


        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image3' => $path]);


         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }
    public function addImagefour(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image4' => $path]);


         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }

    public function addImagefive(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);
        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image5' => $path]);


         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }

    public function addImagesix(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image6' => $path]);


         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }

    public function addImageseven(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image7' => $path]);


         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }

    public function addImageeight(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image8' => $path]);


         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }

    public function addImagenine(Request $request,$id)
    {   
        $job= DB::table('verification_surveys')
        ->where('id', $id)
        ->select('job_id')
        ->get();

        $surid=$job[0]->job_id;
          

        $file = $request->file('image');
        $fname = str_random(28);

        $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$surid.'/Survey/'.$id, $file, $fname . ".".$file->getClientOriginalExtension());
    
        $img= DB::table('verification_survey_images')->insert([
            'path' => $path,
            'survey_id' => $id,
            'title' => $fname.".".$file->getClientOriginalExtension()
            
        ]);

        $image= DB::table('verification_surveys')
        ->where('id', $id)
        ->update(['image9' => $path]);


         return response()->json([
            "success" => true,
            "imagepath" => url('/'). "/".$path,
        ]);
        



    }

    

    

    

    

    
    // public function addImage(Request $request)
    // {   
      
    //         $id=11;
          

    //          $file = $request->file('image');
    //         //  $file = $_FILES['image'];
    //          $fname = str_random(28);
       
    //          $path = Storage::disk('dir')->putFileAs('Reports/Verification/'.$id.'/Survey', $file, $fname . '.jpg');
         

    //       $image= DB::table('verification_surveys')
    //        ->where('id', 1)
    //        ->update(['image1' => $path]);


    //      return response()->json([
    //         "success" => true,
    //         "imagepath" => url('/'). "/".$path,
    //     ]);



    // }
}
