<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Log;
use App\Verification;
use PDF;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class VerificationFHM extends Model
{
  
    public static function applicantWorkplaceReport($request,$pdf,$survey,$id)
    {
        $pdf->setSourceFile("src/reportformat/fhm/workplaceperfoma.pdf");

        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

         //BankName
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(149, 37);
         $pdf->Write(0, $survey->job_id."-W");

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','',9);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(57, 55.4);
        $pdf->Write(0, date_format(date_create($survey->conducted_on),'F d, Y'));

         // Applicant Name Heading
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(57, 61);
         $pdf->Write(0, date_format(date_create($survey->conducted_on),'F d, Y'));


           // Applicant Name Heading
           $pdf->SetFont('Helvetica');
           $pdf->SetFont('Arial','',9);
           // $pdf->SetTextColor(255, 0, 0);
           $pdf->SetXY(57, 67);
           $pdf->Write(0, $survey->surveyor);
  


         //Applicant Cell
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(48, 79.5   );
         $pdf->Write(0, $survey->applicant_name);
        
         //Applicant Cell
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(134, 79.5);
         $pdf->Write(0, $survey->applicant_father);


          //Applicant Cell
           $pdf->SetFont('Helvetica');
           $pdf->SetFont('Arial','',9);
           // $pdf->SetTextColor(255, 0, 0);
           $pdf->SetXY(59, 85);
           $pdf->Write(0, $survey->applicant_designation);

              //Applicant Cell
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','',9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(136, 85);
              $pdf->Write(0, $survey->applicant_work_phone);


              
              //Applicant Cell
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','',9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(173, 85);
              $pdf->Write(0, $survey->applicant_contact);


          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(35, 90);
          $pdf->Write(0, $survey->applicant_cnic);
         
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(130, 90);
          $pdf->Write(0, date_format(date_create($survey->applicant_dob),'F d, Y'));

          
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(57, 96);
          $pdf->Write(0, $survey->applicant_business_name);
 
 
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('ZapfDingbats','', 8);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(62.5, 101.5);
          $pdf->Write(0, $survey->wp_business_type=="Shop"?3:'');


            $pdf->SetFont('Helvetica');
            $pdf->SetFont('ZapfDingbats','', 8);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(80.8, 101.5);
            $pdf->Write(0, $survey->wp_business_type=="Office"?3:'');


            //Applicant Cell
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('ZapfDingbats','', 8);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(101.2, 101.5);
            $pdf->Write(0, $survey->wp_business_type=="Factory"?3:'');

            //Applicant Cell
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('ZapfDingbats','', 8);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(119.2, 101.5);
            $pdf->Write(0, $survey->wp_business_type=="Others"?3:'');


            //Applicant Cell
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','',9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(138.8, 101.5);
            $pdf->Write(0, $survey->wp_business_type=="Others"?$survey->wp_other_business_type:'');
                
    

                //Applicant Cell
                $pdf->SetFont('Helvetica');
                $pdf->SetFont('Arial','',9);
                // $pdf->SetTextColor(255, 0, 0);
                $pdf->SetXY(51, 107.5);
                $pdf->Write(0, $survey->main_address);


                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(106.8, 123.3);
                        $pdf->Write(0, $survey->wp_is_address_correct=="Yes"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(121.4, 123.3);
                        $pdf->Write(0, $survey->wp_is_address_correct=="No"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(168.5, 123.3);
                        $pdf->Write(0, $survey->wp_name_plate_affixed=="Yes"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(181.5, 123.3);
                        $pdf->Write(0, $survey->wp_name_plate_affixed=="No"?3:'');


                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('Arial','',9);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(56, 128.6);
                        $pdf->Write(0, $survey->wp_is_address_correct=="Yes"?'':$survey->wp_correct_address);

                        
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('Arial','',9);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(52, 134);
                        $pdf->Write(0, $survey->wp_business_nature=="Others"?$survey->wp_other_business_nature:$survey->wp_business_nature);
    
                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(153.5, 134.4);
                        $pdf->Write(0, $survey->wp_permisses_is=="Owned"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(173.5, 134.4);
                        $pdf->Write(0, $survey->wp_permisses_is=="Rented"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(192, 134.4);
                        $pdf->Write(0, $survey->wp_permisses_is=="Others"?3:'');


                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('Arial','',9);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(66, 140);
                        $pdf->Write(0, $survey->wp_established_since);

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(178.5,140);
                        $pdf->Write(0, $survey->wp_does_applicant_works_here=="Yes"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(192, 140);
                        $pdf->Write(0, $survey->wp_does_applicant_works_here=="No"?3:'');
                      

                        
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('Arial','',9);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(87, 146);
                        $pdf->Write(0, $survey->wp_working_here_since);

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(178.5,146);
                        $pdf->Write(0, $survey->wp_is_applicant_available=="Yes"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(192, 146);
                        $pdf->Write(0, $survey->wp_is_applicant_available=="No"?3:'');

                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('Arial','',9);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(60, 152);
                        $pdf->Write(0, $survey->wp_reson_of_non_ava);


        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('Arial','',9);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(65, 108.5);
        //            $pdf->Write(0, $survey->res_residence_area_size.' '.$survey->res_residence_area_unit);
                       
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('Arial','',9);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(125.8, 108.5);
        //            $pdf->Write(0, $survey->res_residence_area_details);


                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(95.4, 114.3);
                        $pdf->Write(0, $survey->wp_is_address_correct=="Yes"?3:'');

                        //Applicant Cell
                        $pdf->SetFont('Helvetica');
                        $pdf->SetFont('ZapfDingbats','', 8);
                        // $pdf->SetTextColor(255, 0, 0);
                        $pdf->SetXY(120.4, 114.3);
                        $pdf->Write(0, $survey->wp_is_address_correct=="No"?3:'');


        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(70.4, 121.3);
        //            $pdf->Write(0, $survey->res_residence_condition=="Excellent"?3:'');

        //             //Applicant Cell
        //             $pdf->SetFont('Helvetica');
        //             $pdf->SetFont('ZapfDingbats','', 8);
        //             // $pdf->SetTextColor(255, 0, 0);
        //             $pdf->SetXY(86, 121.3);
        //             $pdf->Write(0, $survey->res_residence_condition=="Good"?3:'');
                       
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(106, 121.3);
        //            $pdf->Write(0, $survey->res_residence_condition=="Average"?3:'');

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(152.5, 121.3);
        //            $pdf->Write(0, $survey->res_residence_area_condition=="Excellent"?3:'');
                       

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(167.5, 121.3);
        //            $pdf->Write(0, $survey->res_residence_area_condition=="Good"?3:'');
   
                                       
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(187.5, 121.3);
        //            $pdf->Write(0, $survey->res_residence_area_condition=="Average"?3:'');


        //             //Applicant Cell
        //             $pdf->SetFont('Helvetica');
        //             $pdf->SetFont('ZapfDingbats','', 8);
        //             // $pdf->SetTextColor(255, 0, 0);
        //             $pdf->SetXY(57, 127.5);
        //             $pdf->Write(0, $survey->res_residence_is=="Owned"?3:'');
                       
                    
        //             //Applicant Cell
        //             $pdf->SetFont('Helvetica');
        //             $pdf->SetFont('ZapfDingbats','', 8);
        //             // $pdf->SetTextColor(255, 0, 0);
        //             $pdf->SetXY(75.5, 127.5);
        //             $pdf->Write(0, $survey->res_residence_is=="Rented"?3:'');

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(96.5, 127.5);
        //            $pdf->Write(0, $survey->res_residence_is=="Relatives"?3:'');
                                 
                   
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(124.5, 127.5);
        //            $pdf->Write(0, $survey->res_residence_is=="Parents/Joint"?3:'');
                   
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(149, 127.5);
        //            $pdf->Write(0, $survey->res_residence_is=="Mortgaged"?3:'');
                   

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(165, 127.5);
        //            $pdf->Write(0, $survey->res_residence_is=="Others"?3:'');

        //             //Applicant Cell
        //             $pdf->SetFont('Helvetica');
        //             $pdf->SetFont('Arial','', 8);
        //             // $pdf->SetTextColor(255, 0, 0);
        //             $pdf->SetXY(89, 133);
        //             $pdf->Write(0, $survey->res_monthly_rent);
                                   
        //             //Applicant Cell
        //             $pdf->SetFont('Helvetica');
        //             $pdf->SetFont('Arial','', 8);
        //             // $pdf->SetTextColor(255, 0, 0);
        //             $pdf->SetXY(161, 133);
        //             $pdf->Write(0, $survey->res_living_since);

        //              //Applicant Cell
        //              $pdf->SetFont('Helvetica');
        //              $pdf->SetFont('Arial','', 8);
        //              // $pdf->SetTextColor(255, 0, 0);
        //              $pdf->SetXY(56, 146);
        //              $pdf->Write(0, $survey->res_name_of_person_met);


        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('Arial','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(124, 146);
        //            $pdf->Write(0, $survey->res_relationship_with_applicant);

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('Arial','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(174, 146);
        //            $pdf->Write(0, $survey->res_rel_phone);
                                   
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('Arial','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(32, 150);
        //            $pdf->Write(0, $survey->res_rel_cell);

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(95.8, 157.5);
        //            $pdf->Write(0, $survey->res_is_address_correct=="Yes"?3:'');
                   
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(121.4, 157.5);
        //            $pdf->Write(0, $survey->res_is_address_correct=="No"?3:'');

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(95.8, 163.7);
        //            $pdf->Write(0, $survey->res_is_address_correct=="Yes"?'':'');
                   
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(121.4, 163.7);
        //            $pdf->Write(0, $survey->res_is_address_correct=="No"?'':'');
                   

        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('Arial','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(162, 163.7);
        //            // $pdf->Write(0, $survey->res_rel_cell."dsa");
                   
        //             //       

        //             //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(96.4, 170);
        //            $pdf->Write(0, $survey->res_applicant_live_here=="Yes"?3:'');
                   
        //            //Applicant Cell
        //            $pdf->SetFont('Helvetica');
        //            $pdf->SetFont('ZapfDingbats','', 8);
        //            // $pdf->SetTextColor(255, 0, 0);
        //            $pdf->SetXY(121.4, 170);
        //            $pdf->Write(0, $survey->res_applicant_live_here=="No"?3:'');
                  
                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('Arial','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(31, 165);
                   $pdf->Write(0, $survey->mc_one_person_met);

                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('ZapfDingbats','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(150, 164.5);
                   $pdf->Write(0, $survey->mc_one_knows_applicant=="Yes"?3:'');
                   
                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('ZapfDingbats','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(165, 164.5);
                   $pdf->Write(0, $survey->mc_one_knows_applicant=="No"?3:'');
                   
                   
                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('ZapfDingbats','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(187.5, 164.5);
                   $pdf->Write(0, $survey->mc_one_knows_applicant=="Refused"?3:'');
                   
                   
                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('Arial','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(79, 171);
                   $pdf->Write(0, $survey->mc_one_knows_applicant_since);


                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(156, 171);
                    $pdf->Write(0, $survey->mc_one_designation_of_met_person);
                   

                    //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('Arial','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(70, 177);
                   $pdf->Write(0, $survey->mc_one_applicant_emp_status);


                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(150, 177);
                    $pdf->Write(0, $survey->mc_one_applicant_designation);


                    //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('Arial','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(60, 183);
                   $pdf->Write(0, $survey->mc_one_applicant_nature_of_job);


                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(121, 183);
                    $pdf->Write(0, $survey->mc_one_applicant_salary);



                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(31, 196);
                    $pdf->Write(0, $survey->mc_two_person_met);
 
                    

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(150, 196);
                    $pdf->Write(0, $survey->mc_two_knows_applicant=="Yes"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(165.4, 196);
                    $pdf->Write(0, $survey->mc_two_knows_applicant=="No"?3:'');
                    
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(189, 196);
                    $pdf->Write(0, $survey->mc_two_knows_applicant=="Refused"?3:'');
                    
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(79, 202);
                    $pdf->Write(0, $survey->mc_two_knows_applicant_since);
 
 
                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('Arial','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(156, 202);
                     $pdf->Write(0, $survey->mc_two_designation_of_met_person);
                    
 
                     //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(70, 208);
                    $pdf->Write(0, $survey->mc_two_applicant_emp_status);
 
 
                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('Arial','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(150, 208);
                     $pdf->Write(0, $survey->mc_two_applicant_designation);
 
 
                     //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(60, 214.5);
                    $pdf->Write(0, $survey->mc_two_applicant_nature_of_job);
 
 
                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('Arial','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(121, 214.5);
                     $pdf->Write(0, $survey->mc_two_applicant_salary);
                   
                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('Arial','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(21, 228);
                   $pdf->Write(0, $survey->outcome_comments.". ".$survey->outcome_remarks);
                   
                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('ZapfDingbats','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(111, 245);
                   $pdf->Write(0, $survey->outcome_report_status=="Positive"?3:'');
                                    
                   //Applicant Cell
                   $pdf->SetFont('Helvetica');
                   $pdf->SetFont('ZapfDingbats','', 8);
                   // $pdf->SetTextColor(255, 0, 0);
                   $pdf->SetXY(160, 245);
                   $pdf->Write(0, $survey->outcome_report_status=="Negative"?3:'');
                                    

    }


    public static function salaryslipReport($request,$pdf,$survey,$id)
    {
        $pdf->setSourceFile("src/reportformat/fhm/salaryperfoma.pdf");

        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

              // Applicant Name Heading
              $pdf->SetFont('Helvetica');
              $pdf->SetFont('Arial','B',10);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(47, 37.5);
              $pdf->Write(0, $survey->applicant_name);
            
      
                //JobID
                $pdf->SetFont('Helvetica');
                $pdf->SetFont('Arial','B',9);
                // $pdf->SetTextColor(255, 0, 0);
                $pdf->SetXY(144, 35.5);
                $pdf->Write(0, $survey->job_id."-SS");
               
               //Ref Id
               $pdf->SetFont('Helvetica');
               $pdf->SetFont('Arial','B',9);
               // $pdf->SetTextColor(255, 0, 0);
               $pdf->SetXY(42, 47.5);
               $pdf->Write(0,$survey->inquiry_no);
              
      
          
               //Date
               $pdf->SetFont('Helvetica');
               $pdf->SetFont('Arial','B',9);
               // $pdf->SetTextColor(255, 0, 0);
               $pdf->SetXY(172, 48.5);
               $pdf->Write(0, date('F d, Y'));
      
            
      
              // Applicant Name
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(52, 59);
              $pdf->Write(0, $survey->applicant_name);
              
              // Applicant Contact
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(148, 59);
              $pdf->Write(0, $survey->applicant_contact);
              
              // Applicant CNIC
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(52, 63.3);
              $pdf->Write(0, $survey->applicant_business_name);
      
                // Applicant Designation
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(9);
                // $pdf->SetTextColor(255, 0, 0);
                $pdf->SetXY(155.4, 63.3);
                $pdf->Write(0, $survey->applicant_designation);
                
      
              // Applicant Office Name
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(52, 65.4);
              $pdf->MultiCell(0, 3.9,$survey->main_address);
             
            
      
      
              // Applicant Landmarks
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(52,76.2);
              $pdf->Write(0,$survey->landmark);
             
              // Applicant gps
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(52.5,79.2);
              $pdf->Write(0,$survey->latitiude.','.$survey->longitude);
      
              // Applicant gps URL
              $pdf->SetFont('Helvetica');
              $pdf->SetFontSize(9);
              // $pdf->SetTextColor(255, 0, 0);
              $pdf->SetXY(52.5,84.4);
              $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.','.$survey->longitude);
      
            
                // GeneraL Comments
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(9);
                // $pdf->SetTextColor(255, 0, 0);
                $pdf->SetXY(66, 89);
                $pdf->MultiCell(135,4.3,$survey->wp_ss_comments);
            
                // Result of Verification
    
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(9);
                $pdf->SetXY(66,106);
    
                $pdf->Write(0,strtoupper($survey->wp_ss_report_status));
    


              

    }
    public static function applicantResidenceReport($request,$pdf,$survey,$id)
    {
       

        $pdf->setSourceFile("src/reportformat/fhm/residenceperfoma.pdf");

         // $pdf->setSourceFile("Reports/Verification/$id/residence.pdf");

         $tplIdx = $pdf->importPage(1);
         $pdf->useTemplate($tplIdx, 0, 0);

         //BankName
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(150, 33.1);
          $pdf->Write(0, $survey->job_id."-R");
 
         // Applicant Name Heading
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(57, 46);
         $pdf->Write(0, date_format(date_create($survey->conducted_on),'F d, Y'));

          // Applicant Name Heading
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(57, 51);
          $pdf->Write(0, date_format(date_create($survey->conducted_on),'F d, Y'));


            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','',9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(57, 56);
            $pdf->Write(0, $survey->surveyor);
   
 

          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(48, 70);
          $pdf->Write(0, $survey->applicant_name);
         
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(130, 70);
          $pdf->Write(0, $survey->applicant_father);


           //Applicant Cell
           $pdf->SetFont('Helvetica');
           $pdf->SetFont('Arial','',9);
           // $pdf->SetTextColor(255, 0, 0);
           $pdf->SetXY(48, 75);
           $pdf->Write(0, $survey->applicant_cnic);
          
           //Applicant Cell
           $pdf->SetFont('Helvetica');
           $pdf->SetFont('Arial','',9);
           // $pdf->SetTextColor(255, 0, 0);
           $pdf->SetXY(130, 75);
           $pdf->Write(0, date_format(date_create($survey->applicant_dob),'F d, Y'));


            //Applicant Cell
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','',9);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(48, 81);
            $pdf->Write(0, $survey->applicant_res_phone);

               //Applicant Cell
               $pdf->SetFont('Helvetica');
               $pdf->SetFont('Arial','',9);
               // $pdf->SetTextColor(255, 0, 0);
               $pdf->SetXY(102, 81);
               $pdf->Write(0, $survey->applicant_work_phone);


                 //Applicant Cell
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','',9);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(146, 81);
                 $pdf->Write(0, $survey->applicant_contact);

                 
                 //Applicant Cell
                 $pdf->SetFont('Helvetica');
                 $pdf->SetFont('Arial','',9);
                 // $pdf->SetTextColor(255, 0, 0);
                 $pdf->SetXY(51, 87.5);
                 $pdf->Write(0, $survey->main_address);

                //  //Applicant Cell
                //  $pdf->SetFont('Helvetica');
                //  $pdf->SetFont('Arial','',9);
                //  // $pdf->SetTextColor(255, 0, 0);
                //  $pdf->SetXY(49, 102.5);
                //  $pdf->Write(0, $survey->res_residence_type);


                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(81.4, 102.5);
                    $pdf->Write(0, $survey->res_residence_type=="House/Bungalow"?3:'');


                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('ZapfDingbats','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(102, 102.5);
                     $pdf->Write(0, $survey->res_residence_type=="Portion"?3:'');

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(128, 102.5);
                    $pdf->Write(0, $survey->res_residence_type=="Apartment"?3:'');

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(145.8, 102.5);
                    $pdf->Write(0, $survey->res_residence_type=="Others"?3:'');
                    

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','',9);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(165, 102.5);
                    $pdf->Write(0, $survey->res_residence_type=="Others"?$survey->res_other_residence_type:'');
                       

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','',9);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(65, 108.5);
                    $pdf->Write(0, $survey->res_residence_area_size.' '.$survey->res_residence_area_unit);
                        
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','',9);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(125.8, 108.5);
                    $pdf->Write(0, $survey->res_residence_area_details);


                         //Applicant Cell
                         $pdf->SetFont('Helvetica');
                         $pdf->SetFont('ZapfDingbats','', 8);
                         // $pdf->SetTextColor(255, 0, 0);
                         $pdf->SetXY(95.4, 114.3);
                         $pdf->Write(0, $survey->res_name_plate_affixed=="Yes"?3:'');

                         //Applicant Cell
                         $pdf->SetFont('Helvetica');
                         $pdf->SetFont('ZapfDingbats','', 8);
                         // $pdf->SetTextColor(255, 0, 0);
                         $pdf->SetXY(120, 114.3);
                         $pdf->Write(0, $survey->res_name_plate_affixed=="No"?3:'');
 

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(70.5, 121.3);
                    $pdf->Write(0, $survey->res_residence_condition=="Excellent"?3:'');

                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('ZapfDingbats','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(86.8, 121.3);
                     $pdf->Write(0, $survey->res_residence_condition=="Good"?3:'');
                        
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(108, 121.3);
                    $pdf->Write(0, $survey->res_residence_condition=="Average"?3:'');

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(155.5, 121.3);
                    $pdf->Write(0, $survey->res_residence_area_condition=="Excellent"?3:'');
                        

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(171.5, 121.3);
                    $pdf->Write(0, $survey->res_residence_area_condition=="Good"?3:'');
    
                                        
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(192, 121.3);
                    $pdf->Write(0, $survey->res_residence_area_condition=="Average"?3:'');


                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('ZapfDingbats','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(55.5, 127.5);
                     $pdf->Write(0, $survey->res_residence_is=="Owned"?3:'');
                        
                     
                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('ZapfDingbats','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(75, 127.5);
                     $pdf->Write(0, $survey->res_residence_is=="Rented"?3:'');

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(96.8, 127.5);
                    $pdf->Write(0, $survey->res_residence_is=="Relatives"?3:'');
                                  
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(126, 127.5);
                    $pdf->Write(0, $survey->res_residence_is=="Parents/Joint"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(151, 127.5);
                    $pdf->Write(0, $survey->res_residence_is=="Mortgaged"?3:'');
                    

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(168.4, 127.5);
                    $pdf->Write(0, $survey->res_residence_is=="Others"?3:'');

                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('Arial','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(89, 133);
                     $pdf->Write(0, $survey->res_monthly_rent);
                                    
                     //Applicant Cell
                     $pdf->SetFont('Helvetica');
                     $pdf->SetFont('Arial','', 8);
                     // $pdf->SetTextColor(255, 0, 0);
                     $pdf->SetXY(161, 133);
                     $pdf->Write(0, $survey->res_living_since);

                      //Applicant Cell
                      $pdf->SetFont('Helvetica');
                      $pdf->SetFont('Arial','', 8);
                      // $pdf->SetTextColor(255, 0, 0);
                      $pdf->SetXY(56, 146);
                      $pdf->Write(0, $survey->res_name_of_person_met);


                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(124, 146);
                    $pdf->Write(0, $survey->res_relationship_with_applicant);

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(174, 146);
                    $pdf->Write(0, $survey->res_rel_phone);
                                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(32, 150);
                    $pdf->Write(0, $survey->res_rel_cell);

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(95.8, 157.5);
                    $pdf->Write(0, $survey->res_is_address_correct=="Yes"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(121.4, 157.5);
                    $pdf->Write(0, $survey->res_is_address_correct=="No"?3:'');

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(95.8, 163.7);
                    $pdf->Write(0, $survey->res_is_address_correct=="Yes"?'':'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(121.4, 163.7);
                    $pdf->Write(0, $survey->res_is_address_correct=="No"?'':'');
                    

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(96, 163.5);
                    $pdf->Write(0, $survey->res_does_know_applicant=="Yes"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(121.4, 163.5);
                    $pdf->Write(0, $survey->res_does_know_applicant=="No"?3:'');

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(161.4, 163.5);
                    $pdf->Write(0, $survey->res_know_how);
                    

                     //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(96.4, 170);
                    $pdf->Write(0, $survey->res_applicant_live_here=="Yes"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(121.6, 170);
                    $pdf->Write(0, $survey->res_applicant_live_here=="No"?3:'');
                   

             
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(34, 185);
                    $pdf->Write(0, $survey->res_neigh_one_name);

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(155, 185);
                    $pdf->Write(0, $survey->res_neigh_one_knows_applicant=="Yes"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(170.5, 185);
                    $pdf->Write(0, $survey->res_neigh_one_knows_applicant=="No"?3:'');
                    
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(194, 185);
                    $pdf->Write(0, $survey->res_neigh_one_knows_applicant=="Refused"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(52, 191.5);
                    $pdf->Write(0, $survey->res_neigh_one_address);
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(168, 191.5);
                    $pdf->Write(0, $survey->res_neigh_one_knows_applicant_since);

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(34, 205);
                    $pdf->Write(0, $survey->res_neigh_two_name);
                    

                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(155, 205);
                    $pdf->Write(0, $survey->res_neigh_two_knows_applicant=="Yes"?3:'');
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(170.5, 205);
                    $pdf->Write(0, $survey->res_neigh_two_knows_applicant=="No"?3:'');
                                        
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(194, 205);
                    $pdf->Write(0, $survey->res_neigh_two_knows_applicant=="Refused"?3:'');
                                        
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(52, 211);
                    $pdf->Write(0, $survey->res_neigh_two_address);
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(168, 211);
                    $pdf->Write(0, $survey->res_neigh_two_knows_applicant_since);
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('Arial','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(20, 225);
                    $pdf->Write(0, $survey->outcome_comments.". ".$survey->outcome_remarks);
                    
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(155.3, 238);
                    $pdf->Write(0, $survey->outcome_report_status=="Positive"?3:'');
                                     
                    //Applicant Cell
                    $pdf->SetFont('Helvetica');
                    $pdf->SetFont('ZapfDingbats','', 8);
                    // $pdf->SetTextColor(255, 0, 0);
                    $pdf->SetXY(114.8, 238);
                    $pdf->Write(0, $survey->outcome_report_status=="Negative"?3:'');
                                        
    //       //Team Lead
    //       $pdf->SetFont('Helvetica');
    //       $pdf->SetFont('Arial','B',9);
    //       // $pdf->SetTextColor(255, 0, 0);
    //       $pdf->SetXY(167, 48);
    //       $pdf->Write(0, date('F d, Y'));       
 
 
    //      // Applicant Name
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(52, 58.3);
    //      $pdf->Write(0, $survey->applicant_name);
         
    //      // Applicant Contact
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(148.5, 58.3);
    //      $pdf->Write(0,  $survey->applicant_contact);
         
       
         
    //      // Applicant CNIC
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(52,63);
    //      $pdf->Write(0, $survey->applicant_cnic);
         
    //      // Applicant Address
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(52,65.5);
    //      $pdf->MultiCell(0,4,$survey->main_address);
    //      // $pdf->Write(0, );
 
    //      // Applicant CNIC
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(52,76);
    //      $pdf->Write(0, $survey->landmark);
        
    //      // Applicant gps
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(52,80.5);
    //      $pdf->Write(0,$survey->latitiude.",".$survey->longitude);
 
    //      // Applicant gps URL
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(52,84.5);
    //      $pdf->Write(0, 'http://maps.google.com/?q='.$survey->latitiude.",".$survey->longitude);
 
 
    //      // Was APPLICANT Available
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(60,100.5);
    //      $pdf->Write(0, $survey->res_applicant_is_available);
        
       
    //      // Name of Person to Met
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(151,100.5);
    //      $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ? 'N/A': $survey->res_name_of_person_met);
 
    //      // Relation with Applicant:
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(60,105);
    //      $pdf->Write(0, $survey->res_applicant_is_available=="Yes" ? 'N/A': $survey->res_relationship_with_applicant);
 
    //      // Was Actual Address Same
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(10);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(158,105);
    //      $pdf->Write(0, $survey->res_is_address_correct);
 
    //    if($survey->res_is_address_correct=="Yes")
    //    {
    //          // Correct Address
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          // $pdf->SetTextColor(255, 0, 0);
    //          $pdf->SetXY(60,109);
    //         $pdf->Write(0, 'As Above');
    //    }
 
    //    else{
 
    //       // Correct Address
    //       $pdf->SetFont('Helvetica');
    //       $pdf->SetFontSize(9);
    //       // $pdf->SetTextColor(255, 0, 0);
    //       $pdf->SetXY(60,109);
    //       $pdf->Write(0,  $survey->res_correct_address); 
    //    }
 
    //      // Contact
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      $pdf->SetXY(60,113.5);
 
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->Write(0,$survey->res_applicant_is_available=="Yes" ?  $survey->applicant_contact : $survey->res_rel_cell);
 
    //      // CNIC
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      // $pdf->SetTextColor(255, 0, 0);
    //      $pdf->SetXY(152,113.5);
 
    //      $pdf->Write(0, $survey->res_applicant_is_available=="Yes" ?  $survey->applicant_cnic : $survey->res_nic_of_person_met);
 
    //      // Lives At Given Address
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      $pdf->SetXY(60,117.5);
 
    //      $pdf->Write(0, $survey->res_applicant_live_here);
 
       
    //      // Since How Long Living
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      $pdf->SetXY(152,117.5);
 
    //      $pdf->Write(0, $survey->res_living_since);
 
    //      if($survey->res_applicant_live_here=="Yes")
    //      {
 
    //      // Permanant Address
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      $pdf->SetXY(60,121.8);
 
    //      $pdf->Write(0, 'As Above');
      
    //      }
 
    //      else{
 
    //      // Permanant Address
    //      $pdf->SetFont('Helvetica');
    //      $pdf->SetFontSize(9);
    //      $pdf->SetXY(60,121.8);
 
    //      $pdf->Write(0,  'N/A');
      
    //      }
 

    //      if($survey->res_residence_type=="Others")
    //      {
    //          // Ttype of Residence
    //         $pdf->SetFont('Helvetica');
    //         $pdf->SetFontSize(10);
    //         $pdf->SetXY(52,138.5);
 
    //         $pdf->Write(0, $survey->res_other_residence_type);
    //      }
    //      else{
    //          // Ttype of Residence
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(52,138.5);
 
    //          $pdf->Write(0, $survey->res_residence_type);
    //      }
           
 
    //          if($survey->res_residence_is=="Owned")
    //          {
    //               // Applicant Is
    //              $pdf->SetFont('Helvetica');
    //              $pdf->SetFontSize(9);
    //              $pdf->SetXY(145,138.5);
 
    //              $pdf->Write(0, 'Owner');
 
    //          }
    //          else if($survey->res_residence_is=="Rented")
    //          {
    //                // Applicant Is
    //                $pdf->SetFont('Helvetica');
    //                $pdf->SetFontSize(9);
    //                $pdf->SetXY(145,138.5);
    //                $pdf->Write(0, 'Tenant');
    //          }
    //          else{
    //              // Applicant Is
    //              $pdf->SetFont('Helvetica');
    //              $pdf->SetFontSize(9);
    //              $pdf->SetXY(145,138.5);

    //             $pdf->Write(0,  $survey->res_residence_is);
    //        }
    //        if($survey->res_residence_is=="Others")
    //        {
    //           // Mention Other
    //         $pdf->SetFont('Helvetica');
    //         $pdf->SetFontSize(9);
    //         $pdf->SetXY(52,142.8);
 
    //         $pdf->Write(0, $survey->res_residence_is_other);
    //        }
    //        else{
    //             // Mention Other
    //         $pdf->SetFont('Helvetica');
    //         $pdf->SetFontSize(9);
    //         $pdf->SetXY(52,142.8);
 
    //         $pdf->Write(0, 'N/A');
    //        }
           
    //        if($survey->res_residence_is=="Rented")
    //        {
    //              // Mention Rent
    //              $pdf->SetFont('Helvetica');
    //              $pdf->SetFontSize(9);
    //              $pdf->SetXY(145,142.8);

    //              $pdf->Write(0,  $survey->res_monthly_rent);
    //        }
 
    //        else{
    //           // Mention Rent
    //         $pdf->SetFont('Helvetica');
    //         $pdf->SetFontSize(9);
    //         $pdf->SetXY(145,142.8);
 
    //         $pdf->Write(0,  'N/A');
    //        }
          
           
 
    //         // Size
    //         $pdf->SetFont('Helvetica');
    //         $pdf->SetFontSize(9);
    //         $pdf->SetXY(51,147);
 
    //         $pdf->Write(0, $survey->res_residence_area_size ." " .$survey->res_residence_area_unit);
 
          
    //         // Utliization
    //         $pdf->SetFont('Helvetica');
    //         $pdf->SetFontSize(9);
    //         $pdf->SetXY(154,147);
 
    //         $pdf->Write(0, $survey->res_residence_utilization);
 
    //         if($survey->res_residence_is=="Rented")
    //         {
    //              // Rent DEED
    //              $pdf->SetFont('Helvetica');
    //              $pdf->SetFontSize(9);
    //              $pdf->SetXY(52,151.5);

    //              $pdf->Write(0, $survey->res_rent_deed_verified);
    //         }
    //         else{
    //              // Rent DEED
    //              $pdf->SetFont('Helvetica');
    //              $pdf->SetFontSize(9);
    //              $pdf->SetXY(52,151.5);

 
    //              $pdf->Write(0,'N/A');
    //         }
           
 
 
    //          // Neighboorhood
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(54,168);
 
    //          $pdf->Write(0, $survey->res_neighboorhood_is);
 
    //           // Area Accessiblity
    //           $pdf->SetFont('Helvetica');
    //           $pdf->SetFontSize(9);
    //           $pdf->SetXY(147,168);
 
    //           $pdf->Write(0,  $survey->res_area_access);
        
    //           // Resident Belong to
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(54,172.5);
 
    //          $pdf->Write(0, $survey->res_belongs_to);
 
    //           // Repossesion in the area
    //           $pdf->SetFont('Helvetica');
    //           $pdf->SetFontSize(9);
    //           $pdf->SetXY(158,172.5);
 
    //           $pdf->Write(0,  $survey->res_repossession);
 
 
    //          // Neighbor Name
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,187);
 
    //          $pdf->Write(0, $survey->res_neigh_one_name);
            
            
    //          // Neighbor Address
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,191.5);
 
    //          $pdf->Write(0, $survey->res_neigh_one_address);
 
    //          // Knows Applicant
 
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,195.8);
 
    //          $pdf->Write(0, $survey->res_neigh_one_knows_applicant);
 
    //          if($survey->res_neigh_one_knows_applicant=="Yes")
    //          {
    //                    // Knows How Long
            
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(135,195.9);
 
    //         $pdf->Write(0, $survey->res_neigh_one_knows_applicant_since);
 
    //          }
    //          else{
    //                  // Knows How Long
                             
    //                  $pdf->SetFont('Helvetica');
    //                  $pdf->SetFontSize(9);
    //                  $pdf->SetXY(135,195.9);
 
    //                  $pdf->Write(0, 'N/A');
    //          }           
          
 
    //          // Neighbor Comments
 
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,199.9);
 
    //          $pdf->Write(0,strtoupper($survey->res_neigh_one_comments));
 
    //          // Neighboor Check Two
    //          // Neighboor Check Two
    //          // Neighboor Check Two
 
             
    //          // Neighbor Name
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,210.5);
 
    //          $pdf->Write(0, $survey->res_neigh_two_name);
            
            
    //          // Neighbor Address
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,214.5);
 
    //          $pdf->Write(0, $survey->res_neigh_two_address);
             
 
             
    //          // Knows Applicant
 
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,219.5);
 
    //          $pdf->Write(0, $survey->res_neigh_two_knows_applicant);
            
 
    //          if($survey->res_neigh_two_knows_applicant=="Yes")
    //          {
                 
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(135,219);
 
    //          $pdf->Write(0, $survey->res_neigh_two_knows_applicant_since);
 
    //          }
 
    //          else {
                
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(135,219);

 
    //          $pdf->Write(0, 'N/A');
 
    //          }
    //         //  // Knows How Long
            
    //          // Neighbor Comments
 
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(56,223);
 
    //          $pdf->Write(0, strtoupper($survey->res_neigh_two_comments));
           
           

    //          // GeneraL Comments
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          // $pdf->SetTextColor(255, 0, 0);
    //          $pdf->SetXY(66, 225);
    //          $pdf->MultiCell(0,4.2, $survey->outcome_comments.". ".$survey->outcome_remarks);
        
    //          // Result of Verification
 
    //          $pdf->SetFont('Helvetica');
    //          $pdf->SetFontSize(9);
    //          $pdf->SetXY(66,241.6);
 
    //          $pdf->Write(0, strtoupper($survey->outcome_report_status));
 
 
             // $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('data'));
 
           
             
             // Verficication Images
 
 
        
    }

    public static function getImagesPage($request,$pdf,$survey,$id,$residence)
    {
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
           $pdf->setSourceFile('images/imgsheadermeezan.pdf');

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
            $pdf->SetXY(140, 35);

            if($residence=="Workplace / Business")
            {
                $pdf->Write(0, $survey->job_id.'-W');

            }

            else{
                $pdf->Write(0, $survey->job_id.'-R');

            }

              
            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','B',10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(160, 40);
            $pdf->Write(0, date('F d, Y'));


           
            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','B',10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(85, 46);
            $pdf->Write(0, 'Applicant - '.$residence);
           


          }
    }

    public static function getImagesPageFinal($request,$pdf,$survey,$id,$residence)
    {

        $id=$survey->sid;

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
            $pdf->Write(0, 'SONERI BANK LIMITED');
         
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
            $pdf->Write(0, 'Verification Images - '.$residence);
           
            // Applicant Name Heading
            $pdf->SetFont('Helvetica');
            $pdf->SetFont('Arial','B',10);
            // $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(11, 52);
            $pdf->Write(0, 'Inquiry No.:'.'              '.$survey->inquiry_no);
         
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
 
    public static function storeBulkVerification($request,$cnid,$refid,$type)
    {

        $b = DB::table('c_branch')->where('branch_id',$request->branch_id)->select('*')->get();

        $val = new Verification;

        // $val->request_date=date("Y/m/d");
        $val->region_id = $request->regional_id;
        $val->job_by = $request->job_by;
        $val->given_by = "Bank";
        $val->bank_id = $request->bank_id;
        $val->branch_id = $request->branch_id;
        // $val->product_type = $request->product_type;
        $val->operational_branch = $request->opbranch;
        $val->bank_letter_date = date('Y-m-d');
        $val->bank_letter = 'Email';
        $val->product_type = $type;
        $val->product_sub_type = 'Applicant';
        $val->inquiry_no= $refid;
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

    public static function addSurveysBulkForMezzan($request,$id,$rad,$oad,$amc,$bs,$salaryslip,$no,$other,$lead,$business)
    {
        if($rad!=null)
        {

            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Residence',
                'address'=>$rad,
                'team_lead'=>$lead,
            ]);
            
        }

        if($oad!=null)
        {
            $val = DB::table('verification_surveys')->insert([
                'job_id' => $id,
                'type'=>'Workplace',
                'company_business'=>$business,
                'address'=>$oad,
                'salary_slip'=>$salaryslip==""?0:1,
                'team_lead'=>$lead,

            ]);

        }

      

    

    
    }

    public static function verticalAutoFormatMezzan($request,$myarray,$billid,$type)
    {
        $count = count($myarray[0]);
        $data =collect();
        
        
        foreach($myarray as $item)
        {
          
            for ($i=1; $i < $count ; $i++) { 

                $cnid="";
                $refid= $item[$i][3];
                //  echo $item[$i][0]."<br>";
                $vmzn=new VerificationFHM();
                $vmzn->storeBulkVerification($request,$cnid,$refid,$type);
                 $cjob = Verification::getLatestJob($request);
                 $cid = $cjob->id;
                 Verification::addCommonJob($request, $cid,$billid->id);
                 Verification::updateJobID($request, $cid);
                 $radd= $item[$i][4];
                 $resarea= "";
                 $rescont= "";
                 $offadd= $item[$i][7];
                 $offcont= "";
                 $offarea= "";


                 $amc= '';
                 $bs= '';
                 $salaryslip=$item[$i][10];
                 $no= '';
                 $other='';

                 $teamlead= '';
                 $business=$item[$i][6];
                 $vmzn->addSurveysBulkForMezzan($request, $cid,$radd,$offadd,$amc,$bs,$salaryslip,$no,$other,$teamlead,$business);

                 $appname= $item[$i][1];
                 $appcell= $item[$i][5];
                 $appcnic= $item[$i][2];

                Verification::addDetailsBulkForSoneri($request, $cid,$appname,$appcell,$appcnic,$business);

            
            
            
            }


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
                $ver= new VerificationFHM();
                $ver->applicantWorkplaceReport($request,$pdf,$survey,$id);
                $ver->getImagesPage($request,$pdf,$survey,$id,"Workplace / Business");

    
            }
    
            // elseif($appsubtype=="Co-Applicant")
            // {
            //     $ver= new VerificationFHM();
            //     $ver->applicantcoWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);

                
            // }
            // elseif($appsubtype=="Reference")
            // {
            //     $ver= new VerificationFHM();
            //     $ver->applicantrefWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);
    
            // }
        }

        else{
      

            $ver= new VerificationFHM();
            $ver->applicantWorkplaceReport($request,$pdf,$survey,$id);
            $ver->getImagesPage($request,$pdf,$survey,$id,"Workplace / Business");
    
    
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

        if($apptype=="Home")
        {
            $appsubtype=$survey->product_sub_type;
            if($appsubtype=="Applicant")
            {
                $ver = new VerificationFHM();

              
                    $ver->applicantResidenceReport($request,$pdf,$survey,$id);
                    $ver->getImagesPage($request,$pdf,$survey,$id,"Residence");
            
            }
    
            // elseif($appsubtype=="Co-Applicant")
            // {
            //     $Verification = new VerificationFHM();
            //     $Verification->applicantcoResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
                
            // }
            // elseif($appsubtype=="Reference")
            // {
            //     $Verification = new VerificationFHM();
            //     $Verification->applicantrefResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
    
            // }
        }

        else{

            $Verification = new VerificationFHM();
             $Verification->applicantResidenceReport($request,$pdf,$survey,$id);
             $Verification->getImagesPage($request,$pdf,$survey,$id,"Residence");
                
            

        }
   
   
       
        
         

 
    }

    public static function getworkplaceReportFinal($request,$pdf,$survey,$appinfo)
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
                $ver= new VerificationFHM();

                $emp=$survey->is_employee;
                if($emp==1)
                {
                    $ver->applicantWorkplaceReportforhomeemp($request,$pdf,$survey,$id);

                    $ss=$survey->salary_slip;
                    if($ss==1)
                    {
                    $pdf->AddPage();

                        $ver->salaryslipReport($request,$pdf,$survey,$id);

                    }


                }
                else{
                    $ver->applicantWorkplaceReportforhomebusiness($request,$pdf,$survey,$id);
                    
                }
    
            }
    
            // elseif($appsubtype=="Co-Applicant")
            // {
            //     $ver= new VerificationFHM();
            //     $ver->applicantcoWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);

                
            // }
            // elseif($appsubtype=="Reference")
            // {
            //     $ver= new VerificationFHM();
            //     $ver->applicantrefWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);
    
            // }
        }

        else{
      

            $ver= new VerificationFHM();

            $emp=$survey->is_employee;
            if($emp==1)
            {
                $ver->applicantWorkplaceReportforhomeemp($request,$pdf,$survey,$id);
        

                $ss=$survey->salary_slip;
                if($ss==1)
                {
                $pdf->AddPage();

                    $ver->salaryslipReport($request,$pdf,$survey,$id);

                }

                
            }
            else{
                $ver->applicantWorkplaceReportforhomebusiness($request,$pdf,$survey,$id);
                
            }

        }
       

        // $pdf->setSourceFile("Reports/Verification/$id/residence.pdf");

      

         
         


    }

    public static function getresidenceReportFinal($request,$pdf,$survey,$appinfo)
    {


        $id=$survey->sid;
            
  
   
        // $pdf1 = PDF::loadView('Verification/Reports/residenceimages',compact('data'));
        // $pdf1->save('Reports/Verification/1/images.pdf');
   
   
        // $pdf = new \setasign\Fpdi\Fpdi('P', 'mm', array(210, 297));

        $pdf->AddPage();
        
        $apptype=$survey->product_type;

        if($apptype=="Home")
        {
            $appsubtype=$survey->product_sub_type;
            if($appsubtype=="Applicant")
            {
                $ver = new VerificationFHM();

              
                    $ver->applicantResidenceReport($request,$pdf,$survey,$id);
            
            }
    
            // elseif($appsubtype=="Co-Applicant")
            // {
            //     $Verification = new VerificationFHM();
            //     $Verification->applicantcoResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
                
            // }
            // elseif($appsubtype=="Reference")
            // {
            //     $Verification = new VerificationFHM();
            //     $Verification->applicantrefResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
    
            // }
        }

        else{

            $Verification = new VerificationFHM();
             $Verification->applicantResidenceReport($request,$pdf,$survey,$id);
                
            

        }
   
   
       
        
         

 
    }
}

