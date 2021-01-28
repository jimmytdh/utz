<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    static function greetings()
    {
        $time = date('H:i');
        if($time>='00:00' && $time<'12:00'){
            return 'Good Morning';
        }else if($time>='12:01' && $time<'13:00'){
            return 'Good Noon';
        }else if($time>='13:01' && $time<'18:00'){
            return 'Good Afternoon';
        }else if($time>='18:01' && $time<='23:59'){
            return 'Good Evening';
        }
    }

    static function age($date)
    {
        return Carbon::parse($date)->diff(Carbon::now())->format('%y');
    }
}
