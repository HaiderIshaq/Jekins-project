<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Log;
use App\Job;
use App\Bill_Ibr;
use App\Livestock_Animals_Detail;
use App\Livestock_Animals_Remark;

class Inspection extends Model
{
    protected $table = 'inspection_jobs';

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
    public static function makeLog($request, $cid)
    {

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No:" . $cid . " Was Added";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Livestock';
        $log->save();
    }

    public static function getLivestockImages($id)
    {
        $files = DB::table('inspection_livestock_report_images')
            ->where('job_id', $id)
            ->select(
                '*'
            )
            ->get();
        return $files;
    }
    public static function  deleteLivestockImage($id, $image)
    {
        $file = DB::table('inspection_livestock_report_images')->where('id', $id)->delete();

        Storage::disk('dir')->delete($image);
    }

    public static function storeInspection($request)
    {

        $val = new Inspection;

        // $val->request_date=date("Y/m/d");
        $val->region_id = $request->regional_id;
        $val->job_by = $request->job_by;
        $val->given_by = $request->given_by;
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
        $val->byvendor_id = $request->ins_vendor_id;
        $val->byvendor_representative = $request->ins_vendor_representaive;
        $val->byvendor_designation = $request->ins_vendor_designation;
        $val->byvendor_address = $request->ins_billing_address;
        $val->byvendor_phone = $request->ins_vendor_phone;
        $val->byvendor_fax = $request->ins_vendor_fax;
        $val->byvendor_email = $request->ins_vendor_email;
        $val->byvendor_letter = $request->ins_vendor_letter;
        $val->vendor_letter_date = $request->ins_vendor_date;
        $val->customer_id = $request->customer_id;
        $val->customer_representative = $request->customer_representative;
        $val->customer_designation = $request->customer_designation;
        $val->customer_phone = $request->customer_phone;
        $val->customer_cnic = $request->customer_cnic;
        $val->customer_address = $request->customer_location;
        $val->customer_email = $request->customer_email;
        $val->is_stock_joint = $request->is_stock_joint == true ? '1' : '0';
        $val->stock_is = $request->stock_is;
        $val->muccaduum_id = $request->muccaduum_id;
        $val->is_print_muccaduum = $request->is_print_muccaduum == true ? '1' : '0';
        $val->is_print_representative = $request->is_print_representative == true ? '1' : '0';
        $val->muccaduum_representative = $request->muccaduum_representative;
        $val->muccaduum_representative_nic = $request->muccaduum_representative_nic;
        $val->muccaduum_representative_desig = $request->muccaduum_representative_desig;
        $val->muccaduum_representative_phone = $request->muccaduum_representative_phone;
        $val->muccaduum_representative_email = $request->muccaduum_representative_email;
        $val->muccaduum_representative_fax = $request->muccaduum_representative_fax;
        $val->is_rotation = $request->is_rotation == true ? '1' : '0';
        $val->last_do = $request->last_do;
        $val->request_date = $request->requested_on;
        $val->site_start = $request->site_start;
        $val->facility_id = json_encode($request->input("facility"));
        $val->is_facility_print = $request->is_facility_print == true ? '1' : '0';
        $val->sactioned_limit = $request->sactioned_limit;
        $val->scope = $request->scope;
        $val->collateral = $request->collateral;
        $val->quantity = $request->quantity;
        $val->ownership_evidance = $request->ownership_evidance;
        $val->operational_branch = $request->operational_branch;
        $val->service_charges = $request->service_charges;
        $val->is_service_charges_corporate = $request->is_service_charges_corporate == true ? '1' : '0';
        $val->is_sales_tax = $request->is_sales_tax == true ? '1' : '0';
        $val->sale_reg = $request->sale_reg;
        $val->is_travel_charges = $request->is_travel_charges == true ? '1' : '0';
        $val->travel_charges = $request->travel_charges;
        $val->total_amount = 0;
        $val->cancalled = 0;
        $val->customer_delay = 0;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();
        
      
    }

