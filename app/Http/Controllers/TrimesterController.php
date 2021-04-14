<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\Trimester;
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

    public function store($id)
    {
        $admID = AdmissionController::store($id,'trimester');
        $trimester = array(
            'admission_id' => $admID,
            'fetus_no' => '',
            'presentation' => '',
            'heart_activity' => '',
            'gender' => '',
            'biometry' => '',
            'bpd' => '',
            'hc' => '',
            'fl' => '',
            'fac' => '',
            'sefw' => '',
            'others' => '',
            'gestation_age' => '',
            'afi' => '',
            'single_vertical' => '',
            'location' => '',
            'grade' => '',
            'abnormality' => '',
            'cord_vessels' => '',
            'nst' => -1,
            'amniotic' => -1,
            'body_movement' => -1,
            'fetal_tone' => -1,
            'fetal_breathing' => -1,
            'doppler_velocimetry' => '',
            'other_findings' => '',
            'remarks' => '',
            'cerebral' => '',
            'cranium' => '',
            'cranifaceum' => '',
            'spine' => '',
            'heart' => '',
            'stomach' => '',
            'abnormal_wall' => '',
            'insertion' => '',
            'kidneys' => '',
            'bladder' => '',
            'upper_extremities' => '',
            'lower_extremities' => '',
            'atypical_finds' => '',
            'atypical_finds_desc' => '',
            'ob_doctor' => 0,
        );

        Trimester::create($trimester);
        return array(
            'id' => $admID,
            'type' => 'trimester'
        );
    }

    public function updateX(Request $req)
    {
        $tri = Trimester::find($req->pk);
        $tri->update([
            $req->name => $req->value
        ]);
        return $req;
    }
}
