<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Valuation_Jobs;
use App\Valuation;
use App\Valuation_Vehicles;
use App\Log;
use App\SaleTax;
use App\Bill_Ibr;
use DataTables;
use PDF;
use File;
use Illuminate\Support\Facades\DB;

class ValuationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");
    }

    public function getValuationData(Request $request)
    {
        if ($request->ajax()) {
            $jobs = DB::table('c_jobs')
                ->where('c_jobs.service','=','Valuation')
                ->leftJoin('c_region', 'c_jobs.region_id', '=', 'c_region.reg_id')
                ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                ->leftJoin('ibr_vendors', 'c_jobs.byvendor_id', '=', 'ibr_vendors.id')
                ->leftJoin('c_customer', 'c_jobs.customer_id', '=', 'c_customer.cust_id')
                ->leftJoin('c_bank', 'c_jobs.bank_id', '=', 'c_bank.bank_id')
                ->select(
                    'c_jobs.id',
                    'c_jobs.job_id',
                    'c_jobs.taken_on',
                    'c_jobs.status',
                    'c_city.city_name',
                    // 'c_jobs.service',
                    'c_bank.bank_name',
                    'ibr_vendors.name',
                    'c_customer.cust_name',
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
    }
    public function index(Request $request)
    {
        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Valuation::getUserCompany($uid, $token);
        return view('Valuation.create', compact('user'));
    }


    public function getCategory()
    {

        $categories = Valuation::catDetails();
        return $categories;
    }

    public function getConsultants()
    {

        $consultants = Valuation::getConsultants();
        return $consultants;
    }

    public function getDistricts()
    {

        $districts = Valuation::getDistricts();
        return $districts;
    }

    public function getSubcategory($id)
    {

        $subcategories = Valuation::getCategoryById($id);
        return $subcategories;
    }

    public function addJob(Request $request)
    {


        Valuation::storeValuation($request);
        $cjob = Valuation::getLatestJob($request);
        $cid = $cjob->id;
        Valuation::addCommonJob($request, $cid);
        Valuation::updateJobID($request, $cid);

        if ($request->main_category_name == 'Vehicle') {
            Valuation::addVehicle($request, $cid);
        }
        Valuation::makeLog($request, $cid);
    }

    public function getValuationJob($id)
    {
        $jobDetails = Valuation::getJobById($id);
        return $jobDetails;
    }

    public function getEmployees()
    {

        $employees = Valuation::getEmployees();
        return $employees;
    }

    public function getEmployeesById($id)
    {

        $employees = Valuation::getEmployeesById($id);
        return $employees;
    }

    public function updateValuation(Request $request, $id)
    {
        Valuation::updateValuation($request, $id);
    }

    public function uploadFinal(Request $request)
    {
        $file = $request->file('myfile');
        $filext = $request->file('myfile')->extension();


        if ($filext != "pdf") {
            return response()->json('Unsupported');
        } else {

            $id = $request->job_id;
            $filename = Valuation::uploadFinal($request, $id, $file);
            return response()->json($filename);
        }
    }
    public function getFinalReport($id)
    {
        $file = Valuation::getFinalReport($id);
        return $file;
    }
    public function uploadDocuments(Request $request)
    {

        Valuation::uploadDocuments($request);
    }
    public function uploadValuationImages(Request $request)
    {


        $file = $request->file('myfile');
        $filext = $request->file('myfile')->extension();
        $id = $request->job_id;
        $ftype = $request->filename;
        $filename = Valuation::uploadImage($request, $id, $file, $filext, $ftype);
        return response()->json($filename);
    }

    public function deleteVehicleImage(Request $request, $id)
    {
        $image = $request->image;
        $file = Valuation::deleteVehicleImage($id, $image);

        return response()->json('Record Deleted');
    }

    public function getFiles($id)
    {

        $files = [];
        $filesInFolder = \File::files('Reports/Valuation/' . $id);
        foreach ($filesInFolder as $path) {

            $file = pathinfo($path);
            array_push($files, $file['filename'] . "." . $file['extension']);
        }
        if ($files == []) {
            return 'No Files';
        } else {
            return $files;
        }
    }
    public function getTypes()
    {
        return Valuation::getTypes();
    }

    public function getImages($id)
    {
        $images = Valuation::getImages($id);
        return $images;
    }
    public function updateBrightStatus(Request $request, $id)
    {
        Valuation::updateBrightStatus($request, $id);
        return response()->json('Updated Successfully');
    }
    public function updateHalfStatus(Request $request, $id)
    {
        Valuation::updateHalfStatus($request, $id);
        return response()->json('Updated Successfully');
    }

    public function printReportASKBL(Request $request, $id)
    {
        // return Valuation::generateBAHReport($request,$id);
        //     $vehiclefrontimage=VehicleImage::where('job_id',$id)->where('type',8)
        //  ->first();

        // if($bankName=='ASKBL')
        // {
        return Valuation::generateASKBLReport($request, $id);

        // }
        //  elseif($bankName=='MZN'){

        //     return Valuation::generateBAHReport($request,$id);

        // }
        //Askari Bank Limited

        //Mezzan Bank //Bank Al Habib

        // return Valuation::generateBAFReport($request,$id);
        // return Valuation::generateMCBReport($request,$id);

    }

    public function printReportBAH(Request $request, $id)
    {
        return Valuation::generateBAHReport($request, $id);
        //     $vehiclefrontimage=VehicleImage::where('job_id',$id)->where('type',8)
        //  ->first();

        // if($bankName=='ASKBL')
        // {
        // return Valuation::generateASKBLReport($request,$id);

        // }
        //  elseif($bankName=='MZN'){

        //     return Valuation::generateBAHReport($request,$id);

        // }
        //Askari Bank Limited

        //Mezzan Bank //Bank Al Habib

        // return Valuation::generateBAFReport($request,$id);
        // return Valuation::generateMCBReport($request,$id);

    }

    public function storeReportData(Request $request, $id)
    {
        return  Valuation::storeReportData($request, $id);
    }

    public function getReportDetails(Request $request, $id)
    {
        return Valuation::getReportDetails($request, $id);
    }
    public function getClasses()
    {
        return Valuation::getClasses();
    }

    public function getBodyTypes()
    {
        return Valuation::getBodyTypes();
    }

    public function getRimTypes()
    {
        return Valuation::getRimTypes();
    }

    public function printBill(Request $request)
    {

        $jobid = $request->jobid;
        $sales = $request->sales;
        $id = $request->id;
        $branchid = $request->branch;
        $billDate = $request->billDate;

        $bill = Bill_Ibr::where('job_number', '=', $jobid)
            ->first();

        $branchRegion = DB::table('c_branch')
            ->where('c_branch.branch_id', $branchid)
            ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
            ->select('c_city.city_name')
            ->get();


        // $reportDetails = DB::table('inspection_livestock_details')
        //     ->where('job_id', $id)
        //     ->select('bill_date')
        //     ->get();




        if (empty($bill)) {

            $scharges = $request->service == '' ? 0 : $request->service;
            $tcharges = $request->travel_charges == '' ? 0 : $request->travel_charges;
            $stotal = $scharges + $tcharges;
            $srate = 0;
            if ($request->sales == null) {
                $stax = 0;
            } else {
                $sale_reg = DB::table('sales_tax')
                    ->where('region', $request->sales)
                    ->select('rate')
                    ->get();
                $rate = $sale_reg[0]->rate / 100;
                $srate = $sale_reg[0]->rate;
                $stax = $stotal * $rate;
            }


            $total = $stotal + $stax;
            $vletter = $request->vendorletter;

            $date = date_create($request->bank_date);
            $bankDate = date_format($date, "d-M-Y");
            $data = [

                $request->bank,
                $request->address,
                $request->jobid,
                // $request->company_address,
                $request->bank_letter,
                $bankDate,
                'Valuation',
                $total,
                $request->customer,
                $request->vendor,
                $request->customerAddress,
                $request->vendorAddress,
                $branchRegion[0]->city_name,



            ];

            $id = $request->id;

            $giver = $request->givenby;

            $bill = new Bill_Ibr;
            $bill->bill_number = $data[2];
            $bill->job_number = $data[2];
            $bill->bill_date = $billDate;
            $bill->total_amount = $total;
            $bill->tax = $stax;
            $bill->discount = '0';
            $bill->recievable = $request->region;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bankID;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch;
            $bill->customer = $request->customerIs;
            $bill->status = 'Receivable';
            $bill->service = 'Valuation';
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $data[3] . " Bill Was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Valuation|Livestock';
            $log->save();


            $billData = Valuation::getJobByIdForBill($id, $request->jobid);

            $tonumber = Valuation::convertNumberToWord($total);


            $date = date_create($billData['bill'][0]->bill_date);
            $billDate = date_format($date, "d-M-Y");

            $date1 = date_create($billData['job'][0]->bank_letter_date);
            $bankDate = date_format($date1, "d M, Y");


            $data = [
                $billData['bill'][0]->job_number,
                $billDate,
                $billData['job'][0]->given_by,
                $billData['job'][0]->bank_name,
                $billData['job'][0]->bank_address,
                $billData['job'][0]->cust_name,
                // $billData['job'][0]->customer_address,
                $billData['job'][0]->bank_letter,
                $bankDate,
                $tonumber,
                $total,
                $billData['job'][0]->name,
                $billData['job'][0]->byvendor_address,
                $branchRegion[0]->city_name,
                $scharges,
                $tcharges,
                $stotal,
                $srate,
                $stax,

            ];
            // $pdf1 = PDF::loadView('V/insinvoice', compact('data'));
            // $pdf1->save('Reports/Inspection/' . $id . '/invoice.pdf');
            // $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

            // $pdf->AddPage();
            // $pdf->setSourceFile("Reports/Inspection/$id/invoice.pdf");
            // $tplIdx = $pdf->importPage(1);
            // $pdf->useTemplate($tplIdx, 5, 5);
            // $pdf = $pdf->Output();

            // return $pdf;
            echo 'working';
        } else {
            $scharges = $request->service == '' ? 0 : $request->service;
            $tcharges = $request->travel_charges == '' ? 0 : $request->travel_charges;
            $stotal = $scharges + $tcharges;
            $srate = 0;
            if ($request->sales == null) {
                $stax = 0;
            } else {
                $sale_reg = DB::table('sales_tax')
                    ->where('region', $request->sales)
                    ->select('rate')
                    ->get();
                $rate = $sale_reg[0]->rate / 100;
                $srate = $sale_reg[0]->rate;
                $stax = $stotal * $rate;
            }


            $total = $stotal + $stax;

            $vletter = $request->vendorletter;
            $giver = $request->givenby;


            $id = $request->id;

            //File::delete('Reports/IBR/'.$id.'/bill.pdf');




            $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
            $bill->bill_number = $request->jobid;
            $bill->job_number = $request->jobid;
            $bill->bill_date = $billDate;
            $bill->total_amount = $total;
            $bill->tax = $stax;
            $bill->discount = '0';
            $bill->recievable = $request->region;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bankID;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch;
            $bill->customer = $request->customerIs;
            $bill->status = 'Receivable';
            $bill->service = 'Valuation';
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->jobid . " Bill Was Updated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Valuation|Livestock';
            $log->save();

            $billData = Valuation::getJobByIdForBill($id, $request->jobid);

            $tonumber = Valuation::convertNumberToWord($total);


            $date = date_create($billData['bill'][0]->bill_date);
            $billDate = date_format($date, "d-M-Y");

            $date1 = date_create($billData['job'][0]->bank_letter_date);
            $bankDate = date_format($date1, "d M, Y");

            $branchRegion = DB::table('c_branch')
                ->where('c_branch.branch_id', $billData['bill'][0]->branch)
                ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
                ->select('c_city.city_name')
                ->get();


            $data = [
                $billData['bill'][0]->job_number,
                $billDate,
                $billData['job'][0]->given_by,
                $billData['job'][0]->bank_name,
                $billData['job'][0]->bank_address,
                $billData['job'][0]->cust_name,
                // $billData['job'][0]->customer_address,
                $billData['job'][0]->bank_letter,
                $bankDate,
                $tonumber,
                $total,
                $billData['job'][0]->name,
                $billData['job'][0]->byvendor_address,
                $branchRegion[0]->city_name,
                $scharges,
                $tcharges,
                $stotal,
                $srate,
                $stax,



            ];
            // $pdf1 = PDF::loadView('Inspection/insinvoice', compact('data'));
            // $pdf1->save('Reports/Inspection/' . $id . '/invoice.pdf');
            // $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

            // $pdf->AddPage();
            // $pdf->setSourceFile("Reports/Inspection/$id/invoice.pdf");
            // $tplIdx = $pdf->importPage(1);
            // $pdf->useTemplate($tplIdx, 5, 5);
            // $pdf = $pdf->Output();

            // return $pdf;
            // return true;
            echo 'working';
            // dd($billData);
        }
    }
}
