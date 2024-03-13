<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Bill_Ibr;
use App\Job;


class Muccaduum extends Model
{
    protected $table = 'muccaduum_jobs';

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

    public static function makeLog($request, $cid)
    {

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No:" . $cid . " Was Added";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Muccaduum';
        $log->save();
    }

    public static function storeMuccaduum($request)
    {

        $val = new Muccaduum;

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
        $val->customer_email = $request->customer_email;
        $val->operational_branch = $request->operational_branch;
        $val->service_charges = $request->service_charges;
        $val->total_amount = $request->total_amount;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();
    }

    public static function getLatestJob()
    {
        $cjob = DB::table('muccaduum_jobs')->latest('created_at', 'desc')->first();
        Storage::disk('dir')->makeDirectory('Reports/Muccaduum/' . $cjob->id . '/Report');
        // Storage::disk('dir')->makeDirectory('Reports/Valuation/' . $cjob->id.'/Images');
        return $cjob;
    }

    public static function updateJobID($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "MUC";

        $val1 = Muccaduum::findOrFail($cid);

        if ($givenBy == "Bank") {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
        } else {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
        }
        $val1->save();
    }

    public static function getJobById($id)
    {
        $job = DB::table('muccaduum_jobs')
            ->where('muccaduum_jobs.id', $id)
            ->leftJoin('c_company', 'muccaduum_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'muccaduum_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_muccaduum', 'muccaduum_jobs.muccaduum_id', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'muccaduum_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'muccaduum_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'muccaduum_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'muccaduum_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'muccaduum_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'muccaduum_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_employees', 'muccaduum_jobs.conducted_by', '=', 'c_employees.id')

            ->select(
                'muccaduum_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'muccaduum_jobs.operational_branch',
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

    public static function addCommonJob($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "MUC";

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
            $bill->service = 'Muccadam';
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
            $bill->service = 'Muccadam';
            $bill->save();
        }
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);
        $job->region_id = $request->regional_id;
        $job->service = "Muccadam";
        $job->bank_id = $request->bank_id;
        $job->byvendor_id = $request->val_vendor_id;
        $job->branch_id = $request->branch_id;
        $job->customer_id = $request->customer_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();
    }

    public static function updateMuccaddum($request, $id)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = Muccaduum::where('id', $id)->first();

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
        // $ibr->show_values = $request->show_values == true ? '1' : '0';
        // $ibr->letter_head = $request->letter_head == true ? '1' : '0';
        $ibr->completed = $request->completed == true ? '1' : '0';
        $ibr->delivered_on = $request->delivered_on;
        // $ibr->prepared_by_cpu = $request->prepared_by_cpu == true ? '1' : '0';
        // $ibr->is_stock_joint = $request->is_joint == true ? '1' : '0';
        // $ibr->stock_is = $request->stock_selected;
        // $ibr->request_date = $request->requested_on;
        // $ibr->site_start = $request->site_start;
        // $ibr->facility_id = $request->facility_id;
        // $ibr->is_facility_print = $request->is_facility_print == true ? '1' : '0';
        // $ibr->sactioned_limit = $request->sactioned_limit;
        // $ibr->scope = $request->scope;
        // $ibr->collateral = $request->collateral;
        // $ibr->quantity = $request->quantity;
        // $ibr->ownership_evidance = $request->ownership_evidance;
        $ibr->service_charges = $request->service_charges;
        // $ibr->is_service_charges_corporate = $request->is_service_charges_corporate == true ? '1' : '0';
        // $ibr->is_sales_tax = $request->is_sales_tax == true ? '1' : '0';
        // $ibr->sale_reg = $request->sale_reg;
        // $ibr->muccaduum_id = $request->muccaduum_id;
        // $ibr->is_print_muccaduum = $request->is_print_muccaduum == true ? '1' : '0';
        // $ibr->is_print_representative = $request->is_print_representative == true ? '1' : '0';
        // $ibr->muccaduum_representative = $request->muccaduum_representative;
        // $ibr->muccaduum_representative_nic = $request->muccaduum_representative_nic;
        // $ibr->muccaduum_representative_fax = $request->muccaduum_representative_fax;
        // $ibr->muccaduum_representative_desig = $request->muccaduum_representative_desig;
        // $ibr->muccaduum_representative_phone = $request->muccaduum_representative_phone;
        // $ibr->muccaduum_representative_email = $request->muccaduum_representative_email;
        $ibr->updated_by = $request->user()->id;
        // $ibr->declared_currency = $request->declared_currency;
        // $ibr->declared_amount = $request->declared_amount;
        // $ibr->declared_currency_print = $request->declared_currency_print == true ? '1' : '0';
        // $ibr->declared_currency_attachments = $request->declared_currency_print_attachments == true ? '1' : '0';
        // $ibr->declared_as_per = $request->declared_as_per;
        // $ibr->declared_no_label_input = $request->declared_no_label_input;
        // $ibr->declared_no_label_attachments = $request->declared_no_label_attachments == true ? '1' : '0';
        // $ibr->declared_remarks_print = $request->declared_remarks_print == true ? '1' : '0';
        // $ibr->declared_remarks = $request->declared_remarks;
        // $ibr->insurance_insured_by = $request->insurance_insured_by;
        // $ibr->insurance_insurance_for = $request->insurance_insurance_for;
        // $ibr->insurance_expiry = $request->insurance_expiry;
        // $ibr->is_insurance_with_bank = $request->is_insurance_with_bank == true ? '1' : '0';
        // $ibr->insurance_status = $request->insurance_status;
        // $ibr->insurance_remarks = $request->insurance_remarks;
        // $ibr->insurance_no_label_input = $request->insurance_no_label_input;
        // $ibr->insurance_next_line = $request->insurance_next_line == true ? '1' : '0';
        // $ibr->inspection_stock_inspector = $request->inspection_stock_inspector;
        // $ibr->inspection_next_line = $request->inspection_next_line == true ? '1' : '0';
        // $ibr->is_travel_charges = $request->is_travel_charges == true ? '1' : '0';
        // $ibr->travel_charges = $request->travel_charges;
        // $ibr->inspection_date = $request->inspection_date;
        // $ibr->inspection_report_date = $request->inspection_report_date;
        // $ibr->inspection_stock_report_date = $request->inspection_stock_report_date;
        // $ibr->conducted_by = $request->conducted_by;
        // $ibr->signed_by = $request->signed_by;



        $ibr->save();


        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No: " . $jid . " Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Muccadam';
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
        $job = DB::table('muccaduum_jobs')
            ->where('muccaduum_jobs.id', $id)
            ->leftJoin('c_company', 'muccaduum_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'muccaduum_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_muccaduum', 'muccaduum_jobs.muccaduum_id', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'muccaduum_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'muccaduum_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'muccaduum_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'muccaduum_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'muccaduum_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'muccaduum_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_employees', 'muccaduum_jobs.conducted_by', '=', 'c_employees.id')

            ->select(
                'muccaduum_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'muccaduum_jobs.operational_branch',
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
}
