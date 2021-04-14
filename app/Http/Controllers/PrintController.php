<?php

namespace App\Http\Controllers;

use App\Admission;
use App\EarlyPregnancy;
use App\Patient;
use App\Sonographic;
use App\Trimester;
use Illuminate\Http\Request;
use PDF;

class PrintController extends Controller
{
    public function earlyPregnancy($admission_id){
        $adm = Admission::find($admission_id);
        $patient = Patient::find($adm->patient_id);
        $early = EarlyPregnancy::where('admission_id',$admission_id)->first();
        //return view('print.early',compact('adm','patient','early'));

        $pdf = PDF::loadView('print.early',compact('adm','patient','early'));
        $filename = "$patient->lname, $patient->fname";
        return $pdf->setPaper('a4','portrait')
            ->stream($filename.'.pdf');
    }

    public function sonographic($admission_id){
        $adm = Admission::find($admission_id);
        $patient = Patient::find($adm->patient_id);
        $sono = Sonographic::where('admission_id',$admission_id)->first();
        //return view('print.sonographic',compact('adm','patient','sono'));

        $pdf = PDF::loadView('print.sonographic',compact('adm','patient','sono'));
        $filename = "$patient->lname, $patient->fname";
        return $pdf->setPaper('a4','portrait')
            ->stream($filename.'.pdf');
    }

    public function trimester($admission_id){
        $adm = Admission::find($admission_id);
        $patient = Patient::find($adm->patient_id);
        $tri = Trimester::where('admission_id',$admission_id)->first();
        //return view('print.trimester',compact('adm','patient','tri'));

        $pdf = PDF::loadView('print.trimester',compact('adm','patient','tri'));
        $filename = "$patient->lname, $patient->fname";
        return $pdf->setPaper('a4','portrait')
            ->stream($filename.'.pdf');
    }
}
