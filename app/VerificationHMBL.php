<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use App\Job;
use App\Log;
use App\VerificationSoneri;
use PDF;
use App\Bill_Ibr;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class VerificationHMBL extends Model
{
    protected $table = 'verification_jobs';

    public static function getUserCompany($id, $token)
    {

        $rec = Company::where('company_id', $id)
            ->select('*')
            ->get();
        $user = [
            $id,
            $rec[0],
            $token
        ];
        return $user;
    }

    

    public static function storeVerification($request)
    {

        $val = new Verification;

        // $val->request_date=date("Y/m/d");
        $val->region_id = $request->regional_id;
        $val->job_by = $request->job_by;
        $val->given_by = $request->given_by;
        $val->bank_id = $request->bank_id;
        $val->branch_id = $request->branch_id;
        $val->bank_address = $request->bank_address;
        $val->bank_representative = $request->bank_representative;
        $val->bank_designation = $request->bank_designation;
        $val->bank_phone = $request->bank_phone;
        $val->bank_fax = $request->bank_fax;
        $val->bank_email = $request->bank_email;
        $val->bank_letter = $request->bank_letter;
        $val->bank_letter_date = $request->letter_date;
        $val->byvendor_id = $request->ins_vendor_id;
        $val->byvendor_representative = $request->ins_vendor_representaive;
        $val->byvendor_designation = $request->ins_vendor_designation;
        $val->byvendor_address = $request->ins_billing_address;
        $val->byvendor_phone = $request->ins_vendor_phone;
        $val->byvendor_fax = $request->ins_vendor_fax;
        $val->byvendor_email = $request->ins_vendor_email;
        $val->byvendor_letter = $request->ins_vendor_letter;
        $val->vendor_letter_date = $request->ins_vendor_date;
        $val->customer_id = $request->customer_id;
        $val->customer_representative = $request->customer_representative;
        $val->customer_designation = $request->customer_designation;
        $val->customer_phone = $request->customer_phone;
        $val->customer_cnic = $request->customer_cnic;
        $val->customer_address = $request->customer_location;
        $val->customer_email = $request->customer_email;
        $val->request_date = $request->requested_on;
        $val->operational_branch = $request->operational_branch;
        $val->service_charges = $request->service_charges;
        $val->is_sales_tax = $request->is_sales_tax == true ? '1' : '0';
        // $val->is_hold = $request->is_hold == true ? '1' : '0';
        $val->sale_reg = $request->sale_reg;
        $val->product_type = $request->product_type;
        $val->product_sub_type = $request->product_sub_type;
        $val->qc_officer = $request->qc_officer;
        $val->total_amount = 0;
        $val->cancalled = 0;
        $val->customer_delay = 0;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();
    }
    public static function verticalHomeFormatHMBL($request,$myarray,$billid)
    {
        $count = count($myarray[0]);
        $data =collect();
        foreach($myarray as $item)
        {
            for ($i=1; $i < $count ; $i++) { 

                $cnid="";
                $refid=$item[$i][1];
                $proname=$item[$i][2];
                // echo $item[$i][4]."<br>";
                VerificationHMBL::storeBulkVerification($request,$cnid,$refid,$proname);
                $cjob = VerificationHMBL::getLatestJob($request);
                $cid = $cjob->id;
                VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                VerificationHMBL::updateJobID($request, $cid);
                $radd= $item[$i][8];
                $offadd= $item[$i][6];

                $amc= "";
                $bs= $item[$i][11];
                $bname= $item[$i][10];
                $salaryslip= $item[$i][12];
                $no= "";
                $other= "";

                $teamlead= "";
                $offcont= $item[$i][7];
                $rescont= $item[$i][9];

                VerificationHMBL::addSurveysBulk($request, $cid,$radd,$offadd,$amc,$bs,$salaryslip,$no,$other,$teamlead,$bname);

                $appname= $item[$i][3];
                $appcnic= $item[$i][4];
                $appcell= "";

                VerificationHMBL::addDetailsBulk($request, $cid,$appname,$appcell,$offcont,$rescont,$appcnic);

            
            
            
            }


        }
    }

    public static function verticalAutoFormatSoneri($request,$myarray,$billid)
    {
        $count = count($myarray[0]);
        $data =collect();
        
        
        foreach($myarray as $item)
        {
          
            for ($i=2; $i < $count ; $i++) { 

                $cnid="";
                $refid=$item[$i][1];
                //  echo $item[$i][0]."<br>";
                VerificationHMBL::storeBulkVerification($request,$cnid,$refid);
                 $cjob = VerificationHMBL::getLatestJob($request);
                 $cid = $cjob->id;
                 VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                 VerificationHMBL::updateJobID($request, $cid);
                 $radd= $item[$i][8];
                $resarea= $item[$i][9];
                $rescont= $item[$i][7];
                 $offadd= $item[$i][14];
                 $offcont= $item[$i][13];
                $offarea= $item[$i][15];


                 $amc= '';
                 $bs= '';
                 $salaryslip=$item[$i][11];
                 $no= '';
                 $other='';

                 $teamlead= '';
                 $business=$item[$i][5];
                 VerificationHMBL::addSurveysBulkForSoneri($request, $cid,$radd,$offadd,$amc,$bs,$salaryslip,$no,$other,$teamlead,$business);

                 $appname= $item[$i][2];
                 $appcell= $item[$i][7];
                 $appcnic= $item[$i][4];

                VerificationHMBL::addDetailsBulkForSoneri($request, $cid,$appname,$appcell,$appcnic,$business);

            
            
            
            }


        }
    }
    public static function verticalHomeFormat($request,$myarray)
    {
        
        $count = count($myarray[0]);
        $billid = Verification::getLatestJob($request);

            $data=collect([]);
            foreach($myarray as $item)
            {   
                $d=collect();

                for($i=1; $i < $count ; $i++)
                {
                    $contains = Str::contains($item[$i][0], 'Case');

                    if($contains)
                    {
                      $d->push($i+2);
                    }
                    
                 
                }

                $d->push(count($item)+2);
                $data->push($d);

                $data->all();
                

                
            }


           

            $recs=collect();
            
           
            for ($j=0; $j <  count($data[0]); $j++) { 
           

                if($j!=0)
                {
                $end=$data[0][$j]-2;
                $start=$data[0][$j-1];
              
                foreach($myarray as $it)
                {

                    // echo $start . "-" . $end."<br>";

                    $temp=collect();
                        
                        for($k=$start; $k < $end ; $k++)
                        {
                            $case=collect();
                            $case[]=$it[$k][0];
                            $case[]=$it[$k][1];//Inquiry
                            $case[]=$it[$k][2];//BrCode
                            $case[]=$it[$k][3];//Type
                            $case[]=$it[$k][4];//Segment
                            $case[]=$it[$k][5];//Account
                            $case[]=$it[$k][6];//Customer
                            $case[]=$it[$k][7];//Residence
                            $case[]=$it[$k][8];//ResidenceContact
                            $case[]=$it[$k][9];//Designation
                            $case[]=$it[$k][10];//Company
                            $case[]=$it[$k][11];//Office
                            $case[]=$it[$k][12];//SalarySlip
                            $case[]=$it[$k][13];//Team Lead
                            $case[]=$it[$k][14];//Team Lead
                            $case->all();

                            // if($it[$k][2]!=null || $it[$k][0]!=null)
                            // {
                                
                            // // $temp->push($it[$k][1]);
                            // if($it[$k][2]==null)
                            // {
                            // $temp[] = '';

                            // }
                            // else{
                            // $temp[] = $it[$k][2];

                            // }

                            // }
                            $temp->push($case);

                        }
                    $temp->all();
                    
                    $recs->push($temp);

                }

                }
                
              

                
            }
            $recs->all();

            
            
            
            for ($p=0; $p < count($recs) ; $p++) { 
                # code...
                // echo $recs[$p][1][3]."<br>";
               
                // dd($recs[$p][0]);
               
                 $cnid="";

                //Applicant
                if($recs[$p][0][6]!="")
                {

                    

                    $type="Applicant";
                    $refid=$recs[$p][0][1];
                    Verification::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                    $cjob = Verification::getLatestJob($request);
                    $cid = $cjob->id;
                    $cnid=$cjob->id;
                    Verification::addCommonJob($request, $cid,$billid->id);
                    Verification::updateJobID($request, $cid);

                    $appname= $recs[$p][0][6];
                    $appfather= "";
                    $appdob= "";
                    $appcnic= "";
                    $appcell=$recs[$p][0][8];
                    $appdes=$recs[$p][0][9];
                    $appbusiness=$recs[$p][0][10];
                    $apprescell="";
                    $appworkcell= "";

                    VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell,$appdes,$appbusiness);
               
                    //Residence
                    if($recs[$p][0][7]!=null)
                    {
                        // $city = DB::table('c_city')
                        // ->where('city_name', $recs[$p][12])
                        // ->select('city_id')
                        // ->get();  
                        $radd= $recs[$p][0][7];
                        $teamlead= $recs[$p][0][14];

                        $city= "";
                        $surname= "Residence";
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);
                        
                    }

                    //Workplace
                    if($recs[$p][0][11]!=null)
                    {

                            
                        $offadd= $recs[$p][0][11];
                        $teamlead= $recs[$p][0][14];
                        $salaryslip= $recs[$p][0][12]==null ? 0 : 1;

                    
                        Verification::addWorkSurveyforhome($request, $cid,$offadd,$teamlead,$salaryslip);
                        
                    }

                    //Salary Slip
                    if($recs[$p][0][12]!=null )
                    {

                        $city= "";
                            
                        $radd= $recs[$p][0][12];
                        $teamlead= $recs[$p][0][14];
                        $surname= "Salary Slip";
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);

                    
                        
                    }

                    //BS
                    if($recs[$p][0][13]!=null)
                    {

                        $city= "";
                            
                        $radd= $recs[$p][0][13];
                        $teamlead= $recs[$p][0][14];
                        $surname='Bank Statement';
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);

                    
                        
                    }
                  
                }

             
                //Co-Applicant
                if($recs[$p][1][6]!="")
                {

                    $type="Co-Applicant";
                    $refid="";
                    VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                    $cjob = VerificationHMBL::getLatestJob($request);
                    $cid = $cjob->id;
                    VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                    VerificationHMBL::updateJobID($request, $cid);

                    $appname= $recs[$p][1][6];
                    $appfather= "";
                    $appdob= "";
                    $appcnic= "";
                    $appcell=$recs[$p][1][8];
                    $appdes=$recs[$p][1][9];
                    $appbusiness=$recs[$p][1][10];
                    $apprescell="";
                    $appworkcell= "";


                    VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell,$appdes,$appbusiness);
                  
                        //Residence
                    if($recs[$p][1][7]!=null)
                    {
                        // $city = DB::table('c_city')
                        // ->where('city_name', $recs[$p][12])
                        // ->select('city_id')
                        // ->get();  
                        $radd= $recs[$p][1][7];
                        $teamlead= $recs[$p][1][14];

                        $city= "";
                        $surname= "Residence";
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);
                        
                    }

                    //Workplace
                    if($recs[$p][1][11]!=null)
                    {

                            
                        $offadd= $recs[$p][1][11];
                        $teamlead= $recs[$p][1][14];
                        $salaryslip= $recs[$p][1][12]==null ? 0 : 1;

                    
                        Verification::addWorkSurveyforhome($request, $cid,$offadd,$teamlead,$salaryslip);
                        
                    }

                    //Salary Slip
                    if($recs[$p][1][12]!=null )
                    {

                        $city= "";
                            
                        $radd= $recs[$p][1][12];
                        $teamlead= $recs[$p][1][14];
                        $surname= "Salary Slip";
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);

                    
                        
                    }

                    //BS
                    if($recs[$p][1][13]!=null)
                    {

                        $city= "";
                            
                        $radd= $recs[$p][1][13];
                        $teamlead= $recs[$p][1][14];
                        $surname='Bank Statement';
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);

                    
                        
                    }
                  
                }
                
                //Reference #1
                if($recs[$p][2][6]!="")
                {
                   
                    $type="Reference";
                    $refid="";
                    VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                    $cjob = VerificationHMBL::getLatestJob($request);
                    $cid = $cjob->id;
                    VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                    VerificationHMBL::updateJobID($request, $cid);

                    $appname= $recs[$p][2][6];
                    $appfather= "";
                    $appdob= "";
                    $appcnic= "";
                    $appcell=$recs[$p][2][8];
                    $appdes=$recs[$p][2][9];
                    $appbusiness=$recs[$p][2][10];
                    $apprescell="";
                    $appworkcell= "";


                    VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell,$appdes,$appbusiness);
                   

                    //Residence
                    if($recs[$p][2][7]!=null)
                    {
                        // $city = DB::table('c_city')
                        // ->where('city_name', $recs[$p][12])
                        // ->select('city_id')
                        // ->get();  
                        $radd= $recs[$p][2][7];
                        $teamlead= $recs[$p][2][14];

                        $city= "";
                        $surname= "Residence";
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);
                        
                    }

                    //Workplace
                    if($recs[$p][2][11]!=null)
                    {

                            
                        $offadd= $recs[$p][2][11];
                        $teamlead= $recs[$p][2][14];
                        $salaryslip= $recs[$p][2][12]==null ? 0 : 1;


                        Verification::addWorkSurveyforhome($request, $cid,$offadd,$teamlead,$salaryslip);
                        
                    }

                    //Salary Slip
                    if($recs[$p][2][12]!=null )
                    {

                        $city= "";
                            
                        $radd= $recs[$p][2][12];
                        $teamlead= $recs[$p][2][14];
                        $surname= "Salary Slip";
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);


                        
                    }

                    //BS
                    if($recs[$p][2][13]!=null)
                    {

                        $city= "";
                            
                        $radd= $recs[$p][2][13];
                        $teamlead= $recs[$p][2][14];
                        $surname='Bank Statement';
                        Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);


                        
                    }
                   
                  
                }


                   //Reference #2
                if($recs[$p][3][6]!="")
                {
                    
                    $type="Reference";
                    $refid="";
                    VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                    $cjob = VerificationHMBL::getLatestJob($request);
                    $cid = $cjob->id;
                    VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                    VerificationHMBL::updateJobID($request, $cid);

                    $appname= $recs[$p][3][6];
                    $appfather= "";
                    $appdob= "";
                    $appcnic= "";
                    $appcell=$recs[$p][3][8];
                    $appdes=$recs[$p][3][9];
                    $appbusiness=$recs[$p][3][10];
                    $apprescell="";
                    $appworkcell= "";

                    VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell,$appdes,$appbusiness);
                    
                   //Residence
                   if($recs[$p][3][7]!=null)
                   {
                       // $city = DB::table('c_city')
                       // ->where('city_name', $recs[$p][12])
                       // ->select('city_id')
                       // ->get();  
                       $radd= $recs[$p][3][7];
                       $teamlead= $recs[$p][3][14];

                       $city= "";
                       $surname= "Residence";
                       Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);
                       
                   }

                   //Workplace
                   if($recs[$p][3][11]!=null)
                   {

                           
                       $offadd= $recs[$p][3][11];
                       $teamlead= $recs[$p][3][14];
                       $salaryslip= $recs[$p][3][12]==null ? 0 : 1;

                   
                       Verification::addWorkSurveyforhome($request, $cid,$offadd,$teamlead,$salaryslip);
                       
                   }

                   //Salary Slip
                   if($recs[$p][3][12]!=null )
                   {

                       $city= "";
                           
                       $radd= $recs[$p][3][12];
                       $teamlead= $recs[$p][3][14];
                       $surname= "Salary Slip";
                       Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);

                   
                       
                   }

                   //BS
                   if($recs[$p][3][13]!=null)
                   {

                       $city= "";
                           
                       $radd= $recs[$p][3][13];
                       $teamlead= $recs[$p][3][14];
                       $surname='Bank Statement';
                       Verification::addResSurveyforhome($request, $cid,$radd,$teamlead,$city,$surname);

                   
                       
                   }
                    
                }
              

            }

    }
    
    public static function verticalHomeFormatSoneri($request,$myarray)
    {
        $count = count($myarray[0]);
        $data =collect();
        $billid = VerificationHMBL::getLatestJob($request);
        
        
        foreach($myarray as $item)
        {
          
            for ($i=2; $i < $count ; $i++) { 

               
                     $cnid="";
                    $type="Applicant";
                    $refid= $item[$i][1];
                    VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                    $cjob = VerificationHMBL::getLatestJob($request);
                    $cid = $cjob->id;
                    $cnid=$cjob->id;
                    VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                    VerificationHMBL::updateJobID($request, $cid);

                    $appname= $item[$i][2];
                    $appfather= "";
                    $appdob= "";
                    $appcnic= $item[$i][4];
                    $appcell='';
                    $appdes='';
                    $appbusiness=$item[$i][5];
                    $apprescell=$item[$i][13];
                    $appworkcell= $item[$i][7];

                    VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell,$appdes,$appbusiness);
               
                    //Residence
                    if($item[$i][14]!=null)
                    {
                        // $city = DB::table('c_city')
                        // ->where('city_name', $recs[$p][12])
                        // ->select('city_id')
                        // ->get();  
                        $radd= $item[$i][14];
                        $teamlead= "";

                        $city= "";
                        $surname= "Residence";
                        // $areares= $item[$i][9];
                         $area= $item[$i][15];
                        VerificationHMBL::addResSurveyforhomeSoneri($request, $cid,$radd,$teamlead,$city,$surname,$area);
                        
                    }

                    //Workplace
                    if($item[$i][8]!=null)
                    {

                            
                        $offadd= $item[$i][8];
                        $teamlead= "";
                        $salaryslip= $item[$i][11];
                        // $areaoff= $item[$i][12];
                        $area= $item[$i][9];

                    
                        VerificationHMBL::addWorkSurveyforhomeSoneri($request, $cid,$offadd,$teamlead,$salaryslip,$area);
                        
                    }
            
            
            }


        }
        }

    // public static function verticalHomeFormat($request,$myarray)
    // {
        
    //     $count = count($myarray[0]);
    //     $billid = VerificationHMBL::getLatestJob($request);

    //         $data=collect([]);
    //         foreach($myarray as $item)
    //         {   
    //             $d=collect();

    //             for($i=1; $i < $count ; $i++)
    //             {
    //                 $contains = Str::contains($item[$i][0], 'CASE');

    //                 if($contains)
    //                 {
    //                   $d->push($i);

    //                 }
                 
    //             }

    //             $d->push(count($item));
    //             $data->push($d);

    //             $data->all();
                

                
    //         }
    //         $recs=collect();
            
           
    //         for ($j=0; $j <  count($data[0]); $j++) { 
           

    //             if($j!=0)
    //             {
    //             $end=$data[0][$j];
    //             $start=$data[0][$j-1];
              
    //             foreach($myarray as $it)
    //             {

    //                 // echo $start . "-" . $end;

    //                 $temp=collect();
                        
    //                     for($k=$start; $k < $end ; $k++)
    //                     {
    //                         if($it[$k][1]!=null || $it[$k][0]!=null)
    //                         {
                                
    //                         // $temp->push($it[$k][1]);
    //                         if($it[$k][1]==null)
    //                         {
    //                         $temp[] = '';

    //                         }
    //                         else{
    //                         $temp[] = $it[$k][1];

    //                         }

    //                         }
    //                     }
    //                 $temp->all();
                    
    //                 $recs->push($temp);

    //             }

    //             }
                
              

                
    //         }
    //         $recs->all();
            
            
    //         for ($p=0; $p < count($recs) ; $p++) { 
    //             # code...
    //             // echo $recs[$p]["Br Code"]."<br>";
    //             // dd($recs);

               
    //              $cnid="";

    //             //Applicant
    //             if($recs[$p][3]!="")
    //             {

                    

    //                 $type="Applicant";
    //                 VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type);
    //                 $cjob = VerificationHMBL::getLatestJob($request);
    //                 $cid = $cjob->id;
    //                 $cnid=$cjob->id;
    //                 VerificationHMBL::addCommonJob($request, $cid,$billid->id);
    //                 VerificationHMBL::updateJobID($request, $cid);

    //                 $appname= $recs[$p][3];
    //                 $appfather= $recs[$p][4];
    //                 $appdob= date_format(date_create($recs[$p][6]),'Y-m-d');
    //                 $appcnic= $recs[$p][7];
    //                 $appcell= $recs[$p][14];
    //                 $apprescell= $recs[$p][13];
    //                 $appworkcell= $recs[$p][20];

    //                 VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
                    
    //                 if($recs[$p][11]!="")
    //                 {
    //                     $city = DB::table('c_city')
    //                     ->where('city_name', $recs[$p][12])
    //                     ->select('city_id')
    //                     ->get();  
    //                     $radd= $recs[$p][11];
    //                     $teamlead= $recs[$p][1];

    //                     $city= $city[0]->city_id;
                    
    //                     VerificationHMBL::addResSurveyforhome($request, $cid,$radd,$teamlead,$city);
                        
    //                 }

    //                 if($recs[$p][16]!="")
    //                 {

                         
    //                 $offadd= $recs[$p][18];
    //                 $teamlead= $recs[$p][1];

                
    //                 VerificationHMBL::addWorkSurveyforhome($request, $cid,$offadd,$teamlead);
                        
    //                 }
                  
    //             }

             
    //             //Co-Applicant
    //             if($recs[$p][22]!="")
    //             {

    //                 $type="Co-Applicant";
    //                 VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type);
    //                 $cjob = VerificationHMBL::getLatestJob($request);
    //                 $cid = $cjob->id;
    //                 VerificationHMBL::addCommonJob($request, $cid,$billid->id);
    //                 VerificationHMBL::updateJobID($request, $cid);

    //                 $appname= $recs[$p][22];
    //                 $appfather= $recs[$p][23];
    //                 $appdob= date_format(date_create($recs[$p][25]),'Y-m-d');
    //                 $appcnic= $recs[$p][26];
    //                 $appcell= $recs[$p][33];
    //                 $apprescell= $recs[$p][32];
    //                 $appworkcell= $recs[$p][39];

    //                 VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
                    
    //                 if($recs[$p][30]!="")
    //                 {

    //                     $city = DB::table('c_city')
    //                     ->where('city_name', $recs[$p][12])
    //                     ->select('city_id')
    //                     ->get(); 
    //                     $city= $city[0]->city_id;

    //                     $radd= $recs[$p][11];
    //                     $teamlead= $recs[$p][1];

    //                     VerificationHMBL::addResSurveyforhome($request, $cid,$radd,$teamlead,$city);
                        
    //                 }

    //                 if($recs[$p][35]!="")
    //                 {

                         
    //                     $offadd= $recs[$p][37];
    //                     $teamlead= $recs[$p][1];

                
    //                     VerificationHMBL::addWorkSurveyforhome($request, $cid,$offadd,$teamlead);
                        
    //                 }
                  
    //             }
                
    //             //Reference #1
    //             if($recs[$p][43]!="")
    //             {
                   
    //                 $type="Reference";
    //                 VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type);
    //                 $cjob = VerificationHMBL::getLatestJob($request);
    //                 $cid = $cjob->id;
    //                 VerificationHMBL::addCommonJob($request, $cid,$billid->id);
    //                 VerificationHMBL::updateJobID($request, $cid);

    //                 $appname= $recs[$p][43];
    //                 $appfather= "";
    //                 $appdob= "";
    //                 $appcnic= $recs[$p][44];
    //                 $appcell= $recs[$p][49];
    //                 $apprescell= $recs[$p][48];
    //                 $appworkcell= $recs[$p][53];

    //                 VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
                    
    //                 if($recs[$p][46]!="")
    //                 {

    //                     $radd= $recs[$p][46];
    //                     $teamlead= $recs[$p][1];

    //                     $city = DB::table('c_city')
    //                     ->where('city_name', $recs[$p][12])
    //                     ->select('city_id')
    //                     ->get();
    //                     $city= $city[0]->city_id;

                    
    //                     VerificationHMBL::addResSurveyforhome($request, $cid,$radd,$teamlead,$city);
                        
    //                 }

    //                 if($recs[$p][51]!="")
    //                 {

                          
    //                     $offadd= $recs[$p][52];
    //                     $teamlead= $recs[$p][1];

    //                     VerificationHMBL::addWorkSurveyforhome($request, $cid,$offadd,$teamlead);
                        
    //                 }
                  
    //             }


    //                //Reference #2
    //             if($recs[$p][56]!="")
    //             {
                    
    //                 $type="Reference";
    //                 VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type);
    //                 $cjob = VerificationHMBL::getLatestJob($request);
    //                 $cid = $cjob->id;
    //                 VerificationHMBL::addCommonJob($request, $cid,$billid->id);
    //                 VerificationHMBL::updateJobID($request, $cid);

    //                 $appname= $recs[$p][56];
    //                 $appfather= "";
    //                 $appdob= "";
    //                 $appcnic= $recs[$p][57];
    //                 $appcell= $recs[$p][62];
    //                 $apprescell= $recs[$p][61];
    //                 $appworkcell= $recs[$p][66];

    //                 VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
                    
    //                 if($recs[$p][59]!="")
    //                 {

    //                     $radd= $recs[$p][59];
    //                     $teamlead= $recs[$p][1];

    //                     $city = DB::table('c_city')
    //                     ->where('city_name', $recs[$p][60])
    //                     ->select('city_id')
    //                     ->get();
    //                     $city= $city[0]->city_id;

                    
    //                     VerificationHMBL::addResSurveyforhome($request, $cid,$radd,$teamlead,$city);
                        
    //                 }

    //                 if($recs[$p][64]!="")
    //                 {

                            
    //                     $offadd= $recs[$p][65];
    //                     $teamlead= $recs[$p][1];

    //                     VerificationHMBL::addWorkSurveyforhome($request, $cid,$offadd,$teamlead);
                        
    //                 }
                    
    //             }
              

    //         }

    // }

    public static function horizontalFormat($request,$myarray)
    {   
        $count = count($myarray[0]);
        $billid = VerificationHMBL::getLatestJob($request);

         foreach($myarray as $item)
            {
                for ($i=1; $i < $count ; $i++) { 
                   
                    $appl=$item[$i][2];
                    $coapp1=$item[$i][19];
                    $ref1=$item[$i][39];
                    $ref2=$item[$i][49];
                    $cnid="";
                   

                    if($appl!="")
                    {
                        $type="Applicant";
                        VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                        $cjob = VerificationHMBL::getLatestJob($request);
                        $cid = $cjob->id;
                        $cnid=$cjob->id;
                        VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                        VerificationHMBL::updateJobID($request, $cid);

                      

                 
                        $appname= $item[$i][2];
                        $appfather= $item[$i][3];
                        $appdob= date_format(date_create($item[$i][5]),'Y-m-d');
                        $appcnic= $item[$i][6];
                        $appcell= $item[$i][12];
                        $apprescell= $item[$i][11];
                        $appworkcell= $item[$i][17];

                        VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
                     
                        $radd= $item[$i][9];
                        $offadd= $item[$i][15];
                        $teamlead= $item[$i][0];

                     
                        VerificationHMBL::addSurveysBulkforhome($request, $cid,$radd,$offadd,$teamlead);

                    }

                    if($coapp1!="")
                    {
                        $type="Co-Applicant";
                        VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                        $cjob = VerificationHMBL::getLatestJob($request);
                        $cid = $cjob->id;
                        VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                        VerificationHMBL::updateJobID($request, $cid);
                        // VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic);


                        $appname= $item[$i][19];
                        $appfather= $item[$i][20];
                        $appdob= date_format(date_create($item[$i][22]),'Y-m-d');
                        $appcnic= $item[$i][23];
                        $appcell= $item[$i][29];
                        $apprescell= $item[$i][28];
                        $appworkcell= $item[$i][34];

                        VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
                        
                        $radd= $item[$i][26];
                        $offadd= $item[$i][32];
                        $teamlead= $item[$i][0];

                     
                        VerificationHMBL::addSurveysBulkforhome($request, $cid,$radd,$offadd,$teamlead);

                    }

                    if($ref1!="")
                    {
                        $type="Reference";
                        VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                        $cjob = VerificationHMBL::getLatestJob($request);
                        $cid = $cjob->id;
                        VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                        VerificationHMBL::updateJobID($request, $cid);
                        // VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic);

                        
                        $appname= $item[$i][39];
                        $appfather= "";
                        $appdob="";
                        $appcnic= $item[$i][40];
                        $appcell= $item[$i][44];
                        $apprescell= $item[$i][43];
                        $appworkcell= $item[$i][47];

                        VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
                       
                        $radd= $item[$i][41];
                        $offadd= $item[$i][46];
                        $teamlead= $item[$i][0];

                     
                        VerificationHMBL::addSurveysBulkforhome($request, $cid,$radd,$offadd,$teamlead);

                    }

                    if($ref2!="")
                    {
                        $type="Reference";
                        VerificationHMBL::storeBulkVerificationforhome($request,$cnid,$type,$refid);
                        $cjob = VerificationHMBL::getLatestJob($request);
                        $cid = $cjob->id;
                        VerificationHMBL::addCommonJob($request, $cid,$billid->id);
                        VerificationHMBL::updateJobID($request, $cid);
                        // VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic);

                        
                        $appname= $item[$i][49];
                        $appfather= "";
                        $appdob= "";
                        $appcnic= $item[$i][50];
                        $appcell= $item[$i][54];
                        $apprescell= $item[$i][53];
                        $appworkcell= "";

                        VerificationHMBL::addDetailsBulkforhome($request, $cid,$appname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell);
  
                        $radd= $item[$i][51];
                        $offadd= $item[$i][56];
                        $teamlead= $item[$i][0];

                     
                        VerificationHMBL::addSurveysBulkforhome($request, $cid,$radd,$offadd,$teamlead);

                    }

                  

                   
               
                    // $radd= $item[$i][6];
                    // $offadd= $item[$i][10];

                    // $amc= $item[$i][14];
                    // $bs= $item[$i][15];
                    // $salaryslip= $item[$i][16];
                    // $no= $item[$i][17];
                    // $other= $item[$i][18];

                    // $teamlead= $item[$i][19];
                  

                
                
                
                }


            }
    }
    public static function storeBulkVerification($request,$cnid,$refid,$proname)
    {

        $b = DB::table('c_branch')->where('branch_id',$request->branch_id)->select('*')->get();

        $val = new Verification;

        // $val->request_date=date("Y/m/d");
        $val->region_id = $request->regional_id;
        $val->job_by = $request->job_by;
        $val->given_by = "Bank";
        $val->bank_id = $request->bank_id;
        $val->branch_id = $request->branch_id;
        $val->product_type = $request->product_type;
        $val->operational_branch = $request->opbranch;
        $val->bank_letter_date = date('Y-m-d');
        $val->bank_letter = 'Email';
        $val->ref_Id= $refid;
        $val->product_name= $proname;


        $val->bank_address = $b[0]->branch_address;
        // $val->sale_reg = $request->sales_reg;
        $val->bank_phone = $b[0]->branch_phone;

        // $val->bank_representative = $request->bank_representative;
        // $val->bank_designation = $request->bank_designation;
        // $val->bank_phone = $request->bank_phone;
        // $val->bank_fax = $request->bank_fax;
        // $val->bank_email = $request->bank_email;
        // $val->bank_letter = $request->bank_letter;
        // $val->bank_letter_date = $request->letter_date;
        // $val->byvendor_id = $request->ins_vendor_id;
        // $val->byvendor_representative = $request->ins_vendor_representaive;
        // $val->byvendor_designation = $request->ins_vendor_designation;
        // $val->byvendor_address = $request->ins_billing_address;
        // $val->byvendor_phone = $request->ins_vendor_phone;
        // $val->byvendor_fax = $request->ins_vendor_fax;
        // $val->byvendor_email = $request->ins_vendor_email;
        // $val->byvendor_letter = $request->ins_vendor_letter;
        // $val->vendor_letter_date = $request->ins_vendor_date;
        // $val->customer_id = $request->customer_id;
        // $val->customer_representative = $request->customer_representative;
        // $val->customer_designation = $request->customer_designation;
        // $val->customer_phone = $request->customer_phone;
        // $val->customer_cnic = $request->customer_cnic;
        // $val->customer_address = $request->customer_location;
        // $val->customer_email = $request->customer_email;
        // $val->request_date = $request->requested_on;
        // $val->operational_branch = $request->operational_branch;
        // // $val->service_charges = $request->service_charges;
        // $val->is_sales_tax = $request->is_sales_tax == true ? '1' : '0';
        // $val->is_hold = $request->is_hold == true ? '1' : '0';
        // $val->sale_reg = $request->sale_reg;
        // $val->hold_reason = $request->hold_reason;
        // $val->qc_officer = $request->qc_officer;
        $val->total_amount = 0;
        $val->cancalled = 0;
        $val->customer_delay = 0;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();
    }

    public static function storeBulkVerificationforhome($request,$cnid,$type,$refid)
    {

        $b = DB::table('c_branch')->where('branch_id',$request->branch_id)->select('*')->get();

        $val = new Verification;

        // $val->request_date=date("Y/m/d");
        $val->region_id = $request->regional_id;
        $val->job_by = $request->job_by;
        $val->given_by = "Bank";
        $val->bank_id = $request->bank_id;
        $val->branch_id = $request->branch_id;
        $val->product_type = $request->product_type;
        $val->operational_branch = $request->opbranch;
        $val->bank_letter_date = date('Y-m-d');
        $val->bank_letter = 'Email';
        $val->product_type = 'Home';
        $val->product_sub_type = $type;
        $val->ref_Id= $refid;
        // $val->sale_reg = $request->sales_reg;


        $val->bank_address = $b[0]->branch_address;
        $val->conid = $cnid;
        $val->bank_phone = $b[0]->branch_phone;

        // $val->bank_representative = $request->bank_representative;
        // $val->bank_designation = $request->bank_designation;
        // $val->bank_phone = $request->bank_phone;
        // $val->bank_fax = $request->bank_fax;
        // $val->bank_email = $request->bank_email;
        // $val->bank_letter = $request->bank_letter;
        // $val->bank_letter_date = $request->letter_date;
        // $val->byvendor_id = $request->ins_vendor_id;
        // $val->byvendor_representative = $request->ins_vendor_representaive;
        // $val->byvendor_designation = $request->ins_vendor_designation;
        // $val->byvendor_address = $request->ins_billing_address;
        // $val->byvendor_phone = $request->ins_vendor_phone;
        // $val->byvendor_fax = $request->ins_vendor_fax;
        // $val->byvendor_email = $request->ins_vendor_email;
        // $val->byvendor_letter = $request->ins_vendor_letter;
        // $val->vendor_letter_date = $request->ins_vendor_date;
        // $val->customer_id = $request->customer_id;
        // $val->customer_representative = $request->customer_representative;
        // $val->customer_designation = $request->customer_designation;
        // $val->customer_phone = $request->customer_phone;
        // $val->customer_cnic = $request->customer_cnic;
        // $val->customer_address = $request->customer_location;
        // $val->customer_email = $request->customer_email;
        // $val->request_date = $request->requested_on;
        // $val->operational_branch = $request->operational_branch;
        // // $val->service_charges = $request->service_charges;
        // $val->is_sales_tax = $request->is_sales_tax == true ? '1' : '0';
        // $val->is_hold = $request->is_hold == true ? '1' : '0';
        // $val->sale_reg = $request->sale_reg;
        // $val->hold_reason = $request->hold_reason;
        // $val->qc_officer = $request->qc_officer;
        $val->total_amount = 0;
        $val->cancalled = 0;
        $val->customer_delay = 0;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();
    }


    public static function updateVerification($request, $id)
    {
        date_default_timezone_set("Asia/Karachi");

        $ibr = VerificationHMBL::where('id', $id)->first();

        $ibr->region_id = $request->regional_id;
        $ibr->operational_branch = $request->operational_branch;
        $ibr->job_by = $request->job_by;
        $ibr->bank_id = $request->bank_id;
        $ibr->given_by = $request->given_by;
        $ibr->branch_id = $request->branch_id;
        $ibr->bank_address = $request->bank_address;
        $ibr->bank_representative = $request->bank_representative;
        $ibr->bank_designation = $request->bank_designation;
        $ibr->bank_phone = $request->bank_phone;
        $ibr->bank_fax = $request->bank_fax;
        $ibr->bank_email = $request->bank_email;
        $ibr->bank_letter = $request->bank_letter;
        $ibr->bank_letter_date = $request->letter_date;
        $ibr->byvendor_id = $request->ins_vendor_id;
        $ibr->byvendor_address = $request->ins_billing_address;
        $ibr->byvendor_representative = $request->ins_vendor_representaive;
        $ibr->byvendor_designation = $request->ins_vendor_designation;
        $ibr->byvendor_phone = $request->ins_vendor_phone;
        $ibr->byvendor_fax = $request->ins_vendor_fax;
        $ibr->byvendor_email = $request->ins_vendor_email;
        $ibr->byvendor_letter = $request->ins_vendor_letter;
        $ibr->vendor_letter_date = $request->ins_vendor_date;
        $ibr->customer_id = $request->customer_id;
        $ibr->customer_representative = $request->customer_representative;
        $ibr->customer_designation = $request->customer_designation;
        $ibr->customer_phone = $request->customer_phone;
        $ibr->customer_address = $request->customer_address;
        $ibr->customer_cnic = $request->customer_cnic;
        $ibr->customer_email = $request->customer_email;
        $ibr->atten = $request->atten;
        $ibr->qc_officer = $request->qcofficer;
        $ibr->product_type = $request->product_type;
        $ibr->product_sub_type = $request->product_sub_type;

        $ibr->completed = $request->completed == true ? '1' : '0';

        if($request->completed==true)
        {
            $ibr->completed_on = date('Y-m-d');
        }
        $ibr->delivered_on = $request->delivered_on;

        $ibr->request_date = $request->requested_on;

               
        
        $ibr->service_charges = $request->service_charges;



        $ibr->is_sales_tax = $request->is_sales_tax == true ? '1' : '0';
        $ibr->sale_reg = $request->sale_reg;

        $ibr->updated_by = $request->user()->id;

        $ibr->save();

        $val = DB::table('verification_job_details')->where('job_id',$id)->update([
            'applicant_name' => $request->applicant_name,
            'applicant_father' => $request->applicant_father,
            'applicant_contact' => $request->applicant_contact,
            'applicant_cnic' => $request->applicant_cnic,
            'applicant_dob' => $request->applicant_dob,
            'applicant_res_phone' => $request->applicant_res_phone,
            'applicant_work_phone' => $request->applicant_work_phone,

        ]);

        


        $jid = $request->jobid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No: " . $jid . " Was Updated";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Verification';
        $log->save();

       
        
    }

    public static function  deleteSurveyImage($id)
    {
        $sur = DB::table('verification_survey_images')->where('id', $id)->select('*')->get();
        $file = DB::table('verification_survey_images')->where('id', $id)->delete();

        Storage::disk('dir')->delete($sur[0]->path);
    }

    

    public static function addSurvey($request)
    {

        $val = DB::table('verification_surveys')->insert([
            'job_id' => $request->jobid,
            'type'=>$request->surType,
            'city'=>'',
            'surveyor'=>'',
            'address'=>'',
            'surveyor_on_report'=>'',
            'surveyor_billing'=>'',
            'longitude'=>'',
            'latitiude'=>''
        ]);
    }
    public static function updateSurvey($request)
    {
        $val = DB::table('verification_surveys')->where('id', $request->id)->update([
            'city' => $request->city,
            'surveyor'=>$request->surveyor,
            'address'=>$request->address,
            'surveyor_on_report'=>$request->surveyor_on_report,
            'surveyor_billing'=>$request->surveyor_billing,
            'area'=>$request->area,
            'longitude'=>$request->longitude,
            'latitiude'=>$request->latitiude,
            'salary_slip'=>$request->salary_slip == true ? '1' : '0',
            'is_employee'=>$request->is_employee == true ? '1' : '0'


        ]);
    }
    public static function rotateImage($request)
    {
        $val = DB::table('verification_survey_images')->where('id', $request->id)->update([
            'rotate' => $request->rotate


        ]);
    }

    public static function clearSurvey($request)
    {
        $val = DB::table('verification_surveys')->where('id', $request->id)->update([
            'conducted_on' => '',
            'image1'=>'',
            'longitude'=>'',
            'latitiude'=>'',
            'image2'=>'',
            'image3'=>'',
            'res_applicant_is_available'=>'',
            'res_name_of_person_met'=>'',
            'res_nic_of_person_met'=>'',
            'res_relationship_with_applicant'=>'',
            'res_rel_phone'=>'',
            'res_rel_cell'=>'',
            'res_original_nic_seen'=>'',
            'res_cnic_of_applicant'=>'',
            'res_is_address_correct'=>'',
            'res_is_address_correct'=>'',
            'res_correct_address'=>'',
            'res_applicant_live_here'=>'',
            'res_living_since'=>'',
            'res_permanent_address'=>'',
            'res_name_plate_affixed'=>'',
            'res_residence_type'=>'',
            'res_other_residence_type'=>'',
            'res_residence_is'=>'',
            'res_residence_is_other'=>'',
            'res_applicant_is'=>'',
            'res_monthly_rent'=>'',
            'res_rent_deed_verified'=>'',
            'res_residence_utilization'=>'',
            'res_residence_area_size'=>'',
            'res_residence_area_unit'=>'',
            'res_residence_area_details'=>'',
            'res_residence_area_condition'=>'',
            'res_residence_condition'=>'',
            'res_neighboorhood_is'=>'',
            'res_area_access'=>'',
            'res_belongs_to'=>'',
            'res_repossession'=>'',
            'res_repossession'=>'',
            'image4'=>'',
            'image5'=>'',
            'image6'=>'',
            'image7'=>'',
            'image8'=>'',
            'image9'=>'',
            'landmark'=>'',
            'res_neigh_one_name'=>'',
            'res_neigh_one_address'=>'',
            'res_neigh_one_knows_applicant'=>'',
            'res_neigh_one_knows_applicant_since'=>'',
            'res_neigh_one_comments'=>'',
            'res_neigh_two_name'=>'',
            'res_neigh_two_address'=>'',
            'res_neigh_two_knows_applicant'=>'',
            'res_neigh_two_knows_applicant_since'=>'',
            'res_neigh_two_comments'=>''

        ]);
    }
    public static function cancelSurvey($request)
    {
        $val = DB::table('verification_surveys')->where('id', $request->id)->update([
            'status' => 2,
        ]);
        
    }
    public static function completeSurvey($request)
    {
        if($request->title=="Workplace" || $request->title=="Residence" || $request->title=="Workplace / Business")
        {
            $snaps= DB::table('verification_survey_images')
            ->leftJoin('verification_surveys', 'verification_survey_images.survey_id', '=', 'verification_surveys.id')
            ->select('verification_survey_images.id','verification_survey_images.path','verification_surveys.job_id')
            ->where('survey_id', '=',$request->id)
            ->get();
            
            $snapscharges=0;
            $bank=$request->bank;
            if(count($snaps)>0)
            {
                if($bank=="22")
                {
                    $snapscharges=0;
    
                }
                else{
                    $snapscharges=100;
    
                }
    
            }
            else{
                $snapscharges=0;
    
            }
            $serv=$request->sercharges;
            $val = DB::table('verification_surveys')->where('id', $request->id)->update([
                'status' => 1,
                'city' => $request->city,
                'surveyor'=>$request->surveyor,
                'address'=>$request->address,
                'surveyor_on_report'=>$request->surveyor_on_report,
                'surveyor_billing'=>$request->surveyor_billing,
                'longitude'=>$request->longitude,
                'latitiude'=>$request->latitiude,
                'service_charges'=>$serv,
                'snap_charges'=>$snapscharges,
                'total_charges'=>$serv+$snapscharges,
            ]);

            // echo $serv+$snapscharges;
        }

        else{
          
            
            $snapscharges=0;
            
            $val = DB::table('verification_surveys')->where('id', $request->id)->update([
                'status' => 1,
                'city' => $request->city,
                'surveyor'=>$request->surveyor,
                'address'=>$request->address,
                'surveyor_on_report'=>$request->surveyor_on_report,
                'surveyor_billing'=>$request->surveyor_billing,
                'longitude'=>$request->longitude,
                'latitiude'=>$request->latitiude,
                'service_charges'=>$request->sercharges,
                'snap_charges'=>$snapscharges,
                'total_charges'=>$request->sercharges+$snapscharges,
            ]);

            // echo $request->sercharges;

        }

       

     
    }
    public static function addSurveys($request,$id)
    {

        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Residence'
        ]);
        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Workplace'
        ]);
    }

    public static function getAutoInvoice($id,$type)
    {
        $cases=DB::table('bill')
        ->leftJoin('verification_jobs', 'bill.bill_number', '=', 'verification_jobs.job_id')
        ->where('bill.invoice_id', $id)
        ->where('verification_jobs.product_type', $type)
        ->select(
            DB::raw('COUNT(bill.id) as cases')
            )
        ->get();

        $atten=DB::table('bill')
        ->where('bill.invoice_id', $id)
        ->leftJoin('c_atten', 'bill.atten', '=', 'c_atten.id')

        // ->where('status', 'Receivable')
        ->select(
            'c_atten.name',
            'c_atten.id'
            )
        ->get();
            
        $total=DB::table('bill')
        ->leftJoin('verification_jobs', 'bill.bill_number', '=', 'verification_jobs.job_id')
        ->where('bill.invoice_id', $id)
        ->where('verification_jobs.product_type', $type)
        ->select(
            DB::raw('sum(bill.service_charges) as total'),
            DB::raw('sum(bill.total_amount) as total_amnt'),
            )
        ->get();

        $sales=DB::table('bill')
        ->leftJoin('verification_jobs', 'bill.bill_number', '=', 'verification_jobs.job_id')
        ->leftJoin('sales_tax', 'verification_jobs.sale_reg', '=', 'sales_tax.region')
        ->where('bill.invoice_id', $id)
        ->where('verification_jobs.product_type', $type)
        ->select(
            DB::raw('sum(bill.tax) as tax')
            
            )
        ->get();
        $salesrate=DB::table('c_atten')
        ->leftJoin('sales_tax', 'c_atten.sale_reg', '=', 'sales_tax.region')
        ->where('c_atten.id', $atten[0]->id)
        ->select(
            'sales_tax.rate'
            
            )
        ->get();

        $bank=DB::table('bill')
        ->leftJoin('c_bank', 'bill.bank', '=', 'c_bank.bank_id')
        ->leftJoin('verification_jobs', 'bill.bill_number', '=', 'verification_jobs.job_id')
        ->where('invoice_id', $id)
        ->where('verification_jobs.product_type', $type)
        // ->where('status', 'Receivable')
        ->select(
            'bill.bank as bnk',
            'c_bank.bank_name',
            'bill.bill_date',
            )
        ->get();

        $bnkis=$bank[0]->bnk;
      

        $b=DB::table('verification_rates')
        ->where('bank_id',$bnkis)
        // ->where('status', 'Receivable')
        ->select(
            'regular',
            'lon',
            'snaps'
            )
        ->get();

        $jobs=DB::table('bill')
        ->leftJoin('verification_jobs', 'bill.job_number', '=', 'verification_jobs.job_id')
        ->where('bill.invoice_id', $id)
        ->where('bill.status', 'Receivable')
        ->where('verification_jobs.product_type', $type)
        ->select(
            'verification_jobs.bank_id',
            'verification_jobs.id',
            'bill.bill_number'
            )
        ->get();

        $visits=0;
        $regular=0;
        $regularrate=$b[0]->regular;
        $longrate=$b[0]->lon;
        $snaprate=$b[0]->snaps;
        $regulartotal=0;
        $longtotal=0;
        $extratotal=0;
        $snaptotal=0;
        $long=0;
        $extra=0;
        $snaps=0;

        foreach($jobs as $job=>$value)
        {

            $recs=DB::table('verification_surveys')
            ->where('job_id', $value->id)
            ->where('status', 1)
            ->select(
                DB::raw('COUNT(id) as visits'),
                DB::raw('sum(snap_charges) as snap_charges')
                )
            ->get();

     
           
            $recs1=DB::table('verification_surveys')
            ->where('job_id', $value->id)
            ->where('status', 1)
            ->where('surveyor_billing', 'Regular')
            ->select(
                DB::raw('COUNT(id) as regular'),
                DB::raw('sum(service_charges) as regular_total'),
                )
            ->get();

           
            $recs3=DB::table('verification_surveys')
            ->where('job_id', $value->id)
            ->where('status', 1)
            ->where('surveyor_billing', 'Extra Long')
            ->select(
                DB::raw('COUNT(id) as extralong'),
                DB::raw('sum(service_charges) as extra_total'),

                )
            ->get();

            $recs2=DB::table('verification_surveys')
            ->where('job_id', $value->id)
            ->where('status', 1)
            ->where('surveyor_billing', 'Long')
            ->select(
                DB::raw('COUNT(id) as lon'),
                DB::raw('sum(service_charges) as long_total'),

                )
            ->get();
            
           

            // $sn=DB::table('verification_surveys')
            // ->leftJoin('verification_survey_images ', 'verification_surveys.id', '=', 'verification_survey_images.survey_id')
            // ->where('verification_surveys.job_id','=' ,$value->id)
            // ->select(
            //     DB::raw('COUNT(verification_survey_images.id) as snaps')
            //     )
            // ->get();

            $sn = DB::select('call GetSnapsCount(?)', array($value->id));


            $snps= DB::table('verification_survey_images')
            // ->where('survey_id', '=',$request->id)
            ->leftJoin('verification_surveys', 'verification_survey_images.survey_id', '=', 'verification_surveys.id')
            ->select('verification_survey_images.id','verification_survey_images.path','verification_surveys.job_id')
            ->where('verification_surveys.job_id', '=',$value->id)
            ->get();
            
            $snapscharges = DB::select('call GetSnapsBill(?)', array($value->id));


          

               $regulartotal+=$recs1[0]->regular_total;
               $longtotal+=$recs2[0]->long_total;
               $extratotal+=$recs3[0]->extra_total;
               $snaptotal+=$snapscharges[0]->snaps;
               $visits+=$recs[0]->visits;
               $regular+=$recs1[0]->regular;
               $long+=$recs2[0]->lon;
               $extra+=$recs3[0]->extralong;
                $snaps+=$sn[0]->snaps;

            //    $snaps+=$recs4[0]->extralong;
        }


        $myDate =$bank[0]->bill_date;
        $date = Carbon::createFromFormat('Y-m-d', $myDate)
                        ->endOfMonth()
                        ->format('d-M-Y');

     
            $data=[
                $id,
                $date,
                $cases[0]->cases, //Cases
                $visits, // Total Visits
                $regular, //Regular Visits
                $long, //Long Visits
                $extra, //Extra Long Visits
                $snaps, //Snaps
                number_format($total[0]->total), //Total
                VerificationHMBL::convertNumberToWord($total[0]->total_amnt) .' only', //Total
                number_format($regulartotal),
                number_format($longtotal),
                number_format($extratotal),
                number_format($snaptotal),
                $regularrate, 
                $longrate, 
                $snaprate, 
                $atten[0]->name,
                $bank[0]->bank_name,
                $type,
                number_format($sales[0]->tax), //Total
                $salesrate[0]->rate,
                number_format($total[0]->total_amnt),



            ];

            return $data;
    }

    public static function addSurveysBulkforhome($request,$id,$rad,$oad,$lead)
    {

        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Residence',
            'address'=>$rad,
            'team_lead'=>$lead,
        ]);
        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Workplace',
            'address'=>$oad,
            'salary_slip'=>0,
            'team_lead'=>$lead,

        ]);

      
    
    
    }

    public static function addResSurveyforhome($request,$id,$rad,$lead,$city,$sname)
    {

        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>$sname,
            'address'=>$rad,
            'team_lead'=>$lead,
            'city'=>$city
        ]);
     

      
    
    
    }

    public static function addWorkSurveyforhome($request,$id,$oad,$lead,$salaryslip)
    {

       
        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Workplace',
            'address'=>$oad,
            'salary_slip'=>$salaryslip,
            'team_lead'=>$lead,

        ]);

      
    
    
    }

    public static function addResSurveyforhomeSoneri($request,$id,$rad,$lead,$city,$sname,$area)
    {

        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>$sname,
            'address'=>$rad,
            'area'=>$area,
            'team_lead'=>$lead,
            'city'=>$city
        ]);
     

      
    
    
    }

    public static function addWorkSurveyforhomeSoneri($request,$id,$oad,$lead,$salaryslip,$area)
    {

        if($salaryslip=="-" || $salaryslip==null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Workplace',
                'address'=>$oad,
                'area'=>$area,
                'salary_slip'=>0,
                'team_lead'=>$lead,
    
            ]);
        }

        else{
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Workplace',
                'address'=>$oad,
                'area'=>$area,
                'salary_slip'=>1,
                'team_lead'=>$lead,
    
            ]);
        }
       
       

      
    
    
    }
    
    public static function addSurveysBulkForSoneri($request,$id,$rad,$oad,$amc,$bs,$salaryslip,$no,$other,$lead,$business)
    {
        if($rad!=null || $rad!="N/A" )
        {
        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Residence',
            'address'=>$rad,
            'team_lead'=>$lead,
        ]);
          }

        if($oad!=null || $oad!="N/A" )
        {
        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Workplace',
            'company_business'=>$business,
            'address'=>$oad,
            'salary_slip'=>$salaryslip=="-"?0:1,
            'team_lead'=>$lead,

        ]);

        }

        if($amc!=null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Account Maintenance Certificate',
                'address'=>$amc,
            ]);
        }

        if($bs!=null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Bank Statement',
                'address'=>$bs,
                'team_lead'=>$lead,

            ]);
        }

        if($no!=null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'NOC',
                'address'=>$no,
                'team_lead'=>$lead,

            ]);
        }
      
        if($other!=null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>$other,
                'address'=>$other,
            ]);
        }

        // if($amc=)
    
    
    }

   

    public static function addSurveysBulk($request,$id,$rad,$oad,$amc,$bs,$salaryslip,$no,$other,$lead,$bname)
    {
        
        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Residence',
            'address'=>$rad,
            'team_lead'=>$lead,
        ]);
    

    
        $val = DB::table('verification_surveys')->insert([
            'job_id' => $id,
            'type'=>'Workplace',
            'address'=>$oad,
            'salary_slip'=>$salaryslip==null?0:1,
            'team_lead'=>$lead,

        ]);



        if($bs!=null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Bank Statement',
                'address'=>$bs,
                'bnkst_bank_name'=>$bname,
                'team_lead'=>$lead,

            ]);
        }

      
        if($salaryslip!=null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Salary Slip',
                'address'=>$salaryslip
            ]);
        }

        // if($amc=)
    
    
    }

    public static function holdVerification($request, $id)
    {
        $ishold = $request->is_hold;


        if ($ishold == true) {
            $ibr = VerificationHMBL::where('id', $id)->first();
            $ibr->cancalled = 0;
            $ibr->completed = 0;
            $ibr->customer_delay = $request->is_hold == true ? '1' : '0';
            $ibr->delayed_remarks = $request->remarks;
            $ibr->delayed_date = date('y-m-d');
            $ibr->save();

            $com_id = $request->commonId;
            $comJob = Job::where('id', $com_id)->first();


            $comJob->status = '2';

            $comJob->save();

            $myid = $request->jobid;
            $bill = Bill_Ibr::where('job_number', '=', $myid)
                ->first();



            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $myid . " was holded";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Verification';
            $log->save();
        } else {
            $ibr = VerificationHMBL::where('id', $id)->first();
            $ibr->cancalled = 0;
            $ibr->completed = 0;
            $ibr->customer_delay = $request->is_hold == true ? '1' : '0';
            $ibr->delayed_remarks = '';
            $ibr->delayed_date = date('y-m-d');
            $ibr->save();

            $com_id = $request->commonId;
            $comJob = Job::where('id', $com_id)->first();


            $comJob->status = '0';

            $comJob->save();

            $myid = $request->jobid;
            $bill = Bill_Ibr::where('job_number', '=', $myid)
                ->first();



            $log = new Log;
            $log->user_id = $request->user()->id;
            $log->activity = $myid . " was resumed";
            $log->date = date('Y/m/d');
            $log->time = date("h:i:sa");
            $log->service = 'Verification';
            $log->save();
        }
    }

    public static function cancelVerification($request, $id)
    {

        $ibr = VerificationHMBL::where('id', $id)->first();
        $ibr->cancalled = 1;
        $ibr->completed = 3;
        $ibr->customer_delay = 0;
        $ibr->cancallation_remarks = $request->remarks;
        $ibr->cancalled_date = date('y-m-d');
        $ibr->save();

        $com_id = $request->commonId;
        $comJob = Job::where('id', $com_id)->first();


        $comJob->status = '3';

        $comJob->save();

        $myid = $request->jobid;
        $bill = Bill_Ibr::where('job_number', '=', $myid)->first();
        if ($bill !== null) {

            $bill->status = 'Cancelled';
            $bill->save();
        }



        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = $myid . " was cancelled";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Verification';
        $log->save();
    }
    public static function  convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '', trim($num));
        if (!$num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array(
            '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array(
            '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ($tens < 20) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
                $tens = (int) ($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_levels[$i])) ? ' ' . $list3[$levels] . ' ' : '');
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }
    public static function getJobByIdForBill($id, $jobnumber)
    {
        $job = DB::table('verification_jobs')
            ->where('verification_jobs.id', $id)
            ->leftJoin('c_company', 'verification_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'verification_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'verification_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'verification_jobs.byvendor_id', '=', 'ibr_vendors.id')
            ->leftJoin('c_customer', 'verification_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'verification_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'verification_jobs.branch_id', '=', 'c_branch.branch_id')
            // ->leftJoin('qc_officers', 'verification_jobs.branch_id', '=', 'c_branch.branch_id')

            ->select(
                'verification_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'verification_jobs.operational_branch',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_branch.branch_name',
                'tax_regions.name AS tax_region'

            )
            ->get();

        $bill = DB::table('bill')
            ->where('bill.job_number', '=', $jobnumber)
            ->select('*')
            ->get();

        $data = [
            'job' => $job,
            'bill' => $bill
        ];

        return $data;
    }

    public static function updateLocalJob($request, $id)
    {

        $com_id = $request->commonId;
        $comJob = Job::where('id', $com_id)->first();
        $comJob->company_id = strtoupper($request->company_id);
        $comJob->region_id = $request->regional_id;
        $comJob->bank_id = $request->bank_id;
        $comJob->byvendor_id = $request->ibr_vendor_id;
        $comJob->customer_id = $request->customer_id;
        $comJob->branch_id = $request->branch_id;


        if ($request->delayed == true) {
            $comJob->status = '2';
        } else if ($request->completed == true) {
            $comJob->status = '1';
        } else {
            $comJob->status = '0';
        }

        $comJob->save();
    }
    public static function addDetails($request, $cid)
    {

        $val = DB::table('verification_job_details')->insert([
            'job_id' => $cid,
            'applicant_name' => $request->applicant_name,
            'applicant_father' => $request->applicant_father,
            'applicant_contact' => $request->applicant_contact,
            'applicant_cnic' => $request->applicant_cnic,
            'applicant_dob' => $request->applicant_dob,
            'applicant_res_phone' => $request->applicant_res_phone,
            'applicant_work_phone' => $request->applicant_work_phone,
        ]);

    }
    public static function addDetailsBulkForSoneri($request, $cid,$apname,$appcell,$cnic,$business)
    {

        $val = DB::table('verification_job_details')->insert([
            'job_id' => $cid,
            'applicant_name' => $apname,
            'applicant_father' => $request->applicant_father,
            'applicant_contact' => $appcell,
            'applicant_cnic' => $cnic,
            'applicant_dob' => $request->applicant_dob,
            'applicant_res_phone' => $request->applicant_res_phone,
            'applicant_work_phone' => $request->applicant_work_phone,
            'applicant_business_name' => $request->business,
        ]);

    }
    public static function addDetailsBulk($request, $cid,$apname,$appcell,$offcont,$rescont,$cnic)
    {

        $val = DB::table('verification_job_details')->insert([
            'job_id' => $cid,
            'applicant_name' => $apname,
            // 'applicant_father' => $request->applicant_father,
            'applicant_contact' => $appcell,
            'applicant_cnic' =>$cnic,
            // 'applicant_dob' => $request->applicant_dob,
            'applicant_res_phone' => $rescont,
            'applicant_work_phone' => $offcont,
        ]);

    }
    public static function addDetailsBulkforhome($request, $cid,$apname,$appcell,$appfather,$appdob, $appcnic,$apprescell,$appworkcell,$appdes,$appbusiness)
    {

        $val = DB::table('verification_job_details')->insert([
            'job_id' => $cid,
            'applicant_name' => $apname,
            'applicant_father' => $appfather,
            'applicant_contact' => $appcell,
            'applicant_cnic' => $appcnic,
            'applicant_dob' => $appdob,
            'applicant_designation' => $appdes,
            'applicant_business_name' => $appbusiness,
            'applicant_res_phone' => $apprescell,
            'applicant_work_phone' => $appworkcell,
        ]);

    }
    public static function getLatestJob()
    {
        $cjob = DB::table('verification_jobs')->latest('id', 'desc')->first();
        Storage::disk('dir')->makeDirectory('Reports/Verification/' . $cjob->id . '/Report');
        Storage::disk('dir')->makeDirectory('Reports/Verification/' . $cjob->id . '/Survey');
        // Storage::disk('dir')->makeDirectory('Reports/Valuation/' . $cjob->id.'/Images');
        return $cjob;
    }

  

    public static function addCommonJob($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "VER";

        $job = new Job;
        if ($givenBy == "Bank") {

            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');


            $bill = new Bill_Ibr;
            $bill->bill_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->job_number =  $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
            $bill->total_amount = '0';
            $bill->tax = '0';
            $bill->bill_date = date("Y/m/d");
            $bill->discount = '0';
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->companyID;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Verification';
            $bill->save();


        } else {
            $job->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');

            $bill = new Bill_Ibr;
            $bill->bill_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->job_number = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
            $bill->total_amount = '0';
            $bill->tax = '0';
            $bill->discount = '0';
            $bill->bill_date = date("Y/m/d");
            $bill->recievable = $request->regional_id;
            $bill->old_debt = '0';
            $bill->cancalled = '0';
            $bill->bank = $request->bank_id;
            $bill->company = $request->company_id;
            $bill->branch = $request->branch_id;
            $bill->customer = $request->customer_id;
            $bill->status = 'In Progress';
            $bill->service = 'Verification';
            $bill->save();
        }
        $job->taken_on = date('Y/m/d');
        $job->company_id = strtoupper($request->company_id);
        $job->region_id = $request->regional_id;
        $job->service = "Verification";
        $job->bank_id = $request->bank_id;
        $job->byvendor_id = $request->val_vendor_id;
        $job->branch_id = $request->branch_id;
        $job->customer_id = $request->customer_id;
        $job->remarks = "";
        $job->status = "0";
        $job->save();
    }

    public static function updateJobID($request, $cid)
    {

        $cmp = $request->company_prefix;
        $reg = $request->regional_prefix;
        $bnk = $request->bank_prefix;
        $givenBy = $request->given_by;
        $ser = "VER";

        $val1 = VerificationHMBL::findOrFail($cid);

        if ($givenBy == "Bank") {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $bnk . '/' . $cid . '/' . date('Y');
        } else {
            $val1->job_id = $cmp . '/' . $ser . '/' . $reg . '/' . $cid . '/' . date('Y');
        }
        $val1->save();
    }

    public static function makeLog($request, $cid)
    {

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job No:" . $cid . " Was Added";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Verification';
        $log->save();
    }

    public static function getJobById($id)
    {
        $job = DB::table('verification_jobs')
            ->where('verification_jobs.id', $id)
            ->leftJoin('c_company', 'verification_jobs.job_by', '=', 'c_company.company_id')
            ->leftJoin('c_region', 'verification_jobs.region_id', '=', 'c_region.reg_id')
            ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
            ->leftJoin('c_region AS op', 'verification_jobs.operational_branch', '=', 'op.reg_id')
            ->leftJoin('c_city AS opbr', 'op.reg_city_id', '=', 'opbr.city_id')
            ->leftJoin('c_bank', 'verification_jobs.bank_id', '=', 'c_bank.bank_id')
            ->leftJoin('ibr_vendors', 'verification_jobs.byvendor_id', '=', 'ibr_vendors.id')
            ->leftJoin('c_atten', 'verification_jobs.atten', '=', 'c_atten.id')
            ->leftJoin('c_customer', 'verification_jobs.customer_id', '=', 'c_customer.cust_id')
            ->leftJoin('tax_regions', 'verification_jobs.sale_reg', '=', 'tax_regions.id')
            ->leftJoin('c_branch', 'verification_jobs.branch_id', '=', 'c_branch.branch_id')
            ->leftJoin('qc_officers', 'verification_jobs.qc_officer', '=', 'qc_officers.id')
            ->select(
                'verification_jobs.*',
                'c_company.company_name AS job_company',
                'region.city_name AS region',
                'opbr.city_name AS op_branch',
                'verification_jobs.operational_branch',
                'c_customer.cust_name',
                'ibr_vendors.name',
                'c_bank.bank_name',
                'c_atten.name as atten_name',
                'c_branch.branch_name',
                'qc_officers.name AS officer_name',
                'tax_regions.name AS tax_region'

            )
            ->get();


        $data = [
            'job' => $job,
        ];

        return $data;
    }
    public static function getDetailsById($id)
    {
        $job = DB::table('verification_job_details')
            ->where('job_id', $id)
            ->select('*')
            ->get();


        $data = [
            'job' => $job,
        ];

        return $data;
    }

    public static function getqcOfficers(){
        $officer = DB::table('qc_officers')
        ->select('*')
        ->get();

        return $officer;
    }
    public static function getSurveyors(){
        $surveyors = DB::table('users')
        ->where('users.role', 4)
        ->leftJoin('c_region', 'users.region', '=', 'c_region.reg_id')
        ->leftJoin('c_city AS region', 'c_region.reg_city_id', '=', 'region.city_id')
        ->select(
            'users.id',
            'users.name',
            'region.city_name'
            )
        ->get();

        return $surveyors;
    }
    public static function getSurveyImages($id){
       
        $recs = DB::table('verification_survey_images')
        ->where('survey_id','=', $id)
        ->select('*')
        ->orderBy('id', 'DESC')
        ->get();

        return $recs;
    }
    public static function getVerificationChargesTotal($request){
       
       
            
        

        $recs = DB::table('verification_surveys')
            ->where('job_id','=', $request->id)
            ->where('status','=', 1)
            ->select(
                DB::Raw('sum(total_charges) as total_charges')
                )
            ->get();

        return $recs;
    }

    public static function getVerificationBill($request){
       
        $recs = DB::table('bill')
            ->where('job_number','=', $request->jid)
            ->select(
                DB::Raw('total_amount')
                )
            ->get();
        


        return $recs;
    }


    public static function uploadSurveyimages($request)
    {
        $files = $request->file('files');
        $id = $request->jid;

        $sur = DB::table('verification_surveys')
        ->where('id','=', $id)
        ->select('job_id')
        ->get();

        foreach ($files as $file) {

            $fname = str_random(28);
            $filename = Storage::disk('dir')->putFileAs('Reports/Verification/'.$sur[0]->job_id.'/Survey/'.$id, $file, $fname . '.jpg');

            $job = DB::table('verification_survey_images')->insert([
                'survey_id' => $id,
                'title' => $fname . '.jpg',
                'path' =>  $filename,

            ]);
        }


        $jid = $request->jid;
        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "Job Id:" . $jid . " images uploaded";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = 'Livestock';
        $log->save();
    }

    public static function applicantWorkplaceReportforhome($request,$pdf,$survey,$id)
    {
        $pdf->setSourceFile("src/reportformat/habibmetro/workplaceperfoma.pdf");

        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','B',10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(42, 33.5);
        $pdf->Write(0, $survey->applicant_name);
      
     
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(42, 44.5);
         $pdf->Write(0, $survey->team_lead);
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(42, 48.5);
         $pdf->Write(0,$survey->product_type);
        
         //Jobid
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(139, 44.5);
         $pdf->Write(0, $survey->job_id."-W");
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(139, 48.5);
         $pdf->Write(0, date('F d, Y'));

      


        // Applicant Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(48, 59);
        $pdf->Write(0, $survey->applicant_name);
        
        // Applicant Contact
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(146, 59);
        $pdf->Write(0, $survey->applicant_contact);
        
        // Applicant CNIC
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(48, 63.3);
        $pdf->Write(0, $survey->applicant_cnic);

        // Applicant Office Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(48.5, 67.5);
        $pdf->Write(0, $survey->applicant_business_name);
       
        // Applicant Designation
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(152.4, 67.5);
        $pdf->Write(0, $survey->applicant_designation);
        
        // Applicant Address
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(48.5, 69.8);
        $pdf->MultiCell(149,4,$survey->main_address);
        // $pdf->Write(0, );

        // Applicant Landmarks
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(48.5,80.2);
        $pdf->Write(0,$survey->landmark);
       
        // Applicant gps
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(48.5,84.6);
        $pdf->Write(0,$survey->latitiude.','.$survey->longitude);

        // Applicant gps URL
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(48.5,88.8);
        $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.','.$survey->longitude);


      
        // Was Actual Address Same
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(59,102);
        $pdf->Write(0,$survey->wp_is_address_correct);
       

        

        if($survey->wp_is_address_correct=="Yes")
        {
                // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(140 ,102);

            $pdf->Write(0,$survey->wp_establish_time);


            // Was Actual Address Same
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(46.6,106.5);
            $pdf->Write(0,'As Above');
        }
        else{

            // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(140 ,102);
            $pdf->Write(0,'N/A');


            // Was Actual Address Same
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(46.6,106.5);
            $pdf->Write(0,$survey->wp_correct_address);
        }
      

      
       
        // Works At Giving Address
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(55,110.4);
        $pdf->Write(0, $survey->wp_does_applicant_works_here);

        if($survey->wp_does_applicant_works_here=="Yes")
        {

            // Date Joining
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10); 
            $pdf->SetXY(140,110.4);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0,$survey->wp_working_here_since);

              // Contact
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(47,114.4);
  
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->Write(0, 'N/A');


        }
        else{

            // Date Joining
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(138,107.4);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0, 'N/A');
              // Contact
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(47,114.4);


            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0, $survey->wp_new_address);

            
        }
      

        

        // Lives At Given Address
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->SetXY(55,118.8);

        $pdf->Write(0, $survey->wp_is_applicant_available);

      
        if($survey->wp_is_applicant_available=="Yes")
        {
                // Reason of Non AVA
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(100,118.8);

                $pdf->Write(0, 'N/A');

                // nAME OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(172,118.8);

                $pdf->Write(0, 'N/A');


                    // cnios
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(32,123);

                $pdf->Write(0, $survey->wp_original_nic_seen);

                if($survey->wp_original_nic_seen=="No")
                {
                     // cnic
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(91,123);

                    $pdf->Write(0, 'N/A');
                }
                else {
                      // cnic
                      $pdf->SetFont('Helvetica');
                      $pdf->SetFontSize(10);
                      $pdf->SetXY(91,123);
  
                      $pdf->Write(0, 'As Above');
                }
               

                // CNIC OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(163,123);

                $pdf->Write(0, 'N/A');
        
        }
        else{
                // Reason of Non AVA
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(100,118.8);

                $pdf->Write(0, $survey->wp_reson_of_non_ava);


                // nAME OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(172,118.8);

                $pdf->Write(0,  $survey->wp_name_of_person_met);


                // cnios
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(32,123);

                $pdf->Write(0, 'N/A');

            
                // cnic
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(91,123);

                $pdf->Write(0, 'N/A');

                // CNIC OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(162 ,123);

                $pdf->Write(0, $survey->wp_nic_of_person_met);
        
        }


        
           // Ttype of Business
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(48,135.5);

           $pdf->Write(0, $survey->wp_business_type);

        if($survey->wp_business_type=="Others")
        {
            // Other Business Type
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(146,135.5);

             $pdf->Write(0, $survey->wp_other_business_type);
        }
        else{
            // Other Business Type
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(146,135.5);

            $pdf->Write(0,'N/A');
        }
         


        if($survey->wp_permisses_is=="Owned")
        {
                // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(48,140);
           $pdf->Write(0, 'Owner');


           
                // Mention Rent
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(172,140);

         $pdf->Write(0, 'N/A');
        }
        else if($survey->wp_permisses_is=="Rented"){
            // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(48,140);
           $pdf->Write(0, 'Rental');

              // Mention Rent
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(172,140);

         $pdf->Write(0, $survey->wp_premissi_rent);
        }
        else{
            // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(48,140);
           $pdf->Write(0, $survey->is_employee==1?'Employee':$survey->wp_permisses_is);

            // Mention Rent
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(172,140);

            $pdf->Write(0,$survey->is_employee==1?'N/A': 'N/A');
        }
       
        if($survey->wp_permisses_is="Others")
        {
                // Applicant Is
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(119,140);

                $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_other_permisses_is);
        }

        else{
                // Applicant Is
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(119,140);

                $pdf->Write(0,'N/A');
        }


      
          
         

            // Nature of Busienss
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(48,144.5);

           $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_nature);

            if($survey->wp_business_nature=="Others")
            {
                 // Other Nature of Busienss
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(148,144.5);

                $pdf->Write(0, $survey->is_employee==1?'N/A':'N/A');
            }

            else{
                 // Other Nature of Busienss
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(148,144.5);

                $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_other_business_nature);
            }
          

           // Size
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(52,148.5);

           $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_legal_activity);

         
           // Government Employee
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(144,148.5);

           $pdf->Write(0,$survey->is_employee==0?'N/A':$survey->wp_is_government_employee);

            // Name Plates
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(47,152.5);

            $pdf->Write(0, $survey->wp_name_plate_affixed);


             // Size
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(138,152.6);
 
             $pdf->Write(0,  $survey->is_employee==1?'N/A':$survey->wp_area_size."  ".$survey->wp_area_unit);
        
             // Business Activity
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(47,156.9);

            $pdf->Write(0, $survey->is_employee==1?'N/A': $survey->wp_business_activity);


             // No of Emplyees
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(138,156.9);
 
             $pdf->Write(0,  $survey->is_employee==1?'N/A':$survey->wp_no_of_employees);
            
             // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(62,161.5);

            $pdf->Write(0,$survey->is_employee==1?'N/A':$survey->wp_established_since);


             // Line of Business
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(138,161.5);
 
             $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_line);

             

            // Neighbor's Name
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,174);

            $pdf->Write(0, $survey->mc_one_person_met);
          
            // Neighbor's Address
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,178.5);

            $pdf->Write(0, $survey->mc_one_addrees);
      
        
       
             // Knows Applicant
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,183);

            $pdf->Write(0, $survey->mc_one_knows_applicant);
            
            if($survey->mc_one_knows_applicant=="Yes")
            {
                  // Knows How Long
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(140,183);
                    $pdf->Write(0, $survey->mc_one_knows_applicant_since);

            }

            else{
                // Knows How Long
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(140,183);
                $pdf->Write(0, 'N/A');

            }
           



            // Neighbor Comments
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,187.4);

            $pdf->Write(0,strtoupper($survey->mc_one_neighbor_comments));
           
           
            // Market Check
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(88,191.5);

            $pdf->Write(0,  $survey->mc_one_business_established_since);

            // Neighbor Name 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,204);

            $pdf->Write(0, $survey->mc_two_person_met);
           
   
            // Neighbor Address 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,208.5);

            $pdf->Write(0, $survey->mc_two_addrees);

            // Knows Applicant 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,212.8);

            $pdf->Write(0,  $survey->mc_two_knows_applicant);

            // // Knows How Long  2

            if($survey->mc_two_knows_applicant=="Yes")
            {
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(140,212.8);
    
                $pdf->Write(0,$survey->mc_two_knows_applicant_since);
            }

            else{

                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(140,212.8);
    
                $pdf->Write(0,'N/A');
            }
           

             // Neighbor Comments

             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,217);
             $pdf->Write(0, strtoupper($survey->mc_two_neighbor_comments));
            
             //Market Check

             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(89,221);
 
             $pdf->Write(0, $survey->mc_two_business_established_since);



           
                 // Surveyor

         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(51,228);

         $pdf->Write(0,  $survey->surveyor);

           // QC Officer

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(132,228);
  
           $pdf->Write(0,  $survey->qc_officer_name);
          
           // GeneraL Comments
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(62, 231);
            $pdf->MultiCell(135,4.3,$survey->outcome_comments.". ".$survey->outcome_remarks);
       
            // Result of Verification

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(62,247);

            $pdf->Write(0,strtoupper($survey->outcome_report_status));

            
           
            $job = DB::table('verification_survey_images')
            ->where('survey_id', $id)
            ->select(
                'path',
                'rotate'
            )
            ->get();
            
            // Verficication Images

           //     $data=[
           //     ];
           //     foreach ($job as $item) {
           //      // echo  $item->path;
           //      array_push($data, $item->path);
           //    }
           
           $recs=count($job);

              if($recs>0)
              {

                
                $pdf->AddPage();
                $pdf->setSourceFile('images/imgsheader.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);

                $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('job'));
                $pdf1->save('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
                $pdf->setSourceFile('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);
  
  
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 35);
              $pdf->Write(0, 'HABIB METROPOLITAN BANK LIMITED');
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(140, 35);
              $pdf->Write(0, $survey->job_id.'-W');
  
                
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 39);
              $pdf->Write(0, 'Applicant Name - '.$survey->applicant_name);
  
  
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(80, 46);
              $pdf->Write(0, 'Verification Images - Workplace / Business');
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 52);
              $pdf->Write(0, 'Inquiry No.:'.'              '.$survey->id);
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 58);
              $pdf->Write(0, $survey->main_address);
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(160, 52);
              $pdf->Write(0, date('F d, Y'));   

        




              }

    }


    public static function salaryslipReport($request,$pdf,$survey,$id)
    {
        $sid=$survey->sid;
        $pdf->AddPage();

        $pdf->setSourceFile("src/reportformat/habibmetro/salaryslipperfoma.pdf");

        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

            
        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','B',10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(45.3, 33.5);
        $pdf->Write(0, $survey->applicant_name);
      
        $ss=DB::table('verification_surveys')
        ->leftJoin('users','verification_surveys.surveyor','=','users.id')
        ->where('job_id','=',$survey->id)
        ->where('type','=','Salary Slip')
        ->select('*','verification_surveys.id as sid','users.name as surveyor_name','users.phone_no as phone')
        ->orderBy('verification_surveys.id', 'DESC')
        ->get();

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','',9);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(53.3, 62.5);
        $pdf->Write(0, strtoupper($ss[0]->outcome_report_status));

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','',9);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(53.3, 72.5);
        $pdf->Write(0, strtoupper($ss[0]->outcome_verification_status));


            // GeneraL Comments
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(9);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(53.2, 82.5);
        $pdf->MultiCell(52,4.3,$ss[0]->outcome_remarks.".".$ss[0]->outcome_comments);
        
        
           
        $ssimg= DB::table('verification_survey_images')
        ->where('survey_id', $ss[0]->sid)
        ->where('order_by', 1)
        ->select(
            'path',
            'rotate'
        )
        ->orderBy('id', 'DESC')
        ->get();

        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        $pdf->Cell(80);
        // Framed title
        // $pdf->Cell(30,10,'Header',1,0,'C');
        // Line break
        // $pdf->Ln(20);
        $pdf->SetXY(57, 44.5);
        $pdf->Image($ssimg[0]->path,18, 116,80,95);

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','',7.5);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(39.3, 228.5);
        $pdf->Write(0, 'http://maps.google.com/?q='.$ss[0]->latitiude.','.$ss[0]->longitude);
        
        
          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(39.3, 233);
          $pdf->Write(0, $ss[0]->latitiude.','.$ss[0]->longitude);


          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(39.3, 237);
          $pdf->Write(0, date_format(date_create($ss[0]->conducted_on),'d F, Y'));
          
          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(39.3, 241.5);
          $pdf->Write(0, $ss[0]->surveyor_name);
           
          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(39.3, 245.5);
        //   $pdf->Write(0, $ss[0]->phone);
          $pdf->Write(0, $ss[0]->wp_ss_officer_contact);



          $bs=DB::table('verification_surveys')
          ->leftJoin('users','verification_surveys.surveyor','=','users.id')
          ->where('job_id','=',$survey->id)
          ->where('type','=','Bank Statement')
          ->select('*','verification_surveys.id as sid','users.name as surveyor_name','users.phone_no as phone')
          ->orderBy('verification_surveys.id', 'DESC')
          ->get();
  
          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(149.3, 62);
          $pdf->Write(0, strtoupper($bs[0]->outcome_report_status));
  
          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(149.3, 72.5);
          $pdf->Write(0, strtoupper($bs[0]->outcome_verification_status));
  
  
              // GeneraL Comments
          $pdf->SetFont('Helvetica');
          $pdf->SetFontSize(9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(149.3, 82.5);
          $pdf->MultiCell(52,4.3,$bs[0]->outcome_remarks.".".$bs[0]->outcome_comments);
          
                 
           
        $bsimg= DB::table('verification_survey_images')
        ->where('survey_id', $bs[0]->sid)
        ->where('order_by', 1)
        ->select(
            'path',
            'rotate'
        )
        ->orderBy('id', 'DESC')
        ->get();
          
          $pdf->SetFont('Arial', 'B', 15);
          // Move to the right
          $pdf->Cell(80);
          // Framed title
          // $pdf->Cell(30,10,'Header',1,0,'C');
          // Line break
          // $pdf->Ln(20);
          $pdf->SetXY(57, 44.5);
          $pdf->Image($bsimg[0]->path,118, 116,80,95);
  
          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',7.5);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(136.3, 227.5);
          $pdf->Write(0, 'http://maps.google.com/?q='.$bs[0]->latitiude.','.$ss[0]->longitude);
          
          
            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','',9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(136.3, 232);
            $pdf->Write(0, $bs[0]->latitiude.','.$bs[0]->longitude);
  
  
            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','',9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(136.3, 236);
            $pdf->Write(0, date_format(date_create($bs[0]->conducted_on),'d F, Y'));
            
            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','',9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(136.3, 240.5);
            $pdf->Write(0, $bs[0]->surveyor_name);
             
            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','',9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(136.3, 244.5);
          //   $pdf->Write(0, $ss[0]->phone);
            $pdf->Write(0, $bs[0]->bnkst_officer_mobile);
           
        

    }
    public static function bankstatementReport($request,$pdf,$survey,$id)
    {
            $sid=$survey->sid;
        $pdf->AddPage();

        $pdf->setSourceFile("src/reportformat/habibmetro/bankstatementperfoma.pdf");

        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        // // Applicant Name Heading
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFont('Arial','B',10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(42, 33.5);
        // $pdf->Write(0, $survey->applicant_name);
      
     
        //  //Team Lead
        //  $pdf->SetFont('Helvetica');
        //  $pdf->SetFont('Arial','B',10);
        //  // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->SetXY(42, 44.5);
        //  $pdf->Write(0, $survey->team_lead);
    
        //  //Team Lead
        //  $pdf->SetFont('Helvetica');
        //  $pdf->SetFont('Arial','B',10);
        //  // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->SetXY(42, 48.5);
        //  $pdf->Write(0,$survey->product_type);
        
        //  //Jobid
        //  $pdf->SetFont('Helvetica');
        //  $pdf->SetFont('Arial','B',10);
        //  // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->SetXY(139, 44.5);
        //  $pdf->Write(0, $survey->job_id."-BS");
    
        //  //Team Lead
        //  $pdf->SetFont('Helvetica');
        //  $pdf->SetFont('Arial','B',10);
        //  // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->SetXY(139, 48.5);
        //  $pdf->Write(0, date('F d, Y'));

      


        // // Applicant Name
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(48, 59);
        // $pdf->Write(0, $survey->applicant_name);
        
        // // Applicant Contact
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(146, 59);
        // $pdf->Write(0, $survey->applicant_contact);
        
        // // Applicant CNIC
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(48, 63.3);
        // $pdf->Write(0, $survey->applicant_cnic);

        // // Applicant Office Name
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(48.5, 67.5);
        // $pdf->Write(0, $survey->applicant_business_name);
       
        // // Applicant Designation
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(152.4, 67.5);
        // $pdf->Write(0, $survey->applicant_designation);
        
        // // Applicant Address
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(48.5, 69.8);
        // $pdf->MultiCell(149,4,$survey->main_address);
        // // $pdf->Write(0, );

        // // Applicant Landmarks
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(48.5,80.2);
        // $pdf->Write(0,$survey->landmark);
       
        // // Applicant gps
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(48.5,84.6);
        // $pdf->Write(0,$survey->latitiude.','.$survey->longitude);

        // // Applicant gps URL
        // $pdf->SetFont('Helvetica');
        // $pdf->SetFontSize(10);
        // // $pdf->SetTextColor(255, 0, 0);
        // $pdf->SetXY(48.5,88.8);
        // $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.','.$survey->longitude);

            
           
            $job = DB::table('verification_survey_images')
            ->where('survey_id', $sid)
            ->select(
                'path',
                'rotate'
            )
            ->get();
            
            // Verficication Images

           //     $data=[
           //     ];
           //     foreach ($job as $item) {
           //      // echo  $item->path;
           //      array_push($data, $item->path);
           //    }
           
           $recs=count($job);

              if($recs>0)
              {

                
                $pdf->AddPage();
                $pdf->setSourceFile('images/imgsheader.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);

                $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('job'));
                $pdf1->save('Reports/Verification/'.$survey->id.'/Survey/'.$sid.'/images.pdf');
                $pdf->setSourceFile('Reports/Verification/'.$survey->id.'/Survey/'.$sid.'/images.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);
  
  
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 35);
              $pdf->Write(0, 'HABIB METROPOLITAN BANK LIMITED');
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(140, 35);
              $pdf->Write(0, $survey->job_id.'-BS');
  
                
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 39);
              $pdf->Write(0, 'Applicant Name - '.$survey->applicant_name);
  
  
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(80, 46);
              $pdf->Write(0, 'Verification Images - Bank Statement');
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 52);
              $pdf->Write(0, 'Inquiry No.:'.'              ');
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 58);
              $pdf->Write(0, $survey->main_address);
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(160, 52);
              $pdf->Write(0, date('F d, Y'));   

        




              }

    }


    public static function applicantResidenceReportforhome($request,$pdf,$survey,$id)
    {
       

        $pdf->setSourceFile("src/reportformat/habibmetro/residenceperfoma.pdf");

         // $pdf->setSourceFile("Reports/Verification/$id/residence.pdf");

         $tplIdx = $pdf->importPage(1);
         $pdf->useTemplate($tplIdx, 0, 0);
 
         // Applicant Name Heading
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(47, 33.5);
         $pdf->Write(0, $survey->applicant_name);
   
 
          //Applicant Name
         
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(47, 44);
          $pdf->Write(0, $survey->team_lead);
     
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(47, 48);
          $pdf->Write(0, $survey->product_type);
         
          //Jobid
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(148, 44);
          $pdf->Write(0, $survey->job_id."-R");
     
          //Team Lead
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(148, 48);
          $pdf->Write(0, date('F d, Y'));       
 
 
         // Applicant Name
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50, 58.3);
         $pdf->Write(0, $survey->applicant_name);
         
         // Applicant Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(147.5, 58.3);
         $pdf->Write(0,  $survey->applicant_contact);
         
       
         
         // Applicant CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,63);
         $pdf->Write(0, $survey->applicant_cnic);
         
         // Applicant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,65.5);
         $pdf->MultiCell(0,4,$survey->main_address);
         // $pdf->Write(0, );
 
         // Applicant CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,76);
         $pdf->Write(0, $survey->landmark);
        
         // Applicant gps
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,80.5);
         $pdf->Write(0,$survey->latitiude.",".$survey->longitude);
 
         // Applicant gps URL
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,84.5);
         $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.",".$survey->longitude);
 
 
         // Was APPLICANT Available
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(59,99.5);
         $pdf->Write(0, $survey->res_applicant_is_available);
        
       
         // Name of Person to Met
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(149,99.5);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? 'N/A': $survey->res_name_of_person_met);
 
         // Relation with Applicant:
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(59,104);
         $pdf->Write(0, $survey->res_applicant_is_available=="Yes" ? 'N/A': $survey->res_relationship_with_applicant);
 
         // Was Actual Address Same
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(156,104);
         $pdf->Write(0, $survey->res_is_address_correct);
 
       if($survey->res_is_address_correct=="Yes")
       {
             // Correct Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(59,108);
             $pdf->Write(0, 'As Above');
       }
 
       else{
 
          // Correct Address
          $pdf->SetFont('Helvetica');
          $pdf->SetFontSize(10);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(59,108);
          $pdf->Write(0,  $survey->res_correct_address); 
       }
 
         // Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(59,112.5);
 
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ?  $survey->applicant_contact : $survey->res_rel_cell);
 
         // CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(150,112.5);
 
         $pdf->Write(0, $survey->res_applicant_is_available=="Yes" ?  $survey->applicant_cnic : $survey->res_nic_of_person_met);
 
         // Lives At Given Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(59,116.8);
 
         $pdf->Write(0, $survey->res_applicant_live_here);
 
       
         // Since How Long Living
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(150,116.8);
 
         $pdf->Write(0, $survey->res_living_since);
 
         if($survey->res_applicant_live_here=="Yes")
         {
 
         // Permanant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(59,120.9);
 
         $pdf->Write(0, 'As Above');
      
         }
 
         else{
 
         // Permanant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(59,120.9);
 
         $pdf->Write(0,  'N/A');
      
         }
 
         // Name Plate Affixed
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(59,125.2);
 
         $pdf->Write(0,  $survey->res_name_plate_affixed);
 
         if($survey->res_residence_type=="Others")
         {
             // Ttype of Residence
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(50,141);
 
            $pdf->Write(0, $survey->res_other_residence_type);
         }
         else{
             // Ttype of Residence
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(50,141);
 
             $pdf->Write(0, $survey->res_residence_type);
         }
           
 
             if($survey->res_residence_is=="Owned")
             {
                  // Applicant Is
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(143,141);
 
                 $pdf->Write(0, 'Owner');
 
             }
             else if($survey->res_residence_is=="Rented")
             {
                   // Applicant Is
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFontSize(10);
                   $pdf->SetXY(143,141);
   
                   $pdf->Write(0, 'Tenant');
             }
             else{
                 // Applicant Is
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(143,141);

                $pdf->Write(0,  $survey->res_residence_is);
           }
           if($survey->res_residence_is=="Others")
           {
              // Mention Other
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(50,145.5);
 
            $pdf->Write(0, $survey->res_residence_is_other);
           }
           else{
                // Mention Other
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(50,145.5);
 
            $pdf->Write(0, 'N/A');
           }
           
           if($survey->res_residence_is=="Rented")
           {
                 // Mention Rent
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(143,145.5);
 
                 $pdf->Write(0,  $survey->res_monthly_rent);
           }
 
           else{
              // Mention Rent
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(143,145.5);
 
            $pdf->Write(0,  'N/A');
           }
          
           
 
            // Size
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(50,149.7);
 
            $pdf->Write(0, $survey->res_residence_area_size ." " .$survey->res_residence_area_unit);
 
          
            // Utliization
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(152,149.7);
 
            $pdf->Write(0, $survey->res_residence_utilization);
 
            if($survey->res_residence_is=="Rented")
            {
                 // Rent DEED
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(50,154);
 
                 $pdf->Write(0, $survey->res_rent_deed_verified);
            }
            else{
                 // Rent DEED
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(50,154);

 
                 $pdf->Write(0,'N/A');
            }
           
 
 
             // Neighboorhood
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(52,170.5);
 
             $pdf->Write(0, $survey->res_neighboorhood_is);
 
              // Area Accessiblity
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(146,170.5);
 
              $pdf->Write(0,  $survey->res_area_access);
        
              // Resident Belong to
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(52,175);
 
             $pdf->Write(0, $survey->res_belongs_to);
 
              // Repossesion in the area
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(156,175);
 
              $pdf->Write(0,  $survey->res_repossession);
 
 
             // Neighbor Name
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,189.8);
 
             $pdf->Write(0, $survey->res_neigh_one_name);
            
            
             // Neighbor Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,194.6);
 
             $pdf->Write(0, $survey->res_neigh_one_address);
 
             // Knows Applicant
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,198.8);
 
             $pdf->Write(0, $survey->res_neigh_one_knows_applicant);
 
             if($survey->res_neigh_one_knows_applicant=="Yes")
             {
                       // Knows How Long
            
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,198.9);
 
             $pdf->Write(0, $survey->res_neigh_one_knows_applicant_since);
 
             }
             else{
                     // Knows How Long
                             
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFontSize(10);
                     $pdf->SetXY(141,198.9);
 
                     $pdf->Write(0, 'N/A');
             }           
          
 
             // Neighbor Comments
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,202.9);
 
             $pdf->Write(0,strtoupper($survey->res_neigh_one_comments));
 
             // Neighboor Check Two
             // Neighboor Check Two
             // Neighboor Check Two
 
             
             // Neighbor Name
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,215.5);
 
             $pdf->Write(0, $survey->res_neigh_two_name);
            
            
             // Neighbor Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,219.8);
 
             $pdf->Write(0, $survey->res_neigh_two_address);
             
 
             
             // Knows Applicant
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,224);
 
             $pdf->Write(0, $survey->res_neigh_two_knows_applicant);
            
 
             if($survey->res_neigh_two_knows_applicant=="Yes")
             {
                 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,224);
 
             $pdf->Write(0, $survey->res_neigh_two_knows_applicant_since);
 
             }
 
             else {
                
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,224);

 
             $pdf->Write(0, 'N/A');
 
             }
            //  // Knows How Long
            
             // Neighbor Comments
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(55,228.4);
 
             $pdf->Write(0, strtoupper($survey->res_neigh_two_comments));
           
           
            // Surveyor
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(53, 233);
             $pdf->MultiCell(0,3.7,$survey->surveyor);
            
             // QC Officer
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(134, 233);
             $pdf->MultiCell(0,3.7,$survey->qc_officer_name);

             // GeneraL Comments
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(64, 238);
             $pdf->MultiCell(0,4.2, $survey->outcome_comments.". ".$survey->outcome_remarks);
        
             // Result of Verification
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(64,253.6);
 
             $pdf->Write(0, strtoupper($survey->outcome_report_status));
 
 
             // $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('data'));
 
           
             
             // Verficication Images
 
             $job = DB::table('verification_survey_images')
             ->where('survey_id', $id)
             ->select(
                 'path',
                 'rotate'
             )
             ->get();
             
             // Verficication Images
 
            //     $data=[
            //     ];
            //     foreach ($job as $item) {
            //      // echo  $item->path;
            //      array_push($data, $item->path);
            //    }
            
            $recs=count($job);
 
               if($recs>0)
               {
 
                $pdf->AddPage();
                $pdf->setSourceFile('images/imgsheader.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);

                $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('job'));
                $pdf1->save('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
                $pdf->setSourceFile('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);
     
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 35);
                 $pdf->Write(0, 'HABIB METROPOLITAN BANK LIMITED');
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(140, 35);
                 $pdf->Write(0, $survey->job_id.'-R');
     
                   
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 39);
                 $pdf->Write(0, 'Applicant Name - '.$survey->applicant_name);
     
     
                
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(80, 46);
                 $pdf->Write(0, 'Verification Images - Residence');
                
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 52);
                 $pdf->Write(0, 'Inquiry No.:'.'              '.$survey->id);
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 58);
                 $pdf->Write(0, $survey->main_address);
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(160, 52);
                 $pdf->Write(0, date('F d, Y'));
 
 
               }
        
    }


    public static function applicantcoWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo)
    {
        $pdf->setSourceFile("src/reportformat/habibmetro/workplacecoperfoma.pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','B',10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(45, 33);
        $pdf->Write(0,$survey->applicant_name);
      
       

         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(45, 44);
         $pdf->Write(0, $survey->team_lead);
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(45, 48);
         $pdf->Write(0,$survey->applicant_name);
        
         //Jobid
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(145, 44);
         $pdf->Write(0, $survey->job_id."-W");
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(145, 48);
         $pdf->Write(0, date('F d, Y'));

      


        // Applicant Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49, 58.5);
        $pdf->Write(0, $appinfo[0]->applicant_name);
        
        // Applicant Contact
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(147, 58.5);
        $pdf->Write(0,$appinfo[0]->applicant_cnic);
        
        // Co-Applicant Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49, 70.5);
        $pdf->Write(0, $survey->applicant_name);
        
        // Co-Applicant Contact
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(147, 70.5);
        $pdf->Write(0, $survey->applicant_contact);
        
        // CNIC
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49, 74.8);
        $pdf->Write(0, $survey->applicant_cnic);
      
        // Applicant Office Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49, 79.2);
        $pdf->Write(0, $survey->applicant_business_name);
       
        // Applicant Designation
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(149, 79.2);
        $pdf->Write(0, $survey->applicant_designation);
        
        // Applicant Address
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49,81.5);
        $pdf->MultiCell(149,4,$survey->main_address);
        // $pdf->Write(0, );

        // Applicant Landmarks
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49,92);
        $pdf->Write(0,$survey->landmark);
       
        // Applicant gps
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49,96);
        $pdf->Write(0,$survey->latitiude.','.$survey->longitude);

        // Applicant gps URL
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(49,100);
        $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.','.$survey->longitude);


      
        // Was Actual Address Same
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(60,113.5);
        $pdf->Write(0,$survey->wp_is_address_correct);
       

        

        if($survey->wp_is_address_correct=="Yes")
        {
                // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(140,113.5);
            $pdf->Write(0,$survey->wp_establish_time);


            // Was Actual Address Same
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(47,118);
            $pdf->Write(0,'As Above');
        }
        else{

            // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(140,113.5);
            $pdf->Write(0,'N/A');


            // Was Actual Address Same
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(47,118);
            $pdf->Write(0,$survey->wp_correct_address);
        }
      

      
       
        // wORKS HERE
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(56,122.4);
        $pdf->Write(0, $survey->wp_does_applicant_works_here);

        if($survey->wp_does_applicant_works_here=="Yes")
        {

            // Date Joining
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(140,122);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0,$survey->wp_working_here_since);

              // Contact
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(47,126.5);
  
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->Write(0, 'N/A');


        }
        else{

            // Date Joining
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(140,122);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0, 'N/A');
              // Contact
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(47,126.5);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0, $survey->wp_new_address);

            
        }
      

        

        // was applicant available
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->SetXY(55,130.5);

        $pdf->Write(0, $survey->wp_is_applicant_available);

      
        if($survey->wp_is_applicant_available=="Yes")
        {
                // Reason of Non AVA
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(99,130.5);

                $pdf->Write(0, 'N/A');

                // nAME OF PERSON MET
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(172,130.5);

                    $pdf->Write(0, 'N/A');


                    // cnios
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(32,135);


                $pdf->Write(0, $survey->wp_original_nic_seen);

                if($survey->wp_original_nic_seen=="No")
                {
                     // cnic
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(93,135);


                    $pdf->Write(0, 'N/A');
                }
                else {
                      // cnic
                      $pdf->SetFont('Helvetica');
                      $pdf->SetFontSize(10);
                      $pdf->SetXY(93,135);
  
                      $pdf->Write(0, 'As Above');
                }
               

                // CNIC OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(164,135);

                $pdf->Write(0, 'N/A');
        
        }
        else{
                // Reason of Non AVA
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(99,130.5);

                $pdf->Write(0, $survey->wp_reson_of_non_ava);


                // nAME OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(172,130.5);

                $pdf->Write(0,  $survey->wp_name_of_person_met);


                // cnios
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(32,135);

                $pdf->Write(0, 'N/A');

            
                // cnic
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(93,135);

                $pdf->Write(0, 'N/A');

                // CNIC OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(164,135);

                $pdf->Write(0, $survey->wp_nic_of_person_met);
        
        }

       
      

      

      
      
      

           // Ttype of Business
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(49,147.5);

           $pdf->Write(0, $survey->wp_business_type);

        if($survey->wp_business_type=="Others")
        {
            // Other Business Type
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(147,147.5);

             $pdf->Write(0, $survey->wp_other_business_type);
        }
        else{
            // Other Business Type
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(147,147.5);

            $pdf->Write(0,'N/A');
        }
         
        if($survey->wp_permisses_is=="Owned")
        {
                // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(49,151.8);
           $pdf->Write(0, 'Owner');

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(172,151.8);
           $pdf->Write(0, 'N/A');
        }
        else if($survey->wp_permisses_is=="Rented"){
            // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(49,151.8);
           $pdf->Write(0, 'Rental');

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(172,151.8);
           $pdf->Write(0, $survey->wp_premissi_rent);
        }
        else{
            // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(49,151.8);
           $pdf->Write(0, $survey->is_employee==1?'Employee':$survey->wp_permisses_is);

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(172,151.8);
           $pdf->Write(0, $survey->is_employee==1?'N/A':'N/A');
        }
       
           
        if($survey->wp_permisses_is="Others")
        {
                // Applicant Is
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(119,151.8);

                $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_other_permisses_is);
        }

        else{
                // Applicant Is
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(119,151.8);

                $pdf->Write(0,'N/A');
        }
          
         

            // Nature of Busienss
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(49,156);

           $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_nature);

         
           // Other Nature of Busienss
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(148,156);

           $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_other_business_nature);

           // Size
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(51,160.2);

           $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_legal_activity);

         
           // Utliization
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(144,160.2);

           $pdf->Write(0,$survey->is_employee==0?'N/A':$survey->wp_is_government_employee);

            // Name Plates
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(46,164.5);

            $pdf->Write(0, $survey->wp_name_plate_affixed);


             // Size
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(138,164.5);
 
             $pdf->Write(0,  $survey->is_employee==1?'N/A':$survey->wp_area_size."  ".$survey->wp_area_unit);
        
             // Business Activity
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(47,168.5);

            $pdf->Write(0, $survey->is_employee==1?'N/A': $survey->wp_business_activity);


             // No of Emplyees
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(138,168.5);
 
             $pdf->Write(0,  $survey->is_employee==1?'N/A':$survey->wp_no_of_employees);
            
             // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(62,172.9);

            $pdf->Write(0,$survey->is_employee==1?'N/A':$survey->wp_established_since);


             // Line of Business
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(138,172.9);
 
             $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_line);


            // Neighbor's Name
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,186);

            $pdf->Write(0, $survey->mc_one_person_met);
          
            // Neighbor's Address
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,190);

            $pdf->Write(0, $survey->mc_one_addrees);
      
        
       
             // Knows Applicant
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,194.5);

            $pdf->Write(0, $survey->mc_one_knows_applicant);
            
            if($survey->mc_one_knows_applicant=="Yes")
            {
                  // Knows How Long
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(141,194.5);
                    $pdf->Write(0, $survey->mc_one_knows_applicant_since);

            }

            else{
                // Knows How Long
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(141,194.5);
                $pdf->Write(0, 'N/A');

            }
           



            // Neighbor Comments
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,198.9);

            $pdf->Write(0, strtoupper($survey->mc_one_neighbor_comments));
           
           
            // Market Check
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(89,203);

            $pdf->Write(0,  $survey->mc_one_business_established_since);

            // Neighbor Name 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,216);

            $pdf->Write(0, $survey->mc_two_person_met);
           
   
            // Neighbor Address 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,220);

            $pdf->Write(0, $survey->mc_two_addrees);

            // Knows Applicant 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(53,224.5);

            $pdf->Write(0,  $survey->mc_two_knows_applicant);

            // Knows How Long  2

            if($survey->mc_two_knows_applicant=="Yes")
            {
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(140,224.5);

    
                $pdf->Write(0,$survey->mc_two_knows_applicant_since);
            }

            else{

                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(140,224.5);
    
                $pdf->Write(0,'N/A');
            }
           

             // Neighbor Comments

             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,228.5);
             $pdf->Write(0, $survey->mc_two_neighbor_comments);
            
             //Market Check

             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(89,233);
 
             $pdf->Write(0, $survey->mc_two_business_established_since);



         // Surveyor

         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(51,239.5);

         $pdf->Write(0,  $survey->surveyor);

           // QC Officer

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(133,239.5);
  
           $pdf->Write(0,  $survey->qc_officer_name);

          
           // GeneraL Comments
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(63, 242.5);
            $pdf->MultiCell(135,4.3,$survey->outcome_comments.". ".$survey->outcome_remarks);
       
            // Result of Verification

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(63,259.3);

            $pdf->Write(0,strtoupper($survey->outcome_report_status));

            
            $job = DB::table('verification_survey_images')
            ->where('survey_id', $id)
            ->select(
                'path',
                'rotate'
            )
            ->get();
            
            // Verficication Images

             $recs=count($job);

              if($recs>0)
              {
                $pdf->AddPage();
                $pdf->setSourceFile('images/imgsheader.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);

                $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('job'));
                $pdf1->save('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
                $pdf->setSourceFile('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);
  
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 35);
              $pdf->Write(0, 'HABIB METROPOLITAN BANK LIMITED');
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(140, 35);
              $pdf->Write(0, $survey->job_id.'-R');
  
                
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 39);
              $pdf->Write(0, 'Applicant Name - '.$survey->applicant_name);
  
  
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(80, 46);
              $pdf->Write(0, 'Verification Images - Workplace /  Business');
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 52);
              $pdf->Write(0, 'Inquiry No.:'.'              '.$survey->id);
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 58);
              $pdf->Write(0, $survey->main_address);
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(160, 52);
              $pdf->Write(0, date('F d, Y'));
              }

    }
    public static function applicantcoResidenceReportforhome($request,$pdf,$survey,$id,$appinfo)
    {


        $pdf->setSourceFile("src/reportformat/habibmetro/residencecoperfoma.pdf");

         // $pdf->setSourceFile("Reports/Verification/$id/residence.pdf");

         $tplIdx = $pdf->importPage(1);
         $pdf->useTemplate($tplIdx, 0, 0);
 
         // Applicant Name Heading
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(45, 33);
         $pdf->Write(0, $survey->applicant_name);
   
 
          //Applicant Name
         
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(45, 44);
          $pdf->Write(0, $survey->team_lead);
     
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(45, 48);
          $pdf->Write(0, $survey->product_type);
         
          //Jobid
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(147, 44);
          $pdf->Write(0, $survey->job_id."-R");
     
          //Team Lead
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(147, 48);
          $pdf->Write(0, date('F d, Y'));
 
       
 
 
         // Applicant Name
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50, 58.3);
         $pdf->Write(0, $appinfo[0]->applicant_name);
         
         // Applicant Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(147, 58.3);
         $pdf->Write(0, $appinfo[0]->applicant_cnic);
         
         //Co- Applicant Name
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50, 70.5);
         $pdf->Write(0, $survey->applicant_name);
         
         //Co- Applicant Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(147, 70.5);
         $pdf->Write(0,  $survey->applicant_contact);
         
         // Applicant CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,75);
         $pdf->Write(0, $survey->applicant_cnic);
         
         // Applicant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50, 77.2);
         $pdf->MultiCell(0,4,$survey->main_address);
         // $pdf->Write(0, );
 
         // Applicant CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,88.2);
         $pdf->Write(0, $survey->landmark);
        
         // Applicant gps
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,92.4);
         $pdf->Write(0,$survey->latitiude.",".$survey->longitude);
 
         // Applicant gps URL
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,96.3);
         $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.",".$survey->longitude);
 
 
         // Was APPLICANT Available
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(58,111.5);
         $pdf->Write(0, $survey->res_applicant_is_available);
 
         // Name of Person to Met
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(148,111.5);
         $pdf->Write(0, $survey->res_name_of_person_met);
 
         // Relation with Applicant:
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(58,116);
         $pdf->Write(0, $survey->res_relationship_with_applicant);
 
         // Was Actual Address Same
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(154,116);
         $pdf->Write(0, $survey->res_is_address_correct);
 
       if($survey->res_is_address_correct=="Yes")
       {
             // Correct Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(58,120);
             $pdf->Write(0, 'As Above');
       }
 
       else{
 
          // Correct Address
          $pdf->SetFont('Helvetica');
          $pdf->SetFontSize(10);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(58,120);
          $pdf->Write(0,  $survey->res_correct_address); 
       }
 
         // Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,124.2);
 
         // $pdf->SetTextColor(255, 0, 0);
        //  $pdf->Write(0, $survey->res_rel_cell);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? $survey->applicant_contact : $survey->res_rel_cell);

 
         // CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(148,124.2);
 
        //  $pdf->Write(0, $survey->res_nic_of_person_met);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? $survey->applicant_cnic : $survey->res_nic_of_person_met);

 
         // Lives At Given Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,128.3);
 
         $pdf->Write(0, $survey->res_applicant_live_here);
 
       
         // Since How Long Living
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(148,128.3);
 
         $pdf->Write(0, $survey->res_living_since);
 
         if($survey->res_applicant_live_here=="Yes")
         {
 
         // Permanant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,132.5);
 
         $pdf->Write(0, 'As Above');
      
         }
 
         else{
 
         // Permanant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,132.5);
 
         $pdf->Write(0,  'N/A');
      
         }
 
         // Name Plate Affixed
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,136.8);
 
         $pdf->Write(0,  $survey->res_name_plate_affixed);
 
         if($survey->res_residence_type=="Others")
         {
             // Ttype of Residence
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,153);
 
            $pdf->Write(0, $survey->res_other_residence_type);
         }
         else{
             // Ttype of Residence
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(49,153);
 
             $pdf->Write(0, $survey->res_residence_type);
         }
           
 
             if($survey->res_residence_is=="Owned")
             {
                  // Applicant Is
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(142,153);
 
                 $pdf->Write(0, 'Owner');
 
             }
             else if($survey->res_residence_is=="Rented")
             {
                   // Applicant Is
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFontSize(10);
                   $pdf->SetXY(142,153);
   
                   $pdf->Write(0, 'Tenant');
             }
             else{
                 // Applicant Is
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(142,153);
 
                 $pdf->Write(0,  $survey->res_residence_is);
           }
           if($survey->res_residence_is=="Others")
           {
              // Mention Other
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,157.5);
 
            $pdf->Write(0, $survey->res_residence_is_other);
           }
           else{
                // Mention Other
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,157.5);
 
            $pdf->Write(0, 'N/A');
           }
           
           if($survey->res_residence_is=="Rented")
           {
                 // Mention Rent
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(142,157.5);
 
                 $pdf->Write(0,  $survey->res_monthly_rent);
           }
 
           else{
              // Mention Rent
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(142,157.5);
 
            $pdf->Write(0,  'N/A');
           }
          
           
 
            // Size
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,161.7);
 
            $pdf->Write(0, $survey->res_residence_area_size ." " .$survey->res_residence_area_unit);
 
          
            // Utliization
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(151,161.7);
 
            $pdf->Write(0, $survey->res_residence_utilization);
 
            if($survey->res_residence_is=="Rented")
            {
                 // Rent DEED
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(49,166);
 
                 $pdf->Write(0, $survey->res_rent_deed_verified);
            }
            else{
                 // Rent DEED
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(49,166);
 
                 $pdf->Write(0,'N/A');
            }
           
 
 
             // Neighboorhood
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(51,182.5);
 
             $pdf->Write(0, $survey->res_neighboorhood_is);
 
              // Area Accessiblity
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(144,182.5);
 
              $pdf->Write(0,  $survey->res_area_access);
        
              // Resident Belong to
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(51,187);
 
             $pdf->Write(0, $survey->res_belongs_to);
 
              // Repossesion in the area
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(154,187);
 
              $pdf->Write(0,  $survey->res_repossession);
 
 
             // Neighbor Name
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,202);
 
             $pdf->Write(0, $survey->res_neigh_one_name);
            
            
             // Neighbor Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,206);
 
             $pdf->Write(0, $survey->res_neigh_one_address);
 
             // Knows Applicant
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,210.5);
 
             $pdf->Write(0, $survey->res_neigh_one_knows_applicant);
 
             if($survey->res_neigh_one_knows_applicant=="Yes")
             {
            // Knows How Long
            
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(140,210.5);
 
             $pdf->Write(0, $survey->res_neigh_one_knows_applicant_since);
 
             }
             else{
                     // Knows How Long
                             
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFontSize(10);
                     $pdf->SetXY(140,210.5);
 
                     $pdf->Write(0, 'N/A');
             }           
          
 
             // Neighbor Comments
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,214.7);
 
             $pdf->Write(0,strtoupper($survey->res_neigh_one_comments));
 
             // Neighboor Check Two
             // Neighboor Check Two
             // Neighboor Check Two
 
             
             // Neighbor Name
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,226.8);
 
             $pdf->Write(0, $survey->res_neigh_two_name);
            
            
             // Neighbor Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,231.5);
 
             $pdf->Write(0, $survey->res_neigh_two_address);
             
 
             
             // Knows Applicant
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,235.9);
 
             $pdf->Write(0, $survey->res_neigh_two_knows_applicant);
            
 
             if($survey->res_neigh_two_knows_applicant=="Yes")
             {
                 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,235.9);
 
             $pdf->Write(0, $survey->res_neigh_two_knows_applicant_since);
 
             }
 
             else {
                
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,235.9);
 
             $pdf->Write(0, 'N/A');
 
             }
            //  // Knows How Long
            
             // Neighbor Comments
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,240);
 
             $pdf->Write(0, strtoupper($survey->res_neigh_two_comments));
           
           
            // Surveyor
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(51, 245);
             $pdf->MultiCell(0,3.7,$survey->surveyor);
            
             // QC Officer
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(132, 245);
             $pdf->MultiCell(0,3.7,$survey->qc_officer_name);

             // GeneraL Comments
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(62.5, 249.5);
             $pdf->MultiCell(0,3.7, $survey->outcome_comments.". ".$survey->outcome_remarks);
        
             // Result of Verification
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(62.5,265.6);
 
             $pdf->Write(0, strtoupper($survey->outcome_report_status));
 
 
             // $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('data'));
 
           
             
             // Verficication Images
 
            
             $job = DB::table('verification_survey_images')
             ->where('survey_id', $id)
             ->select(
                 'path',
                 'rotate'
             )
             ->get();
             
             // Verficication Images
 
            //     $data=[
            //     ];
            //     foreach ($job as $item) {
            //      // echo  $item->path;
            //      array_push($data, $item->path);
            //    }
            
            $recs=count($job);
 
               if($recs>0)
               {
 
                $pdf->AddPage();
                $pdf->setSourceFile('images/imgsheader.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);

                $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('job'));
                $pdf1->save('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
                $pdf->setSourceFile('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);
     
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 35);
                 $pdf->Write(0, 'HABIB METROPOLITAN BANK LIMITED');
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(140, 35);
                 $pdf->Write(0, $survey->job_id.'-R');
     
                   
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 39);
                 $pdf->Write(0, 'Applicant Name - '.$survey->applicant_name);
     
     
                
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(80, 46);
                 $pdf->Write(0, 'Verification Images - Residence');
                
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 52);
                 $pdf->Write(0, 'Inquiry No.:'.'              '.$survey->id);
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 58);
                 $pdf->Write(0, $survey->main_address);
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(160, 52);
                 $pdf->Write(0, date('F d, Y'));
 
 
               }
        
    }

    public static function applicantrefWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo)
    {
        

        $pdf->setSourceFile("src/reportformat/habibmetro/workplacereferenceproforma.pdf");


        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','B',10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(45, 33);
        $pdf->Write(0,$survey->applicant_name);
      
       

         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(45, 44);
         $pdf->Write(0, $survey->team_lead);
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(45, 48);
         $pdf->Write(0,$survey->applicant_name);
        
         //Jobid
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(145, 44);
         $pdf->Write(0, $survey->job_id."-W");
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(145, 48);
         $pdf->Write(0, date('F d, Y'));

      


        // Applicant Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52, 58.5);
        $pdf->Write(0, $appinfo[0]->applicant_name);
        
        // Applicant Contact
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(150, 58.5);
        $pdf->Write(0,$appinfo[0]->applicant_cnic);
        
        // Co-Applicant Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52, 70.5);
        $pdf->Write(0, $survey->applicant_name);
        
        // Co-Applicant Contact
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(150, 70.5);
        $pdf->Write(0, $survey->applicant_contact);
        
        // CNIC
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52, 74.8);
        $pdf->Write(0, $survey->applicant_cnic);
      
        // Applicant Office Name
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52, 79.2);
        $pdf->Write(0, $survey->applicant_business_name);
       
        // Applicant Designation
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(156, 79.2);
        $pdf->Write(0, $survey->applicant_designation);
        
        // Applicant Address
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52,81.5);
        $pdf->MultiCell(149,4,$survey->main_address);
        // $pdf->Write(0, );

        // Applicant Landmarks
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52,92);
        $pdf->Write(0,$survey->landmark);
       
        // Applicant gps
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52,96);
        $pdf->Write(0,$survey->latitiude.','.$survey->longitude);

        // Applicant gps URL
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(52,100);
        $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.','.$survey->longitude);


      
        // Was Actual Address Same
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(63,113.5);
        $pdf->Write(0,$survey->wp_is_address_correct);
       

        

        if($survey->wp_is_address_correct=="Yes")
        {
                // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(143,113.5);
            $pdf->Write(0,$survey->wp_establish_time);


            // Was Actual Address Same
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(50,118);
            $pdf->Write(0,'As Above');
        }
        else{

            // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(143,113.5);
            $pdf->Write(0,'N/A');


            // Was Actual Address Same
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(50,118);
            $pdf->Write(0,$survey->wp_correct_address);
        }
      

      
       
        // wORKS HERE
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(59,122.4);
        $pdf->Write(0, $survey->wp_does_applicant_works_here);

        if($survey->wp_does_applicant_works_here=="Yes")
        {

            // Date Joining
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(143,122);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0,$survey->wp_working_here_since);

              // Contact
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(50,126.5);
  
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->Write(0, 'N/A');


        }
        else{

            // Date Joining
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(143,122);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0, 'N/A');
              // Contact
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(50,126.5);

            // $pdf->SetTextColor(255, 0, 0);
            $pdf->Write(0, $survey->wp_new_address);

            
        }
      

        

        // was applicant available
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->SetXY(65,130.5);

        $pdf->Write(0, $survey->wp_is_applicant_available);

      
        if($survey->wp_is_applicant_available=="Yes")
        {
                // Reason of Non AVA
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(103,130.5);

                $pdf->Write(0, 'N/A');

                // nAME OF PERSON MET
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(175,130.5);

                    $pdf->Write(0, 'N/A');


                    // cnios
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(35,135);


                $pdf->Write(0, $survey->wp_original_nic_seen);

                if($survey->wp_original_nic_seen=="No")
                {
                     // cnic
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(96,135);


                    $pdf->Write(0, 'N/A');
                }
                else {
                      // cnic
                      $pdf->SetFont('Helvetica');
                      $pdf->SetFontSize(10);
                      $pdf->SetXY(96,135);
  
                      $pdf->Write(0, 'As Above');
                }
               

                // CNIC OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(166,135);

                $pdf->Write(0, 'N/A');
        
        }
        else{
                // Reason of Non AVA
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(103,130.5);

                $pdf->Write(0, $survey->wp_reson_of_non_ava);


                // nAME OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(175,130.5);

                $pdf->Write(0,  $survey->wp_name_of_person_met);


                // cnios
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(35,135);

                $pdf->Write(0, 'N/A');

            
                // cnic
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(96,135);

                $pdf->Write(0, 'N/A');

                // CNIC OF PERSON MET
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(166,135);

                $pdf->Write(0, $survey->wp_nic_of_person_met);
        
        }

       
      

      

      
      
      

           // Ttype of Business
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(52,147.5);

           $pdf->Write(0, $survey->wp_business_type);

        if($survey->wp_business_type=="Others")
        {
            // Other Business Type
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(149,147.5);

             $pdf->Write(0, $survey->wp_other_business_type);
        }
        else{
            // Other Business Type
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(149,147.5);

            $pdf->Write(0,'N/A');
        }
         
        if($survey->wp_permisses_is=="Owned")
        {
                // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(52,151.8);
           $pdf->Write(0, 'Owner');

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(175,151.8);
           $pdf->Write(0, 'N/A');
        }
        else if($survey->wp_permisses_is=="Rented"){
            // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(52,151.8);
           $pdf->Write(0, 'Rental');

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(175,151.8);
           $pdf->Write(0, $survey->wp_premissi_rent);
        }
        else{
            // Applicant Is
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(52,151.8);
           $pdf->Write(0, $survey->is_employee==1?'Employee':$survey->wp_permisses_is);

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(175,151.8);
           $pdf->Write(0, $survey->is_employee==1?'N/A':'N/A');
        }
       
           
        if($survey->wp_permisses_is="Others")
        {
                // Applicant Is
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(122,151.8);

                $pdf->Write(0, $survey->wp_other_permisses_is);
        }

        else{
                // Applicant Is
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(122,151.8);

                $pdf->Write(0, 'N/A');
        }
          
         

            // Nature of Busienss
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(52,156);

           $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_nature);

         
           // Other Nature of Busienss
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(152,156);

           $pdf->Write(0,$survey->is_employee==1?'N/A':$survey->wp_other_business_nature);

           // Size
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(55,160.2);

           $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_legal_activity);

         
           // Utliization
           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(147,160.2);

           $pdf->Write(0,$survey->is_employee==0?'N/A':$survey->wp_is_government_employee);

            // Name Plates
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(50,164.5);

            $pdf->Write(0,$survey->wp_name_plate_affixed);


             // Size
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(142,164.5);
 
             $pdf->Write(0,  $survey->is_employee==1?'N/A':$survey->wp_area_size."  ".$survey->wp_area_unit);
        
             // Business Activity
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(50,168.5);

            $pdf->Write(0,  $survey->is_employee==1?'N/A':$survey->wp_business_activity);


             // No of Emplyees
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,168.5);
 
             $pdf->Write(0,  $survey->is_employee==1?'N/A':$survey->wp_no_of_employees);
            
             // Established Since
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(65,172.9);

            $pdf->Write(0,$survey->is_employee==1?'N/A':$survey->wp_established_since);


             // Line of Business
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,172.9);
 
             $pdf->Write(0, $survey->is_employee==1?'N/A':$survey->wp_business_line);


            // Neighbor's Name
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(56,186);

            $pdf->Write(0, $survey->mc_one_person_met);
          
            // Neighbor's Address
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(56,190);

            $pdf->Write(0, $survey->mc_one_addrees);
      
        
       
             // Knows Applicant
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(56,194.5);

            $pdf->Write(0, $survey->mc_one_knows_applicant);
            
            if($survey->mc_one_knows_applicant=="Yes")
            {
                  // Knows How Long
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFontSize(10);
                    $pdf->SetXY(143,194.5);
                    $pdf->Write(0, $survey->mc_one_knows_applicant_since);

            }

            else{
                // Knows How Long
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(143,194.5);
                $pdf->Write(0, 'N/A');

            }
           



            // Neighbor Comments
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(56,198.9);

            $pdf->Write(0, strtoupper($survey->mc_one_neighbor_comments));
           
           
            // Market Check
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(93,203);

            $pdf->Write(0,  $survey->mc_one_business_established_since);

            // Neighbor Name 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(56,216);

            $pdf->Write(0, $survey->mc_two_person_met);
           
   
            // Neighbor Address 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(56,220);

            $pdf->Write(0, $survey->mc_two_addrees);

            // Knows Applicant 2

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(56,224.5);

            $pdf->Write(0,  $survey->mc_two_knows_applicant);

            // Knows How Long  2

            if($survey->mc_two_knows_applicant=="Yes")
            {
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(143,224.5);

    
                $pdf->Write(0,$survey->mc_two_knows_applicant_since);
            }

            else{

                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(10);
                $pdf->SetXY(143,224.5);
    
                $pdf->Write(0,'N/A');
            }
           

             // Neighbor Comments

             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(56,228.5);
             $pdf->Write(0, $survey->mc_two_neighbor_comments);
            
             //Market Check

             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(93,233);
 
             $pdf->Write(0, $survey->mc_two_business_established_since);



         // Surveyor

         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(54,239.5);

         $pdf->Write(0,  $survey->surveyor);

           // QC Officer

           $pdf->SetFont('Helvetica');
           $pdf->SetFontSize(10);
           $pdf->SetXY(135,239.5);
  
           $pdf->Write(0,  $survey->qc_officer_name);

          
           // GeneraL Comments
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(65, 242.5);
            $pdf->MultiCell(135,4.3,$survey->outcome_comments.". ".$survey->outcome_remarks);
            

             
            
            // Result of Verification

            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(65,258.3);

            $pdf->Write(0,strtoupper($survey->outcome_report_status));

            
           
            $job = DB::table('verification_survey_images')
            ->where('survey_id', $id)
            ->select(
                'path',
                'rotate'
            )
            ->get();
            
            // Verficication Images

           
           $recs=count($job);

              if($recs>0)
              {
                $pdf->AddPage();
                $pdf->setSourceFile('images/imgsheader.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);

                $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('job'));
                $pdf1->save('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
                $pdf->setSourceFile('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);
  
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 35);
              $pdf->Write(0, 'HABIB METROPOLITAN BANK LIMITED');
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(140, 35);
              $pdf->Write(0, $survey->job_id.'-W');
  
                
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 39);
              $pdf->Write(0, 'Applicant Name - '.$survey->applicant_name);
  
  
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(80, 46);
              $pdf->Write(0, 'Verification Images - Workplace / Business');
             
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 52);
              $pdf->Write(0, 'Inquiry No.:'.'              '.$survey->id);
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(11, 58);
              $pdf->Write(0, $survey->main_address);
           
              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(160, 52);
              $pdf->Write(0, date('F d, Y'));
              }

    }
    public static function applicantrefResidenceReportforhome($request,$pdf,$survey,$id,$appinfo)
    {
        

        $pdf->setSourceFile("src/reportformat/habibmetro/residencereferenceproforma.pdf");


         // $pdf->setSourceFile("Reports/Verification/$id/residence.pdf");

         $tplIdx = $pdf->importPage(1);
         $pdf->useTemplate($tplIdx, 0, 0);
 
         // Applicant Name Heading
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(45, 33);
         $pdf->Write(0, $survey->applicant_name);
   
 
          //Applicant Name
         
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(45, 44);
          $pdf->Write(0,$survey->team_lead);
     
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(45, 48);
          $pdf->Write(0,$survey->product_type);
         
          //Jobid
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(146, 44);
          $pdf->Write(0, $survey->job_id."-R");
     
          //Team Lead
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(146, 48);
          $pdf->Write(0, date('F d, Y'));
 
       
 
 
         // Applicant Name
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50, 58.3);
         $pdf->Write(0, $appinfo[0]->applicant_name);
         
         // Applicant Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(147, 58.3);
         $pdf->Write(0,  $appinfo[0]->applicant_cnic);
         
         //Co- Applicant Name
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50, 70.5);
         $pdf->Write(0, $survey->applicant_name);
         
         //Co- Applicant Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(147, 70.5);
         $pdf->Write(0,  $survey->applicant_contact);
         
         // Applicant CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,75);
         $pdf->Write(0, $survey->applicant_cnic);
         
         // Applicant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50, 77.2);
         $pdf->MultiCell(0,4,$survey->main_address);
         // $pdf->Write(0, );
 
         // Applicant CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,88.2);
         $pdf->Write(0, $survey->landmark);
        
         // Applicant gps
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,92.4);
         $pdf->Write(0,$survey->latitiude.",".$survey->longitude);
 
         // Applicant gps URL
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(50,96.3);
         $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.",".$survey->longitude);
 
 
         // Was APPLICANT Available
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(58,111.5);
         $pdf->Write(0, $survey->res_applicant_is_available);
 
         // Name of Person to Met
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(148,111.5);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? 'N/A': $survey->res_name_of_person_met);
 
         // Relation with Applicant:
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(58,116);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? 'N/A': $survey->res_relationship_with_applicant);
 
         // Was Actual Address Same
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(154,116);
         $pdf->Write(0, $survey->res_is_address_correct);
 
       if($survey->res_is_address_correct=="Yes")
       {
             // Correct Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(58,120);
             $pdf->Write(0, 'As Above');
       }
 
       else{
 
          // Correct Address
          $pdf->SetFont('Helvetica');
          $pdf->SetFontSize(10);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(58,120);
          $pdf->Write(0,  $survey->res_correct_address); 
       }
 
         // Contact
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,124.2);
 
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? $survey->applicant_contact : $survey->res_rel_cell);
 
         // CNIC
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(148,124.2);
 
        //  $pdf->Write(0, $survey->res_nic_of_person_met);
         $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? $survey->applicant_cnic : $survey->res_nic_of_person_met);
 
         // Lives At Given Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,128.3);
 
         $pdf->Write(0, $survey->res_applicant_live_here);
 
       
         // Since How Long Living
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(148,128.3);
 
         $pdf->Write(0, $survey->res_living_since);
 
         if($survey->res_applicant_live_here=="Yes")
         {
 
         // Permanant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,132.5);
 
         $pdf->Write(0, 'As Above');
      
         }
 
         else{
 
         // Permanant Address
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,132.5);
 
         $pdf->Write(0,  'N/A');
      
         }
 
         // Name Plate Affixed
         $pdf->SetFont('Helvetica');
         $pdf->SetFontSize(10);
         $pdf->SetXY(58,136.8);
 
         $pdf->Write(0,  $survey->res_name_plate_affixed);
 
         if($survey->res_residence_type=="Others")
         {
             // Ttype of Residence
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,153);
 
            $pdf->Write(0, $survey->res_other_residence_type);
         }
         else{
             // Ttype of Residence
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(49,153);
 
             $pdf->Write(0, $survey->res_residence_type);
         }
           
 
             if($survey->res_residence_is=="Owned")
             {
                  // Applicant Is
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(142,153);
 
                 $pdf->Write(0, 'Owner');
 
             }
             else if($survey->res_residence_is=="Rented")
             {
                   // Applicant Is
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFontSize(10);
                   $pdf->SetXY(142,153);
   
                   $pdf->Write(0, 'Tenant');
             }
             else{
                 // Applicant Is
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(142,153);
 
                 $pdf->Write(0,  $survey->res_residence_is);
           }
           if($survey->res_residence_is=="Others")
           {
              // Mention Other
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,157.5);
 
            $pdf->Write(0, $survey->res_residence_is_other);
           }
           else{
                // Mention Other
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,157.5);
 
            $pdf->Write(0, 'N/A');
           }
           
           if($survey->res_residence_is=="Rented")
           {
                 // Mention Rent
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(142,157.5);
 
                 $pdf->Write(0,  $survey->res_monthly_rent);
           }
 
           else{
              // Mention Rent
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(142,157.5);
 
            $pdf->Write(0,  'N/A');
           }
          
           
 
            // Size
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(49,161.7);
 
            $pdf->Write(0, $survey->res_residence_area_size ." " .$survey->res_residence_area_unit);
 
          
            // Utliization
            $pdf->SetFont('Helvetica');
            $pdf->SetFontSize(10);
            $pdf->SetXY(151,161.7);
 
            $pdf->Write(0, $survey->res_residence_utilization);
 
            if($survey->res_residence_is=="Rented")
            {
                 // Rent DEED
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(49,166);
 
                 $pdf->Write(0, $survey->res_rent_deed_verified);
            }
            else{
                 // Rent DEED
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFontSize(10);
                 $pdf->SetXY(49,166);
 
                 $pdf->Write(0,'N/A');
            }
           
 
 
             // Neighboorhood
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(51,182.5);
 
             $pdf->Write(0, $survey->res_neighboorhood_is);
 
              // Area Accessiblity
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(144,182.5);
 
              $pdf->Write(0,  $survey->res_area_access);
        
              // Resident Belong to
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(51,187);
 
             $pdf->Write(0, $survey->res_belongs_to);
 
              // Repossesion in the area
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(10);
              $pdf->SetXY(154,187);
 
              $pdf->Write(0,  $survey->res_repossession);
 
 
             // Neighbor Name
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,202);
 
             $pdf->Write(0, $survey->res_neigh_one_name);
            
            
             // Neighbor Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,206);
 
             $pdf->Write(0, $survey->res_neigh_one_address);
 
             // Knows Applicant
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,210.5);
 
             $pdf->Write(0, $survey->res_neigh_one_knows_applicant);
 
             if($survey->res_neigh_one_knows_applicant=="Yes")
             {
                       // Knows How Long
            
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(140,210.5);
 
             $pdf->Write(0, $survey->res_neigh_one_knows_applicant_since);
 
             }
             else{
                     // Knows How Long
                             
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFontSize(10);
                     $pdf->SetXY(140,210.5);
 
                     $pdf->Write(0, 'N/A');
             }           
          
 
             // Neighbor Comments
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,214.7);
 
             $pdf->Write(0,strtoupper($survey->res_neigh_one_comments));
 
             // Neighboor Check Two
             // Neighboor Check Two
             // Neighboor Check Two
 
             
             // Neighbor Name
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,226.8);
 
             $pdf->Write(0, $survey->res_neigh_two_name);
            
            
             // Neighbor Address
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53,231.5);
 
             $pdf->Write(0, $survey->res_neigh_two_address);
             
 
             
             // Knows Applicant
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,235.9);
 
             $pdf->Write(0, $survey->res_neigh_two_knows_applicant);
            
 
             if($survey->res_neigh_two_knows_applicant=="Yes")
             {
                 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,235.9);
 
             $pdf->Write(0, $survey->res_neigh_two_knows_applicant_since);
 
             }
 
             else {
                
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(141,235.9);
 
             $pdf->Write(0, 'N/A');
 
             }
            //  // Knows How Long
            
             // Neighbor Comments
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(53.5,240);
 
             $pdf->Write(0, strtoupper($survey->res_neigh_two_comments));
           
           
            // Surveyor
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(51, 245);
             $pdf->MultiCell(0,3.7,$survey->surveyor);
            
             // QC Officer
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(132, 245);
             $pdf->MultiCell(0,3.7,$survey->qc_officer_name);

             // GeneraL Comments
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             // $pdf->SetTextColor(255, 0, 0);
             $pdf->SetXY(62.5, 249.5);
             $pdf->MultiCell(0,3.7, $survey->outcome_comments.". ".$survey->outcome_remarks);
        
             // Result of Verification
 
             $pdf->SetFont('Helvetica');
             $pdf->SetFontSize(10);
             $pdf->SetXY(62.5,265.6);
 
             $pdf->Write(0, strtoupper($survey->outcome_report_status));
 
 
             // $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('data'));
 
           
             
             // Verficication Images
 
            
             $job = DB::table('verification_survey_images')
             ->where('survey_id', $id)
             ->select(
                 'path',
                 'rotate'
             )
             ->get();
             
             // Verficication Images
 
            //     $data=[
            //     ];
            //     foreach ($job as $item) {
            //      // echo  $item->path;
            //      array_push($data, $item->path);
            //    }
            
            $recs=count($job);
 
               if($recs>0)
               {
 
                $pdf->AddPage();
                $pdf->setSourceFile('images/imgsheader.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);

                $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('job'));
                $pdf1->save('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
                $pdf->setSourceFile('Reports/Verification/'.$survey->id.'/Survey/'.$id.'/images.pdf');
  
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0);
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 35);
                 $pdf->Write(0, 'HABIB METROPOLITAN BANK LIMITED');
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(140, 35);
                 $pdf->Write(0, $survey->job_id.'-R');
     
                   
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 39);
                 $pdf->Write(0, 'Applicant Name - '.$survey->applicant_name);
     
     
                
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(80, 46);
                 $pdf->Write(0, 'Verification Images - Residence');
                
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 52);
                 $pdf->Write(0, 'Inquiry No.:'.'              '.$survey->id);
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(11, 58);
                 $pdf->Write(0, $survey->main_address);
              
                 // Applicant Name Heading
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','B',10);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(160, 52);
                 $pdf->Write(0, date('F d, Y'));
 
 
               }
        
    }

   

    public static function getworkplaceReport($request,$pdf,$survey,$appinfo)
    {

        $id=$survey->sid;
       

        $pdf->AddPage();

        $apptype=$survey->product_type;
        $bankid=$survey->bank_id;

        
            if($apptype=="Home")
            {
                $appsubtype=$survey->product_sub_type;
                if($appsubtype=="Applicant")
                {
                    $ver= new VerificationHMBL();
                    $ver->applicantWorkplaceReportforhome($request,$pdf,$survey,$id);
        
                }
        
                elseif($appsubtype=="Co-Applicant")
                {
                    $ver= new VerificationHMBL();
                    $ver->applicantcoWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);
    
                    
                }
                elseif($appsubtype=="Reference")
                {
                    $ver= new VerificationHMBL();
                    $ver->applicantrefWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);
        
                }
            }
    
            else{
          
    
                $ver= new VerificationHMBL();
                $ver->applicantWorkplaceReportforhome($request,$pdf,$survey,$id);
    
            }
       

        // $pdf->setSourceFile("Reports/Verification/$id/residence.pdf");

      

         
         


    }

    public static function getresidenceReport($request,$pdf,$survey,$appinfo)
    {


        $id=$survey->sid;
            
  
   
        // $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('data'));
        // $pdf1->save('Reports/Verification/1/images.pdf');
   
   
        // $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        $pdf->AddPage();
        
        $apptype=$survey->product_type;
        $bankid=$survey->bank_id;

       
            if($apptype=="Home")
            {
                $appsubtype=$survey->product_sub_type;
                if($appsubtype=="Applicant")
                {
    
                    $Verification = new VerificationHMBL();
                    $Verification->applicantResidenceReportforhome($request,$pdf,$survey,$id);
        
                }
        
                elseif($appsubtype=="Co-Applicant")
                {
                    $Verification = new VerificationHMBL();
                    $Verification->applicantcoResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
                    
                }
                elseif($appsubtype=="Reference")
                {
                    $Verification = new VerificationHMBL();
                    $Verification->applicantrefResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
        
                }
            }
    
            else{
    
                $Verification = new VerificationHMBL();
                $Verification->applicantResidenceReportforhome($request,$pdf,$survey,$id);
    
            }
        
        
   
   
       
        
         

 
    }
}

