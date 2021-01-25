<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('schedule');
    }
}
