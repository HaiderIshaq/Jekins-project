<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valuation_Consultant extends Model
{
    protected $table='valuation_consultants';

    // protected $fillable = [
    //     'id', 
    //     'description'
    // ];

    protected $hidden = [
        'created_at',
         'updated_at',
         'created_by',
         'updated_by'
    ];
}
