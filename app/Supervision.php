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

class supervision extends Model
{
    protected $table = 'supervision_jobs';


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
    public static function makeLog($request, $cid)
    {

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No:" . $cid . " Was Added";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Supervision';
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
    // public static function  deleteLivestockImage($id, $image)
    // {
    //     $file = DB::table('inspection_livestock_report_images')->where('id', $id)->delete();

    //     Storage::disk('dir')->delete($image);
    // }

    public static function storeSupervision($request)
    {

        $val = new Supervision;

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
        $val->operational_branch = $request->operationalBranch;
        $val->from_is = $request->from_is;
        $val->fpt_terminal = $request->fpt_terminal;
        $val->fbw_warehouse = $request->fbw_warehouse;
        $val->fbw_address = $request->fbw_address;
        $val->fpp_location = $request->fpp_location;
        $val->fpp_godown_no = $request->fpp_godown_no;
        $val->fpp_address = $request->fpp_address;
        $val->fpp_bond = $request->fpp_bond == true ? 1 : 0;
        $val->to_is = $request->to_is;
        $val->tbw_warehouse = $request->tbw_warehouse;
        $val->tbw_address = $request->tbw_address;
        $val->tpp_location = $request->tpp_location;
        $val->tpp_godwill = $request->tpp_godwill;
        $val->tpp_addresss = $request->tpp_addresss;
        $val->tpp_bond = $request->tpp_bond  == true ? 1 : 0;

        $val->th_godown_location     = $request->th_godown_location;
        $val->th_godown_no = $request->th_godown_no;
        $val->th_godown_address = $request->th_godown_address;
        $val->is_th_godown_bond = $request->is_th_godown_bond  == true ? 1 : 0;


        $val->is_another_destination = $request->is_another_destination == true ? 1 : 0;
        $val->another_is = $request->another_is;
        $val->dbw_warehouse = $request->dbw_warehouse;
        $val->dbw_address = $request->dbw_address;
        $val->dpp_location = $request->dpp_location;
        $val->dpp_godown_no = $request->dpp_godown_no;
        $val->dpp_bond = $request->dpp_bond  == true ? 1 : 0;
        $val->dpp_address = $request->dpp_address;
        $val->dpg_location = $request->dpg_location;
        $val->dpg_godown_no = $request->dpg_godown_no;
        $val->dpg_bond = $request->dpg_bond  == true ? 1 : 0;
        $val->dpg_address = $request->dpg_address;
        $val->clearing_agent = $request->clearing_agent;
        $val->consignment = $request->consignment;
        $val->package_unit = $request->package_unit;
        $val->package_is = $request->package_is;
        $val->weight = $request->weight;
        $val->container_number = $request->container_number;
        $val->container_unit = $request->container_unit;
        $val->invoice_value = $request->invoice_value;
        $val->invoice_value_code = $request->invoice_value_code;
        $val->import_value_unit = $request->import_value_unit;
        $val->import_value_unit = $request->import_value_unit;
        $val->lc_no = $request->lc_no;
        $val->lc_date = $request->lc_date;
        $val->vessel_no = $request->vessel_no;
        $val->vessel_arrived = $request->vessel_arrived;
        $val->bl_no = $request->bl_no;
        $val->bl_date = $request->bl_date;
        $val->transportation_is = $request->transportation_is;
        $val->rr_receipt_no = $request->rr_receipt_no;
        $val->rr_date = $request->rr_date;
        $val->rt_transporter = $request->rt_transporter;
        $val->delivered_to = $request->delivered_to;
        $val->dtm_muccadum = $request->dtm_muccadum;
        $val->serv_chrg_is = $request->serv_chrg_is;
        $val->service_rate = $request->service_rate;
        $val->service_charges = $request->service_charges;
        $val->is_sales_tax = $request->is_sales_tax == true ? 1 : 0;
        $val->is_received = $request->is_received;
        $val->rec_from = $request->rec_from;
        $val->rec_via = $request->rec_via;
        $val->rec_via_date = $request->rec_via_date;
        $val->rec_via_no = $request->rec_via_no;
        $val->remarks = $request->remarks;
        $val->cancalled = 0;
        $val->customer_delay = 0;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();
    }

    public static function getLatestJob()
    {
        $cjob = DB::table('supervision_jobs')->latest('created_at', 'desc')->first();
        Storage::disk('dir')->makeDirectory('Reports/Supervision/' . $cjob->id . '/Report');
        // Storage::disk('dir')->makeDirectory('Reports/Valuation/' . $cjob->id.'/Images');
        return $cjob;
    }


    public static function addCommonJob($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "SUP";

        $job = new Job;
        if ($givenBy == "Bank") {

            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');


            $bill = new Bill_Ibr;
            $bill->bill_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->job_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->total_amount = $request->service_charges;
            $bill->service_charges = $request->service_charges;
            $bill->tax = '0';
            // $bill->bill_date = date("Y/m/d");
            $bill->discount = '0';
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Supervision';
            $bill->save();
        } else {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');

            $bill = new Bill_Ibr;
            $bill->bill_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->job_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->total_amount = $request->service_charges;
            $bill->service_charges = $request->service_charges;
            $bill->tax = '0';
            $bill->discount = '0';
            // $bill->bill_date = date("Y/m/d");
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->company_id;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Supervision';
            $bill->save();
        }
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);
        $job->region_id = $request->regional_id;
        $job->service = "Supervision";
        $job->bank_id = $request->bank_id;
        $job->byvendor_id = $request->val_vendor_id;
        $job->branch_id = $request->branch_id;
        $job->customer_id = $request->customer_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();
    }
    public static function updateSupervision($request, $id)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = Supervision::where('id', $id)->first();

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
        $ibr->from_is = $request->from_is;
        $ibr->fpt_terminal = $request->fpt_terminal;
        $ibr->fbw_warehouse = $request->fbw_warehouse;
        $ibr->fbw_address = $request->fbw_address;
        $ibr->fpp_location = $request->fpp_location;
        $ibr->fpp_godown_no = $request->fpp_godown_no;
        $ibr->fpp_address = $request->fpp_address;
        $ibr->fpp_bond = $request->fpp_bond == true ? 1 : 0;
        $ibr->to_is = $request->to_is;
        $ibr->tbw_warehouse = $request->tbw_warehouse;
        $ibr->tbw_address = $request->tbw_address;
        $ibr->tpp_location = $request->tpp_location;
        $ibr->tpp_godwill = $request->tpp_godwill;
        $ibr->tpp_addresss = $request->tpp_addresss;
        $ibr->tpp_bond = $request->tpp_bond  == true ? 1 : 0;

