<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table='c_jobs';

    protected $fillable=[
       'company_id'
    ];
}
