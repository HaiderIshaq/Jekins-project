<?php

namespace App\Http\Controllers;

use App\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Muccaduum;
use App\SaleTax;
use App\Bill_Ibr;
use App\Log;
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
        Inspection::updateJobID($request, $cid);
        Inspection::addLivestockJob($cid);
        Inspection::makeLog($request, $cid);

        $bill = new Bill_Ibr;
        $bill->bill_number = $data[2];
        $bill->job_number = $data[2];
        $bill->bill_date = $reportDetails[0]->bill_date;
        $bill->total_amount = $total;
        $bill->tax = '0';
        $bill->discount = '0';
        $bill->recievable = $request->region;
        $bill->old_debt = '0';
        $bill->cancalled = '0';
        $bill->bank = $request->bankID;
        $bill->company = $request->companyID;
        $bill->branch = $request->branch;
        $bill->customer = $request->customerIs;
        $bill->status = 'Receivable';
        $bill->service = 'Inspection';
        $bill->save();
    }

    public function saveInsReport(Request $request, $id)
    {
        Inspection::storeLivestockDetails($request, $id);
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

        $tonumber = Inspection::convertNumberToWord($reportDetails[0]->caretakers_no);
        // $pdf1 = PDF::loadView('invoice1',compact('data'));
        $reportDate = date_create($reportDetails[0]->report_date);
        $inspectDate = date_create(
            $reportDetails[0]->inspection_date //Site Address
        );

        $data = [

            $jobData[0]->job_id, //Ref Id
            $jobData[0]->cust_name, //Customer
            $reportDetails[0]->site_address, //Site Address
            $jobData[0]->bank_name, //Bank
            $jobData[0]->bank_address, //Branch Address
            '', //Branch Region
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




        if ($items <= 11) {
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
            // Move to the right
            $pdf->Cell(80);
            // Framed title
            // $pdf->Cell(30,10,'Header',1,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetY(-37);
            // $pdf->Image('images/bar2.PNG',-5, $pdf->GetY(),220);
            $tplIdx = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplIdx, 0, 0);
            // $pages=$pdf->PageNo();
            // $page=$pages-1;
            // $pdf->SetFont('Arial','I',8);

            // $pdf->Cell(0,16,'Page '.$page,20,20,'C');
        }


        $pdf->Output("OfficeForm.pdf", "I");
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

        $sales = $request->sales;
        $jobid = $request->jobid;
        $id = $request->id;


        $bill = Bill_Ibr::where('job_number', '=', $jobid)
            ->first();

        $reportDetails = DB::table('inspection_livestock_details')
            ->where('job_id', $id)
            ->select('bill_date')
            ->get();


        if (empty($bill)) {




            $total = $request->service;

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




            ];

            $id = $request->id;

            $giver = $request->givenby;

            $bill = new Bill_Ibr;
            $bill->bill_number = $data[2];
            $bill->job_number = $data[2];
            $bill->bill_date = $reportDetails[0]->bill_date;
            $bill->total_amount = $total;
            $bill->tax = '0';
            $bill->discount = '0';
            $bill->recievable = $request->region;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bankID;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch;
            $bill->customer = $request->customerIs;
            $bill->status = 'Receivable';
            $bill->service = 'Inspection';
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $data[3] . " Bill Was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Inspection|Livestock';
            $log->save();


            $billData = Inspection::getJobByIdForBill($id, $request->jobid);

            $tonumber = Inspection::convertNumberToWord($billData['bill'][0]->total_amount);


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
                $billData['job'][0]->service_charges,
                $billData['job'][0]->name,
                $billData['job'][0]->byvendor_address

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


            $total = $request->service;

            $vletter = $request->vendorletter;
            $giver = $request->givenby;


            $id = $request->id;

            //File::delete('Reports/IBR/'.$id.'/bill.pdf');





            $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
            $bill->bill_number = $request->jobid;
            $bill->job_number = $request->jobid;
            $bill->total_amount = $total;
            $bill->tax = '0';
            $bill->discount = '0';
            $bill->recievable = $request->region;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bankID;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch;
            $bill->customer = $request->customerIs;
            $bill->status = 'Receivable';
            $bill->service = 'Inspection';
            $bill->save();


            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->jobid . " Bill Was Updated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Inspection|Livestock';
            $log->save();

            $billData = Inspection::getJobByIdForBill($id, $request->jobid);

            $tonumber = Inspection::convertNumberToWord($billData['bill'][0]->total_amount);


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
                $billData['job'][0]->service_charges,
                $billData['job'][0]->name,
                $billData['job'][0]->byvendor_address

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
