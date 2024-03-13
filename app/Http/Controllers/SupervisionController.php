<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Supervision;
use App\Muccaduum;
use App\SaleTax;
use App\Bill_Ibr;
use App\Inspection;
use App\Log;
use DataTables;
use PDF;
use Illuminate\Support\Facades\Storage;

class SupervisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");
    }
    public function index(Request $request)
    {

        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Supervision::getUserCompany($uid, $token);
        return view('Supervision.create', compact('user'));
    }

    public function create(Request $request)
    {


        Supervision::storeSupervision($request);
        $cjob = Supervision::getLatestJob($request);
        $cid = $cjob->id;
        Supervision::addCommonJob($request, $cid);
        Supervision::updateJobID($request, $cid);
        Supervision::makeLog($request, $cid);

        // return view('Muccadum.create');
    }


    public function getTerminalsForSupervision()
    {
        $terminals = DB::table('supervision_terminals')
            ->select('*')
            ->get();

        return $terminals;
    }

    public function getSupervisionJob($id)
    {
        $jobDetails = Supervision::getJobById($id);
        return $jobDetails;
    }
    public function getLetterData($id)
    {
        $jobDetails = Supervision::getLetterData($id);
        return $jobDetails;
    }
    public function getWarehousesForSupervision()
    {
        $warehouses = DB::table('supervision_warehouses')
            ->select('id', 'warehouse_name')
            ->get();

        return $warehouses;
    }
    public function updateSupervision(Request $request, $id)
    {
        Supervision::updateSupervision($request, $id);
        Supervision::updateLocalJob($request, $id);
    }

    public function getWarehouseAddressForFrom($id)
    {
        return DB::table('supervision_warehouses')
            ->where('id', $id)
            ->select('warehouse_address')
            ->get();
    }
    public function getGodownData($id)
    {
        return DB::table('supervision_godowns')
            ->where('id', $id)
            ->select('*')
            ->get();
    }
    public function getGodownsForSupervision()
    {
        $godowns = DB::table('supervision_godowns')
            ->select('*')
            ->get();

        return $godowns;
    }

    public function addWarehouse(Request $request)
    {

        DB::table('supervision_warehouses')->insert([
            'warehouse_name' => $request->warehouse_name,
            'warehouse_address' => $request->warehouse_address
        ]);
    }
    public function addGodown(Request $request)
    {

        DB::table('supervision_godowns')->insert([
            'name' => $request->name,
            'godown_no' => $request->godown_no,
            'is_bond' => $request->is_bond == true ? 1 : 0,
            'address' => $request->godown_address,

        ]);
    }
    public function addAgent(Request $request)
    {

        DB::table('supervision_clearning_agent')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'contact_person' => $request->contact_person,
            'designation' => $request->designation,
            'city' => $request->city

        ]);
    }
    public function addTransporter(Request $request)
    {

        DB::table('supervision_transporters')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'contact_person' => $request->contact_person,
            'designation' => $request->designation,
            'city' => $request->city

        ]);
    }

    public function getConsigmentsForSupervision()
    {
        $warehouses = DB::table('supervision_consignments')
            ->select('*')
            ->get();

        return $warehouses;
    }
    public function getAgentsForSupervision()
    {
        $warehouses = DB::table('supervision_clearning_agent')
            ->select('*')
            ->get();

        return $warehouses;
    }
    public function getTransportersForSupervision()
    {
        $warehouses = DB::table('supervision_transporters')
            ->select('*')
            ->get();

        return $warehouses;
    }
    public function getPackagesForSupervision()
    {
        $warehouses = DB::table('supervision_packages')
            ->select('*')
            ->get();

        return $warehouses;
    }

    public function printLogReport(Request $request, $id)
    {

        $job = DB::table('supervision_jobs')
            ->leftJoin('c_region', 'supervision_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_bank', 'supervision_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('c_branch', 'supervision_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_customer', 'supervision_jobs.customer_id', '=', 'c_customer.cust_id')
            ->where('supervision_jobs.id', $id)
            ->select(
                'supervision_jobs.job_id AS jobid',
                'c_bank.bank_name',
                'supervision_jobs.bank_address',
                'c_customer.cust_name',
            )
            ->get();

        $log = DB::table('supervision_letters_log')
            ->where('job_id', $id)
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();


        $data = [

            $job[0]->jobid,
            strtoupper($job[0]->bank_name),
            ucwords($job[0]->bank_address),
            strtoupper($job[0]->cust_name),
            $log
        ];

        $pdf1 = PDF::loadView('Supervision/Reports/logreport', compact('data'));
        $pdf1->save('Reports/Supervision/' . $id . '/logreport.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));


        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Supervision/$id/logreport.pdf");



        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 5, 5);


        $pdf->Output("LogReport.pdf", "I");
    }
    public function printLetter(Request $request, $id)
    {
        $report = Supervision::getLetterData($id);

        $letterdate = date_create($report['job'][0]->date);

        $data = [
            $report['job'][0]->jobid,
            date_format($letterdate, "F d, Y"),
            strtoupper('M/S. ' . $report['job'][0]->to_is_letter),
            strtoupper($report['job'][0]->address),
            strtoupper($report['job'][0]->region),
            strtoupper($report['job'][0]->subject),
            $report['job'][0]->text_of_letter,
            '',
            '',
            strtoupper($report['job'][0]->signed_by),
            'Assistant',
            $report['job'][0]->cc_one, //CC1,
            $report['job'][0]->cc_two, //CC2,
            $report['job'][0]->cc_three, //CC3,
            $report['job'][0]->cc_four, //CC4,
            $report['job'][0]->cc_five, //CC5

        ];

        $pdf1 = PDF::loadView('Supervision/Reports/letter', compact('data'));
        $pdf1->save('Reports/Supervision/' . $id . '/letter.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));


        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Supervision/$id/letter.pdf");



        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 5, 5);


        $pdf->Output("letter.pdf", "I");
    }

    public function updateSupervisionLetterData(Request $request, $id)
    {
        Supervision::updateSupervisionLetterData($request, $id);
    }


    public function cancelSupervision(Request $request, $id)
    {
        Supervision::cancelSupervision($request, $id);
    }
    public function holdSupervision(Request $request, $id)
    {
        Supervision::holdSupervision($request, $id);
    }

    public function printBill(Request $request)
    {

        $jobid = $request->jobid;
        $id = $request->id;

        $bill = DB::table('bill')
            ->where('bill.job_number', '=', $jobid)
            ->leftJoin('supervision_jobs', 'bill.job_number', '=', 'supervision_jobs.job_id')
            ->leftJoin('c_bank', 'c_bank.bank_id', '=', 'supervision_jobs.bank_id')
            ->leftJoin('c_customer', 'supervision_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('supervision_warehouses', 'supervision_warehouses.id', '=', 'supervision_jobs.tbw_warehouse')
            ->leftJoin('supervision_godowns', 'supervision_godowns.id', '=', 'supervision_jobs.tpp_location')
            ->leftJoin('supervision_godowns as tpgdown', 'tpgdown.id', '=', 'supervision_jobs.th_godown_location')
            ->leftJoin('supervision_consignments', 'supervision_consignments.id', '=', 'supervision_jobs.consignment')
            ->select(
                'supervision_jobs.job_id',
                'bill.bill_number',
                'bill.bill_date',
                'c_bank.bank_code',
                'c_customer.cust_name',
                'supervision_jobs.bank_ntn',
                'c_bank.bank_name',
                'supervision_jobs.to_is',
                'supervision_jobs.given_by',
                'supervision_warehouses.warehouse_name',
                'supervision_jobs.tbw_address as warehouse_address',
                'supervision_jobs.tpp_addresss as party_address',
                'supervision_jobs.th_godown_address as third_party_address',
                'supervision_godowns.name As godown_name',
                'tpgdown.name As third_godown_name',
                'supervision_jobs.container_unit',
                'supervision_jobs.package_unit',
                'supervision_jobs.container_number',
                'supervision_jobs.package_is',
                'supervision_jobs.weight',
                'supervision_consignments.name AS consigment_name',
                'supervision_jobs.vessel_no',
                'supervision_jobs.import_value_unit',
                'supervision_jobs.bank_letter_date',
                'supervision_jobs.bank_letter',
                'supervision_jobs.lc_no',
                'bill.total_amount',
                'bill.net_amount',
                'bill.service_charges',
                'bill.discount',



            )
            ->get();

        $data = [
            'jobid' => $bill[0]->job_id,
            'billnumber' => $bill[0]->bill_number,
            'dated' => date_format(date_create($bill[0]->bill_date), "d-M-Y"),
            'bankcode' => strtoupper($bill[0]->bank_code),
            'bankntn' => strtoupper($bill[0]->bank_ntn),
            'giver' => $bill[0]->given_by,
            'messer' => strtoupper(
                $bill[0]->cust_name
            ),
            'account' => strtoupper(
                $bill[0]->bank_name
            ),
            'package' => $bill[0]->package_unit . " " . $bill[0]->package_is,
            'container' => $bill[0]->container_unit . "X" . $bill[0]->container_number,
            'weight' => $bill[0]->weight . " M.TONS",
            'consigment' => strtoupper($bill[0]->consigment_name),
            'vesselNo' => strtoupper($bill[0]->vessel_no),
            'toIs' => $bill[0]->to_is,
            'warehouseAddress' => strtoupper(
                $bill[0]->warehouse_address
            ),
            'partyAddress' => strtoupper($bill[0]->party_address),
            'thirdpartyAddress' => strtoupper(
                $bill[0]->third_party_address
            ),
            'importvalue' => $bill[0]->import_value_unit,
            'bankletterno' => $bill[0]->bank_letter,
            'bankletterdate' => date_format(date_create($bill[0]->bank_letter_date), "d-M-Y"),
            'lcNo' => $bill[0]->lc_no,
            'serviceCharges' => $bill[0]->service_charges,
            'discount' => $bill[0]->discount,
            'bill' => $bill[0]->total_amount,
            'recieved' => $bill[0]->net_amount,
            // 'balance' => $bill[0]->service_charges - $bill[0]->net_amount,
            'billText' => ucwords(Supervision::convertNumberToWord($bill[0]->service_charges)),


        ];


        $pdf1 = PDF::loadView('Supervision/supinvoice', compact('data'));
        $pdf1->save('Reports/Supervision/' . $id . '/invoice.pdf');
        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Supervision/$id/invoice.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 5, 5);
        $pdf = $pdf->Output();

        return $pdf;













        // $jobid = $request->jobid;
        // $sales = $request->sales;
        // $id = $request->id;
        // $branchid = $request->branch;

        // $bill = Bill_Ibr::where('job_number', '=', $jobid)
        //     ->first();

        // $branchRegion = DB::table('c_branch')
        // ->where('c_branch.branch_id', $branchid)
        //     ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
        //     ->select('c_city.city_name')
        //     ->get();


        // $reportDetails = DB::table('inspection_livestock_details')
        // ->where('job_id', $id)
        //     ->select('bill_date')
        //     ->get();




        // if (empty($bill)) {

        //     $scharges = $request->service == '' ? 0 : $request->service;
        //     $tcharges = $request->travel_charges == '' ? 0 : $request->travel_charges;
        //     $stotal = $scharges + $tcharges;
        //     $srate = 0;
        //     if ($request->sales == null) {
        //         $stax = 0;
        //     } else {
        //         $sale_reg = DB::table('sales_tax')
        //         ->where('region', $request->sales)
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
        //     $data = [

        //         $request->bank,
        //         $request->address,
        //         $request->jobid,
        //         // $request->company_address,
        //         $request->bank_letter,
        //         $bankDate,
        //         'Inspection',
        //         $total,
        //         $request->customer,
        //         $request->vendor,
        //         $request->customerAddress,
        //         $request->vendorAddress,
        //         $branchRegion[0]->city_name,



        //     ];

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
        //     $bill->service = 'Livestock';
        //     $bill->save();


        //     $log = new Log;
        //     $log->user_id = $request->user()->id;
        //     $log->activity = $data[3] . " Bill Was generated";
        //     $log->date = date('Y/m/d');
        //     $log->time = date("h:i:sa");
        //     $log->service = 'Inspection|Livestock';
        //     $log->save();


        //     $billData = Inspection::getJobByIdForBill($id, $request->jobid);

        //     $tonumber = Inspection::convertNumberToWord($total);


        //     $date = date_create($billData['bill'][0]->bill_date);
        //     $billDate = date_format($date, "d-M-Y");

        //     $date1 = date_create($billData['job'][0]->bank_letter_date);
        //     $bankDate = date_format($date1, "d M, Y");


        //     $data = [
        //         $billData['bill'][0]->job_number,
        //         $billDate,
        //         $billData['job'][0]->given_by,
        //         $billData['job'][0]->bank_name,
        //         $billData['job'][0]->bank_address,
        //         $billData['job'][0]->cust_name,
        //         $billData['job'][0]->customer_address,
        //         $billData['job'][0]->bank_letter,
        //         $bankDate,
        //         $tonumber,
        //         $total,
        //         $billData['job'][0]->name,
        //         $billData['job'][0]->byvendor_address,
        //         $branchRegion[0]->city_name,
        //         $scharges,
        //         $tcharges,
        //         $stotal,
        //         $srate,
        //         $stax,

        //     ];
        //     $pdf1 = PDF::loadView('Inspection/insinvoice', compact('data'));
        //     $pdf1->save('Reports/Inspection/' . $id . '/invoice.pdf');
        //     $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        //     $pdf->AddPage();
        //     $pdf->setSourceFile("Reports/Inspection/$id/invoice.pdf");
        //     $tplIdx = $pdf->importPage(1);
        //     $pdf->useTemplate($tplIdx, 5, 5);
        //     $pdf = $pdf->Output();

        //     return $pdf;
        // } else {
        //     $scharges = $request->service == '' ? 0 : $request->service;
        //     $tcharges = $request->travel_charges == '' ? 0 : $request->travel_charges;
        //     $stotal = $scharges + $tcharges;
        //     $srate = 0;
        //     if ($request->sales == null) {
        //         $stax = 0;
        //     } else {
        //         $sale_reg = DB::table('sales_tax')
        //         ->where('region', $request->sales)
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
        //     $bill->service = 'Livestock';
        //     $bill->save();


        //     $log = new Log;
        //     $log->user_id = $request->user()->id;
        //     $log->activity = $request->jobid . " Bill Was Updated";
        //     $log->date = date('Y/m/d');
        //     $log->time = date("h:i:sa");
        //     $log->service = 'Inspection|Livestock';
        //     $log->save();

        //     $billData = Inspection::getJobByIdForBill($id, $request->jobid);

        //     $tonumber = Inspection::convertNumberToWord($total);


        //     $date = date_create($billData['bill'][0]->bill_date);
        //     $billDate = date_format($date, "d-M-Y");

        //     $date1 = date_create($billData['job'][0]->bank_letter_date);
        //     $bankDate = date_format($date1, "d M, Y");

        //     $branchRegion = DB::table('c_branch')
        //     ->where('c_branch.branch_id', $billData['bill'][0]->branch)
        //         ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
        //         ->select('c_city.city_name')
        //         ->get();


        //     $data = [
        //         $billData['bill'][0]->job_number,
        //         $billDate,
        //         $billData['job'][0]->given_by,
        //         $billData['job'][0]->bank_name,
        //         $billData['job'][0]->bank_address,
        //         $billData['job'][0]->cust_name,
        //         $billData['job'][0]->customer_address,
        //         $billData['job'][0]->bank_letter,
        //         $bankDate,
        //         $tonumber,
        //         $total,
        //         $billData['job'][0]->name,
        //         $billData['job'][0]->byvendor_address,
        //         $branchRegion[0]->city_name,
        //         $scharges,
        //         $tcharges,
        //         $stotal,
        //         $srate,
        //         $stax,



        //     ];
        //     $pdf1 = PDF::loadView('Inspection/insinvoice', compact('data'));
        //     $pdf1->save('Reports/Inspection/' . $id . '/invoice.pdf');
        //     $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        //     $pdf->AddPage();
        //     $pdf->setSourceFile("Reports/Inspection/$id/invoice.pdf");
        //     $tplIdx = $pdf->importPage(1);
        //     $pdf->useTemplate($tplIdx, 5, 5);
        //     $pdf = $pdf->Output();

        //     return $pdf;
        //     dd($billData);
        // }
    }
}
