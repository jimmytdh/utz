<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trimester extends Model
{
    protected $fillable = [
        'admission_id',
        'fetus_no',
        'presentation',
        'heart_activity',
        'gender',
        'biometry',
        'bpd',
        'hc',
        'fl',
        'fac',
        'sefw',
        'others',
        'gestation_age',
        'afi',
        'single_vertical',
        'location',
        'grade',
        'abnormality',
        'cord_vessels',
        'nst',
        'amniotic',
        'body_movement',
        'fetal_tone',
        'fetal_breathing',
        'doppler_velocimetry',
        'other_findings',
        'remarks',
        'cerebral',
        'cranium',
        'face',
        'spine',
        'heart',
        'stomach',
        'abnormal_wall',
        'insertion',
        'kidneys',
        'bladder',
        'upper_extremities',
        'lower_extremities',
        'atypical_finds',
        'atypical_finds_desc',
        'ob_doctor',
    ];
}
