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
            'heart_motion_desc' => '',
            'body_movement' => '',
            'crl' => '',
            'gestational_age' => '',
            'right_ovary' => '2.59 x 2.40 x 1.25 cm (Vol: 4.06 cc), Lateral; Normal ovarian echopattern',
            'left_ovary' => '2.97 x 2.35 x 1.52 cm (Vol: 5.56 cc), Lateral; Normal ovarian echopattern with corpus lutuem measuring 0.99 x 1.50 x 2.01 cm (Vol: 1.56 cc).
Cervical length is long and closed measuring 3.35 cm.
Uterus is Anteverted, no masses.',
            'remarks' => 'SINGLE LIVE INTRAUTERINE PREGNANCY COMPATIBLE TO 9 WEEKS 3 DAYS AGE OF GESTATION BY CROWN RUMP LENGTH WITH GOOD CARDIAC ACTIVIY
NO SUBCHORIONIC HEMORRAGE
NORMAL OVARIES WITH CORPLUS LUTEUM ON THE LEFT',
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
