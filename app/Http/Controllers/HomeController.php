<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;
use App\Job;
use App\Prism;
use App\IBR;
use App\IE;
use App\Muccaduum;
use App\Inspection;
use App\Supervision;
use App\Valuation_Jobs;
use App\Legal_Service;

use App\Verification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if($request->user()->role == 5) {
            return view('Banker.index');
    
            }
            else{


                if($request->user()->service=="All")
                {
                    if ($request->ajax()) {
                        $jobs = DB::table('c_jobs')
                            ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                            ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                            ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                            ->leftJoin('verification_jobs', 'c_jobs.job_id', '=', 'verification_jobs.job_id')
                            ->leftJoin('verification_job_details', 'verification_jobs.id', '=', 'verification_job_details.job_id')
                            ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                            ->whereIn('c_jobs.status', ['0', '2'])
                            // ->where('c_jobs.service', 'Verification')
                            ->select(
                                'c_jobs.id',
                                'c_jobs.job_id',
                                'c_jobs.taken_on',
                                'c_city.city_name',
                                'c_jobs.service',
                                'c_bank.bank_name',
                                'verification_job_details.applicant_name as cust_name',
                                'c_jobs.company_id'
                            )
                            ->get();
                        return Datatables::of($jobs)
                            ->addIndexColumn()
                            ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                            ->rawColumns(['action'])
                            ->editColumn('taken_on', function ($jobs) {
                                return date('d-M-Y', strtotime($jobs->taken_on));
                            })->make(true);
                    }

                            $uid = $request->user()->company;
                            $token = $request->session()->get('token');
                            $user = Supervision::getUserCompany($uid, $token);
                            return view('home', compact('user'));
                            // return view('home');
                }
                else if($request->user()->service=="Billing")
                {
                    return view('Bill.bills');

                }

                else if($request->user()->service=="Livestock")
                {
                    if ($request->ajax()) {
                        $jobs = DB::table('c_jobs')
                            ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                            ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                            ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                            ->leftJoin('verification_jobs', 'c_jobs.job_id', '=', 'verification_jobs.job_id')
                            ->leftJoin('verification_job_details', 'verification_jobs.id', '=', 'verification_job_details.job_id')
                            ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                            ->whereIn('c_jobs.status', ['0', '2'])
                            ->where('c_jobs.service', 'Livestock')
                            ->select(
                                'c_jobs.id',
                                'c_jobs.job_id',
                                'c_jobs.taken_on',
                                'c_city.city_name',
                                'c_jobs.service',
                                'c_bank.bank_name',
                                'c_customer.cust_name as cust_name',
                                'c_jobs.company_id'
                            )
                            ->get();
                        return Datatables::of($jobs)
                            ->addIndexColumn()
                            ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                            ->rawColumns(['action'])
                            ->editColumn('taken_on', function ($jobs) {
                                return date('d-M-Y', strtotime($jobs->taken_on));
                            })->make(true);
                    }
                            return view('homeins');
                
             
                }
                else if($request->user()->service=="Prism")
                {

  
                    if ($request->ajax()) {

                            $jobs = DB::select('call GetPrismActiveJobs()');
                            

                        return Datatables::of($jobs)
                            ->addIndexColumn()
                            ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary ac-btn">Edit</a>')
                            ->rawColumns(['action'])
                            ->editColumn('taken_on', function ($jobs) {
                                return date('d-M-Y', strtotime($jobs->taken_on));
                            })->make(true);
                    }

                            $uid = $request->user()->company;
                            $token = $request->session()->get('token');
                            $user = Supervision::getUserCompany($uid, $token);
                            return view('homeprism',compact('user'));
                
             
                }
                else if($request->user()->service=="Verification")
                {
                    if ($request->ajax()) {
                        // $jobs = DB::table('c_jobs')
                        //     ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                        //     ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                        //     ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                        //     ->leftJoin('verification_jobs', 'c_jobs.job_id', '=', 'verification_jobs.job_id')
                        //     ->leftJoin('verification_job_details', 'verification_jobs.id', '=', 'verification_job_details.job_id')
                        //     ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                        //     ->whereIn('c_jobs.status', ['0', '2'])
                        //     ->where('c_jobs.service', 'Verification')
                        //     ->select(
                        //         'c_jobs.id',
                        //         'c_jobs.job_id',
                        //         'c_jobs.taken_on',
                        //         'c_city.city_name',
                        //         'c_jobs.service',
                        //         'c_bank.bank_name',
                        //         'verification_job_details.applicant_name as cust_name',
                        //         'c_jobs.company_id'
                        //     )    
                        //     ->get();

                       
                            $jobs = DB::select('call VerificationJobsRunning()');
                            // ->select(
                            //     'id',
                            //     'job_id',
                            //     'taken_on',
                            //     'status',
                            //     'bank_name',
                            //     'cust_name',
                            //     'city',
                            //     'area'
                            // )
                            // ->whereIn('status', ['0', '2'])
                            // ->get();
                        return Datatables::of($jobs)
                            ->addIndexColumn()
                            ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
                            ->rawColumns(['action'])
                            ->editColumn('taken_on', function ($jobs) {
                                return date('d-M-Y', strtotime($jobs->taken_on));
                            })->make(true);
                    }
                    $banks = DB::table('c_bank')
                            ->select(
                            'c_bank.bank_id',
                            'c_bank.bank_name'
                        )    
                        ->get();

                        $cities = DB::table('c_city')
                        ->select(
                        'c_city.city_id',
                        'c_city.city_name',
                        )    
                        ->get();
                    $data=[
                        'banks'=>$banks,
                        'cities'=>$cities
                    ];
                            return view('homeav',compact('data'));
                
             
                }

            }
        

        // return view('home');
        // return view('Debt.index');
    }
    public function verificationav(Request $request){
        
        $jobs = DB::table('verification_jobs_all');
        $jobs->select(
            'id',
            'job_id',
            'taken_on',
            'status',
            'bank_name',
            'cust_name',
            'city',
            'area'
        );
        if($request->status!="")
        {
            $jobs->where('status', $request->status);

        }

        if($request->bank!=""){
            $jobs->where('bank_name',$request->bank);

        }

        if($request->city!=""){
            $jobs->where('city',$request->city);

        }
        $jobs->get();
    return Datatables::of($jobs)
        ->addIndexColumn()
        ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
        ->rawColumns(['action'])
        ->editColumn('taken_on', function ($jobs) {
            return date('d-M-Y', strtotime($jobs->taken_on));
        })->make(true);
    }

    public function editJob(Request $request, $id)
    {

        $job = Job::findOrFail($id);
        $jobid = $job->job_id;
        $service = $job->service;

        if ($service == 'IBR') {

            $ibrjob = IBR::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $ibrjob[0]->id,
                $id,
                $ibrjob[0]->company_id
            ];

            return view('IBR.edit', compact('data'));
        }

        if ($service == 'Valuation') {
            $token = $request->session()->get('token');
            $valuationjob = Valuation_Jobs::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $valuationjob[0]->id,
                $id,
                $valuationjob[0]->company_id,
                $token
            ];

            return view('Valuation.edit', compact('data'));
        }

        if ($service == 'Muccadam') {
            $token = $request->session()->get('token');
            $mucjob = Muccaduum::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $mucjob[0]->id,
                $id,
                $mucjob[0]->company_id,
                $token
            ];

            return view('Muccaduum.edit', compact('data'));
        }
        if ($service == 'Income Estimation') {
            $token = $request->session()->get('token');
            $iejob = IE::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $iejob[0]->id,
                $id,
                $iejob[0]->company_id,
                $token
            ];

            return view('IE.edit', compact('data'));
        }

        if ($service == 'Livestock') {
            $token = $request->session()->get('token');
            $inspectionJob = Inspection::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $inspectionJob[0]->id,
                $id,
                $inspectionJob[0]->company_id,
                $token
            ];

            return view('Inspection.edit', compact('data'));
        }
        if ($service == 'Verification') {
            $token = $request->session()->get('token');
            $verificationJob = Verification::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $verificationJob[0]->id,
                $id,
                $verificationJob[0]->company_id,
                $token
            ];

            return view('Verification.edit', compact('data'));
        }

        if ($service == 'Prism') {
            $token = $request->session()->get('token');
            $prism = Prism::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $prism[0]->id,
                $id,
                $prism[0]->company_id,
                $token
            ];

            return view('Prism.edit', compact('data'));
        }
        if ($service == 'Muccadum') {
            // $token=$request->session()->get('token');
            // $verificationJob=Verification::where('job_id',$jobid)
            // ->select('*')
            // ->get();

            // $data=[
            //     $jobid,
            //     $verificationJob[0]->id,
            //     $id,
            //     $verificationJob[0]->company_id,
            //     $token
            // ];

            // return view('Muccaduum.edit',compact('data'));
            return view('Muccaduum.edit');
        }

        if ($service == 'Supervision') {

            $token = $request->session()->get('token');
            $supervisionJob = Supervision::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $supervisionJob[0]->id,
                $id,
                $supervisionJob[0]->company_id,
                $token
            ];
            return view('Supervision.edit', compact('data'));
        }
        if ($service == 'Clearing') {

            return view('Clearing.edit');
        }

        if ($service == 'BIR') {

            return view('bir.edit');
        }

        if ($service == 'IE') {

            return view('IE.edit');
        }
        if ($service == 'LCR') {

            return view('LCR.edit');
        }
        if ($service == 'MVR') {

            return view('MVR.edit');
        }
        if ($service == 'Legal Service') {

            $token = $request->session()->get('token');
            $verificationJob = Legal_Service::where('job_id', $jobid)
                ->select('*')
                ->get();

            $data = [
                $jobid,
                $verificationJob[0]->id,
                $id,
                $verificationJob[0]->company_id,
                $token
            ];


            return view('Legal_Service.edit', compact('data'));
        }
        if ($service == 'MCR') {

            return view('MCR.edit');
        }
    }
}
