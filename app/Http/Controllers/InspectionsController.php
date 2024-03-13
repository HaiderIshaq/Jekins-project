<?php

namespace App\Http\Controllers;

use App\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Muccaduum;
use App\SaleTax;
use App\Bill_Ibr;
use App\Log;
use DataTables;

use App\Facility;
use PDF;
use Illuminate\Support\Facades\Storage;

class InspectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");
    }
    public function getMuccadums()
    {

        $muccadums = Muccaduum::all();
        return $muccadums;
    }
    public function getFacilities()
    {

        $facilities = Facility::all();
        return $facilities;
    }

    public function addJob(Request $request)
    {
        Inspection::storeInspection($request);
        $cjob = Inspection::getLatestJob($request);
        $cid = $cjob->id;
        Inspection::addCommonJob($request, $cid);
        Inspection::addDefaultDetailsofanimals($cid);
        Inspection::updateJobID($request, $cid);
        Inspection::addLivestockJob($cid);
        Inspection::makeLog($request, $cid);

        $job = DB::table('bank_representative')
        ->where('bank_representative', $request->bank_representative)
        ->select('*')
        ->get();

        if($job->isEmpty())
        {
            DB::table('bank_representative')->insert([
            'bank_id'=>$request->bank_id,
            'branch_id'=>$request->branch_id,
            'bank_representative'=>$request->bank_representative,
            'bank_designation'=>$request->bank_designation,
            'bank_email'=>$request->bank_email
            ]);

        }
        else{
            echo 'found';

        }


       
    }

    public function saveInsReport(Request $request, $id)
    {
        Inspection::storeLivestockDetails($request, $id);
    }
    public function getLivestockMis()
    {
        $recs = Inspection::getLivestockMISDetails();
        $collection = collect([]);

        foreach($recs as $rec)
        {
        $details = Inspection::getAnimalsDetails($rec->jid);
        $collection->push(
            [
                'job_id' => $rec->job_id,
                'bill_date' => $rec->bill_date,
                'bank_code' => $rec->bank_code,
                'bank_address' => $rec->bank_address,
                'cust_name' => $rec->cust_name,
                'customer_cnic' => $rec->customer_cnic,
                'total_bill' => $rec->total_bill,
                'cow_milking_local' =>$details["cow_milking_local"],
                'buffalow_milking_local' =>$details["buffalow_milking_local"],
                'milking_imported' =>$details["milking_imported"],
                'cow_non_milking_local' =>$details["cow_non_milking_local"],
                'buffalow_non_milking_local' =>$details["buffalow_non_milking_local"],
                'non_milking_imported' =>$details["non_milking_imported"]
            ]
        );
        }
       
        $collection->all();
        return $collection;
        

        // echo $records["buffalow_milking_local"];
      

        // return Datatables::of($records)
        //     ->addIndexColumn()
        //     // ->addColumn('action', '<a href="/edit/{{$id}}" class="btn btn-primary">Edit</a>')
        //     // ->rawColumns(['action', 'status'])
        //     // ->editColumn('taken_on', function ($jobs) {
        //     //     return date('d-M-Y', strtotime($jobs->taken_on));
        //     // })
        //     ->make(true);
    }


    public function cancelInspection(Request $request, $id)
    {
        Inspection::cancelInspection($request, $id);
    }
    public function holdInspection(Request $request, $id)
    {
        Inspection::holdInspection($request, $id);
    }
    // public function printBill(Request $request){

    //     $id=1;
    //     // $pdf1 = PDF::loadView('invoice1',compact('data'));
    //             $pdf1 = PDF::loadView('Inspection/insinvoice');

    //             $pdf1->save('Reports/Inspection/'.$id.'/invoice.pdf');
    //             $pdf = new \setasign\Fpdi\Fpdi('P','mm',array(210,297));

    //             $pdf->AddPage();
    //             $pdf->setSourceFile("Reports/Inspection/$id/invoice.pdf");
    //             $tplIdx = $pdf->importPage(1);
    //             $pdf->useTemplate($tplIdx, 5, 5);
    //             $pdf->Output();
    // }

    public function getBankRepresentatives(Request $request, $id){
        
        $jobs = DB::table('bank_representative')
        ->where('branch_id', $id)
        ->select('*')
        ->get();

        return $jobs;
    }
    public function getBankRepresentativesDetails(Request $request){

        $jobs = DB::table('bank_representative')
        ->where('bank_representative', $request->representative)
        ->select('*')
        ->get();

        return $jobs;
    }
    public function printReport(Request $request, $id)
    {




        $animalsDetails = DB::table('inspection_livestock_details_of_animals')
            ->where('job_id', $id)
            ->select('*')
            ->get();

        $items = 0;
        foreach (json_decode($animalsDetails) as $item) {
            // dd($item);
            // dd($item->breed);

            $items += count(json_decode($item->breed, 1));
            // foreach(json_decode($item->breed) as  $key)
            // {

            //     // echo $key->secondType.' '.$key->quantity."<br>";

            //     // foreach($key->secondCross as $it )
            //     // {
            //     //     echo($it->name );
            //     //     echo(" & ");
            //     // }

            //     // echo $key->quantity."<br>";

            // }

        }

        // echo $items;
        $remarks = DB::table('inspection_livestock_remarks')
            ->where('job_id', $id)
            ->select('*')
            ->get();

        $reportDetails = DB::table('inspection_livestock_details')
            ->where('job_id', $id)
            ->select('*')
            ->get();

        $quanTotal = DB::table('inspection_livestock_details_of_animals')
            ->where('job_id', $id)
            ->groupBy('job_id')
            ->selectRaw('SUM(quantity) as total')
            ->get();

        $images = DB::table('inspection_livestock_report_images')
            ->where('job_id', $id)
            ->orderBy('print_order', 'ASC')
            ->select('*')
            ->get();


        $jobData = DB::table('inspection_jobs')
            ->where('inspection_jobs.id', $id)
            ->leftJoin('c_company', 'inspection_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'inspection_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_muccaduum', 'inspection_jobs.muccaduum_id', '=', 'c_muccaduum.id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'inspection_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'inspection_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'inspection_jobs.byvendor_id', '=', 'ibr_vendors.id')
            ->leftJoin('c_customer', 'inspection_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'inspection_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'inspection_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('c_employees', 'inspection_jobs.conducted_by', '=', 'c_employees.id')

            ->select(
                'inspection_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'inspection_jobs.operational_branch',
                'c_muccaduum.muc_name',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'c_employees.name AS employee_name',
                'tax_regions.name AS tax_region'

            )
            ->get();

        $branchRegion = DB::table('c_branch')
            ->where('c_branch.branch_id', $jobData[0]->branch_id)
            ->leftJoin('c_city', 'c_branch.branch_city_id', '=', 'c_city.city_id')
            ->select('c_city.city_name')
            ->get();

        $tonumber = Inspection::convertNumberToWord($reportDetails[0]->caretakers_no);
        // $pdf1 = PDF::loadView('invoice1',compact('data'));
        $reportDate = date_create($reportDetails[0]->report_date);
        $inspectDate = date_create(
            $reportDetails[0]->inspection_date //Site Address
        );
        $txt = $jobData[0]->job_id;

        // $txt = 'KGTBd/INS/MLTN2/ASKB13L/14333/2021';
        if ($reportDetails[0]->is_branch_code == 1) {
            $refId = '';
            $subtxt = '/';
            if (($nth = Inspection::addBranchCodeToRefId($txt, $subtxt, 4, true)) !== false) {
                //echo $nth;
                $refId = substr_replace($txt, "(" . $reportDetails[0]->branch_code . ")", $nth, 0);
            } else {
                $refId = $txt;
            }
        } else {
            $refId = $txt;
        }
        $data = [
            $refId, //Ref Id
            $jobData[0]->cust_name, //Customer
            $reportDetails[0]->site_address, //Site Address
            $jobData[0]->bank_name, //Bank
            $jobData[0]->bank_address, //Branch Address
            $branchRegion[0]->city_name, //Branch Region
            $jobData[0]->region, //Region
            date_format($reportDate, "M d, Y"), //Report Date
            $reportDetails[0]->stock_inspector, //Site Address, //Inspector
            date_format($inspectDate, "M d, Y"), //Inspected Date
            json_decode($animalsDetails),
            $quanTotal,
            $remarks,
            $images,
            ucwords($tonumber),
            $reportDetails[0]->caretakers_no,
            $reportDetails[0]->doctors,
            $reportDetails[0]->is_print_sign,
            $reportDetails[0]->food, //food
            $reportDetails[0]->image_header, //image header
            $reportDetails[0]->is_note,
            $reportDetails[0]->note,
            $reportDetails[0]->is_site_address_second,
            $reportDetails[0]->site_address_second,
            $reportDetails[0]->is_afo,
            $reportDetails[0]->afo_name,
            $reportDetails[0]->afo_contact,
            $reportDetails[0]->afo_branch_code,



        ];

        $pdf1 = PDF::loadView('Inspection/Reports/firstpage', compact('data'));
        $pdf1->save('Reports/Inspection/' . $id . '/firstpage.pdf');
        if ($items <= 11) {

            $pdf2 = PDF::loadView('Inspection/Reports/secondpage', compact('data'));
            $pdf2->save('Reports/Inspection/' . $id . '/secondpage.pdf');
        } else {

            $pdf2 = PDF::loadView('Inspection/Reports/secondpagetwo', compact('data'));
            $pdf2->save('Reports/Inspection/' . $id . '/secondpagetwo.pdf');
        }
        $pdf3 = PDF::loadView('Inspection/Reports/thirdpage', compact('data'));
        $pdf3->save('Reports/Inspection/' . $id . '/thirdpage.pdf');

        $pdf4 = PDF::loadView('Inspection/Reports/fourthpage', compact('data'));
        $pdf4->save('Reports/Inspection/' . $id . '/fourthpage.pdf');

        $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));


        $pdf->AddPage();
        $pdf->setSourceFile("Reports/Inspection/$id/firstpage.pdf");



        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 5, 5);




        if ($items <= 10) {
            $pageCount1 = $pdf->setSourceFile("Reports/Inspection/$id/secondpage.pdf");

            for ($pageNo1 = 1; $pageNo1 <= $pageCount1; $pageNo1++) {

                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 15);
                // Move to the right
                $pdf->Cell(80);
                // Framed title
                // $pdf->Cell(30,10,'Header',1,0,'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetY(-37);
                // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
                $tplIdx = $pdf->importPage($pageNo1);
                $pdf->useTemplate($tplIdx, 5, 5);
                // $pages=$pdf->PageNo();
                // $page=$pages-1;
                //     $pdf->SetFont('Arial','I',8);

                // $pdf->Cell(0,16,'Page '.$page,20,20,'C');

            }
        } else {


            $pageCount1 = $pdf->setSourceFile("Reports/Inspection/$id/secondpagetwo.pdf");

            for ($pageNo1 = 1; $pageNo1 <= $pageCount1; $pageNo1++) {

                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 15);
                // Move to the right
                $pdf->Cell(80);
                // Framed title
                // $pdf->Cell(30,10,'Header',1,0,'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetY(-37);
                // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
                $tplIdx = $pdf->importPage($pageNo1);
                $pdf->useTemplate($tplIdx, 5, 5);
                // $pages=$pdf->PageNo();
                // $page=$pages-1;
                //     $pdf->SetFont('Arial','I',8);

                // $pdf->Cell(0,16,'Page '.$page,20,20,'C');

            }

            $pageCount1 = $pdf->setSourceFile("Reports/Inspection/$id/thirdpage.pdf");

            for ($pageNo1 = 1; $pageNo1 <= $pageCount1; $pageNo1++) {

                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 15);
                // Move to the right
                $pdf->Cell(80);
                // Framed title
                // $pdf->Cell(30,10,'Header',1,0,'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetY(-37);
                // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
                $tplIdx = $pdf->importPage($pageNo1);
                $pdf->useTemplate($tplIdx, 5, 5);
                // $pages=$pdf->PageNo();
                // $page=$pages-1;
                //     $pdf->SetFont('Arial','I',8);

                // $pdf->Cell(0,16,'Page '.$page,20,20,'C');

            }
        }


        $pageCount = $pdf->setSourceFile("Reports/Inspection/$id/fourthpage.pdf");



        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 15);
            // $pdf->SetMargins(100, 100);
            $pdf->Image('images/kgtimageslogo.png', 153, 20, 35);

            // Move to the right
            // $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            // $pdf->SetX(100);



            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 30);
            // $pages=$pdf->PageNo();
            // $page=$pages-1;
            // $pdf->SetFont('Arial','I',8);

            // $pdf->Cell(0,16,'Page '.$page,20,20,'C');
        }


        $pdf->Output("InspectionReport.pdf", "I");

        
    }

    public function getInspectionJob($id)
    {
        $jobDetails = Inspection::getJobById($id);
        return $jobDetails;
    }
    public function getCustomerAddress($id)
    {
        $jobDetails = Inspection::getCustomerAddress($id);
        return $jobDetails;
    }
    public function getLivestockImages($id)
    {
        $images = Inspection::getLivestockImages($id);
        return $images;
    }

    public function deleteLivestockImage(Request $request, $id)
    {
        $image = $request->image;
        $file = Inspection::deleteLivestockImage($id, $image);
    }
    public function uploadLivestockimages(Request $request)
    {

        Inspection::uploadLivestockimages($request);
    }
    public function deleteInspectionDetailsItem(Request $request, $id)
    {
        Inspection::deleteInspectionDetailsItem($request, $id);
    }
    public function deleteInspectionDetailsRemarks(Request $request, $id)
    {
        Inspection::deleteInspectionDetailsRemarks($request, $id);
    }
    public function updateInspection(Request $request, $id)
    {
        Inspection::updateInspection($request, $id);
        Inspection::updateLocalJob($request, $id);

        $job = DB::table('bank_representative')
        ->where('bank_representative', $request->bank_representative)
        ->select('*')
        ->get();

        if($job->isEmpty())
        {
            DB::table('bank_representative')->insert([
            'bank_id'=>$request->bank_id,
            'branch_id'=>$request->branch_id,
            'bank_representative'=>$request->bank_representative,
            'bank_designation'=>$request->bank_designation,
            'bank_email'=>$request->bank_email
            ]);

        }
        else{
            echo 'found';

        }
    }
    public function getMIS()
    {
        return view('Inspection.mis');
    }
    public function updateOrder(Request $request, $id)
    {
        Inspection::updateOrder($request, $id);
    }
    public function getDetailsofanimals($id)
    {
        $job = Inspection::getDetailsofanimals($id);
        return $job;
    }

    public function getRemarksDetails($id)
    {
        $job = Inspection::getRemarksDetails($id);
        return $job;
    }
    public function getLiveStockDetails($id)
    {
        $job = Inspection::getLiveStockDetails($id);
        return $job;
    }

    public function saveDetailsofanimals(Request $request, $id)
    {
        Inspection::saveDetailsofanimals($request, $id);
    }
    public function saveDetailsofRemarks(Request $request, $id)
    {
        Inspection::saveDetailsofRemarks($request, $id);
    }
    public function addDetailsofanimalsRow(Request $request, $id)
    {
        Inspection::addDetailsofanimalsRow($request, $id);
    }
    public function addDetailsofanimalsRemark(Request $request, $id)
    {
        Inspection::addDetailsofanimalsRemark($request, $id);
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
                'Inspection',
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
            $bill->service = 'Livestock';
            $bill->save();




            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $data[3] . " Bill Was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Inspection|Livestock';
            $log->save();


            $billData = Inspection::getJobByIdForBill($id, $request->jobid);

            $tonumber = Inspection::convertNumberToWord($total);



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
            $pdf1 = PDF::loadView('Inspection/insinvoice', compact('data'));
            $pdf1->save('Reports/Inspection/' . $id . '/invoice.pdf');
            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

            $pdf->AddPage();
            $pdf->setSourceFile("Reports/Inspection/$id/invoice.pdf");
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
            $bill->service = 'Livestock';
            $bill->save();




            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->jobid . " Bill Was Updated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Inspection|Livestock';
            $log->save();

            $billData = Inspection::getJobByIdForBill($id, $request->jobid);

            $tonumber = Inspection::convertNumberToWord($total);




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
            $pdf1 = PDF::loadView('Inspection/insinvoice', compact('data'));
            $pdf1->save('Reports/Inspection/' . $id . '/invoice.pdf');
            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

            $pdf->AddPage();
            $pdf->setSourceFile("Reports/Inspection/$id/invoice.pdf");
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 5, 5);
            $pdf = $pdf->Output();

            return $pdf;
            dd($billData);
        }
    }
}
