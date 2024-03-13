<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use DataTables;
use App\Company;
use App\Supervision;
use App\Valuation;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->user()->role == 5) {
        return view('Banker.index');

        }
        else{
        return view('home');

        }
    }

    public function muccaduum(Request $request)
    {

        if ($request->ajax()) {
            $jobs = DB::table('c_jobs')
                ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                ->where('c_jobs.service', '=', 'Muccadam')
                ->select(
                    'c_jobs.id',
                    'c_jobs.job_id',
                    'c_jobs.taken_on',
                    'c_city.city_name',
                    'c_jobs.service',
                    'c_jobs.status',
                    'c_bank.bank_name',
                    'c_customer.cust_name',
                    'c_jobs.company_id'
                )
                ->get();
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }
        return view('Muccaduum.muccaduum');
    }


    public function supervision(Request $request)
    {
        if ($request->ajax()) {
            $jobs = DB::table('c_jobs')
                ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                ->where('c_jobs.service', '=', 'Supervision')
                ->select(
                    'c_jobs.id',
                    'c_jobs.job_id',
                    'c_jobs.taken_on',
                    'c_city.city_name',
                    'c_jobs.service',
                    'c_jobs.status',
                    'c_bank.bank_name',
                    'c_customer.cust_name',
                    'c_jobs.company_id'
                )
                ->get();
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }


        return view('Supervision.index');
    }

    public function clearing()
    {
        return view('Clearing.index');
    }

    public function legal_service(Request $request)
    {

        if ($request->ajax()) {
            $jobs = DB::table('c_jobs')
                ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                ->where('c_jobs.service', '=', 'Legal Service')
                ->select(
                    'c_jobs.id',
                    'c_jobs.job_id',
                    'c_jobs.taken_on',
                    'c_city.city_name',
                    'c_jobs.service',
                    'c_jobs.status',
                    'c_bank.bank_name',
                    'c_customer.cust_name',
                    'c_jobs.company_id'
                )
                ->get();
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }

        return view('Legal_Service.index');
    }


    public function inspection(Request $request)
    {
        if ($request->ajax()) {
            $jobs = DB::table('c_jobs')
                ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                ->where('c_jobs.service', '=', 'Livestock')
                ->select(
                    'c_jobs.id',
                    'c_jobs.job_id',
                    'c_jobs.taken_on',
                    'c_city.city_name',
                    'c_jobs.service',
                    'c_jobs.status',
                    'c_bank.bank_name',
                    'c_customer.cust_name',
                    'c_jobs.company_id'
                )
                ->get();
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }

        return view('Inspection.inspection');
    }

    public function prism(Request $request)
    {
        if ($request->ajax()) {
                $jobs = DB::select('call GetPrismAllJobs()');
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }

        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Supervision::getUserCompany($uid, $token);
        return view('Prism.index',compact('user'));

    

      

    }

    // public function prism(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $jobs = DB::table('c_jobs')
    //             ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
    //             ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
    //             ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
    //             ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
    //             ->where('c_jobs.service', '=', 'Livestock')
    //             ->select(
    //                 'c_jobs.id',
    //                 'c_jobs.job_id',
    //                 'c_jobs.taken_on',
    //                 'c_city.city_name',
    //                 'c_jobs.service',
    //                 'c_jobs.status',
    //                 'c_bank.bank_name',
    //                 'c_customer.cust_name',
    //                 'c_jobs.company_id'
    //             )
    //             ->get();
    //         return Datatables::of($jobs)
    //             ->addIndexColumn()
    //             ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
    //             ->rawColumns(['action', 'status'])
    //             ->editColumn('taken_on', function ($jobs) {
    //                 return date('d-M-Y', strtotime($jobs->taken_on));
    //             })->make(true);
    //     }

    //     return view('Inspection.inspection');
    // }
    public function verification(Request $request)
    {
        if ($request->ajax()) {
                $jobs = DB::select('call VerificationJobsAll()');
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }

        return view('Verification.index');

    

      

    }
    public function inspectionByParam(Request $request)
    {

        $jobs = DB::table('c_jobs')
            ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
            ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
            ->where('c_jobs.status', '=', '2')
            ->select(
                'c_jobs.id',
                'c_jobs.job_id',
                'c_jobs.taken_on',
                'c_city.city_name',
                'c_jobs.service',
                'c_jobs.status',
                'c_bank.bank_name',
                'c_customer.cust_name',
                'c_jobs.company_id'
            )
            ->get();
        return Datatables::of($jobs)
            ->addIndexColumn()
            ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
            ->rawColumns(['action', 'status'])
            ->editColumn('taken_on', function ($jobs) {
                return date('d-M-Y', strtotime($jobs->taken_on));
            })->make(true);
    }

    public function valuation()
    {
        return view('Valuation.index');
    }

    public function ibr(Request $request)
    {
        // $uid=$request->user()->company;
        // $record=Company::where('company_id',$uid)
        // ->select('*')
        // ->get();
        // $user=[
        //     $request->user()->company,
        //     $record[0]
        // ];
        // return view('IBR.create',compact('user'));

        return view('IBR.ibr');
    }

    public function ibrCreate(Request $request)
    {

        $uid = $request->user()->company;
        $record = Company::where('company_id', $uid)
            ->select('*')
            ->get();

        $user = [
            $request->user()->company,
            $record[0]
        ];
        return view('IBR.create', compact('user'));
    }

    function debtCreate(Request $request)
    {
        $uid = $request->user()->company;
        $record = Company::where('company_id', $uid)
            ->select('*')
            ->get();

        $user = [
            $request->user()->company,
            $record[0]

        ];
        return view('Debt.create', compact('user'));
    }

    public function inspectionCreate(Request $request)
    {
        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Valuation::getUserCompany($uid, $token);
        return view('Inspection.create', compact('user'));
    }

    public function bir()
    {
        return view('BIR.index');
    }

    public function ie(Request $request)
    {

        if ($request->ajax()) {
            $jobs = DB::table('c_jobs')
                ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                ->where('c_jobs.service', '=', 'Income Estimation')
                ->select(
                    'c_jobs.id',
                    'c_jobs.job_id',
                    'c_jobs.taken_on',
                    'c_city.city_name',
                    'c_jobs.service',
                    'c_jobs.status',
                    'c_bank.bank_name',
                    'c_customer.cust_name',
                    'c_jobs.company_id'
                )
                ->get();
            return Datatables::of($jobs)
                ->addIndexColumn()
                ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                ->rawColumns(['action', 'status'])
                ->editColumn('taken_on', function ($jobs) {
                    return date('d-M-Y', strtotime($jobs->taken_on));
                })->make(true);
        }
        return view('IE.index');
    }

    public function lcr()
    {
        return view('LCR.index');
    }

    public function mcr()
    {
        return view('MCR.index');
    }

    public function mvr()
    {
        return view('MVR.index');
    }

    public function receipts(Request $request)
    {
        $role = $request->user()->role;

        if ($role == 3) {

            $uid = $request->user()->company;
            $uregion = $request->user()->region;

            $record = Company::where('company_id', $uid)
                ->select('*')
                ->get();


            $region = DB::table('c_region')
                ->join('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->select('c_city.city_name', 'c_region.reg_id', 'c_region.reg_prefix')
                ->where('c_region.reg_id', '=', $uregion)
                ->get();


            $user = [
                $uid,
                $record[0],
                $uregion,
                $region[0]->city_name,
                $region[0]->reg_prefix,
                $request->user()->service

            ];
            return view('Bill.index', compact('user'));
        } else {

            abort(404);
        }
    }
}
