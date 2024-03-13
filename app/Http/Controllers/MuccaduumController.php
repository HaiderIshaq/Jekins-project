<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Muccaduum;
use App\SaleTax;
use App\Bill_Ibr;
use App\Log;
use DataTables;
use PDF;
use Illuminate\Support\Facades\Storage;

class MuccaduumController extends Controller
{
    public function index()
    {
        return view('Muccaduum.index');
    }
    
    public function addJob(Request $request)
    {

        Muccaduum::storeMuccaduum($request);
        $cjob = Muccaduum::getLatestJob($request);
        $cid = $cjob->id;
        Muccaduum::addCommonJob($request, $cid);
        Muccaduum::updateJobID($request, $cid);

    }

    public function getMucJob($id)
    {
        $jobDetails = Muccaduum::getJobById($id);
        return $jobDetails;
    }
    public function create(Request $request)
    {

        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Muccaduum::getUserCompany($uid, $token);
        return view('Muccaduum.create', compact('user'));
    
        // return view('Muccadum.create');
    }

    public function updateMuccaddumJob(Request $request,$id)
     {
        Muccaduum::updateMuccaddum($request, $id);
        Muccaduum::updateLocalJob($request, $id);
     
    }


    public function printBill(Request $request)
    {

        $jobid = $request->jobid;
        $sales = $request->sales;
        $id = $request->id;
        $branchid = $request->branch;

        $bill = Bill_Ibr::where('job_number', '=', $jobid)
            ->first();

        $branchRegion = DB::table('c_branch')
            ->where('c_branch.branch_id', $branchid)
            ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
            ->select('c_city.city_name')
            ->get();


        $reportDetails = DB::table('inspection_livestock_details')
            ->where('job_id', $id)
            ->select('bill_date')
            ->get();




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
                'Muccadam',
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
            $bill->bill_date = date('Y-m-d');
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
            $bill->service = 'Muccadam';
            $bill->save();




            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $data[3] . " Bill Was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Muccadam';
            $log->save();


            $billData = Muccadum::getJobByIdForBill($id, $request->jobid);

            $tonumber = Muccadum::convertNumberToWord($total);



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
            $pdf1 = PDF::loadView('Muccaduum/insinvoice', compact('data'));
            $pdf1->save('Reports/Muccaduum/' . $id . '/invoice.pdf');
            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

            $pdf->AddPage();
            $pdf->setSourceFile("Reports/Muccaduum/$id/invoice.pdf");
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 5, 5);
            $pdf = $pdf->Output();

            return $pdf;
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
            $bill->bill_date =date('Y-m-d');
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
            $bill->service = 'Muccadam';
            $bill->save();




            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->jobid . " Bill Was Updated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Muccadam';
            $log->save();

            $billData = Muccaduum::getJobByIdForBill($id, $request->jobid);

            $tonumber = Muccaduum::convertNumberToWord($total);




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
            $pdf1 = PDF::loadView('Muccaduum/insinvoice', compact('data'));
            $pdf1->save('Reports/Muccaduum/' . $id . '/invoice.pdf');
            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

            $pdf->AddPage();
            $pdf->setSourceFile("Reports/Muccaduum/$id/invoice.pdf");
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 5, 5);
            $pdf = $pdf->Output();

            return $pdf;
            dd($billData);
        }
    }
    
}
