<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Log;
use PDF;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class VerificationSoneri extends Model
{
  
    public static function applicantWorkplaceReportforhome($request,$pdf,$survey,$id)
    {
        $pdf->setSourceFile("src/reportformat/soneri/workplaceperfoma.pdf");

        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0);

        // Applicant Name Heading
        $pdf->SetFont('Helvetica');
        $pdf->SetFont('Arial','B',10);
        // $pdf->SetTextColor(255, 0, 0);
        $pdf->SetXY(42, 33);
        $pdf->Write(0, $survey->applicant_name);
      
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(42, 43);
         $pdf->Write(0, $survey->ref_Id);
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(42, 47.5);
         $pdf->Write(0,$survey->product_type);
        
          //BankName
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',10);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(156, 34.5);
          $pdf->Write(0, "SONERI BANK LIMITED");

         //Jobid
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(144, 44.5);
         $pdf->Write(0, $survey->job_id."-W");
    
         //Team Lead
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',9);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(144, 48.5);
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
              $pdf->Write(0, 'SONERI BANK LIMITED');
           
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
    public static function applicantResidenceReportforhome($request,$pdf,$survey,$id)
    {
       

        $pdf->setSourceFile("src/reportformat/soneri/residenceperfoma.pdf");

         // $pdf->setSourceFile("Reports/Verification/$id/residence.pdf");

         $tplIdx = $pdf->importPage(1);
         $pdf->useTemplate($tplIdx, 0, 0);
 
         // Applicant Name Heading
         $pdf->SetFont('Helvetica');
         $pdf->SetFont('Arial','B',10);
         // $pdf->SetTextColor(255, 0, 0);
         $pdf->SetXY(47, 33);
         $pdf->Write(0, $survey->applicant_name);
   
 
          //Applicant Name
       

          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(47, 44);
          $pdf->Write(0, $survey->ref_Id);
     
          //Applicant Cell
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(47, 48);
          $pdf->Write(0, $survey->product_type);
         
          //BankName
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',10);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(156, 34.5);
          $pdf->Write(0, "SONERI BANK LIMITED");

           //Jobid
           $pdf->SetFont('Helvetica');
           $pdf->SetFont('Arial','B',9);
           // $pdf->SetTextColor(255, 0, 0);
           $pdf->SetXY(144, 44);
           $pdf->Write(0, $survey->job_id."-R");
     
          //Team Lead
          $pdf->SetFont('Helvetica');
          $pdf->SetFont('Arial','B',9);
          // $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(144, 48);
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
        $pdf->setSourceFile("src/reportformat/soneri/workplacecoperfoma.pdf");
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
         $pdf->Write(0, $survey->ref_Id);
    
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


        $pdf->setSourceFile("src/reportformat/soneri/residencecoperfoma.pdf");

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
          $pdf->Write(0, $survey->ref_Id);
     
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
        

        $pdf->setSourceFile("src/reportformat/soneri/workplacereferenceproforma.pdf");


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
         $pdf->Write(0, $survey->ref_Id);
    
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
              $pdf->Write(0, 'SONERI BANK LIMITED');
           
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
        

        $pdf->setSourceFile("src/reportformat/soneri/residencereferenceproforma.pdf");


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
          $pdf->Write(0,$survey->ref_Id);
     
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
                $ver= new VerificationSoneri();
                $ver->applicantWorkplaceReportforhome($request,$pdf,$survey,$id);
    
            }
    
            elseif($appsubtype=="Co-Applicant")
            {
                $ver= new VerificationSoneri();
                $ver->applicantcoWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);

                
            }
            elseif($appsubtype=="Reference")
            {
                $ver= new VerificationSoneri();
                $ver->applicantrefWorkplaceReportforhome($request,$pdf,$survey,$id,$appinfo);
    
            }
        }

        else{
      

            $ver= new VerificationSoneri();
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

        if($apptype=="Home")
        {
            $appsubtype=$survey->product_sub_type;
            if($appsubtype=="Applicant")
            {

                $Verification = new VerificationSoneri();
                $Verification->applicantResidenceReportforhome($request,$pdf,$survey,$id);
    
            }
    
            elseif($appsubtype=="Co-Applicant")
            {
                $Verification = new VerificationSoneri();
                $Verification->applicantcoResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
                
            }
            elseif($appsubtype=="Reference")
            {
                $Verification = new VerificationSoneri();
                $Verification->applicantrefResidenceReportforhome($request,$pdf,$survey,$id,$appinfo);
    
            }
        }

        else{

            $Verification = new VerificationSoneri();
            $Verification->applicantResidenceReportforhome($request,$pdf,$survey,$id);

        }
   
   
       
        
         

 
    }
}