        $ibr->th_godown_location     = $request->th_godown_location;
        $ibr->th_godown_no = $request->th_godown_no;
        $ibr->th_godown_address = $request->th_godown_address;
        $ibr->is_th_godown_bond = $request->is_th_godown_bond  == true ? 1 : 0;


        $ibr->is_another_destination = $request->is_another_destination == true ? 1 : 0;
        $ibr->another_is = $request->another_is;
        $ibr->dbw_warehouse = $request->dbw_warehouse;
        $ibr->dbw_address = $request->dbw_address;
        $ibr->dpp_location = $request->dpp_location;
        $ibr->dpp_godown_no = $request->dpp_godown_no;
        $ibr->dpp_bond = $request->dpp_bond  == true ? 1 : 0;
        $ibr->dpp_address = $request->dpp_address;
        $ibr->dpg_location = $request->dpg_location;
        $ibr->dpg_godown_no = $request->dpg_godown_no;
        $ibr->dpg_bond = $request->dpg_bond  == true ? 1 : 0;
        $ibr->dpg_address = $request->dpg_address;
        $ibr->clearing_agent = $request->clearing_agent;
        $ibr->consignment = $request->consignment;
        $ibr->package_unit = $request->package_unit;
        $ibr->package_is = $request->package_is;
        $ibr->weight = $request->weight;
        $ibr->container_number = $request->container_number;
        $ibr->container_unit = $request->container_unit;
        $ibr->invoice_value = $request->invoice_value;
        $ibr->invoice_value_code = $request->invoice_value_code;
        $ibr->import_value_unit = $request->import_value_unit;
        $ibr->lc_no = $request->lc_no;
        $ibr->lc_date = $request->lc_date;
        $ibr->vessel_no = $request->vessel_no;
        $ibr->vessel_arrived = $request->vessel_arrived;
        $ibr->bl_no = $request->bl_no;
        $ibr->bl_date = $request->bl_date;
        $ibr->transportation_is = $request->transportation_is;
        $ibr->rr_receipt_no = $request->rr_receipt_no;
        $ibr->rr_date = $request->rr_date;
        $ibr->rt_transporter = $request->rt_transporter;
        $ibr->delivered_to = $request->delivered_to;
        $ibr->dtm_muccadum = $request->dtm_muccadum;
        $ibr->serv_chrg_is = $request->serv_chrg_is;
        $ibr->service_rate = $request->service_rate;
        $ibr->service_charges = $request->service_charges;
        $ibr->is_sales_tax = $request->is_sales_tax == true ? 1 : 0;
        $ibr->is_received = $request->is_received;
        $ibr->rec_from = $request->rec_from;
        $ibr->rec_via = $request->rec_via;
        $ibr->rec_via_date = $request->rec_via_date;
        $ibr->rec_via_no = $request->rec_via_no;
        $ibr->remarks = $request->remarks;
        $ibr->created_by = $request->user()->id;
        $ibr->updated_by = $request->user()->id;
        $ibr->bill_date = $request->bill_date;
        $ibr->bank_ntn = $request->bank_ntn;

