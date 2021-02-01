<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sonographic extends Model
{
    protected $fillable = [
        'admission_id',
        'scan',
        'cervix',
        'uterine',
        'endometrium',
        'right_ovary',
        'right_follicles',
        'left_ovary',
        'left_follicles',
        'findings',
        'remarks',
        'ob_doctor'
    ];
}
