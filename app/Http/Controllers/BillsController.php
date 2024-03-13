<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bill_Ibr;
use App\IBR;
use App\Inspection;
use App\Company;
use App\Job;
use App\Log;
use App\Receipt;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Exports\BillsExportMain;
use Maatwebsite\Excel\Facades\Excel;

class BillsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");
    }

    public function getInstruments()
    {
        $instrument = DB::table('instrument_type')
            ->select('*')
            ->get();

        return $instrument;
    }

    public function getAccounts()
    {
        $accounts = DB::table('bank_accounts')
            ->select('*')
            ->get();

        return $accounts;
    }

    public function getIbrBill($id)
    {

        $tax = Bill_Ibr::where('job_number', '=', $id)
            ->first();


        if (empty($tax)) {
            echo 'empty';
        } else {
            echo 'Not empty';
        }
    }

    public function getBills(Request $request)
    {

        $company = $request->company;
        $service = $request->service;
        $regions = $request->regions;
        $invoice = $request->invoice_id;
        $bank = $request->bank;
        $customer = $request->customer;
        $advance = $request->isAdvance == 1 ? 'Yes' : 'No';

        if($invoice=="")
        {
            if ($advance == "Yes") {
                $bills = DB::table('bill');
                $bills = $bills->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id');
                $bills = $bills->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id');
                $bills = $bills->where('bill.status', '=', 'In Progress');
    
                if ($service !== 'All') {
                    $bills = $bills->where('bill.service', '=', $request->service);
                }
    
                if ($regions !== []) {
                    $bills = $bills->whereIn('bill.recievable', $request->regions);
                }
    
                // if ($bank != 0) {
                //     $bills = $bills->where('bill.bank', '=', $bank);
                //     // print_r($bank);
    
                // }
                // if ($customer != 0) {
                //     $bills = $bills->where('bill.customer', '=', $customer);
                //     // print_r($bank);
    
                // }
                // if ($company != '') {
                //     $bills = $bills->where('bill.company', '=', $request->company);
                // }
    
                // if ($service != 'All') {
                //     $bills = $bills->where('bill.service', '=', $request->service);
                // }
    
    
    
                // if ($regions != []) {
                //     $bills = $bills->whereIn('bill.recievable', $request->regions);
                // }
    
    
                $bills = $bills->select(
                    'bill.*',
                    'c_customer.cust_name',
                    'c_branch.branch_name'
    
                );
    
                $bills = $bills->get();
            } else {
    
                $bills = DB::table('bill');
                $bills = $bills->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id');
                $bills = $bills->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id');
                $bills = $bills->where('bill.status', '=', 'Receivable');
    
    
    
                if ($service !== 'All') {
                    $bills = $bills->where('bill.service', '=', $request->service);
                }
    
                if ($regions !== []) {
                    $bills = $bills->whereIn('bill.recievable', $request->regions);
                }
    
                // if ($bank !== 0) {
                //     $bills = $bills->where('bill.bank', '=', $bank);
                //     // print_r($bank);
    
                // }
                // if ($customer !== 0) {
                //     $bills = $bills->where('bill.customer', '=', $customer);
                //     // print_r($bank);
    
                // }
                // if ($company !== '') {
                //     $bills = $bills->where('bill.company', '=', $request->company);
                // }
    
                // if ($service !== 'All') {
                //     $bills = $bills->where('bill.service', '=', $request->service);
                // }
    
    
    
                // if ($regions !== []) {
                //     $bills = $bills->whereIn('bill.recievable', $request->regions);
                // }
    
    
                $bills = $bills->select(
                    'bill.*',
                    'c_customer.cust_name',
                    'c_branch.branch_name'
    
                );
    
                $bills = $bills->get();
            }
        }

        else{

            $id=$request->invoice;
            $bills = DB::table('bill');
            $bills = $bills->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id');
            $bills = $bills->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id');
            $bills = $bills->where('bill.status', '=', 'Receivable');

            // $bills = $bills->where('bill.status', '=', 'Receivable');
            $bills = $bills->where('bill.invoice_id', '=', $invoice);


            $bills = $bills->select(
                'bill.*',
                'c_customer.cust_name',
                'c_branch.branch_name'

            );

            $bills = $bills->get();

        }

      



        return $bills;
    }

    public function getBillsPrism(Request $request)
    {

        $company = $request->company;
        $service = $request->service;
        $regions = $request->regions;
        $invoice = $request->invoice_id;
        $bank = $request->bank;
        $customer = $request->customer;
        $advance = $request->isAdvance == 1 ? 'Yes' : 'No';

        if($invoice=="")
        {
            if ($advance == "Yes") {
                $bills = DB::table('bill');
                // $bills = $bills->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id');
                $bills = $bills->leftJoin('prism_jobs', 'bill.bill_id', '=', 'prism_jobs.id');
                $bills = $bills->leftJoin('prism_insurer_branches', 'prism_jobs.insurer_branch', '=', 'prism_insurer_branches.id');
                $bills = $bills->where('bill.status', '=', 'In Progress');
                $bills = $bills->where('bill.service', '=', 'Prism');
        
                if ($regions !== []) {
                    $bills = $bills->whereIn('bill.recievable', $request->regions);
                }
    
                // if ($bank != 0) {
                //     $bills = $bills->where('bill.bank', '=', $bank);
                //     // print_r($bank);
    
                // }
                // if ($customer != 0) {
                //     $bills = $bills->where('bill.customer', '=', $customer);
                //     // print_r($bank);
    
                // }
                // if ($company != '') {
                //     $bills = $bills->where('bill.company', '=', $request->company);
                // }
    
                // if ($service != 'All') {
                //     $bills = $bills->where('bill.service', '=', $request->service);
                // }
    
    
    
                // if ($regions != []) {
                //     $bills = $bills->whereIn('bill.recievable', $request->regions);
                // }
    
    
                $bills = $bills->select(
                    'bill.*',
                    // 'c_customer.cust_name',
                    'prism_insurer_branches.name as branch_name',
                    'bill.service_charges as prism_service_charges',
                    // 'prism_jobs.travelling',
                    DB::Raw('bill.other_charges as other_charges'),

    
                );    
                $bills = $bills->get();
            } else {
    
                $bills = DB::table('bill');
                $bills = $bills->leftJoin('prism_jobs', 'bill.bill_id', '=', 'prism_jobs.id');
                // $bills = $bills->leftJoin('prism_insurers', 'prism_jobs.insurer', '=', 'prism_insurers.id');
                $bills = $bills->leftJoin('prism_insurer_branches', 'prism_jobs.insurer_branch', '=', 'prism_insurer_branches.id');
                
                $bills = $bills->where('bill.status', '=', 'Receivable');
                $bills = $bills->where('bill.service', '=', 'Prism');

                if ($regions !== []) {
                    $bills = $bills->whereIn('bill.recievable', $request->regions);
                }
    
                if ($bank !== 0) {
                    $bills = $bills->where('prism_jobs.insurer', '=', $bank);
                    // print_r($bank);
    
                }
                // if ($customer !== 0) {
                //     $bills = $bills->where('bill.customer', '=', $customer);
                //     // print_r($bank);
    
                // }
                // if ($company !== '') {
                //     $bills = $bills->where('bill.company', '=', $request->company);
                // }
    
                // if ($service !== 'All') {
                //     $bills = $bills->where('bill.service', '=', $request->service);
                // }
    
    
    
                // if ($regions !== []) {
                //     $bills = $bills->whereIn('bill.recievable', $request->regions);
                // }
    
    
                $bills = $bills->select(
                    'bill.*',
                    'prism_insurer_branches.name as branch_name',
                    'bill.service_charges as prism_service_charges',
                    // 'prism_jobs.travelling',
                    DB::Raw('bill.other_charges as other_charges'),

    
                );    
                $bills = $bills->get();
            }
        }

        else{

            $id=$request->invoice;
        // PRM/33

            $bills = DB::table('bill');
            $bills = $bills->leftJoin('prism_jobs', 'bill.bill_id', '=', 'prism_jobs.id');
            $bills = $bills->leftJoin('prism_insurer_branches', 'prism_jobs.insurer_branch', '=', 'prism_insurer_branches.id');
            $bills = $bills->where('bill.status', '=', 'Receivable');
            $bills = $bills->whereIn('bill.invoice_id', explode(',', $invoice));


            $bills = $bills->select(
                'bill.*',
                'prism_insurer_branches.name as branch_name',
                'bill.service_charges as prism_service_charges',
                DB::Raw('bill.other_charges as other_charges'),

            );

            $bills = $bills->get();

        }

      



        return $bills;
    }

    public function getBillsForEditPrism(Request $request)
    {

        $ids = $request->bills;


        // $asset_requst = asset_request::whereIn('id', explode(",", $ids))->get();
        $bills = DB::table('bill');
        $bills = $bills->leftJoin('prism_jobs', 'bill.bill_id', '=', 'prism_jobs.id');
        $bills = $bills->leftJoin('prism_insurer_branches', 'prism_jobs.insurer_branch', '=', 'prism_insurer_branches.id');
        $bills = $bills->whereIn('bill.id', explode(",", $ids));


        $bills = $bills->select(
            'bill.*',
            // 'c_customer.cust_name',
            'prism_insurer_branches.name as branch_name'

        );

        $bills = $bills->get();

        return $bills;
    }

    public function getBillsForEdit(Request $request)
    {

        $ids = $request->bills;


        // $asset_requst = asset_request::whereIn('id', explode(",", $ids))->get();
        $bills = DB::table('bill');
        $bills = $bills->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id');
        $bills = $bills->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id');
        $bills = $bills->whereIn('bill.id', explode(",", $ids));


        $bills = $bills->select(
            'bill.*',
            'c_customer.cust_name',
            'c_branch.branch_name'

        );

        $bills = $bills->get();

        return $bills;
    }

    public function viewJob($id, Request $request)
    {
        $job = Bill_Ibr::findOrFail($id);
        $jobid = $job->job_number;
        $token = $request->session()->get('token');

        $inspectionJob = Inspection::where('job_id', '=', $jobid)
            ->select('*')
            ->get();
        $cmjob = Job::where('job_id', '=', $jobid)->first();
        $cmjobid = $cmjob->id;
        $data = [
            $jobid,
            $inspectionJob[0]->id,
            $cmjobid,
            $inspectionJob[0]->company_id,
            $token
        ];
        return view('Inspection.edit', compact('data'));
    }

    public function getReceipts()
    {

        $receipts = DB::table('receipts')
            ->leftJoin('c_region', 'receipts.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
            ->leftJoin('instrument_type', 'receipts.instrument_type', '=', 'instrument_type.id')
            ->leftJoin('bank_accounts', 'receipts.deposit_bank', '=', 'bank_accounts.id')
            ->where('receipts.status', '=', "Pending")
            ->whereIn('receipts.instrument_type', [2, 1, 4, 3, 5])
            // ->where('receipts.instrument_type', '=', '4')
            // ->orWhere('receipts.instrument_type', '=', '1')
            ->select(
                'receipts.*',
                'c_city.city_name',
                'instrument_type.description AS method',
                'bank_accounts.description AS bank_account'

            )
            ->get();

        return $receipts;



        // $receipts= Receipt::all();
        // return $receipts;
    }
    public function getReceiptsById($id)
    {

        $receipts = DB::table('receipts')
            ->leftJoin('c_region', 'receipts.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
            ->leftJoin('instrument_type', 'receipts.instrument_type', '=', 'instrument_type.id')
            ->leftJoin('bank_accounts', 'receipts.deposit_bank', '=', 'bank_accounts.id')
            ->where('receipts.id', '=', $id)
            ->whereIn('receipts.instrument_type', [2, 1, 4, 3, 5])
            ->select(
                'receipts.*',
                'c_city.city_name',
                'instrument_type.description AS method',
                'bank_accounts.description AS bank_account'

            )
            ->get();

        return $receipts;



        // $receipts= Receipt::all();
        // return $receipts;
    }

    public function getReceiptById($id)
    {

        $receipts = DB::table('receipts')
            ->leftJoin('c_region', 'receipts.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
            ->leftJoin('instrument_type', 'receipts.instrument_type', '=', 'instrument_type.id')
            ->leftJoin('bank_accounts', 'receipts.deposit_bank', '=', 'bank_accounts.id')
            ->where('receipts.id', '=', $id)
            ->select(
                'receipts.*',
                'c_city.city_name',
                'instrument_type.description AS method',
                'bank_accounts.description AS bank_account'

            )
            ->get();

        return $receipts;



        // $receipts= Receipt::all();
        // return $receipts;
    }




    public function allReceipts(Request $request)
    {
        $role = $request->user()->role;

        if ($role == 3) {


            if ($request->ajax()) {

                $receipts = DB::table('receipts')
                    ->leftJoin('c_region', 'receipts.region_id', '=', 'c_region.reg_id')
                    ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                    ->leftJoin('c_bank', 'receipts.bank_id', '=', 'c_bank.bank_id')
                    ->leftJoin('instrument_type', 'receipts.instrument_type', '=', 'instrument_type.id')
                    ->leftJoin('bank_accounts', 'receipts.deposit_bank', '=', 'bank_accounts.id')
                    ->leftJoin('users', 'receipts.created_by', '=', 'users.id')
                    ->select(
                        'receipts.*',
                        'c_city.city_name',
                        'c_bank.bank_name',
                        'users.name as user_name',
                        'instrument_type.description AS method',
                        'bank_accounts.description AS bank_account'

                    )
                    ->get();
                return Datatables::of($receipts)
                    ->addIndexColumn()
                    ->addColumn('action', '<a class="btn btn-sm btn-primary" style="color:white" href="/editBills/{{$id}}">Edit</a>')
                    ->rawColumns(['action'])
                    ->editColumn('receipt_date', function ($receipt) {
                        return date('d-M-Y', strtotime($receipt->recieved_on));
                    })
                    ->editColumn('deposit_date', function ($receipt) {
                        return date('d-M-Y', strtotime($receipt->deposit_date));
                    })
                    ->make(true);
            }


            return view('Bill.receipts');
        } else {
            abort(404);
        }
    }

    public function getBillView(Request $request)
    {
        $role = $request->user()->role;

        if ($role == 3) {
            return view('Bill.bills');
        } else {
            abort(404);
        }
    }
    public function getAllBills(Request $request)
    {

        $from = date_create($request->from_date);
        $to = date_create($request->to_date);

        $from_date = date_format($from, "Y-m-d");
        $to_date = date_format($to, "Y-m-d");
        $status = $request->status;
        $service = $request->service;



        if ($status != '' ||  $request->from_date != '' || $request->to_date != '') {

            if ($request->ajax()) {

                if ($status != '' &&  $request->from_date == '' && $request->to_date == '') {

                    $bills = DB::table('bill')
                        ->leftJoin('c_region', 'bill.recievable', '=', 'c_region.reg_id')
                        ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                        ->leftJoin('receipts', 'bill.receipt_id', '=', 'receipts.id')
                        ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
                        ->leftJoin('c_company', 'bill.company', '=', 'c_company.company_id')
                        ->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id')
                        ->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id')
                        ->where('bill.status', $status)
                        ->where('bill.service', $service)
                        ->select(
                            'bill.*',
                            'c_city.city_name',
                            'c_bank.bank_name',
                            'c_customer.cust_name',
                            'c_branch.branch_name',
                            'c_company.company_name',
                            'receipts.receipt_id as receipt_name',

                        )
                        ->get();
                    return Datatables::of($bills)
                        ->addIndexColumn()
                        ->addColumn('action', '<a class="btn btn-sm btn-primary" style="color:white" href="#">Edit</a>')
                        ->rawColumns(['action'])
                        ->editColumn('bill_date', function ($bills) {
                            return date('d-M-Y', strtotime($bills->bill_date));
                        })
                        ->make(true);
                } else if ($status != '' &&  $request->from_date != '' && $request->to_date != '') {
                    $bills = DB::table('bill')
                        ->leftJoin('c_region', 'bill.recievable', '=', 'c_region.reg_id')
                        ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                        ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
                        ->leftJoin('receipts', 'bill.receipt_id', '=', 'receipts.id')
                        ->leftJoin('c_company', 'bill.company', '=', 'c_company.company_id')
                        ->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id')
                        ->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id')
                        ->where('bill.status', $status)
                        ->where('bill.service', $service)
                        ->whereBetween('bill.bill_date', array($from_date, $to_date))
                        ->select(
                            'bill.*',
                            'c_city.city_name',
                            'c_bank.bank_name',
                            'c_customer.cust_name',
                            'c_branch.branch_name',
                            'c_company.company_name',
                            'receipts.receipt_id as receipt_name',


                        )
                        ->get();
                    return Datatables::of($bills)
                        ->addIndexColumn()
                        ->addColumn('action', '<a class="btn btn-sm btn-primary" style="color:white" href="#">Edit</a>')
                        ->rawColumns(['action'])
                        ->editColumn('bill_date', function ($bills) {
                            return date('d-M-Y', strtotime($bills->bill_date));
                        })
                        ->make(true);
                } else if ($status == '' &&  $request->from_date != '' && $request->to_date != '') {
                    $bills = DB::table('bill')
                        ->leftJoin('c_region', 'bill.recievable', '=', 'c_region.reg_id')
                        ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                        ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
                        ->leftJoin('receipts', 'bill.receipt_id', '=', 'receipts.id')
                        ->leftJoin('c_company', 'bill.company', '=', 'c_company.company_id')
                        ->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id')
                        ->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id')
                        // ->where('bill.status', $status)
                        ->where('bill.service', $service)

                        ->whereBetween('bill.bill_date', array($from_date, $to_date))
                        ->select(
                            'bill.*',
                            'c_city.city_name',
                            'c_bank.bank_name',
                            'c_customer.cust_name',
                            'c_branch.branch_name',
                            'c_company.company_name',
                            'receipts.receipt_id as receipt_name',


                        )
                        ->get();
                    return Datatables::of($bills)
                        ->addIndexColumn()
                        ->addColumn('action', '<a class="btn btn-sm btn-primary" style="color:white" href="#">Edit</a>')
                        ->rawColumns(['action'])
                        ->editColumn('bill_date', function ($bills) {
                            return date('d-M-Y', strtotime($bills->bill_date));
                        })
                        ->make(true);
                }
            }
        } else {

            if ($request->ajax()) {

                $bills = DB::table('bill')
                    ->leftJoin('c_region', 'bill.recievable', '=', 'c_region.reg_id')
                    ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                    ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
                    ->leftJoin('inspection_jobs', 'bill.job_number', '=', 'inspection_jobs.job_id')
                    ->leftJoin('inspection_livestock_details', 'inspection_jobs.id', '=', 'inspection_livestock_details.job_id')
                    ->leftJoin('receipts', 'bill.receipt_id', '=', 'receipts.id')
                    ->leftJoin('c_company', 'bill.company', '=', 'c_company.company_id')
                    ->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id')
                    ->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id')
                    ->where('bill.service', $service)

                    ->select(
                        'bill.*',
                        'c_city.city_name',
                        'c_bank.bank_name',
                        'c_customer.cust_name',
                        'inspection_livestock_details.branch_code',
                        'c_branch.branch_name',
                        'c_company.company_name',
                        'receipts.receipt_id as receipt_name',


                    )
                    ->get();
                return Datatables::of($bills)
                    ->addIndexColumn()
                    ->addColumn('action', '<a class="btn btn-sm btn-primary" style="color:white" href="#">Edit</a>')
                    ->rawColumns(['action'])
                    ->editColumn('bill_date', function ($bills) {
                        return date('d-M-Y', strtotime($bills->bill_date));
                    })
                    ->make(true);
            }
        }
    }
    public function getTotalofBill(Request $request)
    {

        $from = date_create($request->from_date);
        $to = date_create($request->to_date);

        $from_date = date_format($from, "Y-m-d");
        $to_date = date_format($to, "Y-m-d");
        $status = $request->status;
        $service = $request->service;



        if ($status != '' ||  $request->from_date != '' || $request->to_date != '') {

            if ($request->ajax()) {


                if ($status != '' &&  $request->from_date == '' && $request->to_date == '') {
                    $bills = DB::table('bill')
                        ->leftJoin('c_region', 'bill.recievable', '=', 'c_region.reg_id')
                        ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                        ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
                        ->leftJoin('c_company', 'bill.company', '=', 'c_company.company_id')
                        ->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id')
                        ->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id')
                        ->where('bill.status', $status)
                        ->where('bill.service', $service)
                        // ->whereBetween('bill.bill_date', array($from_date, $to_date))
                        ->selectRaw(
                            'SUM(total_amount) AS total'

                        )
                        ->get();
                    return $bills;
                } else if ($status != '' &&  $request->from_date != '' && $request->to_date != '') {
                    $bills = DB::table('bill')
                        ->leftJoin('c_region', 'bill.recievable', '=', 'c_region.reg_id')
                        ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                        ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
                        ->leftJoin('c_company', 'bill.company', '=', 'c_company.company_id')
                        ->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id')
                        ->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id')
                        ->where('bill.status', $status)
                        ->where('bill.service', $service)
                        ->whereBetween('bill.bill_date', array($from_date, $to_date))
                        ->selectRaw(
                            'SUM(total_amount) AS total'

                        )
                        ->get();
                    return $bills;
                } else if ($status == '' &&  $request->from_date != '' && $request->to_date != '') {
                    $bills = DB::table('bill')
                        ->leftJoin('c_region', 'bill.recievable', '=', 'c_region.reg_id')
                        ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                        ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
                        ->leftJoin('c_company', 'bill.company', '=', 'c_company.company_id')
                        ->leftJoin('c_branch', 'bill.branch', '=', 'c_branch.branch_id')
                        ->leftJoin('c_customer', 'bill.customer', '=', 'c_customer.cust_id')
                        // ->where('bill.status', $status
                        ->where('bill.service', $service)
                        ->whereBetween('bill.bill_date', array($from_date, $to_date))
                        ->selectRaw(
                            'SUM(total_amount) AS total'

                        )
                        ->get();
                    return $bills;
                }
            }
        } 
        
    }
    public function allReceiptsForUnPosted(Request $request)
    {

        if ($request->ajax()) {

            $receipts = DB::table('receipts')
                ->leftJoin('c_region', 'receipts.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->leftJoin('c_bank', 'receipts.bank_id', '=', 'c_bank.bank_id')
                ->leftJoin('instrument_type', 'receipts.instrument_type', '=', 'instrument_type.id')
                ->leftJoin('bank_accounts', 'receipts.deposit_bank', '=', 'bank_accounts.id')
                ->leftJoin('users', 'receipts.created_by', '=', 'users.id')
                ->where('receipts.status', '=', 'Pending')
                ->select(
                    'receipts.*',
                    'c_city.city_name',
                    'c_bank.bank_name',
                    'users.name as user_name',
                    'instrument_type.description AS method',
                    'bank_accounts.description AS bank_account'

                )
                ->get();
            return Datatables::of($receipts)
                ->addIndexColumn()
                ->addColumn('action', '<a class="btn btn-sm btn-primary" style="color:white" href="/editBills/{{$id}}">Edit</a>')
                ->rawColumns(['action'])
                ->editColumn('receipt_date', function ($receipt) {
                    return date('d-M-Y', strtotime($receipt->recieved_on));
                })
                ->editColumn('deposit_date', function ($receipt) {
                    return date('d-M-Y', strtotime($receipt->deposit_date));
                })
                ->make(true);
        }
    }


    public function editBills(Request $request, $id)
    {

        $uid = $request->user()->company;
        $uregion = $request->user()->region;
        $jid = $id;
        $record = Company::where('company_id', $uid)
            ->select('*')
            ->get();


        $region = DB::table('c_region')
            ->join('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
            ->select('c_city.city_name', 'c_region.reg_id', 'c_region.reg_prefix')
            ->where('c_region.reg_id', '=', $uregion)
            ->get();


        $data = [
            $uid,
            $record[0],
            $uregion,
            $region[0]->city_name,
            $region[0]->reg_prefix,
            $jid
        ];

        return view('Bill.edit', compact('data'));
    }



    public function posts(Request $request)
    {
        $role = $request->user()->role;

        if ($role == 3) {
            return view('Bill.posts');
        } else {
            abort(404);
        }
    }

    public function getBillsExcel(Request $request){
        $service=$request->service;
        $fromdate=$request->from_date;
        $todate=$request->to_date;

        return Excel::download(new BillsExportMain($service,$fromdate,$todate), 'bills.xlsx');


    }

    public function makeReceipt(Request $request)
    {


        $instrument = $request->instrument;
        $bankCharges = $request->bank_charges;
        $taxAmount = $request->taxable_amount;
        $saleTaxVal = $request->st_value;
        $extraChanges = $request->extra_charges;
        $saleTaxAmount = $request->sales_tax_amount;


        if ($instrument == 'OnLine Transfer') {


            $ids = $request->ids;
            $jids = implode(",", (array) $ids);

            $jobIds = $request->jobs;
            $jobs = implode(",", (array) $jobIds);


            $receipt = new Receipt();
            $receipt->receipt_date = date('Y-m-d');
            $receipt->recieved_on = $request->recieved_on;
            $receipt->region_id = $request->user()->region;
            $receipt->private = '0';
            $receipt->instrument_type = $request->instrument_id;
            $receipt->instrument_number = $request->instrument_number;
            $receipt->instrument_date = $request->instrument_date;
            $receipt->deposit_bank = $request->deposit_bank;
            $receipt->deposit_date = $request->deposit_date;
            $receipt->slip_number = $request->deposit_slip;
            $receipt->amount = $request->bill;
            $receipt->gross = $request->gross_amount;
            $receipt->remarks = $request->remarks;
            $receipt->sales_tax = $request->sales_tax;
            $receipt->taxable_amount = $request->taxable_amount;
            $receipt->ST_value = $request->st_value;
            $receipt->IT_value = $request->it_value;
            $receipt->it_per = $request->it_per_is;
            $receipt->st_per = $request->st_per;
            $receipt->sales_tax_pay = $request->st_value - $request->sales_tax_amount;
            $receipt->income_tax_amount = $request->income_tax_amount;
            $receipt->sales_tax_amount = $request->sales_tax_amount;
            $receipt->bank_charges = $request->bank_charges;
            $receipt->extra_charges = $extraChanges;
            $receipt->net = $request->net_charges;
            $receipt->created_by = $request->user()->id;
            $receipt->updated_by = $request->user()->id;
            $receipt->write_off = '0';
            $receipt->status = 'Pending';
            $receipt->bills_id = $jids;
            $receipt->jobs_number = $jobs;
            $receipt->save();

            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = "Receipt Was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt | Livestock';
            $log->save();

            // Bill_Ibr::whereIn('id', explode(',', $ids))->update(array(
            //     'status' => 'Pending'
            // ));



            $receipt = DB::table('receipts')->latest('created_at', 'desc')->first();
            $recID = $receipt->id;
            $receipt1 = Receipt::findOrFail($recID);

            $receipt1->receipt_id = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');
            $receipt1->save();

            $myreceipt = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');



            $result = Bill_Ibr::whereIn('id', explode(',', $ids))->get();

            foreach ($result as $rec) {

                $share = $rec->total_amount * 100 / $request->gross_amount;
                $payable = $request->st_value - $request->sales_tax_amount;;
                $wheld = $request->sales_tax_amount;
                $bchrg = $request->bank_charges;
                $deduction = $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100;


                Bill_Ibr::where('id', $rec->id)->update(array(
                    'itax' => $request->income_tax_amount * $share / 100,
                    'stax_payable' => $payable * $share / 100, //Payable
                    'stax_whld' => $wheld * $share / 100, //Wheld
                    'bank_charges' => $bchrg * $share / 100, //Wheld
                    'excess' => $extraChanges * $share / 100, //Wheld
                    'deduction' => $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100, //Wheld
                    'itax_per' =>  $request->it_per_is, //Wheld
                    'tax_per' => $request->st_per, //Wheld
                    'receipt_id' => $recID, //Wheld
                    'net_amount' =>  $rec->total_amount  - $deduction + $extraChanges * $share / 100, //Wheld
                    'status' => 'Pending'
                ));
            }

            echo $myreceipt;
        } else if ($instrument == 'Cash') {

            $slipScan = $request->file('slipScan');
            $f2 = Storage::disk('dir')->put('Documents/Livestock', $slipScan);

            $ids = $request->ids;
            $jids = implode(",", (array) $ids);

            $jobIds = $request->jobs;
            $jobs = implode(",", (array) $jobIds);


            $receipt = new Receipt();
            $receipt->receipt_date = date('Y-m-d');
            $receipt->recieved_on = $request->recieved_on;
            $receipt->region_id = $request->user()->region;
            $receipt->private = '0';
            $receipt->instrument_type = $request->instrument_id;
            $receipt->instrument_number = $request->instrument_number;
            $receipt->instrument_date = $request->instrument_date;
            $receipt->deposit_bank = $request->deposit_bank;
            $receipt->deposit_date = $request->deposit_date;
            $receipt->slip_number = $request->deposit_slip;
            $receipt->amount = $request->bill;
            $receipt->gross = $request->gross_amount;
            $receipt->remarks = $request->remarks;
            $receipt->sales_tax = $request->sales_tax;
            $receipt->taxable_amount = $request->taxable_amount;
            $receipt->ST_value = $request->st_value;
            $receipt->IT_value = $request->it_value;
            $receipt->it_per = $request->it_per_is;
            $receipt->st_per = $request->st_per;
            $receipt->income_tax_amount = $request->income_tax_amount;
            $receipt->sales_tax_amount = $request->sales_tax_amount;
            $receipt->sales_tax_pay = $request->st_value - $request->sales_tax_amount;

            $receipt->bank_charges = $request->bank_charges;
            $receipt->extra_charges = $extraChanges;
            $receipt->net = $request->net_charges;
            $receipt->created_by = $request->user()->id;
            $receipt->updated_by = $request->user()->id;
            $receipt->write_off = '0';
            $receipt->status = 'Pending';
            $receipt->client_copy = '';
            $receipt->deposit_copy = 'Documents/Livestock/' . basename($f2);
            $receipt->bills_id = $jids;
            $receipt->jobs_number = $jobs;
            $receipt->save();

            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = "Receipt Was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt | Livestock';
            $log->save();

            // Bill_Ibr::whereIn('id', explode(',', $ids))->update(array(
            //     'status' => 'Pending'
            // ));






            $receipt = DB::table('receipts')->latest('created_at', 'desc')->first();
            $recID = $receipt->id;
            $receipt1 = Receipt::findOrFail($recID);

            $receipt1->receipt_id = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');
            $receipt1->save();

            $myreceipt = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');


            $result = Bill_Ibr::whereIn('id', explode(',', $ids))->get();

            foreach ($result as $rec) {

                $share = $rec->total_amount * 100 / $request->gross_amount;
                $payable = $request->st_value - $request->sales_tax_amount;;
                $wheld = $request->sales_tax_amount;
                $bchrg = $request->bank_charges;
                $deduction = $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100;


                Bill_Ibr::where('id', $rec->id)->update(array(
                    'itax' => $request->income_tax_amount * $share / 100,
                    'stax_payable' => $payable * $share / 100, //Payable
                    'stax_whld' => $wheld * $share / 100, //Wheld
                    'bank_charges' => $bchrg * $share / 100, //Wheld
                    'excess' => $extraChanges * $share / 100, //Wheld
                    'deduction' => $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100, //Wheld
                    'itax_per' =>  $request->it_per_is, //Wheld
                    'tax_per' => $request->st_per, //Wheld
                    'receipt_id' => $recID, //Wheld
                    'net_amount' =>  $rec->total_amount  - $deduction + $extraChanges * $share / 100, //Wheld
                    'status' => 'Pending'
                ));
            }
            echo $myreceipt;
        } else {
            // $itper = $request->it_per;

            if ($bankCharges > 0  || $extraChanges > 0 || $request->it_per != 1 || $saleTaxVal > 0 || $saleTaxAmount > 0) {
                $ids = $request->ids;
                $jids = implode(",", (array) $ids);

                $jobIds = $request->jobs;
                $jobs = implode(",", (array) $jobIds);

                $instScan = $request->file('instScan');
                $slipScan = $request->file('slipScan');
                $f1 = Storage::disk('dir')->put('Documents/Livestock', $instScan);
                $f2 = Storage::disk('dir')->put('Documents/Livestock', $slipScan);

                $receipt = new Receipt();
                $receipt->receipt_date = date('Y-m-d');
                $receipt->recieved_on = $request->recieved_on;
                $receipt->region_id = $request->user()->region;
                $receipt->private = '0';
                $receipt->instrument_type = $request->instrument_id;
                $receipt->instrument_number = $request->instrument_number;
                $receipt->instrument_date = $request->instrument_date;
                $receipt->deposit_bank = $request->deposit_bank;
                $receipt->deposit_date = $request->deposit_date;
                $receipt->slip_number = $request->deposit_slip;
                $receipt->amount = $request->bill;
                $receipt->gross = $request->gross_amount;
                $receipt->remarks = $request->remarks;
                $receipt->sales_tax = $request->sales_tax;
                $receipt->extra_charges = $extraChanges;
                $receipt->taxable_amount = $request->taxable_amount;
                $receipt->ST_value = $request->st_value;
                $receipt->IT_value = $request->it_value;
                $receipt->it_per = $request->it_per_is;
                $receipt->st_per = $request->st_per;
                $receipt->income_tax_amount = $request->income_tax_amount;
                $receipt->sales_tax_amount = $request->sales_tax_amount;
                $receipt->sales_tax_pay = $request->st_value - $request->sales_tax_amount;

                $receipt->bank_charges = $request->bank_charges;
                $receipt->net = $request->net_charges;
                $receipt->created_by = $request->user()->id;
                $receipt->updated_by = $request->user()->id;
                $receipt->write_off = '0';
                $receipt->status = 'Pending';
                $receipt->bills_id = $jids;
                $receipt->jobs_number = $jobs;
                $receipt->client_copy = 'Documents/Livestock/' . basename($f1);
                $receipt->deposit_copy = 'Documents/Livestock/' . basename($f2);
                $receipt->save();

                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = "Bill No: [" . $ids . "] receipt was generated";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'Receipt | LiveStock';
                $log->save();



                $receipt = DB::table('receipts')->latest('created_at', 'desc')->first();
                $recID = $receipt->id;
                $receipt1 = Receipt::findOrFail($recID);

                $receipt1->receipt_id = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');

                $receipt1->save();



                $result = Bill_Ibr::whereIn('id', explode(',', $ids))->get();

                foreach ($result as $rec) {

                    $share = $rec->total_amount * 100 / $request->gross_amount;
                    $payable = $request->st_value - $request->sales_tax_amount;;
                    $wheld = $request->sales_tax_amount;
                    $bchrg = $request->bank_charges;
                    $deduction = $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100;


                    Bill_Ibr::where('id', $rec->id)->update(array(
                        'itax' => $request->income_tax_amount * $share / 100,
                        'stax_payable' => $payable * $share / 100, //Payable
                        'stax_whld' => $wheld * $share / 100, //Wheld
                        'bank_charges' => $bchrg * $share / 100, //Wheld
                        'excess' => $extraChanges * $share / 100, //Wheld
                        'deduction' => $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100, //Wheld
                        'itax_per' =>  $request->it_per_is, //Wheld
                        'tax_per' => $request->st_per, //Wheld
                        'receipt_id' => $recID, //Wheld
                        'net_amount' =>  $rec->total_amount  - $deduction + $extraChanges * $share / 100, //Wheld
                        'status' => 'Pending'
                    ));
                }
                $myreceipt = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');

                echo $myreceipt;
            } else {

                $ids = $request->ids;
                $jids = implode(",", (array) $ids);

                $jobIds = $request->jobs;
                $jobs = implode(",", (array) $jobIds);

                $instScan = $request->file('instScan');
                $slipScan = $request->file('slipScan');
                $f1 = Storage::disk('dir')->put('Documents/Livestock', $instScan);
                $f2 = Storage::disk('dir')->put('Documents/Livestock', $slipScan);

                $receipt = new Receipt();
                $receipt->receipt_date = date('Y-m-d');
                $receipt->recieved_on = $request->recieved_on;
                $receipt->region_id = $request->user()->region;
                $receipt->private = '0';
                $receipt->instrument_type = $request->instrument_id;
                $receipt->instrument_number = $request->instrument_number;
                $receipt->instrument_date = $request->instrument_date;
                $receipt->deposit_bank = $request->deposit_bank;
                $receipt->deposit_date = $request->deposit_date;
                $receipt->slip_number = $request->deposit_slip;
                $receipt->amount = $request->bill;
                $receipt->gross = $request->gross_amount;
                $receipt->remarks = $request->remarks;
                $receipt->sales_tax = $request->sales_tax;
                $receipt->taxable_amount = $request->taxable_amount;
                $receipt->ST_value = $request->st_value;
                $receipt->IT_value = $request->it_value;
                $receipt->it_per = $request->it_per_is;
                $receipt->st_per = $request->st_per;
                $receipt->income_tax_amount = $request->income_tax_amount;
                $receipt->sales_tax_amount = $request->sales_tax_amount;
                $receipt->sales_tax_pay = $request->st_value - $request->sales_tax_amount;

                $receipt->bank_charges = $request->bank_charges;
                $receipt->net = $request->net_charges;
                $receipt->extra_charges = $extraChanges;
                $receipt->created_by = $request->user()->id;
                $receipt->updated_by = $request->user()->id;
                $receipt->write_off = '0';
                $receipt->status = 'Approved';
                $receipt->bills_id = $jids;
                $receipt->jobs_number = $jobs;
                $receipt->client_copy = 'Documents/Livestock/' . basename($f1);
                $receipt->deposit_copy = 'Documents/Livestock/' . basename($f2);
                $receipt->save();

                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = "Bill No: [" . $ids . "] receipt was generated";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'Receipt | LiveStock';
                $log->save();


                // Bill_Ibr::whereIn('id', explode(',', $ids))->update(array(
                //     'status' => 'Paid'
                // ));

                $receipt = DB::table('receipts')->latest('created_at', 'desc')->first();
                $recID = $receipt->id;
                $receipt1 = Receipt::findOrFail($recID);
                $receipt1->receipt_id = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');


                $receipt1->save();

                $result = Bill_Ibr::whereIn('id', explode(',', $ids))->get();

                foreach ($result as $rec) {

                    $share = $rec->total_amount * 100 / $request->gross_amount;
                    $payable = $request->st_value - $request->sales_tax_amount;;
                    $wheld = $request->sales_tax_amount;
                    $bchrg = $request->bank_charges;
                    $deduction = $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100;


                    Bill_Ibr::where('id', $rec->id)->update(array(
                        'itax' => $request->income_tax_amount * $share / 100,
                        'stax_payable' => $payable * $share / 100, //Payable
                        'stax_whld' => $wheld * $share / 100, //Wheld
                        'bank_charges' => $bchrg * $share / 100, //Wheld
                        'excess' => $extraChanges * $share / 100, //Wheld
                        'deduction' => $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100, //Wheld
                        'itax_per' =>  $request->it_per_is, //Wheld
                        'tax_per' => $request->st_per, //Wheld
                        'receipt_id' => $recID, //Wheld
                        'net_amount' =>  $rec->total_amount  - $deduction + $extraChanges * $share / 100, //Wheld
                        'status' => 'Paid'
                    ));
                }

                $myreceipt = $request->company . '/' . $request->regprefix . '/' . $recID . '/' . date('d-m-Y');


                echo $myreceipt;
            }
        }
    }
    public function ApproveReceipt(Request $request)
    {


        $instrument = $request->instrument;
        $bankCharges = $request->bank_charges;
        $taxAmount = $request->taxable_amount;
        $saleTax = $request->sales_tax;
        $extraChanges = $request->extra_charges;
        $stper = $request->st_value;
        $recID = $request->rid;


        if ($instrument == 'OnLine Transfer') {


            $ids = $request->ids;
            $jids = implode(",", (array) $ids);

            $jobIds = $request->jobs;
            $jobs = implode(",", (array) $jobIds);


            $receipt = Receipt::findOrFail($recID);
            $receipt->receipt_date = date('Y-m-d');
            $receipt->recieved_on = $request->recieved_on;
            $receipt->region_id = $request->user()->region;
            $receipt->private = '0';
            $receipt->instrument_type = $request->instrument_id;
            $receipt->instrument_number = $request->instrument_number;
            $receipt->instrument_date = $request->instrument_date;
            $receipt->deposit_bank = $request->deposit_bank;
            $receipt->deposit_date = $request->deposit_date;
            $receipt->slip_number = $request->deposit_slip;
            $receipt->amount = $request->bill;
            $receipt->gross = $request->gross_amount;
            $receipt->remarks = $request->remarks;
            $receipt->sales_tax = $request->sales_tax;
            $receipt->taxable_amount = $request->taxable_amount;
            $receipt->ST_value = $request->st_value;
            $receipt->IT_value = $request->it_value;
            $receipt->it_per = $request->it_per_is;
            $receipt->st_per = $request->st_per;
            $receipt->income_tax_amount = $request->income_tax_amount;
            $receipt->sales_tax_amount = $request->sales_tax_amount;
            $receipt->bank_charges = $request->bank_charges;
            $receipt->extra_charges = $extraChanges;
            $receipt->net = $request->net_charges;
            $receipt->created_by = $request->user()->id;
            $receipt->updated_by = $request->user()->id;
            $receipt->deposit_copy = '';
            $receipt->client_copy = '';
            $receipt->write_off = '0';
            $receipt->bills_id = $jids;
            $receipt->jobs_number = $jobs;
            $receipt->save();


            // $result = Bill_Ibr::whereIn('id', explode(',', $ids))->get();

            // foreach ($result as $rec) {

            //     $share = $rec->total_amount * 100 / $request->gross_amount;
            //     $payable = $request->st_value - $request->sales_tax_amount;;
            //     $wheld = $request->sales_tax_amount;
            //     $bchrg = $request->bank_charges;
            //     $deduction = $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100;


            //     Bill_Ibr::where('id', $rec->id)->update(array(
            //         'itax' => $request->income_tax_amount * $share / 100,
            //         'stax_payable' => $payable * $share / 100, //Payable
            //         'stax_whld' => $wheld * $share / 100, //Wheld
            //         'bank_charges' => $bchrg * $share / 100, //Wheld
            //         'excess' => $extraChanges * $share / 100, //Wheld
            //         'deduction' => $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100, //Wheld
            //         'itax_per' =>  $request->it_per_is, //Wheld
            //         'tax_per' => $request->st_per, //Wheld
            //         'receipt_id' => $recID, //Wheld
            //         'net_amount' =>  $rec->total_amount  - $deduction + $extraChanges * $share / 100, //Wheld
            //         'status' => 'Pending'
            //     ));
            // }

            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = "Receipt: [" . $request->receiptID . "] is updated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt | Livestock';
            $log->save();
        } else if ($instrument == 'Cash') {


            $ids = $request->ids;
            $jids = implode(",", (array) $ids);

            $jobIds = $request->jobs;
            $jobs = implode(",", (array) $jobIds);
            $slipScan = $request->file('slipScan');

            $receipt = Receipt::findOrFail($recID);
            $receipt->receipt_date = date('Y-m-d');
            $receipt->recieved_on = $request->recieved_on;
            $receipt->region_id = $request->user()->region;
            $receipt->private = '0';
            $receipt->instrument_type = $request->instrument_id;
            $receipt->instrument_number = $request->instrument_number;
            $receipt->instrument_date = $request->instrument_date;
            $receipt->deposit_bank = $request->deposit_bank;
            $receipt->deposit_date = $request->deposit_date;
            $receipt->slip_number = $request->deposit_slip;
            $receipt->amount = $request->bill;
            $receipt->gross = $request->gross_amount;
            $receipt->remarks = $request->remarks;
            $receipt->sales_tax = $request->sales_tax;
            $receipt->taxable_amount = $request->taxable_amount;
            $receipt->ST_value = $request->st_value;
            $receipt->IT_value = $request->it_value;
            $receipt->it_per = $request->it_per_is;
            $receipt->st_per = $request->st_per;
            $receipt->income_tax_amount = $request->income_tax_amount;
            $receipt->sales_tax_amount = $request->sales_tax_amount;
            $receipt->bank_charges = $request->bank_charges;
            $receipt->extra_charges = $extraChanges;
            $receipt->net = $request->net_charges;
            $receipt->created_by = $request->user()->id;
            if ($slipScan != '') {
                $f2 = Storage::disk('dir')->put('Documents/Livestock', $slipScan);
                $receipt->deposit_copy = 'Documents/Livestock/' . basename($f2);
            }

            $receipt->client_copy = '';
            $receipt->updated_by = $request->user()->id;
            $receipt->write_off = '0';
            $receipt->bills_id = $jids;
            $receipt->jobs_number = $jobs;
            $receipt->save();

            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = "Receipt: [" . $request->receiptID . "] is updated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt | Livestock';
            $log->save();
        } elseif ($instrument != 'Cash' ||  $instrument != 'OnLine Transfer') {
            // $itper = $request->it_per;


            $ids = $request->ids;
            $jids = implode(",", (array) $ids);

            $jobIds = $request->jobs;
            $jobs = implode(",", (array) $jobIds);

            $instScan = $request->file('instScan');
            $slipScan = $request->file('slipScan');

            $receipt =  Receipt::findOrFail($recID);
            $receipt->receipt_date = date('Y-m-d');
            $receipt->recieved_on = $request->recieved_on;
            $receipt->region_id = $request->user()->region;
            $receipt->private = '0';
            $receipt->instrument_type = $request->instrument_id;
            $receipt->instrument_number = $request->instrument_number;
            $receipt->instrument_date = $request->instrument_date;
            $receipt->deposit_bank = $request->deposit_bank;
            $receipt->deposit_date = $request->deposit_date;
            $receipt->slip_number = $request->deposit_slip;
            $receipt->amount = $request->bill;
            $receipt->gross = $request->gross_amount;
            $receipt->remarks = $request->remarks;
            $receipt->sales_tax = $request->sales_tax;
            $receipt->taxable_amount = $request->taxable_amount;
            $receipt->ST_value = $request->st_value;
            $receipt->IT_value = $request->it_value;
            $receipt->it_per = $request->it_per_is;
            $receipt->st_per = $request->st_per;
            $receipt->income_tax_amount = $request->income_tax_amount;
            $receipt->sales_tax_amount = $request->sales_tax_amount;
            $receipt->bank_charges = $request->bank_charges;
            $receipt->net = $request->net_charges;
            $receipt->extra_charges = $extraChanges;
            $receipt->created_by = $request->user()->id;
            $receipt->updated_by = $request->user()->id;
            $receipt->write_off = '0';
            $receipt->bills_id = $jids;
            $receipt->jobs_number = $jobs;
            if ($instScan != '') {
                $f1 = Storage::disk('dir')->put('Documents/Livestock', $instScan);
                $receipt->client_copy = 'Documents/Livestock/' . basename($f1);
            }
            if ($slipScan != '') {
                $f2 = Storage::disk('dir')->put('Documents/Livestock', $slipScan);
                $receipt->deposit_copy = 'Documents/Livestock/' . basename($f2);
            }
            $receipt->save();

            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = "Receipt: [" . $request->receiptID . "] is updated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt | Livestock';
            $log->save();
        }
    }

    public function updatelog()
    {

        Bill_Ibr::updateBalanceLog();

        Bill_Ibr::updateJobBalanceLog();

    }

    // public function updateJoblog()
    // {

    //     Bill_Ibr::updateJobBalanceLog();
    // }

    public function updateBillPrism($id, Request $request)
    {
        $choice = $request->choice;

        if ($choice == "Discount") {
            $bill = Bill_Ibr::findOrFail($id);
            $old = $bill->total_amount;

                $discount = 0;
            if ($request->bill_amount < $old) {
                $discount = $old - $request->bill_amount;
                $bill->discount = $bill->discount+ $discount;
                $bill->discount_date = date('Y-m-d');
                $bill->is_discounted = 1;
            } else if($request->bill_amount > $old) {
                $bill->discount = 0;
                $bill->discount_date = '';
                $bill->is_discounted = 0;
            }

            $bill->total_amount = $request->bill_amount;
            $bill->updated_at = date("Y-m-d");
            $bill->service_charges = $request->service_charges;
            $bill->other_charges = $request->other_charges;
            $bill->tax = $request->sales_tax;
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            if($discount==0)
            {
                $log->activity = $request->bid . " Bill Was Updated from " . $old . " to " . $request->bill_amount;

            }
            else{
                $log->activity = $request->bid . " Bill Was Updated from " . $old . " to " . $request->bill_amount . " Discount Is : " . $discount;

            }
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt';
            $log->save();

            Bill_Ibr::updateBalanceLog();

        } else {



            $billold = Bill_Ibr::findOrFail($id);
            $old = $billold->total_amount;
            $outstand = $old - $request->bill_amount;

            $billold->total_amount = $request->bill_amount;
            $billold->service_charges = $request->service_charges;
            $billold->other_charges = $request->other_charges;
            $billold->tax = $request->sales_tax;
            $billold->save();

            $bill = new Bill_Ibr;
            $bill->bill_number = $billold->bill_number;
            $bill->job_number = $billold->job_number;
            $bill->bill_date = $billold->bill_date;
            $bill->total_amount = $outstand;
            $bill->discount = 0;
            $bill->recievable = $billold->recievable;
            $bill->old_debt = $billold->old_debt;
            $bill->cancalled = $billold->cancalled;
            $bill->tax = $billold->tax;
            $bill->branch = $billold->branch;
            $bill->customer = $billold->customer;
            $bill->status = $billold->status;
            $bill->service = $billold->service;
            $bill->company = $billold->company;
            $bill->bank = $billold->bank;
            $bill->net_amount = $billold->net_amount;
            $bill->itax = $billold->itax;
            $bill->bank_charges = $billold->bank_charges;
            $bill->is_written_off = $billold->is_written_off;
            $bill->is_old_debt = $billold->is_old_debt;
            $bill->stax_payable = $billold->stax_payable;
            $bill->stax_whld = $billold->stax_whld;
            $bill->service_charges = $billold->service_charges;
            $bill->receipt_id = $billold->receipt_id;
            $bill->itax_per = $billold->itax_per;
            $bill->tax_per = $billold->tax_per;
            $bill->deduction = $billold->deduction;
            $bill->excess = $billold->excess;
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->bid . " Bill Was Updated from " . $old . " to " . $request->bill_amount . " Outstanding Is : " . $outstand;
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt';
            $log->save();

            // Bill_Ibr::updateBalanceLog();

        }
    }

    public function updateBill($id, Request $request)
    {
        $choice = $request->choice;

        if ($choice == "Discount") {
            $bill = Bill_Ibr::findOrFail($id);
            $old = $bill->total_amount;

            $discount = 0;
            if ($request->bill_amount < $old) {
                $discount = $old - $request->bill_amount;
                $bill->discount = $discount;
            } else {
                $bill->discount = 0;
            }

            $bill->total_amount = $request->bill_amount;
            $bill->updated_at = date("Y-m-d");
            // $bill->updated_at ="2021-12-30";
            $bill->tax = $request->sales_tax;
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            if($discount==0)
            {
                $log->activity = $request->bid . " Bill Was Updated from " . $old . " to " . $request->bill_amount;

            }
            else{
                $log->activity = $request->bid . " Bill Was Updated from " . $old . " to " . $request->bill_amount . " Discount Is : " . $discount;

            }
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt';
            $log->save();

            Bill_Ibr::updateBalanceLog();
        } else {



            $billold = Bill_Ibr::findOrFail($id);
            $old = $billold->total_amount;
            $outstand = $old - $request->bill_amount;

            $billold->total_amount = $request->bill_amount;
            $billold->tax = $request->sales_tax;
            $billold->save();

            $bill = new Bill_Ibr;
            $bill->bill_number = $billold->bill_number;
            $bill->job_number = $billold->job_number;
            $bill->bill_date = $billold->bill_date;
            $bill->total_amount = $outstand;
            $bill->discount = 0;
            $bill->recievable = $billold->recievable;
            $bill->old_debt = $billold->old_debt;
            $bill->cancalled = $billold->cancalled;
            $bill->tax = $billold->tax;
            $bill->branch = $billold->branch;
            $bill->customer = $billold->customer;
            $bill->status = $billold->status;
            $bill->service = $billold->service;
            $bill->company = $billold->company;
            $bill->bank = $billold->bank;
            $bill->net_amount = $billold->net_amount;
            $bill->itax = $billold->itax;
            $bill->bank_charges = $billold->bank_charges;
            $bill->is_written_off = $billold->is_written_off;
            $bill->is_old_debt = $billold->is_old_debt;
            $bill->stax_payable = $billold->stax_payable;
            $bill->stax_whld = $billold->stax_whld;
            $bill->service_charges = $billold->service_charges;
            $bill->receipt_id = $billold->receipt_id;
            $bill->itax_per = $billold->itax_per;
            $bill->tax_per = $billold->tax_per;
            $bill->deduction = $billold->deduction;
            $bill->excess = $billold->excess;
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->bid . " Bill Was Updated from " . $old . " to " . $request->bill_amount . " Outstanding Is : " . $outstand;
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Receipt';
            $log->save();

            // Bill_Ibr::updateBalanceLog();

        }
    }

    public function rejectBill(Request $request)
    {


        $bills = $request->bills;
        $bids = implode(",", $bills);
        $changed = explode(",", $bids);

        $receipts = $request->rid;
        $receiptID = $request->recID;

        $result1 = Bill_Ibr::whereIn('id', $changed)->get();

        foreach ($result1 as $rec1) {

            Bill_Ibr::where('id', $rec1->id)->update(array(
                'itax' => 0,
                'stax_payable' => 0, //Payable
                'stax_whld' => 0, //Wheld
                'bank_charges' => 0, //Wheld
                'excess' =>  0, //Wheld
                'deduction' => 0, //Wheld
                'itax_per' =>  0, //Wheld
                'tax_per' => 0, //Wheld
                'receipt_id' => '', //Wheld
                'net_amount' => 0, //Wheld
                'status' => 'Receivable'
            ));
        }

        // Bill_Ibr::whereIn('id', $changed)->update(array(
        //     'status' => 'Receivable',
        // ));



        $recID = $request->rid;
        $rec = Receipt::find($recID);
        $rec->status = 'Rejected';
        $rec->save();

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Receipt No: [" . $receiptID . "] was rejected";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Receipt | Livestock';
        $log->save();
    }

    public function approveBill(Request $request)
    {
        $bills = $request->bills;
        $removed = $request->removed;

        $receipts = $request->rid;
        $receiptID = $request->recId;


        $result = Bill_Ibr::whereIn('id', $bills)->get();



        foreach ($result as $rec) {

            $share = $rec->total_amount * 100 / $request->gross_amount;
            $payable = $request->st_value - $request->sales_tax_amount;;
            $wheld = $request->sales_tax_amount;
            $bchrg = $request->bank_charges;
            $deduction = $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100;


            Bill_Ibr::where('id', $rec->id)->update(array(
                'itax' => $request->income_tax_amount * $share / 100,
                'stax_payable' => $payable * $share / 100, //Payable
                'stax_whld' => $wheld * $share / 100, //Wheld
                'bank_charges' => $bchrg * $share / 100, //Wheld
                'excess' =>  $request->extra_charges * $share / 100, //Wheld
                'deduction' => $wheld * $share / 100 +   $bchrg * $share / 100 + $request->income_tax_amount * $share / 100, //Wheld
                'itax_per' =>  $request->it_per_is, //Wheld
                'tax_per' => $request->st_per, //Wheld
                'receipt_id' => $request->rid, //Wheld
                'net_amount' =>  $rec->total_amount  - $deduction + $request->extra_charges * $share / 100, //Wheld
                'status' => 'Paid'
            ));
        }



        $result1 = Bill_Ibr::whereIn('id', $removed)->get();



        foreach ($result1 as $rec1) {

            Bill_Ibr::where('id', $rec1->id)->update(array(
                'itax' => 0,
                'stax_payable' => 0, //Payable
                'stax_whld' => 0, //Wheld
                'bank_charges' => 0, //Wheld
                'excess' =>  0, //Wheld
                'deduction' => 0, //Wheld
                'itax_per' =>  0, //Wheld
                'tax_per' => 0, //Wheld
                'receipt_id' => '', //Wheld
                'net_amount' => 0, //Wheld
                'status' => 'Receivable'
            ));
        }



        Receipt::where('id', $request->rid)->update(array(
            'status' => 'Approved'
        ));

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Receipt No: [" . $receiptID . "] was posted";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Receipt | Livestock';
        $log->save();
    }
}