        if ($request->completed == true) {

            $job = DB::table('bill')->where('job_number', $request->job_id)->update([
                'bill_date' => date('Y-m-d'),
                'service_charges' => $request->service_charges
            ]);
            $job1 = DB::table('bill')
                ->where('job_number', $request->job_id)
                ->where('status', "In Progress")
                ->update([
                    'status' => "Receivable"

                ]);


            $ibr->completed = '1';
        } else {
            $job = DB::table('bill')->where('job_number', $request->job_id)->update([
                'service_charges' => $request->service_charges
            ]);
            $ibr->completed = $request->completed == true ? '1' : '0';
        }



        $ibr->save();




        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No: " . $jid . " Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Supervision';
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
    
    public static function updateSupervisionLetterData($request, $id)
    {
        $record = DB::table('supervision_letters')->where('job_id', $id)->first();
        if ($record === null) {
            $job = DB::table('supervision_letters')->insert([
                'job_id' => $id,
                'letter_type' => $request->letter_type,
                'for_purpose' => $request->for_purpose,
                'to_is' => $request->to_is,
                'date' => $request->date,
                'address' => $request->address,
                'subject' => $request->subject,
                'ref' => $request->ref,
                'text_of_letter' => $request->text_of_letter,
                'cc_one' => $request->cc_one,
                'cc_two' => $request->cc_two,
                'cc_three' => $request->cc_three,
                'cc_four' => $request->cc_four,
                'cc_five' => $request->cc_five,
                'signed_by' => $request->signed_by,
                'created_by' => $request->signed_by,
                'updated_by' => $request->signed_by


            ]);

            $log = DB::table('supervision_letters_log')->insert([
                'job_id' => $id,
                'type_of_letter' => $request->letter_type,
                'signed_by' => $request->signed_by
            ]);
        } else {
            $job = DB::table('supervision_letters')->where('job_id', $id)->update([
                'letter_type' => $request->letter_type,
                'for_purpose' => $request->for_purpose,
                'to_is' => $request->to_is,
                'date' => $request->date,
                'address' => $request->address,
                'subject' => $request->subject,
                'ref' => $request->ref,
                'text_of_letter' => $request->text_of_letter,
                'cc_one' => $request->cc_one,
                'cc_two' => $request->cc_two,
                'cc_three' => $request->cc_three,
                'cc_four' => $request->cc_four,
                'cc_five' => $request->cc_five,
                'signed_by' => $request->signed_by,
                'updated_by' => $request->signed_by
            ]);

            $log = DB::table('supervision_letters_log')->insert([
                'job_id' => $id,
                'type_of_letter' => $request->letter_type,
                'signed_by' => $request->signed_by
            ]);
        }
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
        $job = DB::table('supervision_jobs')
            ->where('supervision_jobs.id', $id)
            ->leftJoin('c_company', 'supervision_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'supervision_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_muccaduum', 'supervision_jobs.dtm_muccadum', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'supervision_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'supervision_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'supervision_jobs.byvendor_id', '=', 'ibr_vendors.id')
            ->leftJoin('c_customer', 'supervision_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('supervision_terminals', 'supervision_jobs.fpt_terminal', '=', 'supervision_terminals.id')
            ->leftJoin('supervision_warehouses', 'supervision_jobs.fbw_warehouse', '=', 'supervision_warehouses.id')
            ->leftJoin('supervision_godowns', 'supervision_jobs.fpp_location', '=', 'supervision_godowns.id')

            ->leftJoin('c_branch', 'supervision_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('supervision_warehouses as towar', 'supervision_jobs.tbw_warehouse', '=', 'towar.id')
            ->leftJoin('supervision_godowns as togo', 'supervision_jobs.tpp_location', '=', 'togo.id')
            ->leftJoin('supervision_godowns as togothree', 'supervision_jobs.th_godown_location', '=', 'togothree.id')
            ->leftJoin('supervision_warehouses as anwarehouse', 'supervision_jobs.dbw_warehouse', '=', 'anwarehouse.id')
            ->leftJoin('supervision_godowns as ango', 'supervision_jobs.dpp_location', '=', 'ango.id')
            ->leftJoin('supervision_godowns as angothree', 'supervision_jobs.dpg_location', '=', 'angothree.id')
            ->leftJoin('supervision_clearning_agent', 'supervision_jobs.clearing_agent', '=', 'supervision_clearning_agent.id')
            ->leftJoin('supervision_consignments', 'supervision_jobs.consignment', '=', 'supervision_consignments.id')
            ->leftJoin('supervision_packages', 'supervision_jobs.package_is', '=', 'supervision_packages.id')
            ->leftJoin('supervision_transporters', 'supervision_jobs.rt_transporter', '=', 'supervision_transporters.id')
            ->select(
                'supervision_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'supervision_jobs.operational_branch',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'supervision_terminals.terminal_name',
                'supervision_warehouses.warehouse_name',
                'supervision_godowns.name as godown_name',
                'towar.warehouse_name AS to_warehouse',
                'togo.name As to_godown',
                'togothree.name As three_godown',
                'anwarehouse.warehouse_name As anwarehouse_name',
                'ango.name As angodown_name',
                'angothree.name As angothree_name',
                'supervision_clearning_agent.name AS agent_name',
                'supervision_consignments.name AS consigment_name',
                'supervision_packages.name AS packages_name',
                'supervision_transporters.name AS transporter_name',
                'c_muccaduum.muc_name',
                DB::raw("DATE_FORMAT(supervision_jobs.created_at, '%Y-%m-%d') as created_date")



                // 'tax_regions.name AS tax_region'

            )
            ->get();


        $data = [
            'job' => $job,
        ];

        return $data;
    }
    public static function getLetterData($id)
    {
        $job = DB::table('supervision_letters')
            ->leftJoin('supervision_jobs', 'supervision_jobs.id', '=', 'supervision_letters.job_id')
            ->leftJoin('c_region', 'supervision_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_bank', 'supervision_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('c_branch', 'supervision_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_customer', 'supervision_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('supervision_clearning_agent', 'supervision_jobs.clearing_agent', '=', 'supervision_clearning_agent.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('supervision_packages', 'supervision_jobs.package_is', '=', 'supervision_packages.id')
            ->leftJoin('supervision_warehouses as towar', 'supervision_jobs.tbw_warehouse', '=', 'towar.id')
            ->leftJoin('supervision_godowns as togo', 'supervision_jobs.tpp_location', '=', 'togo.id')
            ->leftJoin('supervision_godowns as togothree', 'supervision_jobs.th_godown_location', '=', 'togothree.id')
            ->leftJoin('supervision_consignments', 'supervision_jobs.consignment', '=', 'supervision_consignments.id')
            ->where('supervision_letters.job_id', $id)
            ->select(
                'supervision_letters.*',
                'supervision_letters.to_is AS to_is_letter',
                'supervision_jobs.job_id AS jobid',
                'region.city_name AS region',
                'supervision_clearning_agent.name as agent_name',
                'supervision_clearning_agent.address as agent_address',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'c_customer.cust_name',
                'supervision_jobs.bank_address',
                'supervision_jobs.to_is',
                'supervision_jobs.tbw_address as to_bonded_address',
                'supervision_jobs.tpp_addresss as to_party_address',
                'supervision_jobs.th_godown_address as to_three_address',
                'towar.warehouse_name AS to_warehouse',
                'togo.name As to_godown',
                'togothree.name As three_godown',
                'supervision_packages.name as package_name',
                'supervision_jobs.package_unit',
                'supervision_jobs.container_unit',
                'supervision_jobs.container_number',
                'supervision_jobs.weight',
                'supervision_jobs.lc_no',
                DB::raw('DATE_FORMAT(supervision_jobs.bank_letter_date,"%d.%m.%Y") as bank_letter_date'),
                'supervision_jobs.bank_letter',
                'supervision_jobs.vessel_no',
                'supervision_jobs.bl_no',
                DB::raw('DATE_FORMAT(supervision_jobs.bl_date,"%d.%m.%Y") as bl_date'),
                'supervision_consignments.name as consigment_name',
                DB::Raw('CONCAT(supervision_jobs.container_unit ,"X",supervision_jobs.container_number) as Container'),




            )
            ->get();


        $data = [
            'job' => $job,
        ];

        return $data;
    }

    public static function getLivestockMis()
    {

        $jobs = DB::table('inspection_livestock_animals_breed')
            ->rightJoin('supervision_jobs', 'supervision_jobs.id', '=', 'inspection_livestock_animals_breed.job_id')
            ->leftJoin('c_bank', 'c_bank.bank_id', '=', 'supervision_jobs.bank_id')
            ->leftJoin('c_customer', 'c_customer.cust_id', '=', 'supervision_jobs.customer_id')
            ->leftJoin('bill', 'bill.bill_number', '=', 'supervision_jobs.job_id')
            ->groupBy('job_id')
            ->orderBy('job_id', 'DESC')
            ->select(
                'supervision_jobs.job_id',
                'bill.bill_date',
                'c_bank.bank_code',
                'supervision_jobs.bank_address',
                'c_customer.cust_name',
                'supervision_jobs.customer_cnic',
                DB::raw('sum(case when inspection_livestock_animals_breed.main_type = "Imported" then inspection_livestock_animals_breed.quantity else 0 end) Imported'),
                DB::raw('sum(case when inspection_livestock_animals_breed.main_type = "Local" then  inspection_livestock_animals_breed.quantity else 0 end) Local'),
                DB::raw('sum(inspection_livestock_animals_breed.quantity) as Total'),
                DB::raw('bill.total_amount + bill.tax as total_bill'),

            )

            ->get();

        return $jobs;
    }

    public static function getJobByIdForBill($id, $jobnumber)
    {
        $job = DB::table('supervision_jobs')
            ->where('supervision_jobs.id', $id)
            ->leftJoin('c_company', 'supervision_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'supervision_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_muccaduum', 'supervision_jobs.muccaduum_id', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'supervision_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'supervision_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'supervision_jobs.byvendor_id', '=', 'ibr_vendors.id')

            ->leftJoin('c_customer', 'supervision_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'supervision_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'supervision_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_employees', 'supervision_jobs.conducted_by', '=', 'c_employees.id')

            ->select(
                'supervision_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'supervision_jobs.operational_branch',
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
        $job = DB::table('supervision_jobs')
            ->where('supervision_jobs.id', $id)
            ->select(
                'supervision_jobs.customer_address'
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
        $ser = "SUP";

        $val1 = Supervision::findOrFail($cid);

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


    public static function holdSupervision($request, $id)
    {
        $ishold = $request->is_hold;


        if ($ishold == true) {
            $ibr = Supervision::where('id', $id)->first();
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
            $log->service = 'Supervision';
            $log->save();
        } else {
            $ibr = Supervision::where('id', $id)->first();
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
            $log->service = 'Inspection';
            $log->save();
        }
    }
    public static function cancelSupervision($request, $id)
    {

        $ibr = Supervision::where('id', $id)->first();
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
