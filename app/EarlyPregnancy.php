<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarlyPregnancy extends Model
{
    protected $fillable = [
        'admission_id',
        'scan_type',
        'gestational_sac',
        'location',
        'borders',
        'mean_sac',
        'yolk_sac',
        'subchrionic',
        'fetus',
        'number',
        'well_formed',
        'heart_motion',
        'heart_motion_desc',
        'body_movement',
        'crl',
        'gestational_age',
        'other_findings',
        'right_ovary',
        'left_ovary',
        'remarks',
        'ob_doctor',
    ];
}
