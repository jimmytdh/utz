<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Doctor;
use App\EarlyPregnancy;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EarlyPregnancyController extends Controller
{
    public function index($id)
    {
        $data = Patient::find($id);
        $doctors = Doctor::orderBy('fname','asc')
                    ->get();
        return view('sheet.earlyPregnancy', compact('data','doctors'));
    }

//    public function store(Request $req, $id)
//    {
//        $admission = array(
//            'admission_type' => 'early_pregnancy',
//            'date_started' => $req->date." ".$req->date_started,
//            'date_ended' => $req->date." ".$req->date_ended,
//            'patient_id' => $req->patient_id,
//            'room' => $req->room,
//            'ward' => $req->ward,
//            'referring_doctor' => $req->referring_doctor,
//            'scan_indication' => $req->scan_indication,
//            'gp_code' => $req->gp_code,
//            'lmp' => $req->lmp,
//            'pmp' => $req->pmp,
//            'menstrual_age' => $req->menstrual_age,
//            'sheet' => 'early_pregnancy'
//        );
//
//        $adm = Admission::create($admission);
//
//        $earlyPregnancy = array(
//            'admission_id' => $adm->id,
//            'scan_type' => $req->scan_type,
//            'gestational_sac' => $req->gestational_sac,
//            'location' => $req->location,
//            'borders' => $req->borders,
//            'mean_sac' => $req->mean_sac,
//            'yolk_sac' => $req->yolk_sac,
//            'subchrionic' => $req->subchrionic,
//            'fetus' => $req->fetus,
//            'number' => $req->number,
//            'well_formed' => $req->well_formed,
//            'heart_motion' => $req->heart_motion,
//            'body_movement' => $req->body_movement,
//            'crl' => $req->crl,
//            'gestational_age' => $req->gestational_age,
//            'right_ovary' => $req->right_ovary,
//            'left_ovary' => $req->left_ovary,
//            'remarks' => $req->remarks,
//            'ob_doctor' => $req->ob_doctor
//        );
//
//        EarlyPregnancy::create($earlyPregnancy);
//
//        return json_encode([
//            'status' => 'Success'
//        ]);
//    }

    public function store($id)
    {
        $admID = AdmissionController::store($id,'early_pregnancy');

        $earlyPregnancy = array(
            'admission_id' => $admID,
            'scan_type' => '',
            'gestational_sac' => '',
            'location' => '',
            'borders' => '',
            'mean_sac' => '',
            'yolk_sac' => '',
            'subchrionic' => '',
            'fetus' => '',
            'number' => 0,
            'well_formed' => '',
            'heart_motion' => '',
            'body_movement' => '',
            'crl' => '',
            'gestational_age' => '',
            'right_ovary' => '',
            'left_ovary' => '',
            'remarks' => '',
            'ob_doctor' => 0
        );

        EarlyPregnancy::create($earlyPregnancy);

        return array(
            'id' => $admID,
            'type' => 'early_pregnancy'
        );
    }

    public function updateX(Request $req)
    {
        $early = EarlyPregnancy::find($req->pk);
        $early->update([
            $req->name => $req->value
        ]);
    }
}
