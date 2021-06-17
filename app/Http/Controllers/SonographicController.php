<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Doctor;
use App\Patient;
use App\Sonographic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SonographicController extends Controller
{
    public function index($id)
    {
        $data = Patient::find($id);
        $doctors = Doctor::orderBy('fname','asc')
            ->get();
        return view('sheet.sonographicFindings', compact('data','doctors'));
    }

    public function store($id)
    {
        $admID = AdmissionController::store($id,'sonographics');

        $sonographic = array(
            'admission_id' => $admID,
            'scan' => null,
            'cervix' => 'No lesions',
            'uterine' => 'Anteverted, symmetric, regular, homogenous, non vascular, intact endometrial - myometrial junction',
            'endometrium' => 'Non uniform: heterogenous with few cystic spaces, midline not defined, intact endometrial - myometrial junction, isoechoec intracavitary fluid, no flow on color mapping.',
            'right_ovary' => '',
            'right_follicles' => 'Normal ovarian echopattern with corpus luteum measuring ',
            'left_ovary' => '',
            'left_follicles' => 'Normal ovarian echopattern. No adnexal mass.',
            'findings' => null,
            'remarks' => 'NORMAL SIZED ANTEVERTED UTERUS
ENDOMETRIUM COMPATIBLE WITH SECRETORY PHASE
NORMAL OVARIES WITH CORPUS LUTEUM ON THE RIGHT',
            'ob_doctor' => 0
        );

        Sonographic::create($sonographic);

        return array(
            'id' => $admID,
            'type' => 'sonographics'
        );
    }

    public function updateX(Request $req)
    {
        $sono = Sonographic::find($req->pk);
        $sono->update([
            $req->name => $req->value
        ]);
        return $req;
    }
//    public function store(Request $req)
//    {
//        $admission = array(
//            'admission_type' => $req->admission_type,
//            'date_started' => $req->date." ".$req->date_started,
//            'date_ended' => $req->date." ".$req->date_ended,
//            'patient_id' => $req->patient_id,
//            'room' => $req->room,
//            'ward' => $req->ward,
//            'referring_doctor' => $req->referring_doctor,
//            'scan_indication' => $req->scan_indication,
//            'gp_code' => $req->gp_code,
//            'sheet' => 'sonographics'
//        );
//
//        $adm = Admission::create($admission);
//
//        $sonographic = array(
//            'admission_id' => $adm->id,
//            'scan' => $req->scan,
//            'cervix' => $req->cervix,
//            'uterine' => $req->uterine,
//            'endometrium' => $req->endometrium,
//            'right_ovary' => $req->right_ovary,
//            'right_follicles' => $req->right_follicles,
//            'left_ovary' => $req->left_ovary,
//            'left_follicles' => $req->left_follicles,
//            'findings' => $req->findings,
//            'remarks' => $req->remarks,
//            'ob_doctor' => $req->ob_doctor
//        );
//
//        Sonographic::create($sonographic);
//
//        return json_encode([
//            'status' => 'Success'
//        ]);
//    }
}
