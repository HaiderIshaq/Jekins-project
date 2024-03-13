<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Deb_Collection_Jobs;
use Illuminate\Support\Facades\Storage;
use PDF;
use File;

use App\Log;


class DebsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");

    }

    public function index(Request $request){

       

           return view('Debt.index');

    }

    public function getDebtData(Request $request){
        if ($request->ajax()) {
            $jobs = DB::table('deb_collection_jobs')
                   ->leftJoin('ibr_country', 'deb_collection_jobs.debtor_comapany_country', '=', 'ibr_country.id')
                   ->select(
                       'deb_collection_jobs.id',
                       'deb_collection_jobs.type',
                       'deb_collection_jobs.client_name',
                       'deb_collection_jobs.company_name',
                       'deb_collection_jobs.amount',
                       'deb_collection_jobs.currency',
                       'deb_collection_jobs.status',
                       'deb_collection_jobs.debtor_company_name',
                       'deb_collection_jobs.debt_period',
                       'deb_collection_jobs.updated_at',
                       'deb_collection_jobs.created_at',
                       'ibr_country.name AS country_name'
                       )
                   ->get();
               return Datatables::of($jobs)
                       ->addIndexColumn()
                       ->addColumn('debt_period','{{$debt_period}} Year ')
                       ->addColumn('amount','{{$amount}} {{$currency}}')
                       ->addColumn('action','<a href="/editDebt/{{$id}}" class="btn btn-primary">Edit</a>')
                       ->rawColumns(['action','status'])
                       ->editColumn('created_at',function($jobs){
                        return date('d-M-Y',strtotime($jobs->created_at));
                       })
                       ->make(true);
           }

           return view('Debt.index');

    }
    public function updateDebt(Request $request,$id){
        date_default_timezone_set("Asia/Karachi");
        
        $debt = Deb_Collection_Jobs::where('id',$id)->first();
       
        $debt->type=$request->type;
        $debt->client_name=$request->client_name;
        $debt->company_name=$request->client_company;
        $debt->client_contanct_number=$request->client_phone;
        $debt->client_comapany_email=$request->client_email;
        $debt->client_comapany_country=$request->client_country;
        $debt->client_comapany_city=$request->client_city;
        $debt->amount=$request->debt_amount;
        $debt->currency=$request->currency_name;
        $debt->debtor_company_name=$request->debtor_company_name;
        $debt->debtor_comapany_city=$request->debtor_company_city;
        $debt->debtor_comapany_country=$request->debtor_company_country;
        $debt->debtor_comapany_address=$request->debtor_company_address;
        $debt->debtor_comapany_representative=$request->debtor_company_representative;
        $debt->debtor_comapany_representative_designation=$request->debtor_company_representative_designation;
        $debt->debt_period=$request->debt_time_period;
        $debt->conflict=$request->is_legal_conflict;
        $debt->conflict_details=$request->dispute_details;
        $debt->comission=$request->decided_comission;
        $debt->remarks=$request->remarks;
        $debt->status=$request->status==true ? 'Completed' : 'Running';
        $debt->client_comapany_address=$request->client_address;
        
 
        $debt->save();

    }
    public function addJob(Request $request){
        $debt=new Deb_Collection_Jobs;
     
       $debt->type=$request->type;
       $debt->client_name=$request->client_name;
       $debt->company_name=$request->client_company;
       $debt->client_contanct_number=$request->client_phone;
       $debt->client_comapany_email=$request->client_email;
       $debt->client_comapany_country=$request->client_country;
       $debt->client_comapany_city=$request->client_city;
       $debt->amount=$request->debt_amount;
       $debt->currency=$request->currency_name;
       $debt->debtor_company_name=$request->debtor_company_name;
       $debt->debtor_comapany_city=$request->debtor_company_city;
       $debt->debtor_comapany_country=$request->debtor_company_country;
       $debt->debtor_comapany_address=$request->debtor_company_address;
       $debt->debtor_comapany_representative=$request->debtor_company_representative;
       $debt->debtor_comapany_representative_designation=$request->debtor_company_representative_designation;
       $debt->debt_period=$request->debt_time_period;
       $debt->conflict=$request->is_legal_conflict;
       $debt->conflict_details=$request->dispute_details;
       $debt->comission=$request->decided_comission;
       $debt->remarks=$request->remarks;
       $debt->client_comapany_address=$request->client_address;

       $debt->save();
    }

    public function editJob($id){
        $data=[
                $id
        ];

        return view('Debt.edit',compact('data'));
    }

    public function getDebtJob($id){
      
     
        $job = DB::table('deb_collection_jobs')
    ->where('deb_collection_jobs.id',$id)
    ->leftJoin('ibr_country AS country1', 'deb_collection_jobs.client_comapany_country', '=', 'country1.id')
    ->leftJoin('ibr_country AS country2', 'deb_collection_jobs.debtor_comapany_country', '=', 'country2.id')
    // ->leftJoin('c_region', 'ibr_jobs.regional_id', '=', 'c_region.reg_id')
    // ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
    // ->leftJoin('c_region AS op', 'ibr_jobs.operational_branch', '=', 'op.reg_id')
    // ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
    // ->leftJoin('c_bank', 'ibr_jobs.bank_id', '=', 'c_bank.bank_id')
    // ->leftJoin('c_branch', 'ibr_jobs.branch_id', '=', 'c_branch.branch_id')
    // ->leftJoin('ibr_vendors', 'ibr_jobs.byvendor_id', '=', 'ibr_vendors.id')
    // ->leftJoin('c_customer', 'ibr_jobs.customer_id', '=', 'c_customer.cust_id')
    // ->leftJoin('ibr_country AS country', 'ibr_jobs.country_id', '=', 'country.id')
    // ->leftJoin('ibr_company', 'ibr_jobs.company_id', '=', 'ibr_company.id')
    // ->leftJoin('ibr_vendors AS vendor', 'ibr_jobs.vendor_id', '=', 'vendor.id')
    // ->leftJoin('ibr_report_type', 'ibr_jobs.report_type', '=', 'ibr_report_type.id')
    // ->leftJoin('ibr_delivery', 'ibr_jobs.delivery_type', '=', 'ibr_delivery.id')
    // ->leftJoin('tax_regions', 'ibr_jobs.sale_tax', '=', 'tax_regions.id')
    ->select(
        
        'deb_collection_jobs.*',
        'country1.name AS country_name',
        'country2.name AS country_name_debt'
        )
    ->get();
    return $job;
  
    }


    public function uplaodAgreement(Request $request){


   
       
        $file=$request->file('myfile');
        $fileSize=$request->file('myfile')->getSize();
        $filext=$request->file('myfile')->extension();
        $filecontent=file_get_contents($file);

    
    
        if($filext!="pdf")
        {
            return response()->json('Unsupported');
    
     
        }
    
        else{

            if(preg_match("/^%PDF-1.5/", $filecontent))
            {
            
                return response()->json('Invalid');
            
            }
            else{

                if($fileSize > 3000000)
                {
                    return response()->json('Limit Reached');
                }

                else{
                    $id=$request->id;
           
                    Storage::disk('dir')->makeDirectory('Reports/Debt/'.$id);
                    $filename=Storage::disk('dir')->putFileAs('Reports/Debt/'.$id,$file,'/agreement.pdf');
                
                    $log = new Log;
                    $log->user_id=$request->user()->id;
                    $log->activity=$id. " Agreement uploaded";
                    $log->date=date('Y/m/d');
                    $log->time=date("h:i:sa");
                    $log->service='Debt Collection';
                    $log->save();
                
                    $ibr = Deb_Collection_Jobs::where('id',$id)->first();
                    $ibr->agreement="1";
                    $ibr->save();
                
                    return response()->json(basename($filename));
                }   
               
                

               
        
            
            }

            
           
        }
   


      
    }

    public function uploadDocuments(Request $request){
        $files=$request->file('files');
        $id=$request->job_id;

        foreach ($files as $file) {
        
        $originalName=$file->getClientOriginalName();
        $filename=Storage::disk('dir')->putFileAs('Reports/Debt/'.$id,$file,$originalName);
        }
        
          
            $log = new Log;
            $log->user_id=$request->user()->id;
            $log->activity=$id. " documents uploaded";
            $log->date=date('Y/m/d');
            $log->time=date("h:i:sa");
            $log->service='Debt Collection';
            $log->save();
    }
    public function getDebtFiles($id){
      
        $files=[];
        $filesInFolder = \File::files('Reports/Debt/'.$id);     
        foreach($filesInFolder as $path) { 
            
              $file = pathinfo($path);
              array_push($files,$file['filename'].".".$file['extension']);
         } 
         if($files==[])
         {
             return 'No Files';
         }
         else{
             return $files;
         }

    }

   
}
