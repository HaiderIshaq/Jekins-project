<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table='c_employees';

    protected $hidden = [
        'appointed',
        'father_name',
        'dob',
        'dob',
        'nationality',
        'nic',
        'experience',
        'company',
        'service',
        'designation',
        'religion',
        'language',
        'qualification',
        'marital_status',
        'address',
        'contact',
        'reference1',
        'nic1',
        'reference2',
        'nic2',
        'fired',
        'salary',
        'PAllowance',
        'CAllowance',
        'created_by',
        'updated_by'
    ];
}
