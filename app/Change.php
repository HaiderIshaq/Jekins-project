<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Image;

class Change extends Model
{
    public static function compressurvey($jobid){

        $compimages=0;
            // $jobid=$survey->job_id;

            $surveys=DB::table('verification_surveys')
            ->where('status',1)
            ->where('job_id',$jobid)
            ->where('image1','!=','')
            ->select('id','image1','job_id')
            ->get();


            foreach($surveys as $survey)
            {

    
            $images=DB::table('verification_survey_images')
            ->where('survey_id',$survey->id)
            ->select('id','survey_id','path','title')
            ->get();
             
            
            foreach($images as $image)
            {
    
                $destinationPath = public_path('Reports/Verification/'.$jobid.'/Survey/'.$image->survey_id.'/');
                $img = Image::make($image->path);
                $height = Image::make($image->path)->height();
                $width = Image::make($image->path)->width();
                $img->resize($width, $height,function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath.'/'.$image->title);
                $compimages+=1;
                // echo $image->title." Compressed <br>";
            }

        }

    

        echo $compimages;

    }
}
