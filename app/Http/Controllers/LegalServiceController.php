<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Clear;
use App\Muccaduum;
use App\SaleTax;
use App\Bill_Ibr;
use App\Log;
use App\Legal_Service;
use App\Line_Manager;
use DataTables;
use PDF;
use File;
use App\Facility;

use Illuminate\Support\Facades\Storage;

class LegalServiceController extends Controller
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
        $user = Muccaduum::getUserCompany($uid, $token);
        return view('Legal_Service.create', compact('user'));
    }

    public function addJob(Request $request)
    {
        Legal_Service::storeLegalService($request);

        $cjob = Legal_Service::getLatestJob($request);
        $cid = $cjob->id;

        Legal_Service::addCommonJob($request, $cid);
        Legal_Service::updateJobID($request, $cid);
        Legal_Service::makeLog($request, $cid);
    }

    public function addManager(Request $request)
    {
        Line_Manager::storeLineManager($request);
    }

    public function GetTask(Request $request)
    {
        $region = $request->region_is;
        $task = DB::table('services')
            ->select('service_name')
            ->where('region_name', $region)
            ->get();
        echo $task;
    }

    public function GetLineManager(Request $request)
    {
        $manager = $request->manager_is;
        $manager = DB::table('line_manager')
            ->select('line_manager_name')
            ->get();
        echo $manager;
    }

    public function getLegalServiceJob($id)
    {
        $jobDetails = Legal_Service::getJobById($id);
        return $jobDetails;
    }

    public function updateLegalService(Request $request, $id)
    {
        Legal_Service::updateLegalService($request, $id);
        Legal_Service::updateLocalJob($request, $id);
    }

    public function holdLegalService(Request $request, $id)
    {
        Legal_Service::holdLegalService($request, $id);
    }


    public function cancelLegalService(Request $request, $id)
    {
        Legal_Service::cancelLegalService($request, $id);
    }

    public function uploadDocuments(Request $request)
    {
        $files = $request->file('files');
        $id = $request->job_id;

        foreach ($files as $file) {

            $originalName = $file->getClientOriginalName();
            $filename = Storage::disk('dir')->putFileAs('Reports/Legal/' . $id, $file, $originalName);
        }


        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $id . " documents uploaded";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Legal Services';
        $log->save();
    }

    public function getLegalServiceFiles($id)
    {

        $files = [];
        $filesInFolder = \File::files('Reports/Legal/' . $id);
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

    public function printBill(Request $request)
    {

        $jobid = $request->jobid;
        $sales = $request->sales;
        $id = $request->id;
        $branchid = $request->branch;

        $bill = Bill_Ibr::where('job_number', '=', $jobid)
            ->first();

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
        $bill->bill_date = date('Y-m-d');;
        $bill->total_amount = $total;
        $bill->service_charges = $stotal;
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
        $bill->service = 'Legal Service';
        $bill->save();




        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $request->jobid . " Bill Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Legal Service';
        $log->save();

        $billData = Legal_Service::getJobByIdForBill($id, $request->jobid);

        $tonumber = Legal_Service::convertNumberToWord($total);




        $date = date_create($billData['bill'][0]->bill_date);
        $billDate = date_format($date, "d-M-Y");

        $date1 = date_create($billData['job'][0]->bank_letter_date);
        $bankDate = date_format($date1, "d M, Y");

        if ($billData['job'][0]->given_by == "Bank") {
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
                $billData['job'][0]->customer_address,
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
        } else {




            $data = [
                $billData['bill'][0]->job_number,
                $billDate,
                $billData['job'][0]->given_by,
                $billData['job'][0]->bank_name,
                $billData['job'][0]->bank_address,
                $billData['job'][0]->cust_name,
                $billData['job'][0]->customer_address,
                $billData['job'][0]->bank_letter,
                $bankDate,
                $tonumber,
                $total,
                $billData['job'][0]->name,
                $billData['job'][0]->byvendor_address,
                "",
                $scharges,
                $tcharges,
                $stotal,
                $srate,
                $stax,



            ];
        }




        $pdf1 = PDF::loadView('Legal_Service/leginvoice', compact('data'));
        $pdf1->save('Reports/Legal/' . $id . '/invoice.pdf');
        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Legal/$id/invoice.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 5, 5);
        $pdf = $pdf->Output();

        return $pdf;
        dd($billData);
    }
}
