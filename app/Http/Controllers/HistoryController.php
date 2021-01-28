<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Patient;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($id)
    {
        $patient = Patient::find($id);
        $admission = Admission::where('patient_id',$id)->get();
        return view('history',compact('patient','admission'));
    }
}
