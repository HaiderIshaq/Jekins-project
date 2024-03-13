<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table='c_districts';

    protected $hidden = [
        'created_at',
         'updated_at',
         'created_by',
         'updated_by'
    ];
}
