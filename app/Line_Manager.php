<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Log;
use App\Job;



class Line_Manager extends Model
{
    protected $table = 'line_manager';
   
    public static function storeLineManager($request)
    {
        $val = new Line_Manager;

        $val->line_manager_name = $request->line_manager_name;
        $val->line_manager_number = $request->line_manager_number;
        $val->created_by = $request->user()->id;
        $val->updated_by = $request->user()->id;

        $val->save();

    }
}

?>