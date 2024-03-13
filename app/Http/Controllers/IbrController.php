<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Region;
use App\Bank;
use App\Company;
use App\Branch;
use App\Customer;
use App\Country;
use App\Ibr_Company;
use App\Ibr_Progress;
use App\SalesRegion;
use App\SaleTax;
use App\Report;
use App\Rate;
use App\Delivery;
use App\City;
use App\Vendor;
use App\IBR;
use App\Job;
use App\Log;
use App\Bill_Ibr;
use DataTables;
use PDF;
use File;
use Illuminate\Support\Facades\Storage;



class IbrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Karachi");
    }

    public function getIbrData(Request $request)
    {
        if ($request->ajax()) {
            $jobs = DB::table('c_jobs')
                ->where('c_jobs.service', 'IBR')
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
                    'c_jobs.service',
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

    public function getCompany()
    {

        $companies = Company::all();
        return $companies;
    }
    public function getCountry()
    {

        $countries = Country::all();
        return $countries;
    }
    public function getIbrCompany()
    {

        $companies = Ibr_Company::all();
        return $companies;
    }

    public function getCountries()
    {

        $companies = Company::all();
        return $companies;
    }

    public function getRegions()
    {
        $regions = DB::table('c_region')
            ->join('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
            ->select('c_city.city_name', 'c_region.reg_id', 'c_region.reg_prefix')
            ->get();
        return $regions;
    }

    public function getBanks()
    {
        $banks = DB::table('c_bank')
            ->select('bank_name', 'bank_id', 'bank_type', 'bank_code')
            ->get();

        return $banks;
    }
    public function getCustomers(Request $request)
    {
        // $service=$request->service;
        // $customers =DB::table('c_customer')
        // ->where('service',$service)
        // ->get();
        $service = $request->service;
        $customers = DB::table('c_customer')
            // ->where('service',$service)
            ->get();

        return $customers;
    }

    public function getVendors()
    {
        $vendors = Vendor::all();

        return $vendors;
    }

    public function getDeliveryType()
    {
        $delivery = Delivery::all();

        return $delivery;
    }
    public function getRates($id)
    {
        return Rate::where('region', $id)
            ->select('*')
            ->get();
    }

    public function getReportType()
    {
        $reports = Report::all();

        return $reports;
    }

    public function getSalesRegion()
    {
        $regions = SalesRegion::all();

        return $regions;
    }

    public function getCities()
    {
        $cities = City::all();
        return $cities;
    }

    public function getIslamicBanks()
    {
        $banks = DB::table('c_bank')
            ->select('bank_name', 'bank_id', 'bank_code')
            ->where('bank_type', 'Islamic')
            ->get();

        return $banks;
    }




    public function getBranches($id)
    {
        return Branch::where('branch_bank_id', $id)
            ->select('branch_name', 'branch_id', 'branch_address')
            ->get();
    }

    public function getCustomerById($id)
    {
        return Customer::where('cust_id', $id)
            ->select('*')
            ->get();
    }



    public function getVendorById($id)
    {
        return Vendor::where('id', $id)
            ->select('*')
            ->get();
    }

    public function getCompanyByCountry($id)
    {
        return IBR::where('country_id', $id)
            ->select('*')
            ->get();
    }

    public function getCompanyByCountryForEdit($id, $jobid)
    {
        return IBR::where('country_id', $id)
            ->where('id', '!=', $jobid)
            ->select('*')
            ->get();
    }
    public function getCompanyById($id)
    {
        return Ibr_Company::where('id', $id)
            ->select('*')
            ->get();
    }

    public function getBranchById($id)
    {
        return Branch::where('branch_id', $id)
            ->select('branch_name', 'branch_id', 'branch_address', 'branch_phone')
            ->get();
    }

    public function getSalesTaxByRegion($id)
    {
        return SaleTax::where('region', $id)
            ->select('*')
            ->get();
    }
    public function getVendorAddress($id)
    {
        return Vendor::where('id', $id)
            ->select('address')
            ->get();
    }

    public function addBranch(Request $request)
    {
        $branch = new Branch;
        $branch->branch_bank_id = $request->branch_bank_id;
        $branch->branch_city_id = $request->branch_city_id;
        $branch->branch_code = $request->branch_code;
        $branch->branch_name = $request->branch_name;
        $branch->branch_address = $request->branch_address;
        $branch->branch_phone = $request->branch_phone;
        $branch->created_by = $request->user()->id;
        $branch->updated_by = $request->user()->id;
        $branch->branch_landline = $request->branch_landline;
        $branch->save();
        return response()->json($branch);
    }
    public function addBank(Request $request)
    {
        $bank = new Bank;
        $bank->bank_name = $request->bank_name;
        $bank->bank_code = strtoupper($request->bank_code);
        $bank->bank_type = $request->bank_type;
        $bank->bank_ibr_rate = $request->bank_ibr_rate;
        $bank->created_by = $request->user()->id;
        $bank->updated_by = $request->user()->id;
        $bank->save();
        return response()->json($bank);
    }
    public function addCompany(Request $request)
    {
        $company = new Ibr_Company;
        $company->name = $request->name;
        $company->address = $request->address;
        $company->street = $request->street;
        $company->po_box = $request->po_box;
        $company->country_id = $request->country_id;
        $company->email = $request->email;
        $company->fax = $request->fax;
        $company->website = $request->website;
        $company->registration_id = $request->registration_id;
        $company->save();
        return response()->json($company);
    }


    public function addCustomer(Request $request)
    {
        $id = 1;
        $customer = new Customer;
        $customer->cust_city_id = $request->cust_city_id;
        $customer->cust_name = $request->cust_name;
        $customer->cust_phone = $request->cust_phone;
        $customer->cust_fax = $request->cust_fax;
        $customer->cust_contact_person = $request->cust_contact_person;
        $customer->cust_designation = $request->cust_designation;
        $customer->cust_part_code = $request->cust_part_code;
        $customer->address = $request->address;
        $customer->ntn = $request->ntn;
        $customer->service = $request->service;
        $customer->gst = $request->gst;
        $customer->created_by = $request->user()->id;
        $customer->updated_by = $request->user()->id;
        $customer->save();
        return response()->json($customer);
    }

    public function addJob(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = new IBR;
        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "IBR";
        $ibr->requested_date = date("Y/m/d");
        $ibr->regional_id = $request->regional_id;
        $ibr->job_by = $request->job_by;
        $ibr->bank_id = $request->bank_id;
        $ibr->branch_id = $request->branch_id;
        $ibr->bank_address = $request->bank_address;
        $ibr->bank_representative = $request->bank_representative;
        $ibr->bank_designation = $request->bank_designation;
        $ibr->bank_phone = $request->bank_phone;
        $ibr->bank_fax = $request->bank_fax;
        $ibr->bank_email = $request->bank_email;
        $ibr->bank_letter = $request->bank_letter;
        $ibr->bank_letter_date = $request->letter_date;
        $ibr->byvendor_id = $request->ibr_vendor_id;
        $ibr->byvendor_representative = $request->ibr_vendor_representaive;
        $ibr->byvendor_designation = $request->ibr_vendor_designation;
        $ibr->byvendor_address = $request->ibr_billing_address;
        $ibr->byvendor_phone = $request->ibr_vendor_phone;
        $ibr->byvendor_fax = $request->ibr_vendor_fax;
        $ibr->byvendor_email = $request->ibr_vendor_email;
        $ibr->byvendor_letter = $request->ibr_vendor_letter;
        $ibr->vendor_letter_date = $request->ibr_vendor_date;
        $ibr->customer_id = $request->customer_id;
        $ibr->customer_representative = $request->customer_representative;
        $ibr->customer_designation = $request->customer_designation;
        $ibr->customer_phone = $request->customer_phone;
        $ibr->customer_fax = $request->customer_fax;
        $ibr->customer_email = $request->customer_email;
        $ibr->country_id = $request->country_id;
        $ibr->city = $request->city;
        $ibr->company_id = strtoupper($request->company_id);
        $ibr->company_address = $request->company_address;
        $ibr->company_street = $request->company_street;
        $ibr->company_pobox = $request->company_pobox;
        $ibr->company_phone = $request->company_phone;
        $ibr->company_fax = $request->company_fax;
        $ibr->company_email = $request->company_email;
        $ibr->company_url = $request->company_url;
        $ibr->registration_id = $request->registration_id;
        $ibr->additionals = $request->additionals;
        $ibr->vendor_id = $request->vendor_id;
        $ibr->report_type = $request->report_type;
        $ibr->delivery_type = $request->delivery_time;
        $ibr->EDID = $request->edd;
        $ibr->sales = $request->sales == true ? '1' : '0';
        $ibr->duplicate = $request->duplicate == true ? '1' : '0';
        $ibr->duplicate_id = $request->duplicate_id;
        $ibr->sale_tax = $request->sales_tax;
        $ibr->service_charges = $request->service_charges;
        $ibr->exchange_rate = $request->ex_rates;
        $ibr->created_by = $request->user()->id;
        $ibr->updated_by = $request->user()->id;
        $ibr->tentative = $request->tentative;
        $ibr->tentativeReport = $request->tentativeReport;
        $ibr->given_by = $request->given_by;
        $ibr->completed = '0';
        $ibr->cancalled = '0';

        $ibr->save();



        $cjob = DB::table('ibr_jobs')->latest('created_at', 'desc')->first();

        Storage::disk('dir')->makeDirectory('Reports/IBR/' . $cjob->id);

        $cid = $cjob->id;

        $job = new Job;
        if ($givenBy == "Bank") {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
        } else {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
        }
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);;
        $job->region_id = $request->regional_id;
        $job->service = "IBR";
        $job->bank_id = $request->bank_id;
        $job->byvendor_id = $request->ibr_vendor_id;
        $job->branch_id = $request->branch_id;
        $job->customer_id = $request->customer_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();


        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "New Job Was Created";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'IBR';
        $log->save();


        $ibr1 = IBR::findOrFail($cid);

        if ($givenBy == "Bank") {
            $ibr1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
        } else {
            $ibr1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
        }


        if ($request->duplicate == true) {

            $myid = $request->reportFolder;
            Storage::disk('dir')->copy('Reports/IBR/' . $myid . '/original.pdf', 'Reports/IBR/' . $cid . '/original.pdf');
            $ibr1->original = '1';
        }
        $ibr1->save();
    }

    public function getJobByCountry($id)
    {

        $date = date('Y-m-d');
        $jobs = DB::table('ibr_jobs')
            ->select('*')
            ->where('company_id', $id)
            ->where('completed', '1')
            ->where('expiry', '>=', date('Y/m/d'))
            ->get();
        // $expiry=$jobs[0]->expiry;
        return $jobs;

        // if($date >= $expiry)
        // {
        //     return "job expired";
        // }
        // else
        // {

        //     return $jobs;

        // }
        // return $jobs;

    }
    public function getIbrJob($id)
    {


        $job = DB::table('ibr_jobs')
            ->where('ibr_jobs.id', $id)
            ->leftJoin('c_company', 'ibr_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'ibr_jobs.regional_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'ibr_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'ibr_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('c_branch', 'ibr_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('ibr_vendors', 'ibr_jobs.byvendor_id', '=', 'ibr_vendors.id')
            ->leftJoin('c_customer', 'ibr_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('ibr_country AS country', 'ibr_jobs.country_id', '=', 'country.id')
            ->leftJoin('ibr_company', 'ibr_jobs.company_id', '=', 'ibr_company.id')
            ->leftJoin('ibr_vendors AS vendor', 'ibr_jobs.vendor_id', '=', 'vendor.id')
            ->leftJoin('ibr_report_type', 'ibr_jobs.report_type', '=', 'ibr_report_type.id')
            ->leftJoin('ibr_delivery', 'ibr_jobs.delivery_type', '=', 'ibr_delivery.id')
            ->leftJoin('tax_regions', 'ibr_jobs.sale_tax', '=', 'tax_regions.id')
            ->select(
                'ibr_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'ibr_jobs.operational_branch',
                'ibr_jobs.registration_id',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'ibr_vendors.name',
                'c_customer.cust_name',
                'country.name AS country_name',
                'ibr_company.name AS company_name',
                'vendor.name AS vendor_name',
                'ibr_report_type.description',
                'ibr_delivery.description AS delivery',
                'tax_regions.name AS tax_region'
            )
            ->get();
        return $job;
    }

    public function updateIbr(Request $request, $id)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = IBR::where('id', $id)->first();

        $ibr->regional_id = $request->regional_id;
        $ibr->operational_branch = $request->operational_branch;
        $ibr->expiry = $request->expiry;
        $ibr->job_by = $request->job_by;
        $ibr->bank_id = $request->bank_id;
        $ibr->branch_id = $request->branch_id;
        $ibr->bank_address = $request->bank_address;
        $ibr->bank_representative = $request->bank_representative;
        $ibr->bank_designation = $request->bank_designation;
        $ibr->bank_phone = $request->bank_phone;
        $ibr->bank_fax = $request->bank_fax;
        $ibr->bank_email = $request->bank_email;
        $ibr->bank_letter = $request->bank_letter;
        $ibr->bank_letter_date = $request->letter_date;
        $ibr->byvendor_id = $request->ibr_vendor_id;
        $ibr->byvendor_address = $request->ibr_billing_address;
        $ibr->byvendor_representative = $request->ibr_vendor_representaive;
        $ibr->byvendor_designation = $request->ibr_vendor_designation;
        $ibr->byvendor_phone = $request->ibr_vendor_phone;
        $ibr->byvendor_fax = $request->ibr_vendor_fax;
        $ibr->byvendor_email = $request->ibr_vendor_email;
        $ibr->byvendor_letter = $request->ibr_vendor_letter;
        $ibr->vendor_letter_date = $request->ibr_vendor_date;
        $ibr->customer_id = $request->customer_id;
        $ibr->customer_representative = $request->customer_representative;
        $ibr->customer_designation = $request->customer_designation;
        $ibr->customer_phone = $request->customer_phone;
        $ibr->customer_fax = $request->customer_fax;
        $ibr->customer_email = $request->customer_email;
        $ibr->country_id = $request->country_id;
        $ibr->city = $request->city;
        $ibr->company_id = strtoupper($request->company_id);
        $ibr->company_address = $request->company_address;
        $ibr->company_street = $request->company_street;
        $ibr->company_pobox = $request->company_pobox;
        $ibr->company_phone = $request->company_phone;
        $ibr->company_fax = $request->company_fax;
        $ibr->company_email = $request->company_email;
        $ibr->company_url = $request->company_url;
        $ibr->registration_id = $request->registration_id;
        $ibr->additionals = $request->additionals;
        $ibr->vendor_id = $request->vendor_id;
        $ibr->report_type = $request->report_type;
        $ibr->delivery_type = $request->delivery_time;
        $ibr->EDID = $request->edd;
        $ibr->sales = $request->sales == true ? '1' : '0';
        $ibr->sale_tax = $request->sales_tax;
        $ibr->service_charges = $request->service_charges;
        $ibr->exchange_rate = $request->ex_rates;
        $ibr->delivery_time = $request->delivery_on;
        $ibr->created_by = $request->user()->id;
        $ibr->updated_by = $request->user()->id;
        $ibr->tentative = $request->tentative;
        $ibr->tentativeReport = $request->tentativeReport;
        $ibr->duplicate = $request->duplicate == true ? '1' : '0';
        $ibr->duplicate_id = $request->duplicate_id;
        $ibr->given_by = $request->given_by;
        if ($request->delay == true) {
            $ibr->completed = '2';
            $ibr->customer_delay = '1';
        } else {
            $ibr->completed = $request->completed == true ? '1' : '0';
            $ibr->customer_delay = $request->delay == true ? '1' : '0';
        }
        $ibr->order_placed = $request->placed;
        $ibr->order_recieved = $request->recieved;
        $ibr->company_limit = $request->limit;
        $ibr->company_rating = $request->rating;
        $ibr->company_litigation = $request->litigation;
        $ibr->company_activity = $request->activity;

        $ibr->save();
        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $jid . " Job Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'IBR';
        $log->save();

        $com_id = $request->commonId;
        $comJob = Job::where('id', $com_id)->first();
        $comJob->company_id = strtoupper($request->company_id);
        $comJob->region_id = $request->regional_id;
        $comJob->bank_id = $request->bank_id;
        $comJob->byvendor_id = $request->ibr_vendor_id;
        $comJob->customer_id = $request->customer_id;
        $comJob->branch_id = $request->branch_id;
        $comJob->status = $request->completed == true ? '1' : '0';
        $comJob->save();


        $myfolder = $request->myfolder;
        $dupfolder = $request->reportFolder;

        $completed = $request->completed;
        if ($completed == true) {
            $sales = $request->sales;
            $jobid = $request->jobid;




            if ($sales != 0) {



                $tax = SaleTax::where('region', $sales)
                    ->select('*')
                    ->get();

                $total = $request->service_charges * $request->ex_rates;
                $saleTax = $tax[0]->rate / 100 * $total;
                $finalamount = $saleTax + $total;
                $vletter = $request->vendorletter;
                $date = date_create($request->bank_date);
                $bankDate = date_format($date, "d-M-Y");
                $data = [
                    $tax[0]->rate,
                    $request->bank,
                    $request->address,
                    $request->jobid,
                    $request->company_address,
                    $request->bank_letter,
                    $bankDate,
                    $request->service,
                    $request->exchange,
                    $total,
                    $finalamount,
                    $saleTax,
                    $request->customer,
                    $request->vendor,
                    $request->customerAddress,
                    $request->vendorAddress,
                    $request->region,
                    $request->customerIs,
                    $request->branch_id,
                    $request->vendorletter,


                ];
            } else {


                $total = $request->service_charges * $request->ex_rates;
                $saleTax = 0 / 100 * $total;
                $finalamount = $saleTax + $total;
                $vletter = $request->vendorletter;

                $date = date_create($request->bank_date);
                $bankDate = date_format($date, "d-M-Y");
                $data = [
                    '0',
                    $request->bank,
                    $request->address,
                    $request->jobid,
                    $request->company_address,
                    $request->bank_letter,
                    $bankDate,
                    $request->service,
                    $request->exchange,
                    $total,
                    $finalamount,
                    $saleTax,
                    $request->customer,
                    $request->vendor,
                    $request->customerAddress,
                    $request->vendorAddress,
                    $request->region,
                    $request->customerIs,
                    $request->branch_id,
                    $request->vendorletter




                ];
            }
            $id = $request->id;

            $giver = $request->givenby;


            //File::delete('Reports/IBR/'.$id.'/bill.pdf');

            if ($giver == 'Customers') {


                $bill = new Bill_Ibr;
                $bill->bill_number = $data[3];
                $bill->job_number = $data[3];
                $bill->bill_date = date('Y/m/d');
                $bill->total_amount = $total;
                $bill->tax = $data[11];
                $bill->discount = '0';
                $bill->recievable = $request->regional_id;
                $bill->old_debt = '0';
                $bill->cancalled = '0';
                $bill->bank = $request->bank_id;
                $bill->company = $request->job_by;
                $bill->branch = $data[18];
                $bill->customer = $data[17];
                $bill->status = 'Receivable';
                $bill->service = 'IBR';
                $bill->save();


                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = $data[3] . " Bill Was generated";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'IBR';
                $log->save();
            } else {


                $bill = new Bill_Ibr;
                $bill->bill_number = $data[3];
                $bill->job_number = $data[3];
                $bill->bill_date = date('Y/m/d');
                $bill->total_amount = $total;
                $bill->tax = $data[11];
                $bill->discount = '0';
                $bill->recievable = $request->regional_id;
                $bill->bank = $request->bank_id;
                $bill->company = $request->job_by;
                $bill->old_debt = '0';
                $bill->cancalled = '0';
                $bill->branch = $data[18];
                $bill->customer = $data[17];
                $bill->status = 'Receivable';
                $bill->service = 'IBR';
                $bill->save();


                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = $data[3] . " Bill Was generated";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'IBR';
                $log->save();
            }
        }

        if ($request->duplicate == true) {

            if ($request->prevJob == null) {

                Storage::disk('dir')->delete('Reports/IBR/' . $myfolder . '/original.pdf');
                Storage::disk('dir')->copy('Reports/IBR/' . $dupfolder . '/original.pdf', 'Reports/IBR/' . $myfolder . '/original.pdf');
            } else {
                if ($request->duplicate_id != $request->prevJob) {
                    Storage::disk('dir')->delete('/Reports/IBR/' . $myfolder . '/original.pdf');
                    Storage::disk('dir')->copy('Reports/IBR/' . $dupfolder . '/original.pdf', 'Reports/IBR/' . $myfolder . '/original.pdf');

                    echo 'Ids Has been changed';
                } else {
                    echo 'Duplicate Ids are Same';
                }
            }
        }


        // $myfolder=$request->myfolder;
        // $newfolder=$request->reportFolder;
        // if($request->duplicate_id==$request->prevJob){

        //     echo 'Duplicate ID is Same';

        // }
        // else{
        //     echo 'Duplicate ID is not Same';
        //     Storage::disk('dir')->copy('Reports/IBR/'.$newfolder.'/original.pdf', 'Reports/IBR/'.$myfolder.'/original.pdf');


        // }

    }

    public function cancelIbr(Request $request, $id)
    {
        $ibr = IBR::where('id', $id)->first();
        $ibr->cancalled = 1;
        $ibr->completed = 3;
        $ibr->customer_delay = 0;
        $ibr->cancallation_remarks = $request->remarks;
        $ibr->cancalled_date = date('y-m-d');
        $ibr->save();

        $myid = $request->jobid;
        $bill = Bill_Ibr::where('job_number', '=', $myid)
            ->first();



        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $myid . " was cancelled";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'IBR';
        $log->save();


        if ($bill != null) {
            $bill->delete();
        }
    }

    public function print(Request $request)
    {




        $file = $request->file('myfile');
        $fileSize = $request->file('myfile')->getSize();
        $filext = $request->file('myfile')->extension();
        $filecontent = file_get_contents($file);



        if ($filext != "pdf") {
            return response()->json('Unsupported');
        } else {

            if (preg_match("/^%PDF-1.5/", $filecontent)) {

                return response()->json('Invalid');
            } else {

                if ($fileSize > 3000000) {
                    return response()->json('Limit Reached');
                } else {
                    $id = $request->job_id;

                    Storage::disk('dir')->makeDirectory('Reports/IBR/' . $id);
                    $filename = Storage::disk('dir')->putFileAs('Reports/IBR/' . $id, $file, '/original.pdf');

                    $jid = $request->jid;
                    $log = new Log;
                    $log->user_id = $request->user()->id;
                    $log->activity = $jid . " report uploaded";
                    $log->date = date('Y/m/d');
                    $log->time = date("h:i:sa");
                    $log->service = 'IBR';
                    $log->save();

                    $ibr = IBR::where('id', $id)->first();
                    $ibr->original = "1";
                    $ibr->save();

                    return response()->json(basename($filename));
                }
            }
        }
    }

    public function printBill(Request $request)
    {

        $sales = $request->sales;
        $jobid = $request->jobid;


        $bill = Bill_Ibr::where('job_number', '=', $jobid)
            ->first();


        if (empty($bill)) {
            if ($sales != 0) {



                $tax = SaleTax::where('region', $sales)
                    ->select('*')
                    ->get();

                $total = $request->service * $request->exchange;
                $saleTax = $tax[0]->rate / 100 * $total;
                $finalamount = $saleTax + $total;
                $vletter = $request->vendorletter;
                $date = date_create($request->bank_date);
                $bankDate = date_format($date, "d-M-Y");
                $data = [
                    $tax[0]->rate,
                    $request->bank,
                    $request->address,
                    $request->jobid,
                    $request->company_address,
                    $request->bank_letter,
                    $bankDate,
                    $request->service,
                    $request->exchange,
                    $total,
                    $finalamount,
                    $saleTax,
                    $request->customer,
                    $request->vendor,
                    $request->customerAddress,
                    $request->vendorAddress,
                    $request->region,
                    $request->customerIs,
                    $request->branch,
                    $request->vendorletter,


                ];
            } else {


                $total = $request->service * $request->exchange;
                $saleTax = 0 / 100 * $total;
                $finalamount = $saleTax + $total;
                $vletter = $request->vendorletter;

                $date = date_create($request->bank_date);
                $bankDate = date_format($date, "d-M-Y");
                $data = [
                    '0',
                    $request->bank,
                    $request->address,
                    $request->jobid,
                    $request->company_address,
                    $request->bank_letter,
                    $bankDate,
                    $request->service,
                    $request->exchange,
                    $total,
                    $finalamount,
                    $saleTax,
                    $request->customer,
                    $request->vendor,
                    $request->customerAddress,
                    $request->vendorAddress,
                    $request->region,
                    $request->customerIs,
                    $request->branch,
                    $request->vendorletter




                ];
            }
            $id = $request->id;

            $giver = $request->givenby;


            //File::delete('Reports/IBR/'.$id.'/bill.pdf');

            if ($giver == 'Customers') {
                $pdf1 = PDF::loadView('invoice1', compact('data'));
                $pdf1->save('Reports/IBR/' . $id . '/invoice.pdf');
                $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

                $pdf->AddPage();
                $pdf->setSourceFile("Reports/IBR/$id/invoice.pdf");
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 5, 5);
                $pdf = $pdf->Output();


                $bill = new Bill_Ibr;
                $bill->bill_number = $data[3];
                $bill->job_number = $data[3];
                $bill->bill_date = date('Y/m/d');
                $bill->total_amount = $finalamount;
                $bill->tax = $data[11];
                $bill->discount = '0';
                $bill->recievable = $request->region;
                $bill->old_debt = '0';
                $bill->cancalled = '0';
                $bill->bank = $request->bankID;
                $bill->company = $request->companyID;
                $bill->branch = $data[18];
                $bill->customer = $data[17];
                $bill->status = 'Receivable';
                $bill->service = 'IBR';
                $bill->save();


                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = $data[3] . " Bill Was generated";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'IBR';
                $log->save();

                return $pdf;
            } else {
                $pdf1 = PDF::loadView('invoice', compact('data'));
                $pdf1->save('Reports/IBR/' . $id . '/invoice.pdf');
                $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

                $pdf->AddPage();
                $pdf->setSourceFile("Reports/IBR/$id/invoice.pdf");
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 5, 5);
                $pdf = $pdf->Output();


                $bill = new Bill_Ibr;
                $bill->bill_number = $data[3];
                $bill->job_number = $data[3];
                $bill->bill_date = date('Y/m/d');
                $bill->total_amount = $finalamount;
                $bill->tax = $data[11];
                $bill->discount = '0';
                $bill->recievable = $request->region;
                $bill->bank = $request->bankID;
                $bill->company = $request->companyID;
                $bill->old_debt = '0';
                $bill->cancalled = '0';
                $bill->branch = $data[18];
                $bill->customer = $data[17];
                $bill->status = 'Receivable';
                $bill->service = 'IBR';
                $bill->save();


                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = $data[3] . " Bill Was generated";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'IBR';
                $log->save();
                return $pdf;
            }
        } else {

            if ($sales != 0) {



                $tax = SaleTax::where('region', $sales)
                    ->select('*')
                    ->get();

                $total = $request->service * $request->exchange;
                $saleTax = $tax[0]->rate / 100 * $total;
                $finalamount = $saleTax + $total;

                $date = date_create($request->bank_date);
                $bankDate = date_format($date, "d-M-Y");
                $data = [
                    $tax[0]->rate,
                    $request->bank,
                    $request->address,
                    $request->jobid,
                    $request->company_address,
                    $request->bank_letter,
                    $bankDate,
                    $request->service,
                    $request->exchange,
                    $total,
                    $finalamount,
                    $saleTax,
                    $request->customer,
                    $request->vendor,
                    $request->customerAddress,
                    $request->vendorAddress,
                    $request->region,
                    $request->customerIs,
                    $request->branch,
                    $request->vendorletter


                ];
            } else {


                $total = $request->service * $request->exchange;
                $saleTax = 0 / 100 * $total;
                $finalamount = $saleTax + $total;

                $date = date_create($request->bank_date);
                $bankDate = date_format($date, "d-M-Y");
                $data = [
                    '0',
                    $request->bank,
                    $request->address,
                    $request->jobid,
                    $request->company_address,
                    $request->bank_letter,
                    $bankDate,
                    $request->service,
                    $request->exchange,
                    $total,
                    $finalamount,
                    $saleTax,
                    $request->customer,
                    $request->vendor,
                    $request->customerAddress,
                    $request->vendorAddress,
                    $request->region,
                    $request->customerIs,
                    $request->branch,
                    $request->vendorletter



                ];
            }
            $id = $request->id;

            //File::delete('Reports/IBR/'.$id.'/bill.pdf');



            $giver = $request->givenby;

            if ($giver == 'Customers') {
                $pdf1 = PDF::loadView('invoice1', compact('data'));
                $pdf1->save('Reports/IBR/' . $id . '/invoice.pdf');
                $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

                $pdf->AddPage();
                $pdf->setSourceFile("Reports/IBR/$id/invoice.pdf");
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 5, 5);

                $pdf = $pdf->Output();

                $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
                $bill->bill_number = $data[3];
                $bill->job_number = $data[3];
                $bill->bill_date = date('Y/m/d');
                $bill->total_amount = $finalamount;
                $bill->tax = $data[11];
                $bill->discount = '0';
                $bill->recievable = $request->region;
                $bill->company = $request->companyID;
                $bill->bank = $request->bankID;
                $bill->old_debt = '0';
                $bill->cancalled = '0';
                $bill->branch = $data[18];
                $bill->customer = $data[17];
                $bill->service = 'IBR';
                $bill->save();


                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = $data[3] . " Bill Was generated again";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'IBR';
                $log->save();
                return $pdf;
            } else {
                $pdf1 = PDF::loadView('invoice', compact('data'));
                $pdf1->save('Reports/IBR/' . $id . '/invoice.pdf');
                $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

                $pdf->AddPage();
                $pdf->setSourceFile("Reports/IBR/$id/invoice.pdf");
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 5, 5);

                $pdf = $pdf->Output();

                $bill = Bill_Ibr::where('job_number', '=', $jobid)->first();
                $bill->bill_number = $data[3];
                $bill->job_number = $data[3];
                $bill->bill_date = date('Y/m/d');
                $bill->total_amount = $finalamount;
                $bill->tax = $data[11];
                $bill->discount = '0';
                $bill->recievable = $request->region;
                $bill->old_debt = '0';
                $bill->cancalled = '0';
                $bill->branch = $data[18];
                $bill->customer = $data[17];
                $bill->bank = $request->bankID;
                $bill->company = $request->companyID;
                $bill->service = 'IBR';

                $bill->save();


                $log = new Log;
                $log->user_id = $request->user()->id;
                $log->activity = $data[3] . " Bill Was generated again";
                $log->date = date('Y/m/d');
                $log->time = date("h:i:sa");
                $log->service = 'IBR';
                $log->save();
                return $pdf;
            }
        }
    }

    public function printPDF(Request $request)
    {
        $date = date_create($request->reqdate);
        $orderDate = date_format($date, "d-M-Y");
        $data = [
            $request->job_id,
            $request->company,
            $request->address,
            $request->bankref,
            $orderDate,
            $request->billadd,
            $request->country,
            $request->score,
            $request->rating,
            $request->litigation,
            $request->register,
            $request->activity,
            $request->letterhead,
            $request->id,
            $request->top,
            $request->bottom,
            $request->topfirst,
            $request->removeFirst,
            $request->removeLast,
            $request->bank,
            $request->customer,
            $request->vendor,
            $request->vendoref,
            $request->vendorDate,
            $request->vendorAddress,
            $request->reportType,
            $orderDate,

        ];

        $id = $request->id;
        File::delete('Reports/IBR/' . $id . '/report.pdf');

        //With LetterHead

        if ($data[12] == true) {
            $giver = $request->given_by;
            if ($giver == "Customers") {
                $pdf4 = PDF::loadView('pdf4', compact('data'));
                $pdf4->save('Reports/IBR/first.pdf');
            } else {
                $pdf1 = PDF::loadView('pdf', compact('data'));
                $pdf1->save('Reports/IBR/first.pdf');
            }




            $pdf3 = PDF::loadView('pdf3', compact('data'));
            $pdf3->save('Reports/IBR/second.pdf');



            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', 'A4');


            //First Page
            if ($data[17] == false) {
                $pdf->AddPage();
                $pdf->setSourceFile("Reports/IBR/first.pdf");
                $pdf->SetY(-37);
                $pdf->Image('images/bar2.PNG', -5, $pdf->GetY(), 220);
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 5, 5);
            }

            $pdf->AddPage();
            $pdf->setSourceFile("Reports/IBR/second.pdf");
            $pdf->SetY(-37);
            $pdf->Image('images/bar2.PNG', -5, $pdf->GetY(), 220);
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 5, 5);

            $pageCount = $pdf->setSourceFile('Reports/IBR/' . $data[13] . '/original.pdf');

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

                $pdf->AddPage();
                $templateId = $pdf->importPage($pageNo);
                $pdf->useTemplate($templateId);
                $pdf->SetFont('Arial', 'I', 8);


                if ($data[14] == true) {

                    $pdf->setY(4);
                    $pdf->Image('images/logo.png', 10, $pdf->GetY(), 70);
                    $pdf->Image('images/logo2.png', 130, $pdf->GetY(), 85);
                }

                if ($data[17] == false) {
                    $pages = $pdf->PageNo();
                    $page = $pages - 2;
                    $pdf->setY(276);
                    $pdf->Cell(0, 0, 'Page ' . $page, 0, 0, 'C');
                } else {

                    $pages = $pdf->PageNo();
                    $page = $pages - 1;
                    $pdf->setY(276);
                    $pdf->Cell(0, 0, 'Page ' . $page, 0, 0, 'C');
                }



                if ($data[15] == true) {

                    $pdf->SetY(283);
                    $pdf->Image('images/footer2.png', 0, $pdf->GetY(), 211);
                }
            }


            //Last Page
            if ($data[18] == false) {
                $pdf->AddPage();
                $pdf->setSourceFile("Reports/IBR/last.pdf");
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, -7, 0);
            }

            if ($data[14] == true) {

                $pdf->setY(4);
                $pdf->Image('images/logo.png', 10, $pdf->GetY(), 70);
                $pdf->Image('images/logo2.png', 130, $pdf->GetY(), 85);
            }

            if ($data[15] == true) {

                $pdf->SetY(-14);
                $pdf->Image('images/footer2.png', 0, $pdf->GetY(), 211);
            }

            $id = $request->id;

            $pdf1 = $pdf->Output();

            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->job_id . " Report was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'IBR';
            $log->save();

            return $pdf1;
        }


        //Without LetterHead
        else {

            $giver = $request->given_by;
            if ($giver == "Customers") {
                $pdf4 = PDF::loadView('pdf4', compact('data'));
                $pdf4->save('Reports/IBR/first.pdf');
            } else {
                $pdf1 = PDF::loadView('pdf', compact('data'));
                $pdf1->save('Reports/IBR/first.pdf');
            }


            $pdf3 = PDF::loadView('pdf3', compact('data'));
            $pdf3->save('Reports/IBR/second.pdf');



            $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', 'A4');



            $pdf->AddPage();
            $pdf->setSourceFile("Reports/IBR/first.pdf");

            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 5, 5);


            $pdf->AddPage();
            $pdf->setSourceFile("Reports/IBR/second.pdf");

            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 5, 5);

            $pageCount = $pdf->setSourceFile('Reports/IBR/' . $data[13] . '/original.pdf');

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

                $pdf->AddPage();
                $templateId = $pdf->importPage($pageNo);
                $pdf->useTemplate($templateId);
                $pdf->SetFont('Arial', 'I', 8);
                $pages = $pdf->PageNo();
                $page = $pages - 2;

                $pdf->setY(276);
                $pdf->Cell(0, 0, 'Page ' . $page, 0, 0, 'C');
            }


            $pdf->AddPage();
            $pdf->setSourceFile("Reports/IBR/last.pdf");
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, -7, 0);

            $id = $request->id;

            //$pdf->Output('F','Reports/IBR/'.$id.'/report.pdf');

            $pdf = $pdf->Output('I', 'report.pdf');


            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $request->job_id . " Report was generated";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'IBR';
            $log->save();

            return $pdf;
        }
    }



    public function progress(Request $request)
    {
        if ($request->ajax()) {
            $progress = DB::table('ibr_progress')
                ->leftJoin('users', 'ibr_progress.user_id', '=', 'users.id')
                ->select(
                    'ibr_progress.*',
                    'users.name'

                )
                ->get();
            return Datatables::of($progress)
                ->addIndexColumn()
                ->make(true);
        }

        return view('ibr.progress');
    }


    public function storeProgress(Request $request)
    {

        $progress = new Ibr_Progress();
        $progress->user_id = $request->user()->id;
        $progress->message = $request->message;
        $progress->date = $request->date;
        $progress->activity = $request->activity;
        $progress->client = $request->client == true ? 'Yes' : 'No';
        $progress->job_id = $request->jobid;
        $progress->save();


        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $request->jobid . " Progress was added";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'IBR';
        $log->save();
        return $request->jobid;
    }
}
