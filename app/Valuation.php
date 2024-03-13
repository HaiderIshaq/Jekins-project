<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Valuation_Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Valuation_Category;
use App\Valuation_Vehicles;
use App\District;
use App\Log;
use App\Valuation_Jobs;
use App\Employee;
use Illuminate\Support\Facades\Storage;
use App\Job;
use App\VehicleImage;
use Illuminate\Support\Str;
// use MPDF;




class Valuation extends Model
{

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

    public static function  convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '', trim($num));
        if (!$num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array(
            '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array(
            '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ($tens < 20) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
                $tens = (int) ($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_levels[$i])) ? ' ' . $list3[$levels] . ' ' : '');
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }

    public static function getJobByIdForBill($id, $jobnumber)
    {
        $job = DB::table('valuation_jobs')
            ->where('valuation_jobs.id', $id)
            ->leftJoin('c_company', 'valuation_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'valuation_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'valuation_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'valuation_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'valuation_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'valuation_jobs.customer_id', '=', 'c_customer.cust_id')
            // ->leftJoin('tax_regions', 'valuation_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'valuation_jobs.branch_id', '=', 'c_branch.branch_id')

            ->select(
                'valuation_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'valuation_jobs.operational_branch',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                // 'tax_regions.name AS tax_region'

            )
            ->get();

        $bill = DB::table('bill')
            ->where('bill.job_number', '=', $jobnumber)
            ->select('*')
            ->get();

        $data = [
            'job' => $job,
            'bill' => $bill
        ];

        return $data;
    }

    public static function catDetails()
    {

        $cat = Valuation_Category::all();
        return $cat;
    }

    public static function getDistricts()
    {

        $rec = District::all();
        return $rec;
    }

    public static function getConsultants()
    {

        $rec = Valuation_Consultant::all();
        return $rec;
    }
    public static function getCategoryById($id)
    {
        return Valuation_Subcategory::where('cat_id', $id)
            ->select('*')
            ->get();
    }

    public static function storeValuation($request)
    {

        $val = new Valuation_Jobs;

        $val->request_date = date("Y/m/d");
        $val->region_id = $request->regional_id;
        $val->job_by = $request->job_by;
        $val->bank_id = $request->bank_id;
        $val->branch_id = $request->branch_id;
        $val->bank_address = $request->bank_address;
        $val->bank_representative = $request->bank_representative;
        $val->bank_designation = $request->bank_designation;
        $val->bank_phone = $request->bank_phone;
        $val->bank_fax = $request->bank_fax;
        $val->bank_email = $request->bank_email;
        $val->bank_letter = $request->bank_letter;
        $val->bank_letter_date = $request->letter_date;
        $val->byvendor_id = $request->val_vendor_id;
        $val->byvendor_representative = $request->val_vendor_representaive;
        $val->byvendor_designation = $request->val_vendor_designation;
        $val->byvendor_address = $request->val_billing_address;
        $val->byvendor_phone = $request->val_vendor_phone;
        $val->byvendor_fax = $request->val_vendor_fax;
        $val->byvendor_email = $request->val_vendor_email;
        $val->byvendor_letter = $request->val_vendor_letter;
        $val->vendor_letter_date = $request->val_vendor_date;
        $val->customer_id = $request->customer_id;
        $val->customer_representative = $request->customer_representative;
        $val->customer_designation = $request->customer_designation;
        $val->customer_phone = $request->customer_phone;
        $val->customer_fax = $request->customer_fax;
        $val->customer_email = $request->customer_email;
        $val->main_category = $request->main_category;
        $val->sub_category = $request->sub_category;
        $val->category = $request->category;
        $val->sub_cat_type = $request->sub_cat_type;
        $val->service_charges = $request->service_charges;
        $val->corporate = $request->is_corporate;
        $val->address = $request->address;
        $val->pobox = $request->pobox;
        $val->city = $request->city;
        $val->postalcode = $request->postal_code;
        $val->district = $request->district;
        $val->operational_branch = $request->operational_branch;
        $val->consultancy = $request->is_consultancy;
        $val->consultant = $request->consultant;
        $val->isSales = $request->is_salesTax;
        $val->STonfull = $request->is_full;
        $val->pocket = $request->out_of_pockets;
        $val->cpu = $request->is_cpu;
        $val->asset_class = $request->asset_class;
        $val->pages = $request->no_of_pages;
        $val->survey_team = $request->survey_team;
        $val->dc_team = $request->dc_team;
        $val->signing_team = $request->sign_team;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;
        $val->given_by = $request->given_by;
        $val->street = $request->valuation_street;
        $val->completed = '0';
        $val->cancalled = '0';

        $val->save();
    }

    public static function updateJobID($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "VAL";

        $val1 = Valuation_Jobs::findOrFail($cid);

        if ($givenBy == "Bank") {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
        } else {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
        }
        $val1->save();
    }
    public static function makeLog($request, $cid)
    {

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No:" . $cid . " Was Added";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Valuation';
        $log->save();
    }

    public static function addCommonJob($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "VAL";

        $job = new Job;
        if ($givenBy == "Bank") {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            
            $bill = new Bill_Ibr;
            $bill->bill_number = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->job_number = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->total_amount = $request->service_charges;
            $bill->tax = '0';
            $bill->discount = '0';
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->company_id;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Valuation';
            $bill->save();
        
        } else {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');


            
            $bill = new Bill_Ibr;
            $bill->bill_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->job_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->total_amount = $request->service_charges;
            $bill->tax = '0';
            $bill->discount = '0';
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->company_id;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Valuation';
            $bill->save();
        }

        $job = new Job;
        if ($givenBy == "Bank") {

            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');



        } else {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');

        }
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);
        $job->region_id = $request->regional_id;
        $job->service = "Valuation";
        $job->bank_id = $request->bank_id;
        $job->byvendor_id = $request->val_vendor_id;
        $job->branch_id = $request->branch_id;
        $job->customer_id = $request->customer_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();
    }

    public static function getLatestJob()
    {
        $cjob = DB::table('valuation_jobs')->latest('created_at', 'desc')->first();
        Storage::disk('dir')->makeDirectory('Reports/Valuation/' . $cjob->id . '/Report');
        Storage::disk('dir')->makeDirectory('Reports/Valuation/' . $cjob->id . '/Images');
        return $cjob;
    }

    public static function addVehicle($request, $cid)
    {
        $job = new Valuation_Vehicles;
        $job->job_number = $cid;
        $job->make = $request->make;
        $job->reg_no = $request->reg_no;
        $job->engine_no = $request->engine_no;
        $job->chassis_no = $request->chassis_no;
        $job->created_by = $request->user()->id;
        $job->updated_by = $request->user()->id;
        $job->save();
    }

    public static function getJobByIdForReport($id)
    {
        $job = DB::table('valuation_jobs')
            ->where('valuation_jobs.id', $id)
            ->leftJoin('c_company', 'valuation_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'valuation_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'valuation_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'valuation_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('c_branch', 'valuation_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('ibr_vendors', 'valuation_jobs.byvendor_id', '=', 'ibr_vendors.id')
            ->leftJoin('c_customer', 'valuation_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('valuation_category', 'valuation_jobs.main_category', '=', 'valuation_category.id')
            ->leftJoin('valuation_subcategory', 'valuation_jobs.category', '=', 'valuation_subcategory.id')
            ->leftJoin('c_districts', 'valuation_jobs.district', '=', 'c_districts.id')
            ->leftJoin('valuation_consultants', 'valuation_jobs.consultant', '=', 'valuation_consultants.id')
            ->leftJoin('c_employees', 'valuation_jobs.employee', '=', 'c_employees.id')
            ->select(
                'valuation_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'valuation_jobs.operational_branch',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'ibr_vendors.name',
                'c_customer.cust_name',
                'valuation_category.description AS valuation_description',
                'valuation_subcategory.description AS subcat_description',
                'c_districts.description AS district_name',
                'c_employees.name AS employee_name',
                'valuation_consultants.description AS consultant_name'
            )
            ->get();
        return $job;
    }

    public static function getJobById($id)
    {
        $job = DB::table('valuation_jobs')
            ->where('valuation_jobs.id', $id)
            ->leftJoin('c_company', 'valuation_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'valuation_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'valuation_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'valuation_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('c_branch', 'valuation_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('ibr_vendors', 'valuation_jobs.byvendor_id', '=', 'ibr_vendors.id')
            ->leftJoin('c_customer', 'valuation_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('valuation_category', 'valuation_jobs.main_category', '=', 'valuation_category.id')
            ->leftJoin('valuation_subcategory', 'valuation_jobs.category', '=', 'valuation_subcategory.id')
            ->leftJoin('c_districts', 'valuation_jobs.district', '=', 'c_districts.id')
            ->leftJoin('valuation_consultants', 'valuation_jobs.consultant', '=', 'valuation_consultants.id')
            ->leftJoin('c_employees', 'valuation_jobs.employee', '=', 'c_employees.id')
            ->select(
                'valuation_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'valuation_jobs.operational_branch',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'ibr_vendors.name',
                'c_customer.cust_name',
                'valuation_category.description AS valuation_description',
                'valuation_subcategory.description AS subcat_description',
                'c_districts.description AS district_name',
                'c_employees.name AS employee_name',
                'valuation_consultants.description AS consultant_name'
            )
            ->get();

        $vehicle = DB::table('valuation_vehicledetails')
            ->where('job_number', $id)
            ->select('*')
            ->get();
        $data = [
            'job' => $job,
            'vehicle' => $vehicle
        ];

        return $data;
    }

    public static function getEmployees()
    {
        $employees = Employee::all();
        return $employees;
    }

    public static function getTypes()
    {
        $types = DB::table('get_types')
            ->select('*')
            ->get();
        return $types;
    }

    public static function getEmployeesById($id)
    {
        $employees = Employee::where('designation', '=', $id)
            ->get();
        return $employees;
    }

    public static function updateValuation($request, $id)
    {

        $iscompleted=$request->is_completed==true?1:0;

        date_default_timezone_set("Asia/Karachi");

        $ibr = Valuation_Jobs::where('id', $id)->first();

        $ibr->region_id = $request->regional_id;
        $ibr->operational_branch = $request->operational_branch;
        $ibr->job_by = $request->job_by;
        $ibr->bank_id = $request->bank_id;
        $ibr->branch_id = $request->branch_id;
        $ibr->bank_address = $request->bank_address;
        $ibr->bank_representative = $request->bank_representative;
        $ibr->bank_designation = $request->bank_designation;
        $ibr->bank_phone = $request->bank_phone;
        $ibr->bank_fax = $request->bank_fax;
        $ibr->bank_email = $request->bank_email;
        $ibr->bank_letter = $request->bank_letter;
        $ibr->bank_letter_date = $request->letter_date;
        $ibr->byvendor_id = $request->ibr_vendor_id;
        $ibr->byvendor_address = $request->ibr_billing_address;
        $ibr->byvendor_representative = $request->ibr_vendor_representaive;
        $ibr->byvendor_designation = $request->ibr_vendor_designation;
        $ibr->byvendor_phone = $request->ibr_vendor_phone;
        $ibr->byvendor_fax = $request->ibr_vendor_fax;
        $ibr->byvendor_email = $request->ibr_vendor_email;
        $ibr->byvendor_letter = $request->ibr_vendor_letter;
        $ibr->vendor_letter_date = $request->ibr_vendor_date;
        $ibr->customer_id = $request->customer_id;
        $ibr->customer_representative = $request->customer_representative;
        $ibr->customer_designation = $request->customer_designation;
        $ibr->customer_phone = $request->customer_phone;
        $ibr->customer_fax = $request->customer_fax;
        $ibr->customer_email = $request->customer_email;
        $ibr->main_category = $request->main_category;
        $ibr->category = $request->category;
        $ibr->corporate = $request->corporate == true ? '1' : '0';
        $ibr->sub_cat_type = $request->sub_cat_type;
        $ibr->sub_category = $request->sub_category;
        $ibr->address = $request->address;
        $ibr->street = $request->street;
        $ibr->pobox = $request->pobox;
        $ibr->postalcode = $request->postal_code;
        $ibr->city = $request->city;
        $ibr->district = $request->district;
        // $ibr->company_id=strtoupper($request->company_id);
        $ibr->consultancy = $request->is_consultancy;
        $ibr->consultant = $request->consultant;
        $ibr->service_charges = $request->service_charges;
        $ibr->isSales = $request->is_sales == true ? '1' : '0';
        $ibr->STonFull = $request->stonfull == true ? '1' : '0';
        $ibr->pocket = $request->out_of_pocket;
        $ibr->cpu = $request->cpu == true ? '1' : '0';
        $ibr->asset_class = $request->asset_class;
        $ibr->pages = $request->no_of_pages;
        $ibr->employee = $request->employee;
        $ibr->survey_team = $request->survey_team;
        $ibr->signing_team = $request->signing_team;
        $ibr->dc_team = $request->dc_team;
        $ibr->value = $request->total_value;
        $ibr->fsv_rate = $request->fsv_rate;
        $ibr->fsv_type = $request->fsv_type;
        $ibr->fsv_calculated = $request->fsv_calculated;
        $ibr->completed = $request->is_completed == true ? '1' : '0';
        $ibr->customer_delay = $request->delayed == true ? '1' : '0';
        $ibr->request_date = $request->requested_date;
        $ibr->delivery_date = $request->delivery_date;

        $ibr->given_by = $request->given_by;
        if ($request->delayed == true) {
            $ibr->completed = '2';
            $ibr->customer_delay = '1';
        } else {
            $ibr->completed = $request->is_completed == true ? '1' : '0';
            $ibr->customer_delay = $request->delayed == true ? '1' : '0';
        }
        $ibr->save();

        if ($request->main_category_text == "Vehicle") {
            $car = Valuation_Vehicles::where('job_number', $id)->first();
            $car->make = $request->car_make;
            $car->reg_no = $request->reg_no;
            $car->engine_no = $request->engine_no;
            $car->chassis_no = $request->chassis_no;
            $car->save();
        }

        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No: " . $jid . " Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Valuation';
        $log->save();

        $com_id = $request->commonId;
        $comJob = Job::where('id', $com_id)->first();
        $comJob->company_id = strtoupper($request->company_id);
        $comJob->region_id = $request->regional_id;
        $comJob->bank_id = $request->bank_id;
        $comJob->byvendor_id = $request->ibr_vendor_id;
        $comJob->customer_id = $request->customer_id;
        $comJob->branch_id = $request->branch_id;
        $comJob->status = $request->is_completed == true ? '1' : '0';
        $comJob->save();


        if($iscompleted == 1)
        {
            $bill = DB::table('bill')->where('bill_number','=',$request->jobid)->update([
                'bill_number'=>$request->jobid,
                'job_number'=>$request->jobid,
                'status'=>'Receivable',
                'bill_date'=>date('Y/m/d'),
                'total_amount'=>$request->service_charges,
                'tax'=>0,
                'status'=>'Receivable'

                            // $bill->bill_date=date('Y/m/d');
            // $bill->total_amount=$request->service_charges;
            // $bill->tax=0;
            // $bill->discount='0';
            // $bill->recievable=$request->regional_id;
            // $bill->old_debt='0';
            // $bill->cancalled='0';
            // $bill->status='Receivable';
            ]);

        }
            // $bill->bill_date=date('Y/m/d');
            // $bill->total_amount=$request->service_charges;
            // $bill->tax=0;
            // $bill->discount='0';
            // $bill->recievable=$request->regional_id;
            // $bill->old_debt='0';
            // $bill->cancalled='0';
            // $bill->status='Receivable';
            // $bill->save();

        // }


        //     $myfolder=$request->myfolder;
        //     $dupfolder=$request->reportFolder;

        //     $completed=$request->completed;
        // if($completed==true )
        // {
        //     $sales=$request->sales;
        //     $jobid=$request->jobid;




        //         if($sales!=0)
        //         {



        //         $tax = SaleTax::where('region',$sales)
        //         ->select('*')
        //         ->get();

        //         $total=$request->service_charges * $request->ex_rates;
        //         $saleTax=$tax[0]->rate / 100 * $total;
        //         $finalamount=$saleTax + $total;
        //             $vletter=$request->vendorletter;
        //         $date=date_create($request->bank_date);
        //         $bankDate=date_format($date,"d-M-Y");
        //         $data=[
        //             $tax[0]->rate,
        //             $request->bank,
        //             $request->address,
        //             $request->jobid,
        //             $request->company_address,
        //             $request->bank_letter,
        //             $bankDate,
        //             $request->service,
        //             $request->exchange,
        //             $total,
        //             $finalamount,
        //             $saleTax,
        //             $request->customer,
        //             $request->vendor,
        //             $request->customerAddress,
        //             $request->vendorAddress,
        //             $request->region,
        //             $request->customerIs,
        //             $request->branch_id,
        //             $request->vendorletter,


        //         ];


        //         }

        //         else{


        //         $total=$request->service_charges * $request->ex_rates;
        //         $saleTax=0 / 100 * $total;
        //         $finalamount=$saleTax + $total;
        //         $vletter=$request->vendorletter;

        //         $date=date_create($request->bank_date);
        //         $bankDate=date_format($date,"d-M-Y");
        //         $data=[
        //             '0',
        //             $request->bank,
        //             $request->address,
        //             $request->jobid,
        //             $request->company_address,
        //             $request->bank_letter,
        //             $bankDate,
        //             $request->service,
        //             $request->exchange,
        //             $total,
        //             $finalamount,
        //             $saleTax,
        //             $request->customer,
        //             $request->vendor,
        //             $request->customerAddress,
        //             $request->vendorAddress,
        //             $request->region,
        //             $request->customerIs,
        //             $request->branch_id,
        //             $request->vendorletter




        //         ];


        //         }
        //         $id=$request->id;

        //         $giver=$request->givenby;


        //         //File::delete('Reports/IBR/'.$id.'/bill.pdf');

        //         if($giver=='Customers'){


        //             $bill = new Bill_Ibr;
        //         $bill->bill_number=$data[3];
        //         $bill->job_number=$data[3];
        //         $bill->bill_date=date('Y/m/d');
        //         $bill->total_amount=$total;
        //         $bill->tax=$data[11];
        //         $bill->discount='0';
        //         $bill->recievable=$request->regional_id;
        //         $bill->old_debt='0';
        //         $bill->cancalled='0';
        //         $bill->bank=$request->bank_id;
        //         $bill->company=$request->job_by;
        //         $bill->branch=$data[18];
        //         $bill->customer=$data[17];
        //         $bill->status='Receivable';
        //         $bill->service='IBR';
        //         $bill->save();


        //         $log = new Log;
        //         $log->user_id=$request->user()->id;
        //         $log->activity=$data[3]." Bill Was generated";
        //         $log->date=date('Y/m/d');
        //         $log->time=date("h:i:sa");
        //         $log->service='IBR';
        //         $log->save();

        //         }

        //         else{


        //             $bill = new Bill_Ibr;
        //         $bill->bill_number=$data[3];
        //         $bill->job_number=$data[3];
        //         $bill->bill_date=date('Y/m/d');
        //         $bill->total_amount=$total;
        //         $bill->tax=$data[11];
        //         $bill->discount='0';
        //         $bill->recievable=$request->regional_id;
        //         $bill->bank=$request->bank_id;
        //         $bill->company=$request->job_by;
        //         $bill->old_debt='0';
        //         $bill->cancalled='0';
        //         $bill->branch=$data[18];
        //         $bill->customer=$data[17];
        //         $bill->status='Receivable';
        //         $bill->service='IBR';
        //         $bill->save();


        //         $log = new Log;
        //         $log->user_id=$request->user()->id;
        //         $log->activity=$data[3]." Bill Was generated";
        //         $log->date=date('Y/m/d');
        //         $log->time=date("h:i:sa");
        //         $log->service='IBR';
        //         $log->save();
        //         }









        // }

        //     if($request->duplicate==true){

        //         if($request->prevJob==null)
        //         {

        //                  Storage::disk('dir')->delete('Reports/IBR/'.$myfolder.'/original.pdf');
        //                 Storage::disk('dir')->copy('Reports/IBR/'.$dupfolder.'/original.pdf', 'Reports/IBR/'.$myfolder.'/original.pdf');


        //         }

        //         else{
        //             if($request->duplicate_id!=$request->prevJob)
        //             {
        //                 Storage::disk('dir')->delete('/Reports/IBR/'.$myfolder.'/original.pdf');
        //                 Storage::disk('dir')->copy('Reports/IBR/'.$dupfolder.'/original.pdf', 'Reports/IBR/'.$myfolder.'/original.pdf');

        //                 echo 'Ids Has been changed';

        //             }

        //             else{
        //                 echo 'Duplicate Ids are Same';

        //             }


        //         }



        // }

    }
    public static function uploadFinal($request, $id, $file)
    {

        $filename = Storage::disk('dir')->putFileAs('Reports/Valuation/' . $id . '/Report', $file, 'final.pdf');

        $path = '/Reports/Valuation/' . $id . '/Report/final.pdf';
        $exists = Storage::disk('dir')->exists($path);
        if ($exists) {
            $jid = $request->jid;
            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $jid . " final document uploaded";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Valuation';
            $log->save();

            $ibr = Valuation_Jobs::where('id', $id)->first();
            $ibr->final = 1;
            $ibr->save();


            return $path;
        } else {
            return false;
        }
    }
    public static function uploadImage($request, $id, $file, $filext, $ftype)
    {

        $fname = str_random(28);
        $filename = Storage::disk('dir')->putFileAs('Reports/Valuation/' . $id . '/Images/', $file, $fname . '.' . $filext);

        $path = 'Reports/Valuation/' . $id . '/Images/' . $fname . '.' . $filext;
        $exists = Storage::disk('dir')->exists($path);
        if ($exists) {
            $jid = $request->jid;
            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $fname . "." . $filext . "  uploaded";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Valuation';
            $log->save();

            $vehicleimages = new VehicleImage;
            $vehicleimages->job_id = $id;
            $vehicleimages->title = $fname . '.' . $filext;
            $vehicleimages->path = $path;
            $vehicleimages->bright = 0;
            $vehicleimages->half_page = 0;
            $vehicleimages->type = $ftype;
            $vehicleimages->rand = Str::random(5);
            $vehicleimages->save();


            return 'File Uploaded Successfully';
        } else {
            return 'File Does Not Uploaded Successfully Something Went Wrong';
        }
    }
    public static function  deleteVehicleImage($id, $image)
    {
        $file = VehicleImage::findOrFail($id);
        $file->delete();
        Storage::disk('dir')->delete($image);
    }

    public static function storeReportData($request, $id)
    {
        $vehicle = Valuation_Vehicles::where('job_number', $id)->first();


        if ($vehicle->bank_name == "Askari Bank Limited") {

            $vehicle->inspected_on = $request->inspected_date;
            $vehicle->surveyor = $request->surveyor_id;
            $vehicle->representative_cnic = $request->representative_cnic;
            $vehicle->inspected_at = $request->inspected_at;
            $vehicle->print_date = $request->print_date;
            $vehicle->title_of_ownership = $request->title_of_ownership;
            $vehicle->make = $request->car_make;
            $vehicle->car_model = $request->car_model;
            $vehicle->color = $request->car_color;
            $vehicle->class = $request->car_class;
            $vehicle->air_conditionar_avalibility = $request->air_conditionar_available;
            $vehicle->is_air_conditionar = $request->air_conditionar_working;
            $vehicle->reg_no = $request->car_registration;
            $vehicle->reg_date = $request->car_registration_date;
            $vehicle->cng_kit = $request->car_cng_kit;
            $vehicle->genre = $request->genre;
            $vehicle->engine_no = $request->car_engine_no;
            $vehicle->body_type = $request->body_type;
            $vehicle->engine_capacity = $request->car_engine_capacity;
            $vehicle->chassis_no = $request->car_chassis_no;
            $vehicle->odometer_reading = $request->odometer_reading;
            $vehicle->rim_type = $request->rim_type;
            $vehicle->manufactured = $request->manufactured;
            $vehicle->transmission = $request->transmission;
            $vehicle->feul_type = $request->feul_type;
            $vehicle->accessories = $request->accessories;
            $vehicle->drive_is = $request->car_drive;
            $vehicle->is_hybrid = $request->is_hybrid;
            $vehicle->body_condition = $request->body_condition;
            $vehicle->engine_condition = $request->engine_condition;
            $vehicle->steering_control = $request->steering_control;
            $vehicle->axle = $request->axle;
            $vehicle->suspension = $request->suspension;
            $vehicle->transmission_system = $request->transmission_system;
            $vehicle->electric_system = $request->electric_system;
            $vehicle->tyres = $request->tyres;
            $vehicle->any_leaks = $request->any_leaks;
            $vehicle->engine_major_defects = $request->major_defects;
            $vehicle->chassis_repaired = $request->chassis_repaired;
            $vehicle->external_body_condition = $request->external_body;
            $vehicle->bonnet_condition = $request->external_bonnet;
            $vehicle->doors_condition = $request->external_doors;
            $vehicle->seating_capacity = $request->seating_capacity;
            $vehicle->dashboard_condition = $request->internal_dashboard;
            $vehicle->roof = $request->internal_roof;
            $vehicle->seats = $request->internal_seats;
            $vehicle->overall_condition = $request->overall_condition;
            $vehicle->negative_remarks = $request->negative_remarks;
            $vehicle->original_registration_book = $request->original_reg_book;
            $vehicle->original_cnic_owner = $request->original_cnic;
            $vehicle->original_eto_certificate = $request->original_eto;
            $vehicle->hypothecated = $request->hypothecated;
            $vehicle->duplicated_reg_book = $request->duplicated_reg_book;
            $vehicle->is_transferred = $request->vehicle_transfered;
            $vehicle->is_stolen = $request->vehicle_transfered;
        } else {
            $vehicle->inspected_on = $request->inspected_date;
            $vehicle->surveyor = $request->surveyor_id;
            $vehicle->print_surveyor = $request->is_print_surveyor = true ? '1' : '0';
            $vehicle->print_date = $request->print_date;
            $vehicle->inspected_on_time = $request->inspected_time;
            $vehicle->is_print_time = $request->is_print_time == true ? '1' : '0';
            $vehicle->inspected_at = $request->inspected_at;
            $vehicle->title_of_ownership = $request->title_of_ownership;
            $vehicle->make = $request->car_make;
            $vehicle->car_model = $request->car_model;
            $vehicle->color = $request->car_color;
            $vehicle->manufacturing_year = $request->manufacturing_year;
            $vehicle->reg_no = $request->car_registration;
            $vehicle->reg_date = $request->car_registration_date;
            $vehicle->first_reg_date = $request->first_reg_date;
            $vehicle->first_reg_no = $request->first_reg_no;
            $vehicle->engine_no = $request->engine_np;
            $vehicle->engine_capacity = $request->car_engine_capacity;
            $vehicle->chassis_no = $request->car_chassis_no;
            $vehicle->odometer_reading = $request->odometer_reading;
            $vehicle->grade = $request->grade;
            $vehicle->acquired = $request->acquired;
            $vehicle->acq_is_reconditioned = $request->reconditioned;
            $vehicle->acq_is_repossesed    = $request->repossesed;
            $vehicle->document_seen    = $request->document_seen;
            $vehicle->document_seen_is_push_start = $request->is_push_start;
            $vehicle->document_seen_is_key_start = $request->is_key_start;
            $vehicle->manufactured = $request->manufactured;
            $vehicle->transmission = $request->transmission;
            $vehicle->feul_type = $request->feul_type;
            $vehicle->is_hybrid = $request->is_hybrid;
            $vehicle->cng_kit = $request->car_cng_kit;
            $vehicle->drive_is = $request->car_drive;
            $vehicle->right_side = $request->right_side;
            $vehicle->left_side = $request->left_side;
            $vehicle->front_side_bonnet = $request->front_side;
            $vehicle->rear_side_trunk = $request->rear_side;
            $vehicle->front_show_grill = $request->show_grill;
            $vehicle->front_lower_shield = $request->front_lower_shield;
            $vehicle->front_back_bumper = $request->front_back_bumper;
            $vehicle->wheel_caps = $request->wheel_caps;
            $vehicle->monograms = $request->monograms;
            $vehicle->original_num_plates = $request->original_number_plates;
            $vehicle->assemblies = $request->assemblies;
            $vehicle->tires = $request->tires;
            $vehicle->seating_capacity = $request->seating_capacity;
            $vehicle->shock_absorbers = $request->shock_absorbers;
            $vehicle->suspension = $request->suspension;
            $vehicle->spare_tire = $request->spare_tire = true ? '1' : '0';
            $vehicle->car_toolkit = $request->car_toolkit = true ? '1' : '0';
            $vehicle->tickli = $request->tickli = true ? '1' : '0';
            $vehicle->ignition_takes = $request->seating_capacity;
            $vehicle->battery_starts = $request->seating_capacity;
            $vehicle->engine_is = $request->engine;
            $vehicle->chassis_is = $request->engine;
            $vehicle->radiator = $request->chassis;
            $vehicle->right_head_light = $request->red_head_light;
            $vehicle->left_head_light = $request->left_head_light;
            $vehicle->right_tail_light = $request->right_tail_light;
            $vehicle->left_tail_light = $request->left_tail_light;
            $vehicle->right_indicator_light = $request->right_indicator_light;
            $vehicle->left_indicator_light = $request->left_indicator_light;
            $vehicle->inner_lights = $request->inner_lights;
            $vehicle->steering_control = $request->steering_control;
            $vehicle->axle = $request->axle;
            $vehicle->clutch = $request->clutch;
            $vehicle->brakes = $request->brakes;
            $vehicle->air_conditionar_avalibility = $request->air_conditionar_available = true ? '1' : '0';
            $vehicle->is_air_conditionar = $request->air_conditionar_working;

            $vehicle->heater_avalibility = $request->heater_available = true ? '1' : '0';
            $vehicle->is_air_conditionar = $request->heater_working;


            $vehicle->bluetooth_avalibility = $request->cd_player_available = true ? '1' : '0';
            $vehicle->is_bluetooth = $request->cd_player_working;

            $vehicle->cameras_avalibility = $request->cameras_available = true ? '1' : '0';
            $vehicle->is_cameras = $request->cameras_working;
            $vehicle->others1 = $request->other1;
            $vehicle->others2 = $request->other2;
            $vehicle->others3 = $request->other3;
            $vehicle->others4 = $request->other4;
            $vehicle->others5 = $request->other5;
        }
        $vehicle->save();

        return 'Details Updated Successfully';
    }

    public static function getReportDetails($request, $id)
    {
        $vehicle = DB::table('valuation_vehicleDetails')
            ->leftjoin('c_employees', 'c_employees.id', '=', 'valuation_vehicleDetails.surveyor')
            ->leftjoin('valuation_vehicle_body_types', 'valuation_vehicle_body_types.id', '=', 'valuation_vehicleDetails.body_type')
            ->leftjoin('valuation_rim_types', 'valuation_rim_types.id', '=', 'valuation_vehicleDetails.rim_type')
            ->leftjoin('valuation_vehicle_classes', 'valuation_vehicle_classes.id', '=', 'valuation_vehicleDetails.class')
            ->where('valuation_vehicleDetails.job_number', '=', $id)
            ->select(
                'valuation_vehicleDetails.*',
                'c_employees.name As surveyor_name',
                'valuation_vehicle_body_types.description As body_type_name',
                'valuation_rim_types.description AS rim_type_name',
                'valuation_vehicle_classes.description AS vehicle_class_name'
            )
            ->get();
        return $vehicle;
    }

    public static function getFinalReport($id)
    {
        $myFile = '/Reports/Valuation/' . $id . '/Report/final.pdf';
        $file = Storage::disk('dir')->exists($myFile);
        if ($file) {
            return $myFile;
        } else {
            $val = Valuation_Jobs::where('id', $id)->first();
            $val->final = 0;
            $val->save();
            return 'File does not exists';
        }
    }

    public static function updateBrightStatus($request, $id)
    {
        $val = VehicleImage::where('id', $id)->first();
        $val->bright = $request->status == true ? '1' : '0';
        $val->save();
    }
    public static function updateHalfStatus($request, $id)
    {
        $val = VehicleImage::where('id', $id)->first();
        $val->half_page = $request->status == true ? '1' : '0';
        $val->save();
    }
    public static function getClasses()
    {
        $classes = DB::table('get_vehicle_classes')
            ->select('*')
            ->get();
        return $classes;
    }

    public static function getBodyTypes()
    {
        $types = DB::table('get_vehicle_body_types')
            ->select('*')
            ->get();
        return $types;
    }

    public static function getRimTypes()
    {
        $rims = DB::table('get_rim_types')
            ->select('*')
            ->get();
        return $rims;
    }

    public static function getImages($id)
    {
        $files = DB::table('valuation_vehicle_images')
            ->where('valuation_vehicle_images.job_id', $id)
            ->leftJoin('valuation_vehicle_image_types', 'valuation_vehicle_image_types.id', '=', 'valuation_vehicle_images.type')
            ->select(
                'valuation_vehicle_images.id',
                'valuation_vehicle_images.job_id',
                'valuation_vehicle_images.title',
                'valuation_vehicle_images.path',
                'valuation_vehicle_images.rand',
                'valuation_vehicle_images.bright',
                'valuation_vehicle_images.half_page',
                'valuation_vehicle_image_types.description'
            )
            ->get();
        return $files;
    }
    public static function uploadDocuments($request)
    {
        $files = $request->file('files');
        $id = $request->job_id;

        foreach ($files as $file) {

            $originalName = $file->getClientOriginalName();
            $filename = Storage::disk('dir')->putFileAs('Reports/Valuation/' . $id, $file, $originalName);
        }


        $jid = $request->jid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $jid . " documents uploaded";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Valuation';
        $log->save();
    }

    public static function generateMCBReport($request)
    {


        $page1 = MPDF::loadView('Valuation/MCB/page1');
        $page1->save('Reports/Valuation/page1.pdf');

        $page2 = MPDF::loadView('Valuation/MCB/page2');
        $page2->save('Reports/Valuation/page2.pdf');

        $page3 = MPDF::loadView('Valuation/MCB/page3');
        $page3->save('Reports/Valuation/page3.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm');

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page1.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pageCount = $pdf->setSourceFile("Reports/Valuation/page2.pdf");

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            // Move to the right
            $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetY(-37);
            // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 0);
        }

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page3.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->output();

        return 'Report Generated';
    }

    public static function generateASKBLReport($request, $id)
    {

        $images = DB::table('valuation_vehicle_images')
            ->where('valuation_vehicle_images.job_id', '=', $id)
            ->leftjoin('valuation_vehicle_image_types', 'valuation_vehicle_images.type', '=', 'valuation_vehicle_image_types.id')
            ->select(
                'valuation_vehicle_image_types.description',
                'valuation_vehicle_images.path'
            )
            ->get();


        $valuation = new Valuation();
        $job = $valuation::getJobByIdForReport($id);
        $vehicle = $valuation::getReportDetails($request, $id);
        $vehiclefrontimage = VehicleImage::where('job_id', $id)->where('type', 8)
            ->first();

        $data = [
            'carName' => $vehicle[0]->make,
            'frontImage' => $vehiclefrontimage->path,
            'client_name' => 'M/S. ' . strtoupper($job[0]->bank_name),
            'bank_name' => $job[0]->bank_name,
            'applicant' => $job[0]->cust_name,
            'acknowledge_to' => strtoupper($job[0]->bank_name),
            'address' => $job[0]->bank_address,
            'job_id' => $job[0]->job_id,
            'delivery_date' => date('M d, Y', strtotime($vehicle[0]->print_date)),
            'account' => 'M/S. ' . strtoupper($job[0]->bank_name),
            'branch_name' => $job[0]->bank_address,
            'visit_date' => date('M d, Y', strtotime($vehicle[0]->inspected_on)),
            'place_of_inspection' => $vehicle[0]->inspected_at,
            'representative' => $job[0]->cust_name,
            'cnic' => $vehicle[0]->representative_cnic == null ? 'N/A' : $vehicle[0]->representative_cnic,
            'manufacturing_year' => $vehicle[0]->car_model,
            'registration_no' => $vehicle[0]->reg_no,
            'class' => $vehicle[0]->vehicle_class_name,
            'name_of_owner' => strtoupper($vehicle[0]->title_of_ownership),
            'chassis_no' => $vehicle[0]->chassis_no,
            'engine_no' => $vehicle[0]->engine_no,
            'genre' => $vehicle[0]->genre,
            'body_type' => $vehicle[0]->body_type_name,
            'color' => $vehicle[0]->color,
            'is_air_conditionar' => $vehicle[0]->air_conditionar_avalibility == 0 ? 'Not Available' : 'Available',
            'is_air_conditionar_working' => $vehicle[0]->is_air_conditionar,
            'cng' => $vehicle[0]->cng_kit != null ? 'Available' : 'Not Available',
            'accessories' => $vehicle[0]->accessories == 0 ? 'No' : 'Yes',
            'engine_capacity' => $vehicle[0]->engine_capacity,
            'drive' => $vehicle[0]->drive_is,
            'fuel_type' => $vehicle[0]->feul_type,
            'transmission' => $vehicle[0]->transmission,
            'seating_capacity' => $vehicle[0]->seating_capacity,
            'mileage' => $vehicle[0]->odometer_reading,
            'rim_type' => $vehicle[0]->rim_type_name,
            'body' => $vehicle[0]->body_condition,
            'engine' => $vehicle[0]->engine_condition,
            'steering_control' => $vehicle[0]->steering_control,
            'axle' => $vehicle[0]->axle,
            'suspension' => $vehicle[0]->suspension,
            'transmission_system' => $vehicle[0]->transmission_system,
            'electric_system' => $vehicle[0]->electric_system,
            'tires' => $vehicle[0]->tyres,
            'any_leaks' => $vehicle[0]->any_leaks,
            'engine_defects' => $vehicle[0]->engine_major_defects,
            'chassis_repaired' => $vehicle[0]->chassis_repaired,
            'external_body' => $vehicle[0]->external_body_condition,
            'external_bonnet' => $vehicle[0]->bonnet_condition,
            'external_doors' => $vehicle[0]->doors_condition,
            'dashboard_condition' => $vehicle[0]->dashboard_condition,
            'roof' => $vehicle[0]->roof,
            'seats' => $vehicle[0]->seats,
            'negative_remarks' => $vehicle[0]->negative_remarks,
            'overall_condition' => $vehicle[0]->overall_condition,
            'original_registration_book' => $vehicle[0]->original_registration_book,
            'duplicate_registration_book' => $vehicle[0]->duplicated_reg_book == 0 ? 'No' : 'Yes',
            'original_cnic' => $vehicle[0]->original_cnic_owner,
            'original_eto' => $vehicle[0]->original_eto_certificate,
            'vehicle_hypothecated' => $vehicle[0]->hypothecated == 0 ? 'No' : 'Yes',
            'vehicle_transferred' => $vehicle[0]->is_transferred == 0 ? 'No' : 'Yes',
            'vehicle_stolen' => $vehicle[0]->is_stolen == 0 ? 'No' : 'Yes',
            'market_value' => number_format($job[0]->value, 2),
            'less_fsv' => number_format($job[0]->fsv_rate, 2),
            'fsv' => number_format($job[0]->fsv_calculated, 2),
            'images' => $images
        ];
        $page1 = MPDF::loadView('Valuation/ASKBL/page1', $data);
        $page1->save('Reports/Valuation/page1.pdf');

        $page2 = MPDF::loadView('Valuation/ASKBL/page2', $data);
        $page2->save('Reports/Valuation/page2.pdf');

        $page3 = MPDF::loadView('Valuation/ASKBL/page345', $data);
        $page3->save('Reports/Valuation/page345.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm');

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page1.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page2.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pageCount = $pdf->setSourceFile("Reports/Valuation/page345.pdf");

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            // Move to the right
            $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetY(-37);
            // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 0);
        }

        // $pdf->AddPage();
        // $pdf->setSourceFile("Reports/Valuation/page345.pdf");
        // $tplIdx = $pdf->importPage(1);
        // $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->output();
    }

    public static function generateBAFReport($request)
    {

        $page1 = MPDF::loadView('Valuation/BAF/page1');
        $page1->save('Reports/Valuation/page1.pdf');

        $page2 = MPDF::loadView('Valuation/BAF/page2');
        $page2->save('Reports/Valuation/page2.pdf');

        $page3 = MPDF::loadView('Valuation/BAF/page3');
        $page3->save('Reports/Valuation/page3.pdf');

        $page3 = MPDF::loadView('Valuation/BAF/page4');
        $page3->save('Reports/Valuation/page4.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm');

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page1.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page2.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);




        $pageCount = $pdf->setSourceFile("Reports/Valuation/page3.pdf");

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            // Move to the right
            $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetY(-37);
            // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 0);
        }


        $pageCount1 = $pdf->setSourceFile("Reports/Valuation/page4.pdf");

        for ($pageNo = 1; $pageNo <= $pageCount1; $pageNo++) {

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            // Move to the right
            $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetY(-37);
            // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 0);
        }

        $pdf->output();

        return 'Report Generated';
    }


    public static function generateBAHReport($request, $id)
    {

        $images = DB::table('valuation_vehicle_images')
            ->where('valuation_vehicle_images.job_id', '=', $id)
            ->leftjoin('valuation_vehicle_image_types', 'valuation_vehicle_images.type', '=', 'valuation_vehicle_image_types.id')
            ->select(
                'valuation_vehicle_image_types.description',
                'valuation_vehicle_images.path'
            )
            ->get();


        $valuation = new Valuation();
        $job = $valuation::getJobByIdForReport($id);
        $vehicle = $valuation::getReportDetails($request, $id);
        $vehiclefrontimage = VehicleImage::where('job_id', $id)->where('type', 8)
            ->first();

        $data = [
            'carName' => $vehicle[0]->make,
            'carModel' => $vehicle[0]->car_model,
            'carColor' => $vehicle[0]->color,
            'regNo' => $vehicle[0]->reg_no,
            'regDate' => $vehicle[0]->reg_date,
            'EngineNo' => $vehicle[0]->engine_no,
            'ChassisNo' => $vehicle[0]->chassis_no,
            'EngineCapacity' => $vehicle[0]->engine_capacity,
            'acquired' => $vehicle[0]->acquired,
            'reconditioned' => $vehicle[0]->acq_is_reconditioned,
            'repossesed' => $vehicle[0]->acq_is_repossesed,
            'odometer' => $vehicle[0]->odometer_reading,
            'manufactured' => $vehicle[0]->manufactured,
            'transmission' => $vehicle[0]->transmission,
            'fuelType' => $vehicle[0]->feul_type,
            'isHybrid' => $vehicle[0]->is_hybrid,
            'cngKit' => $vehicle[0]->cng_kit,
            'isDrive' => $vehicle[0]->drive_is,

            'rightSide' => $vehicle[0]->right_side,
            'leftSide' => $vehicle[0]->left_side,
            'frontSide' => $vehicle[0]->front_side_bonnet,
            'rearSide' => $vehicle[0]->rear_side_trunk,
            'showGrill' => $vehicle[0]->front_show_grill,
            'lowerShield' => $vehicle[0]->front_lower_shield,
            'frontBackBumper' => $vehicle[0]->front_back_bumper,
            'wheelCaps' => $vehicle[0]->wheel_caps,
            'monograms' => $vehicle[0]->monograms,
            'numberPlates' => $vehicle[0]->original_num_plates,
            'shockAbsorbers' => $vehicle[0]->shock_absorbers,
            'assemblies' => $vehicle[0]->assemblies,
            'tires' => $vehicle[0]->tires,
            'spareTires' => $vehicle[0]->spare_tire,
            'carToolkit' => $vehicle[0]->car_toolkit,
            'tickli' => $vehicle[0]->tickli,

            'ignitionTakes' => $vehicle[0]->ignition_takes,
            'batteryStarts' => $vehicle[0]->battery_starts,
            'cengineIs' => $vehicle[0]->engine_is,
            'chassisIs' => $vehicle[0]->chassis_is,
            'radiator' => $vehicle[0]->radiator,
            'rightHeadLight' => $vehicle[0]->right_head_light,
            'leftHeadLight' => $vehicle[0]->left_head_light,
            'rightTailLight' => $vehicle[0]->right_tail_light,
            'leftTailLight' => $vehicle[0]->left_tail_light,
            'rightIndicatorLight' => $vehicle[0]->right_indicator_light,
            'leftIndicatorLight' => $vehicle[0]->left_indicator_light,
            'innerLights' => $vehicle[0]->inner_lights,
            'steeringControl' => $vehicle[0]->steering_control,
            'axle' => $vehicle[0]->axle,
            'clutch' => $vehicle[0]->clutch,
            'brakes' => $vehicle[0]->brakes,
            'airConditionarAvalibility' => $vehicle[0]->air_conditionar_avalibility,
            'heaterAvalibility' => $vehicle[0]->heater_avalibility,
            'bluetoothAvalibility' => $vehicle[0]->bluetooth_avalibility,
            'camerasAvalibility' => $vehicle[0]->cameras_avalibility,
            'reference_date' => date('M d, Y', strtotime($job[0]->bank_letter_date)),

            'title_of_ownership' => strtoupper($vehicle[0]->title_of_ownership),
            'frontImage' => $vehiclefrontimage->path,
            'client_name' => 'M/S. ' . strtoupper($job[0]->bank_name),
            'bank_name' => $job[0]->bank_name,
            'applicant' => $job[0]->cust_name,
            'acknowledge_to' => strtoupper($job[0]->bank_name),
            'address' => $job[0]->bank_address,
            'job_id' => $job[0]->job_id,
            'delivery_date' => date('M d, Y', strtotime($vehicle[0]->print_date)),
            'account' => 'M/S. ' . strtoupper($job[0]->bank_name),
            'branch_name' => $job[0]->bank_address,
            'visit_date' => date('M d, Y', strtotime($vehicle[0]->inspected_on)),
            'place_of_inspection' => $vehicle[0]->inspected_at,
            'representative' => $job[0]->cust_name,
            'cnic' => $vehicle[0]->representative_cnic == null ? 'N/A' : $vehicle[0]->representative_cnic,
            'manufacturing_year' => $vehicle[0]->manufacturing_year,
            'registration_no' => $vehicle[0]->reg_no,
            'class' => $vehicle[0]->vehicle_class_name,
            'name_of_owner' => strtoupper($vehicle[0]->title_of_ownership),
            'chassis_no' => $vehicle[0]->chassis_no,
            'engine_no' => $vehicle[0]->engine_no,
            'genre' => $vehicle[0]->genre,
            'body_type' => $vehicle[0]->body_type_name,
            'color' => $vehicle[0]->color,
            'is_air_conditionar' => $vehicle[0]->air_conditionar_avalibility == 0 ? 'Not Available' : 'Available',
            'is_air_conditionar_working' => $vehicle[0]->is_air_conditionar,
            'cng' => $vehicle[0]->cng_kit != null ? 'Available' : 'Not Available',
            'accessories' => $vehicle[0]->accessories == 0 ? 'No' : 'Yes',
            'engine_capacity' => $vehicle[0]->engine_capacity,
            'drive' => $vehicle[0]->drive_is,
            'fuel_type' => $vehicle[0]->feul_type,
            'transmission' => $vehicle[0]->transmission,
            'seating_capacity' => $vehicle[0]->seating_capacity,
            'mileage' => $vehicle[0]->odometer_reading,
            'rim_type' => $vehicle[0]->rim_type_name,
            'body' => $vehicle[0]->body_condition,
            'engine' => $vehicle[0]->engine_condition,
            'steering_control' => $vehicle[0]->steering_control,
            'axle' => $vehicle[0]->axle,
            'suspension' => $vehicle[0]->suspension,
            'transmission_system' => $vehicle[0]->transmission_system,
            'electric_system' => $vehicle[0]->electric_system,
            //  'tires'=>$vehicle[0]->tyres,
            'any_leaks' => $vehicle[0]->any_leaks,
            'engine_defects' => $vehicle[0]->engine_major_defects,
            'chassis_repaired' => $vehicle[0]->chassis_repaired,
            'external_body' => $vehicle[0]->external_body_condition,
            'external_bonnet' => $vehicle[0]->bonnet_condition,
            'external_doors' => $vehicle[0]->doors_condition,
            'dashboard_condition' => $vehicle[0]->dashboard_condition,
            'roof' => $vehicle[0]->roof,
            'seats' => $vehicle[0]->seats,
            'negative_remarks' => $vehicle[0]->negative_remarks,
            'overall_condition' => $vehicle[0]->overall_condition,
            'original_registration_book' => $vehicle[0]->original_registration_book,
            'duplicate_registration_book' => $vehicle[0]->duplicated_reg_book == 0 ? 'No' : 'Yes',
            'original_cnic' => $vehicle[0]->original_cnic_owner,
            'original_eto' => $vehicle[0]->original_eto_certificate,
            'vehicle_hypothecated' => $vehicle[0]->hypothecated == 0 ? 'No' : 'Yes',
            'vehicle_transferred' => $vehicle[0]->is_transferred == 0 ? 'No' : 'Yes',
            'vehicle_stolen' => $vehicle[0]->is_stolen == 0 ? 'No' : 'Yes',
            'market_value' => number_format($job[0]->value, 2),
            'less_fsv' => number_format($job[0]->fsv_rate, 2),
            'fsv' => number_format($job[0]->fsv_calculated, 2),
            'images' => $images
        ];
        $page1 = MPDF::loadView('Valuation/BAH/page1', $data);
        $page1->save('Reports/Valuation/page1.pdf');

        $page2 = MPDF::loadView('Valuation/BAH/page2', $data);
        $page2->save('Reports/Valuation/page2.pdf');

        $page3 = MPDF::loadView('Valuation/BAH/page3', $data);
        $page3->save('Reports/Valuation/page3.pdf');

        $page3 = MPDF::loadView('Valuation/BAH/page4', $data);
        $page3->save('Reports/Valuation/page4.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm');

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page1.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Valuation/page2.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);




        $pageCount = $pdf->setSourceFile("Reports/Valuation/page3.pdf");

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            // Move to the right
            $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetY(-37);
            // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 0);
        }


        $pageCount1 = $pdf->setSourceFile("Reports/Valuation/page4.pdf");

        for ($pageNo = 1; $pageNo <= $pageCount1; $pageNo++) {

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            // Move to the right
            $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetY(-37);
            // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 0);
        }

        $pdf->output();

        return 'Report Generated';
    }
}
