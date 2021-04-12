<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Doctor;
use App\EarlyPregnancy;
use App\Patient;
use App\Sonographic;
use App\Trimester;
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
        $doctors = Doctor::orderBy('fname','asc')->get();
        $view = null;
        if($admission_type=='early_pregnancy'){
            $early = EarlyPregnancy::where('admission_id',$admission_id)->first();
            return view('form.early',compact('patient','adm','early','doctors'));
            return view('print.earlyPregnancy',compact('patient','adm','early','doctors'));
        }else if($admission_type=='sonographics'){
            $sono = Sonographic::where('admission_id',$admission_id)->first();
            return view('print.sonographicFindings',compact('patient','adm','sono','doctors'));
        }else if($admission_type=='trimester'){
            $tri = Trimester::where('admission_id',$admission_id)->first();
            return view('print.trimester',compact('patient','adm','tri','doctors'));
        }

    }
}
