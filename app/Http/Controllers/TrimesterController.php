<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use Illuminate\Http\Request;

class TrimesterController extends Controller
{
    public function index($id)
    {
        $data = Patient::find($id);
        $doctors = Doctor::orderBy('fname','asc')
            ->get();
        return view('sheet.trimister', compact('data','doctors'));
    }
}
