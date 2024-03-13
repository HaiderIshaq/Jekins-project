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


class Legal_Service extends Model
{
    protected $table = 'legal_service_jobs';

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
        $log->service = 'Legal Service';
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



    public static function storeLegalService($request)
    {

        $val = new Legal_Service;

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
        $val->region = $request->region;
        $val->task = $request->task;
        $val->line_manager = $request->line_manager;
        $val->service_charges = $request->service_charges;
        $val->sales_tax = $request->sales_tax;
        $val->delivery_time = $request->delivery_time;
        $val->remarks = $request->remarks;
        $val->salesRegion = $request->salesRegion;
        $val->customer_delay = 0;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();
    }

    public static function getLatestJob()
    {
        $cjob = DB::table('legal_service_jobs')->latest('created_at', 'desc')->first();
        Storage::disk('dir')->makeDirectory('Reports/Legal/' . $cjob->id);
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
        $log->service = 'Legal Service';
        $log->save();
    }

    public static function addCommonJob($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "PLS";

        $job = new Job;
        if ($givenBy == "Bank") {

            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');


            $bill = new Bill_Ibr;
            $bill->bill_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->job_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->total_amount = $request->service_charges;
            $bill->tax = '0';
            $bill->bill_date = date("Y/m/d");
            $bill->discount = '0';
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Legal Service';
            $bill->save();
        } else {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');

            $bill = new Bill_Ibr;
            $bill->bill_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->job_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->total_amount = $request->service_charges;
            $bill->tax = '0';
            $bill->discount = '0';
            $bill->bill_date = date("Y/m/d");
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->company_id;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Legal Service';
            $bill->save();
        }
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);
        $job->region_id = $request->regional_id;
        $job->service = "Legal Service";
        $job->bank_id = $request->bank_id;
        $job->byvendor_id = $request->val_vendor_id;
        $job->branch_id = $request->branch_id;
        $job->customer_id = $request->customer_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();
    }
    public static function updateLegalService($request, $id)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = Legal_Service::where('id', $id)->first();

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

        $ibr->updated_by = $request->user()->id;

        $ibr->region = $request->region;
        $ibr->task = $request->task;
        $ibr->line_manager = $request->line_manager;
        $ibr->service_charges = $request->service_charges;
        $ibr->sales_tax = $request->salas_tax == true ? '1' : '0';
        $ibr->delivery_time = $request->delivery_time;
        $ibr->remarks = $request->remarks;
        $ibr->save();


        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No: " . $jid . " Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Inspection';
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

    public static function getJobById($id)
    {
        $job = DB::table('legal_service_jobs')
            ->where('legal_service_jobs.id', $id)
            ->leftJoin('c_company', 'legal_service_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'legal_service_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'legal_service_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'legal_service_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'legal_service_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'legal_service_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('c_branch', 'legal_service_jobs.branch_id', '=', 'c_branch.branch_id')

            ->select(
                'legal_service_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'legal_service_jobs.operational_branch',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'legal_service_jobs.region As region_is',

            )
            ->get();


        $data = [
            'job' => $job,
        ];

        return $data;
    }


    public static function getJobByIdForBill($id, $jobnumber)
    {
        $job = DB::table('legal_service_jobs')
            ->where('legal_service_jobs.id', $id)
            ->leftJoin('c_company', 'legal_service_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'legal_service_jobs.region_id', '=', 'c_region.reg_id')
            // ->leftJoin('c_muccaduum', 'legal_service_jobs.muccaduum_id', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'legal_service_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'legal_service_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'legal_service_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'legal_service_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'legal_service_jobs.sales_tax', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'legal_service_jobs.branch_id', '=', 'c_branch.branch_id')
            // ->leftJoin('c_employees', 'legal_service_jobs.conducted_by', '=', 'c_employees.id')

            ->select(
                'legal_service_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'legal_service_jobs.operational_branch',
                // 'c_muccaduum.muc_name',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                // 'c_employees.name AS employee_name',

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
        $job = DB::table('legal_service_jobs')
            ->where('legal_service_jobs.id', $id)
            ->select(
                'legal_service_jobs.customer_address'
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
        $ser = "PLS";

        $val1 = Legal_Service::findOrFail($cid);

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

    public static function cancelLegalService($request, $id)
    {

        $ibr = Legal_Service::where('id', $id)->first();
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
        $log->service = 'Legal Service';
        $log->save();
    }
    public static function holdLegalService($request, $id)
    {
        $ishold = $request->is_hold;


        if ($ishold == true) {
            $ibr = Legal_Service::where('id', $id)->first();
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
            $log->service = 'Legal Service';
            $log->save();
        } else {
            $ibr = Legal_Service::where('id', $id)->first();
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
            $log->service = 'Legal Service';
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
