<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class EarlyPregnancyController extends Controller
{
    public function index($id)
    {
        $data = Patient::find($id);
        return view('sheet.earlyPregnancy', compact('data'));
    }

    public function store(Request $req)
    {
        return $req;
    }
}
