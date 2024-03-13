<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\User;
use App\Prism;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use FFMpeg\Filters\Video\VideoFilters;


class PrismAppController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // date_default_timezone_set("Asia/Karachi");
    }

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

    public function submitSurvey(Request $request,$id)
    {
        date_default_timezone_set("Asia/Karachi");
        $job= DB::table('prism_surveys')
        ->where('id', $id)
        ->update([
            'status' => 1,
            'conducted_on'=>date('Y-m-d H:i:s')
          
        ]);

        return response()->json([
            "success" => true
        ]);
        
    }

    public function getPrismSurveys($id)
    {
       
        if($id==48)
        {
            $job = DB::table('prism_surveys')
            // ->where('prism_surveys.surveyor',$id)
            ->where('prism_jobs.is_completed', 0)
            ->leftJoin('prism_jobs', 'prism_surveys.job_id', '=', 'prism_jobs.id')
            ->leftJoin('prism_survey_vehicles', 'prism_surveys.job_id', '=', 'prism_survey_vehicles.job_id')
            ->leftJoin('prism_insurers', 'prism_jobs.insurer', '=', 'prism_insurers.id')
            // ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
            // ->leftJoin('c_region', 'verification_surveys.city', '=', 'c_region.reg_id')
            // ->leftJoin('c_city AS region', 'verification_surveys.city', '=', 'region.city_id')
            ->select(
                'prism_surveys.id',
                'prism_surveys.job_id',
                'prism_surveys.status',
                // 'prism_jobs.is_completed as job_status',
                'prism_jobs.job_id as reference_id',
                'prism_jobs.contact_person as contact_person',
                'prism_jobs.contact_nos as mobile',
                'prism_insurers.name as insurance_company',
                'prism_survey_vehicles.make as make',
                'prism_surveys.place_of_survey as location',
                DB::raw('CONCAT(prism_survey_vehicles.reg_no," / ",prism_survey_vehicles.chassis_no) AS registration_no'),
                'prism_surveys.job_id'
                // 'verification_surveys.id as survey_id',
                // 'verification_job_details.applicant_name',
                // 'region.city_name AS region',
                // 'verification_surveys.type',
                // 'verification_job_details.applicant_contact',
                // 'c_bank.bank_icon',
                // 'verification_surveys.salary_slip as is_slip',
                // 'verification_surveys.is_employee as is_hr',
                // DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/images/bankslogo/","",c_bank.bank_icon) AS bank_img')
            )
            ->get();
    
        }

        else{
            $job = DB::table('prism_surveys')
            ->where('prism_surveys.surveyor',$id)
            ->where('prism_jobs.is_completed', 0)
            ->leftJoin('prism_jobs', 'prism_surveys.job_id', '=', 'prism_jobs.id')
            ->leftJoin('prism_survey_vehicles', 'prism_surveys.job_id', '=', 'prism_survey_vehicles.job_id')
            ->leftJoin('prism_insurers', 'prism_jobs.insurer', '=', 'prism_insurers.id')
            // ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
            // ->leftJoin('c_region', 'verification_surveys.city', '=', 'c_region.reg_id')
            // ->leftJoin('c_city AS region', 'verification_surveys.city', '=', 'region.city_id')
            ->select(
                'prism_surveys.id',
                'prism_surveys.job_id',
                'prism_surveys.status',
                // 'prism_jobs.is_completed as job_status',
                'prism_jobs.job_id as reference_id',
                'prism_jobs.contact_person as contact_person',
                'prism_jobs.contact_nos as mobile',
                'prism_insurers.name as insurance_company',
                'prism_survey_vehicles.make as make',
                'prism_surveys.place_of_survey as location',
                DB::raw('CONCAT(prism_survey_vehicles.reg_no," / ",prism_survey_vehicles.chassis_no) AS registration_no'),
                'prism_surveys.job_id'
                // 'verification_surveys.id as survey_id',
                // 'verification_job_details.applicant_name',
                // 'region.city_name AS region',
                // 'verification_surveys.type',
                // 'verification_job_details.applicant_contact',
                // 'c_bank.bank_icon',
                // 'verification_surveys.salary_slip as is_slip',
                // 'verification_surveys.is_employee as is_hr',
                // DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/images/bankslogo/","",c_bank.bank_icon) AS bank_img')
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

    public function getSurveyDetails($id)
    {
       

        $job = DB::table('prism_jobs')
        ->where('prism_jobs.id',$id)
        ->select(
            'prism_jobs.name_of_insured',
            'prism_jobs.c_no_of_insured',
            'prism_jobs.address',
            'prism_jobs.contact_person',
            'prism_jobs.contact_nos',
            'prism_jobs.nic_of_insured',
            'prism_jobs.ntn_of_insured'
           
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

    public function updateSurveyDetails(Request $request,$id){


        $job= DB::table('prism_jobs')
        ->where('id', $id)
        ->update([
            'name_of_insured' => $request->name_of_insured,
            'c_no_of_insured' => $request->c_no_of_insured,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'contact_nos' => $request->contact_nos,
            'nic_of_insured' => $request->nic_of_insured,
            'ntn_of_insured' => $request->ntn_of_insured
          
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }
    public function updateTravellingExpense(Request $request,$id){


        $job= DB::table('prism_surveys')
        ->where('job_id', $id)
        ->update([
            'travelling_expenses' => $request->travelling_expenses
          
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }


    public function getTravellingExpense($id)
    {
       

        $job = DB::table('prism_surveys')
        ->where('prism_surveys.job_id',$id)
        ->select(
            'prism_surveys.travelling_expenses'
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
    public function getVehicleDetails($id)
    {
       

        $job = DB::table('prism_survey_vehicles')
        ->where('prism_survey_vehicles.job_id',$id)
        ->select(
            'prism_survey_vehicles.manufacture',
            'prism_survey_vehicles.make',
            'prism_survey_vehicles.model',
            'prism_survey_vehicles.horse_power',
            'prism_survey_vehicles.variant',
            'prism_survey_vehicles.reg_no',
            'prism_survey_vehicles.reg_date',
            'prism_survey_vehicles.manufacture_date',
            'prism_survey_vehicles.engine_no',
            'prism_survey_vehicles.chassis_no',
            'prism_survey_vehicles.seating as cubic_capacity',
            'prism_survey_vehicles.color',
            'prism_survey_vehicles.odometer',
            'prism_survey_vehicles.body_type',
            'prism_survey_vehicles.select_type_one as private_or_commercial',
            'prism_survey_vehicles.select_type_two as local_or_import'
           
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
    public function getBodyObservation($id)
    {
       

        $job = DB::table('prism_survey_vehicles')
        ->where('prism_survey_vehicles.job_id',$id)
        ->select(
            'prism_survey_vehicles.dents_one',
            'prism_survey_vehicles.dents_two',
            'prism_survey_vehicles.dents_three',
            'prism_survey_vehicles.dents_four',
            'prism_survey_vehicles.dents_five',
            'prism_survey_vehicles.dents_remarks'
           
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


    public function getPrismModalAccessories($id){

        $notfit=Prism::getAccessoriesForApp($id,'Not Fitted');
        $facfit=Prism::getAccessoriesForApp($id,'Factory Fitted');
        $selffit=Prism::getAccessoriesForApp($id,'Self Fitted');

        $data=[
            'factory_fitted'=>implode(',',json_decode($facfit,1)),
            'not_fitted'=>implode(',',json_decode($notfit,1)),
            'self_fitted'=>implode(',',json_decode($selffit,1))
        ];
        return response()->json($data);


    }

    public function addPrismModalAccessories(Request $request,$id)
    {

        Prism::addAccessoriesForApp($request->factory_fitted,$id,'Factory Fitted');
        Prism::addAccessoriesForApp($request->not_fitted,$id,'Not Fitted');
        Prism::addAccessoriesForApp($request->self_fitted,$id,'Self Fitted');

        return response()->json([
            "success" => true
        ]);
        

    
    }

    public function updateBodyObservation(Request $request,$id){

        $job= DB::table('prism_survey_vehicles')
        ->where('job_id', $id)
        ->update([
            'dents_one' => $request->dents_one,
            'dents_two' => $request->dents_two,
            'dents_three' => $request->dents_three,
            'dents_four' => $request->dents_four,
            'dents_five' => $request->dents_five,
            'dents_remarks' => $request->dents_remarks
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }


    public function getInsuredEstimateValues($id)
    {
       

        $job = DB::table('prism_survey_vehicles')
        ->where('prism_survey_vehicles.job_id',$id)
        ->select(
            'prism_survey_vehicles.value',
            'prism_survey_vehicles.additional_value'
           
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
    public function updateInsuredEstimateValues(Request $request,$id){

        $job= DB::table('prism_survey_vehicles')
        ->where('job_id', $id)
        ->update([
            'value' => $request->value,
            'additional_value' => $request->additional_value
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }


    public function getReceivingImpDoc($id)
    {
       

        $job = DB::table('prism_survey_vehicles')
        ->where('prism_survey_vehicles.job_id',$id)
        ->select(
            'prism_survey_vehicles.copy_of_reg_book',
            'prism_survey_vehicles.brand_new_vehicle',
            'prism_survey_vehicles.copy_of_cnic_insured',
            'prism_survey_vehicles.copy_of_import_documents',
            'prism_survey_vehicles.bill_of_entry',
           
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



    public function getImages($id)
    {

        // $job = DB::table('prism_survey_assets')
        // ->where('job_id',$id)
        // ->select(
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image1) AS image1'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image2) AS image2'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image3) AS image3'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image4) AS image4'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image5) AS image5'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image6) AS image6'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image7) AS image7'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image8) AS image8'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image9) AS image9'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image10) AS image10'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image11) AS image11'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image12) AS image12'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image13) AS image13'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image14) AS image14'),
        //     DB::raw('CONCAT("http://phplaravel-762668-2926175.cloudwaysapps.com/","",image15) AS image15')         
        // )
        // ->get();

        $job = DB::table('prism_survey_assets')
        ->where('job_id',$id)
        ->where('title','!=','video')
        ->select('path')
        ->get();

        $images=collect([]);

        foreach($job as $item)
        {
            $images->push($item->path);

        }
        $images->all();

        

        if(!$job->isEmpty())
        {
            $data=[
                "status"=>true,
                "error"=>'',
                "data"=>$images
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
    public function updateReceivingImpDoc(Request $request,$id){

        $job= DB::table('prism_survey_vehicles')
        ->where('job_id', $id)
        ->update([
            'copy_of_reg_book' => $request->copy_of_reg_book,
            'brand_new_vehicle' => $request->brand_new_vehicle,
            'copy_of_cnic_insured' => $request->copy_of_cnic_insured,
            'copy_of_import_documents' => $request->copy_of_import_documents,
            'bill_of_entry' => $request->bill_of_entry
        ]);

        return response()->json([
            "success" => true
        ]);
        

    }


    public function updateVehicleDetails(Request $request,$id){


        $job= DB::table('prism_survey_vehicles')
        ->where('job_id', $id)
        ->update([
            'manufacture' => $request->manufacture,
            'manufacture_date' => $request->manufacture_date,
            'make' => $request->make,
            'model' => $request->model,
            'horse_power' => $request->horse_power,
            'reg_no' => $request->reg_no,
            'reg_date' => $request->reg_date,
            'engine_no' => $request->engine_no,
            'chassis_no' => $request->chassis_no,
            'seating' => $request->cubic,
            'color' => $request->color,
            'odometer' => $request->odometer,
            'body_type' => $request->body_type,
            'select_type_one' => $request->select_type_one,
            'select_type_two' => $request->select_type_two
          
        ]);

        
        return response()->json([
            "success" => true
        ]);
        

    }

    public function updateCordinates(Request $request,$id){


        $job= DB::table('prism_surveys')
        ->where('job_id', $id)
        ->update([
            'gps_cordinates' => $request->gps_cordinates,
            'gps_location' => $request->gps_location
        ]); 
        
        return response()->json([
            "success" => true
        ]);
        

    }


    public function getSurveyRemarks($id)
    {
       

        $job = DB::table('prism_surveys')
        ->where('prism_surveys.job_id',$id)
        ->select(
            'prism_surveys.remarks',
            
           
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


    public function updateRemarks(Request $request,$id){


        $job= DB::table('prism_surveys')
        ->where('job_id', $id)
        ->update([
            'remarks' => $request->remarks
        ]); 
        
        return response()->json([
            "success" => true
        ]);
        

    }

    public function process(Request $request,$id){
        
        $file=$request->file('video');
        $location='';
        $cordinates=$request->cordinates;
        $datet=$request->datetime;

        $time=strtotime($datet);

        // echo $time;
        $extension = $file->extension();


        $filename = uniqid() . '.'.$extension;
        $savefpath="Reports/Prism/".$id."/Assets/".$filename;
        
        // $path = $file->store(
        //     $savefpath, ''
        // );
        $filename = Storage::disk('dir')->putFileAs('Reports/Prism/'.$id.'/Assets', $file, $filename);

        
    
         $job=DB::table('prism_survey_assets')
        // ->where('job_id', $id)
        ->insert([
            'job_id' => $id,
            'title' => 'Video',
            'path' => $savefpath,
            'taken_at' => $datet,
            'location' => $location,
            'cordinates' => $cordinates,
          
        ]);



        // echo $savefpath;

        if (file_exists($savefpath))
        {
            return response()->json([
                "success" => true,
                "path"=>url('/')."/".$savefpath
            ]);
        }
        else{
            // echo 'Uploading Failed';
            return response()->json([
                "success" => false,
                "path"=>$savefpath
            ]);
    

        }




    }

    public function addImage(Request $request,$id)
    {   

        $validator = Validator::make($request->all(), [
            // 'image'=>['required'],
            // 'taken_on'=>['required'],
            // 'location'=>['required'],
            // 'cordinates'=>['required']
        ]);


        if($validator->fails())
        {

            return response()->json($validator->errors());
        }

        else{

            return Prism::addImage($request,$id);
        }




    }

  
}