    public static function getLatestJob()
    {
        $cjob = DB::table('inspection_jobs')->latest('created_at', 'desc')->first();
        Storage::disk('dir')->makeDirectory('Reports/Inspection/' . $cjob->id . '/Report');
        // Storage::disk('dir')->makeDirectory('Reports/Valuation/' . $cjob->id.'/Images');
        return $cjob;
    }

    public static function uploadLivestockimages($request)
    {
        $files = $request->file('files');
        $id = $request->jid;


        foreach ($files as $file) {

            $fname = str_random(28);
            $filename = Storage::disk('dir')->putFileAs('Reports/Inspection/' . $id . '/images', $file, $fname . '.jpg');

            $job = DB::table('inspection_livestock_report_images')->insert([
                'job_id' => $id,
                'title' => $fname . '.jpg',
                'path' =>  $filename,

            ]);
        }


        $jid = $request->jid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job Id:" . $jid . " images uploaded";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Livestock';
        $log->save();
    }

    public static function addCommonJob($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "LS";

        $job = new Job;
        if ($givenBy == "Bank") {

            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');


            $bill = new Bill_Ibr;
            $bill->bill_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->job_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->total_amount = $request->service_charges;
            $bill->tax = '0';
            $bill->discount = '0';
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Livestock';
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
            $bill->service = 'Livestock';
            $bill->save();
        }
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);
        $job->region_id = $request->regional_id;
        $job->service = "Livestock";
        $job->bank_id = $request->bank_id;
        $job->byvendor_id = $request->val_vendor_id;
        $job->branch_id = $request->branch_id;
        $job->customer_id = $request->customer_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();
    }
    public static function updateInspection($request, $id)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = Inspection::where('id', $id)->first();

        $ibr->region_id = $request->regional_id;
        $ibr->operational_branch = $request->operational_branch;
        $ibr->job_by = $request->job_by;
        $ibr->bank_id = $request->bank_id;
        $ibr->given_by = $request->given_by;
        $ibr->branch_id = $request->branch_id;
        $ibr->bank_address = $request->bank_address;
        $ibr->bank_representative = $request->bank_representative;
        $ibr->bank_designation = $request->bank_designation;
        $ibr->bank_phone = $request->bank_phone;
        $ibr->bank_fax = $request->bank_fax;
        $ibr->bank_email = $request->bank_email;
        $ibr->bank_letter = $request->bank_letter;
        $ibr->bank_letter_date = $request->letter_date;
        $ibr->byvendor_id = $request->ins_vendor_id;
        $ibr->byvendor_address = $request->ins_billing_address;
        $ibr->byvendor_representative = $request->ins_vendor_representaive;
        $ibr->byvendor_designation = $request->ins_vendor_designation;
        $ibr->byvendor_phone = $request->ins_vendor_phone;
        $ibr->byvendor_fax = $request->ins_vendor_fax;
        $ibr->byvendor_email = $request->ins_vendor_email;
        $ibr->byvendor_letter = $request->ins_vendor_letter;
        $ibr->vendor_letter_date = $request->ins_vendor_date;
        $ibr->customer_id = $request->customer_id;
        $ibr->customer_representative = $request->customer_representative;
        $ibr->customer_designation = $request->customer_designation;
        $ibr->customer_phone = $request->customer_phone;
        $ibr->customer_address = $request->customer_address;
        $ibr->customer_cnic = $request->customer_cnic;
        $ibr->customer_email = $request->customer_email;
        $ibr->show_values = $request->show_values == true ? '1' : '0';
        $ibr->letter_head = $request->letter_head == true ? '1' : '0';
        $ibr->completed = $request->completed == true ? '1' : '0';
        $ibr->delivered_on = $request->delivered_on;
        $ibr->prepared_by_cpu = $request->prepared_by_cpu == true ? '1' : '0';
        $ibr->is_stock_joint = $request->is_joint == true ? '1' : '0';
        $ibr->stock_is = $request->stock_selected;
        $ibr->request_date = $request->requested_on;
        $ibr->site_start = $request->site_start;
        $ibr->facility_id = $request->facility_id;
        $ibr->is_facility_print = $request->is_facility_print == true ? '1' : '0';
        $ibr->sactioned_limit = $request->sactioned_limit;
        $ibr->scope = $request->scope;
        $ibr->collateral = $request->collateral;
        $ibr->quantity = $request->quantity;
        $ibr->ownership_evidance = $request->ownership_evidance;
        $ibr->service_charges = $request->service_charges;
        $ibr->is_service_charges_corporate = $request->is_service_charges_corporate == true ? '1' : '0';
        $ibr->is_sales_tax = $request->is_sales_tax == true ? '1' : '0';
        $ibr->sale_reg = $request->sale_reg;
        $ibr->muccaduum_id = $request->muccaduum_id;
        $ibr->is_print_muccaduum = $request->is_print_muccaduum == true ? '1' : '0';
        $ibr->is_print_representative = $request->is_print_representative == true ? '1' : '0';
        $ibr->muccaduum_representative = $request->muccaduum_representative;
        $ibr->muccaduum_representative_nic = $request->muccaduum_representative_nic;
        $ibr->muccaduum_representative_fax = $request->muccaduum_representative_fax;
        $ibr->muccaduum_representative_desig = $request->muccaduum_representative_desig;
        $ibr->muccaduum_representative_phone = $request->muccaduum_representative_phone;
        $ibr->muccaduum_representative_email = $request->muccaduum_representative_email;
        $ibr->updated_by = $request->user()->id;
        $ibr->declared_currency = $request->declared_currency;
        $ibr->declared_amount = $request->declared_amount;
        $ibr->declared_currency_print = $request->declared_currency_print == true ? '1' : '0';
        $ibr->declared_currency_attachments = $request->declared_currency_print_attachments == true ? '1' : '0';
        $ibr->declared_as_per = $request->declared_as_per;
        $ibr->declared_no_label_input = $request->declared_no_label_input;
        $ibr->declared_no_label_attachments = $request->declared_no_label_attachments == true ? '1' : '0';
        $ibr->declared_remarks_print = $request->declared_remarks_print == true ? '1' : '0';
        $ibr->declared_remarks = $request->declared_remarks;
        $ibr->insurance_insured_by = $request->insurance_insured_by;
        $ibr->insurance_insurance_for = $request->insurance_insurance_for;
        $ibr->insurance_expiry = $request->insurance_expiry;
        $ibr->is_insurance_with_bank = $request->is_insurance_with_bank == true ? '1' : '0';
        $ibr->insurance_status = $request->insurance_status;
        $ibr->insurance_remarks = $request->insurance_remarks;
        $ibr->insurance_no_label_input = $request->insurance_no_label_input;
        $ibr->insurance_next_line = $request->insurance_next_line == true ? '1' : '0';
        $ibr->inspection_stock_inspector = $request->inspection_stock_inspector;
        $ibr->inspection_next_line = $request->inspection_next_line == true ? '1' : '0';
        $ibr->is_travel_charges = $request->is_travel_charges == true ? '1' : '0';
        $ibr->travel_charges = $request->travel_charges;
        $ibr->inspection_date = $request->inspection_date;
        $ibr->inspection_report_date = $request->inspection_report_date;
        $ibr->inspection_stock_report_date = $request->inspection_stock_report_date;
        $ibr->conducted_by = $request->conducted_by;
        $ibr->signed_by = $request->signed_by;



        $ibr->save();


        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No: " . $jid . " Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Livestock';
        $log->save();
    }

    public static function updateLocalJob($request, $id)
    {

        $com_id = $request->commonId;
        $comJob = Job::where('id', $com_id)->first();
        $comJob->company_id = strtoupper($request->company_id);
        $comJob->region_id = $request->regional_id;
        $comJob->bank_id = $request->bank_id;
        $comJob->byvendor_id = $request->ibr_vendor_id;
        $comJob->customer_id = $request->customer_id;
        $comJob->branch_id = $request->branch_id;


        if ($request->delayed == true) {
            $comJob->status = '2';
        } else if ($request->completed == true) {
            $comJob->status = '1';
        } else {
            $comJob->status = '0';
        }

        $comJob->save();
    }
    public static function addDefaultDetailsofanimals($id)
    {
        $data = [
            [
                'job_id' => $id,
                'description_of_stocks' => 'Cow Milking',
                'breed' => '[{"mainType":"Local","secondType":"Freisian","quantity":"0","age":"0-0","time":"Years","remarks":"Active & Healthy"}]',
                'quantity' => '0',

            ], [
                'job_id' => $id,
                'description_of_stocks' => 'Cow Dry',
                'breed' => '[{"mainType":"Local","secondType":"Jersey","quantity":"0","age":"0-0","time":"Years","remarks":"Active & Healthy"}]',
                'quantity' => '0',

            ],
            [
                'job_id' => $id,
                'description_of_stocks' => 'Buffalo Milking',
                'breed' => '[{"mainType":"Local","secondType":"Neeli","quantity":"0","age":"0-0","time":"Years","remarks":"Active & Healthy"}]',
                'quantity' => '0',

            ], [
                'job_id' => $id,
                'description_of_stocks' => 'Buffalo Dry',
                'breed' => '[{"mainType":"Local","secondType":"Ravi","quantity":"0","age":"0-0","time":"Years","remarks":"Active & Healthy"}]',
                'quantity' => '0',

            ],
            [
                'job_id' => $id,
                'description_of_stocks' => 'Calves Cow',
                'breed' => '[{"mainType":"Local","secondType":"Jersey","quantity":"0","age":"0-0","time":"Months","remarks":"Active & Healthy"}]',
                'quantity' => '0',

            ], [
                'job_id' => $id,
                'description_of_stocks' => 'Calves Buffalow',
                'breed' => '[{"mainType":"Local","secondType":"Ravi","quantity":"0","age":"0-0","time":"Months","remarks":"Active & Healthy"}]',
                'quantity' => '0',

            ]
        ];

        $job = DB::table('inspection_livestock_details_of_animals')->insert($data);

        $data1 = [
            [
                'job_id' => $id,
                'title' => 'Traceability',
                'option_first_name' => 'Ear Tag',
                'option_first_status' => 0,
                'option_second_name' => 'Skin Marks',
                'option_second_status' => 0

            ],
            [
                'job_id' => $id,
                'title' => 'Physical Barrier',
                'option_first_name' => 'Yes',
                'option_first_status' => 0,
                'option_second_name' => 'No',
                'option_second_status' => 0

            ],
            [
                'job_id' => $id,
                'title' => 'Property Status',
                'option_first_name' => 'Owned',
                'option_first_status' => 0,
                'option_second_name' => 'Rented',
                'option_second_status' => 0

            ]
        ];

        $remarks = DB::table('inspection_livestock_remarks')->insert($data1);
    }
    public static function getJobById($id)
    {
        $job = DB::table('inspection_jobs')
            ->where('inspection_jobs.id', $id)
            ->leftJoin('c_company', 'inspection_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'inspection_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_muccaduum', 'inspection_jobs.muccaduum_id', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'inspection_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'inspection_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'inspection_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'inspection_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'inspection_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'inspection_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_employees', 'inspection_jobs.conducted_by', '=', 'c_employees.id')

            ->select(
                'inspection_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'inspection_jobs.operational_branch',
                'c_muccaduum.muc_name',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'c_employees.name AS employee_name',

                'tax_regions.name AS tax_region'

            )
            ->get();


        $data = [
            'job' => $job,
        ];

        return $data;
    }

    public static function getLivestockMISDetails(){

        $jobs = DB::table('inspection_livestock_animals_breed')
        ->rightJoin('inspection_jobs', 'inspection_jobs.id', '=', 'inspection_livestock_animals_breed.job_id')
        ->rightJoin('inspection_livestock_details_of_animals', 'inspection_jobs.id', '=', 'inspection_livestock_details_of_animals.job_id')
        ->leftJoin('c_bank', 'c_bank.bank_id', '=', 'inspection_jobs.bank_id')
        ->leftJoin('c_customer', 'c_customer.cust_id', '=', 'inspection_jobs.customer_id')
        ->leftJoin('bill', 'bill.bill_number', '=', 'inspection_jobs.job_id')
        ->groupBy('job_id')
        ->orderBy('job_id', 'DESC')
        ->select(
            'inspection_livestock_animals_breed.job_id as jid',
            'inspection_jobs.job_id',
            'bill.bill_date',
            'c_bank.bank_code',
            'inspection_jobs.bank_address',
            'c_customer.cust_name',
            'inspection_jobs.customer_cnic',
            DB::raw('bill.total_amount as total_bill')
        )
        ->get();

        return $jobs;

        }
    public static function getAnimalsDetails($id)
    {

        

        $jobs = DB::table('inspection_livestock_details_of_animals')
        ->where('inspection_livestock_details_of_animals.job_id',$id)
        ->whereIn('inspection_livestock_details_of_animals.description_of_stocks',["Cow Milking"])
        ->select(
            'inspection_livestock_details_of_animals.description_of_stocks',
            'inspection_livestock_details_of_animals.breed'
        )
        ->get();
        
        $cowmilklocal=0;
        $cowmilkimported=0;
        

        foreach($jobs as $job)
        {
          $breeds=json_decode($job->breed);

          foreach($breeds as $breed)
          {
              if($breed->mainType=="Local")
              {
                  $cowmilklocal+=$breed->quantity;
              }
              else if($breed->mainType=="Imported")
              {
                  $cowmilkimported+=$breed->quantity;
                  
              }
          }

        }


        $jobs = DB::table('inspection_livestock_details_of_animals')
        ->where('inspection_livestock_details_of_animals.job_id',$id)
        ->whereIn('inspection_livestock_details_of_animals.description_of_stocks',["Buffalo Milking"])
        ->select(
            'inspection_livestock_details_of_animals.description_of_stocks',
            'inspection_livestock_details_of_animals.breed'
        )
        ->get();
        
        $buffalolocal=0;
        $buffaloimported=0;
        

        foreach($jobs as $job)
        {
          $breeds=json_decode($job->breed);

          foreach($breeds as $breed)
          {
              if($breed->mainType=="Local")
              {
                 
                  $buffalolocal+=$breed->quantity;
              }
              else if($breed->mainType=="Imported")
              {
                  
                  $buffaloimported+=$breed->quantity;
                  
              }
          }

        }

      

        $jobs = DB::table('inspection_livestock_details_of_animals')
        ->where('inspection_livestock_details_of_animals.job_id',$id)
        ->whereIn('inspection_livestock_details_of_animals.description_of_stocks',["Cow Dry","Calves Cow"])
        ->select(
            'inspection_livestock_details_of_animals.description_of_stocks',
            'inspection_livestock_details_of_animals.breed'
        )
        ->get();
        
        $cownonmilklocal=0;
        $cownonmilkimported=0;
        

        foreach($jobs as $job)
        {
          $breeds=json_decode($job->breed);

          foreach($breeds as $breed)
          {
              if($breed->mainType=="Local")
              {
                $cownonmilklocal+=$breed->quantity;
              }
              else if($breed->mainType=="Imported")
              {
                $cownonmilkimported+=$breed->quantity;
                  
              }
          }

        }

        $jobs = DB::table('inspection_livestock_details_of_animals')
        ->where('inspection_livestock_details_of_animals.job_id',$id)
        ->whereIn('inspection_livestock_details_of_animals.description_of_stocks',["Buffalo Dry","Calves Buffalow"])
        ->select(
            'inspection_livestock_details_of_animals.description_of_stocks',
            'inspection_livestock_details_of_animals.breed'
        )
        ->get();
        
        $buffalononmilklocal=0;
        $buffalononmilkimported=0;
        

        foreach($jobs as $job)
        {
          $breeds=json_decode($job->breed);

          foreach($breeds as $breed)
          {
              if($breed->mainType=="Local")
              {
                $buffalononmilklocal+=$breed->quantity;
              }
              else if($breed->mainType=="Imported")
              {
                $buffalononmilkimported+=$breed->quantity;
                  
              }
          }

        }

       

        // echo "Cow Milking Local: ".$cowmilklocal;
        // echo "<br>";
        // echo "Buffalo Milking Local: ".$buffalolocal;
        // echo "<br>";
        // echo "Milking Imported: ".$cowmilkimported+$buffaloimported;
        // echo "<br>";

        // echo "Cow Non Milking Local: ".$cownonmilklocal;
        // echo "<br>";
        // echo "Buffalo Non Milking Local: ".$buffalononmilklocal;
        // echo "<br>";
        // echo "Non Milking Imported " . $buffalononmilkimported+$cownonmilkimported;
        // echo "<br><br>";

        

        $jobs = DB::table('inspection_livestock_details_of_animals')
        ->where('inspection_livestock_details_of_animals.job_id',$id)
        ->select(
            DB::raw('sum(inspection_livestock_details_of_animals.quantity) as total'),

        )
        ->groupBy('job_id')
        ->get();

        return [
            "cow_milking_local" => $cowmilklocal,
            "buffalow_milking_local" => $buffalolocal,
            "milking_imported" => $cowmilkimported+$buffaloimported,
            "cow_non_milking_local" => $cownonmilklocal,
            "buffalow_non_milking_local" => $buffalononmilklocal,
            "non_milking_imported" => $buffalononmilkimported+$cownonmilkimported,
        ];

    }

    public static function getJobByIdForBill($id, $jobnumber)
    {
        $job = DB::table('inspection_jobs')
            ->where('inspection_jobs.id', $id)
            ->leftJoin('c_company', 'inspection_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'inspection_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_muccaduum', 'inspection_jobs.muccaduum_id', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'inspection_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'inspection_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'inspection_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'inspection_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'inspection_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'inspection_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_employees', 'inspection_jobs.conducted_by', '=', 'c_employees.id')

            ->select(
                'inspection_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'inspection_jobs.operational_branch',
                'c_muccaduum.muc_name',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'c_employees.name AS employee_name',

                'tax_regions.name AS tax_region'

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

    public static function getCustomerAddress($id)
    {
        $job = DB::table('inspection_jobs')
            ->where('inspection_jobs.id', $id)
            ->select(
                'inspection_jobs.customer_address'
            )
            ->get();


        return $job;
    }

    public static function updateJobID($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "LS";

        $val1 = Inspection::findOrFail($cid);

        if ($givenBy == "Bank") {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
        } else {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
        }
        $val1->save();
    }

    public static function addBranchCodeToRefId($str, $substr, $n, $stri = false)
    {
        if ($stri) {
            $str = strtolower($str);
            $substr = strtolower($substr);
        }
        $ct = 0;
        $pos = 0;
        while (($pos = strpos($str, $substr, $pos)) !== false) {
            if (++$ct == $n) {
                return $pos;
            }
            $pos++;
        }
        return false;
    }





    public static function storeLivestockDetails($request, $id)
    {
        $record = DB::table('inspection_livestock_details')->where('job_id', $id)->first();
        if ($record === null) {
            $job = DB::table('inspection_livestock_details')->insert([
                'job_id' => $id,
                'caretakers_no' => $request->care_takers,
                'doctors' => $request->doctor_status,
                'site_address' => $request->site_address,
                'report_date' => $request->report_date,
                'stock_inspector' => $request->stock_inspector,
                'inspection_date' => $request->inspection_date,
                'image_header' => $request->image_header,
                'bill_date' => $request->bill_date,
                'food' => $request->food,
                'is_print_sign' => $request->is_print_sign == true ? '1' : '0',
                'is_branch_code' => $request->is_branch_code == true ? '1' : '0',
                'branch_code' => $request->branch_code,
                'is_note' => $request->is_note == true ? '1' : '0',
                'note' => $request->note,
                'is_site_address_second' => $request->is_site_address_second == true ? '1' : '0',
                'site_address_second' => $request->site_address_second,
                'is_afo' => $request->is_afo == true ? '1' : '0',
                'afo_name' => $request->afo_name,
                'afo_contact' => $request->afo_contact,
                'afo_branch_code' => $request->afo_branch_code


            ]);
        } else {
            $job = DB::table('inspection_livestock_details')->where('job_id', $id)->update([
                'caretakers_no' => $request->care_takers,
                'doctors' => $request->doctor_status,
                'site_address' => $request->site_address,
                'report_date' => $request->report_date,
                'stock_inspector' => $request->stock_inspector,
                'inspection_date' => $request->inspection_date,
                'image_header' => $request->image_header,
                'bill_date' => $request->bill_date,
                'food' => $request->food,
                'is_print_sign' => $request->is_print_sign == true ? '1' : '0',
                'is_branch_code' => $request->is_branch_code == true ? '1' : '0',
                'branch_code' => $request->branch_code,
                'is_note' => $request->is_note == true ? '1' : '0',
                'note' => $request->note,
                'is_site_address_second' => $request->is_site_address_second == true ? '1' : '0',
                'site_address_second' => $request->site_address_second,
                'is_afo' => $request->is_afo == true ? '1' : '0',
                'afo_name' => $request->afo_name,
                'afo_contact' => $request->afo_contact,
                'afo_branch_code' => $request->afo_branch_code
            ]);
        }
    }
    public static function addLivestockJob($id)
    {

        $job = DB::table('inspection_livestock_details')->insert([
            'job_id' => $id
        ]);
    }
    public static function updateOrder($request, $id)
    {
        $rowId = $request->rowId;
        $orderId = $request->orderID;
        if ($orderId == null) {
            $orderId = 0;
        }
        $job = DB::table('inspection_livestock_report_images')->where('id', $rowId)->update([
            'print_order' => $orderId
        ]);
    }
    public static function addDetailsofanimalsRow($request, $id)
    {

        $record = new Livestock_Animals_Detail;
        $record->job_id = $id;
        $record->save();

        echo $record->id;
    }
    public static function addDetailsofanimalsRemark($request, $id)
    {

        $record = new Livestock_Animals_Remark;
        $record->job_id = $id;
        $record->save();

        echo $record->id;
    }

    public static function cancelInspection($request, $id)
    {

        $ibr = Inspection::where('id', $id)->first();
        $ibr->cancalled = 1;
        $ibr->completed = 3;
        $ibr->customer_delay = 0;
        $ibr->cancallation_remarks = $request->remarks;
        $ibr->cancalled_date = date('y-m-d');
        $ibr->save();

        $com_id = $request->commonId;
        $comJob = Job::where('id', $com_id)->first();


        $comJob->status = '3';

        $comJob->save();

        $myid = $request->jobid;
        $bill = Bill_Ibr::where('job_number', '=', $myid)->first();
        if ($bill !== null) {

            $bill->status = 'Cancelled';
            $bill->save();
        }



        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $myid . " was cancelled";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'IBR';
        $log->save();
    }
    public static function holdInspection($request, $id)
    {
        $ishold = $request->is_hold;


        if ($ishold == true) {
            $ibr = Inspection::where('id', $id)->first();
            $ibr->cancalled = 0;
            $ibr->completed = 0;
            $ibr->customer_delay = $request->is_hold == true ? '1' : '0';
            $ibr->delayed_remarks = $request->remarks;
            $ibr->delayed_date = date('y-m-d');
            $ibr->save();

            $com_id = $request->commonId;
            $comJob = Job::where('id', $com_id)->first();


            $comJob->status = '2';

            $comJob->save();

            $myid = $request->jobid;
            $bill = Bill_Ibr::where('job_number', '=', $myid)
                ->first();



            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $myid . " was holded";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Livestock';
            $log->save();
        } else {
            $ibr = Inspection::where('id', $id)->first();
            $ibr->cancalled = 0;
            $ibr->completed = 0;
            $ibr->customer_delay = $request->is_hold == true ? '1' : '0';
            $ibr->delayed_remarks = '';
            $ibr->delayed_date = date('y-m-d');
            $ibr->save();

            $com_id = $request->commonId;
            $comJob = Job::where('id', $com_id)->first();


            $comJob->status = '0';

            $comJob->save();

            $myid = $request->jobid;
            $bill = Bill_Ibr::where('job_number', '=', $myid)
                ->first();



            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $myid . " was resumed";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Livestock';
            $log->save();
        }
    }

    public static function getDetailsofanimals($id)
    {
        $job = DB::table('inspection_livestock_details_of_animals')
            ->where('inspection_livestock_details_of_animals.job_id', $id)
            ->select('*')
            ->get();

        return $job;
    }
    public static function getRemarksDetails($id)
    {
        $job = DB::table('inspection_livestock_remarks')
            ->where('inspection_livestock_remarks.job_id', $id)
            ->select('*')
            ->get();

        return $job;
    }

    public static function getLiveStockDetails($id)
    {
        $job = DB::table('inspection_livestock_details')
            ->where('inspection_livestock_details.job_id', $id)
            ->select('*')
            ->get();

        return $job;
    }
    public static function deleteInspectionDetailsItem($request, $id)
    {
        DB::table('inspection_livestock_details_of_animals')->where('id', $request->rowId)->delete();
    }
    public static function deleteInspectionDetailsRemarks($request, $id)
    {
        DB::table('inspection_livestock_remarks')->where('id', $request->rowId)->delete();
    }
    public static function saveDetailsofanimals($request, $id)
    {
        $record = DB::table('inspection_livestock_details_of_animals')->where('job_id', $id)->first();
        $breed = DB::table('inspection_livestock_animals_breed')->where('job_id', $id)->first();


        if ($record === null) {
            $records = $request->data;
            foreach ($records as $record => $row) {
                $job = DB::table('inspection_livestock_details_of_animals')->insert([
                    'job_id' => $id,
                    'description_of_stocks' => $row['description'],
                    'breed' => $row['type_products'],
                    'quantity' => $row['totalCount'],

                ]);
            }
        } else {
            $records = $request->data;
            foreach ($records as $record => $row) {
                $job = DB::table('inspection_livestock_details_of_animals')->where('job_id', $id)->where('id', $row['id'])->update([
                    'description_of_stocks' => $row['description'],
                    'breed' => $row['type_products'],
                    'quantity' => $row['totalCount'],


                ]);
            }
        }

        DB::table('inspection_livestock_animals_breed')->where('job_id', $id)->delete();

        $records = $request->data;
        foreach ($records as $record => $row) {
            // var_dump($row['type_products']);

            foreach ($row['type_products'] as $item => $key) {
                $breed = DB::table('inspection_livestock_animals_breed')->insert([
                    'job_id' => $id,
                    'main_type' => $key['mainType'],
                    'second_type' => $key['secondType'],
                    'quantity' => $key['quantity'],
                    'age' => $key['age'],
                    'time' => $key['time'],
                    'remarks' => $key['remarks'],


                ]);
            }
        }
    }
    public static function saveDetailsofRemarks($request, $id)
    {
        $record = DB::table('inspection_livestock_remarks')->where('job_id', $id)->first();


        if ($record === null) {
            $records = $request->data;
            foreach ($records as $row) {
                $job = DB::table('inspection_livestock_remarks')->insert([
                    'job_id' => $id,
                    'title' => $row['title'],
                    'option_first_name' => $row['firstItemName'],
                    'option_first_status' => $row['firstItemCheck'] == true ? '1' : '0',
                    'option_second_name' => $row['secondItemName'],
                    'option_second_status' => $row['secondItemCheck'] == true ? '1' : '0',
                ]);
                // var_dump($row['description']);

            }
        } else {
            $records = $request->data;
            foreach ($records as $record => $row) {
                $job = DB::table('inspection_livestock_remarks')->where('job_id', $id)->where('id', $row['id'])->update([
                    'title' => $row['title'],
                    'option_first_name' => $row['firstItemName'],
                    'option_first_status' => $row['firstItemCheck'] == true ? '1' : '0',
                    'option_second_name' => $row['secondItemName'],
                    'option_second_status' => $row['secondItemCheck'] == true ? '1' : '0',

                ]);
            }
        }
    }
}
