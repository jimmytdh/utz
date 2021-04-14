<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = [
        'admission_type',
        'date_started',
        'date_ended',
        'patient_id',
        'room',
        'ward',
        'referring_doctor',
        'scan_indication',
        'gp_code',
        'lmp',
        'pmp',
        'edc',
        'menstrual_age',
        'sheet',
    ];
}
