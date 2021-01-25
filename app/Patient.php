<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = [
        'hospital_no',
        'fname',
        'mname',
        'lname',
        'dob'
    ];
}
