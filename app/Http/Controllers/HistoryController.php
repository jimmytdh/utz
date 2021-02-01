<?php

namespace App\Http\Controllers;

use App\Admission;
use App\EarlyPregnancy;
use App\Patient;
use App\Sonographic;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($id)
    {
        $patient = Patient::find($id);
        $admission = Admission::where('patient_id',$id)
                ->orderBy('date_started','desc')
                ->get();
        return view('history',compact('patient','admission'));
    }

    public function show($id,$admission_id,$admission_type)
    {
        $patient = Patient::find($id);
        $adm = Admission::find($admission_id);
        $view = null;
        if($admission_type=='early_pregnancy'){
            $early = EarlyPregnancy::where('admission_id',$admission_id)->first();
            return view('print.earlyPregnancy',compact('patient','adm','early'));
        }else if($admission_type=='sonographics'){
            $sono = Sonographic::where('admission_id',$admission_id)->first();
            return view('print.sonographicFindings',compact('patient','adm','sono'));
        }


    }
}
