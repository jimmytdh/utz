<?php

namespace App\Http\Controllers;

use App\Admission;
use App\EarlyPregnancy;
use App\Sonographic;
use App\Trimester;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    static function store($id,$sheet)
    {
        $admission = array(
            'admission_type' => 'early_pregnancy',
            'date_started' => Carbon::now(),
            'date_ended' => Carbon::now(),
            'patient_id' => $id,
            'room' => '',
            'ward' => '',
            'referring_doctor' => '',
            'scan_indication' => '',
            'gp_code' => '0-0-0-0',
            'lmp' => '',
            'pmp' => '',
            'edc' => '',
            'menstrual_age' => '',
            'sheet' => $sheet
        );
        $adm = Admission::create($admission);
        return $adm->id;
    }
    public function updateX(Request $req)
    {
        $adm = Admission::find($req->pk);

        if($req->name=='date_started' || $req->name=='date_ended'){
            $date = Carbon::parse($adm->date_started)->format('Y-m-d');
            $date_started = Carbon::parse($date ." ".$req->value)->format('Y-m-d H:i:s');
            $adm->update([
                $req->name => $date_started
            ]);
        }

        else if($req->name=='date'){
            $time_start = Carbon::parse($adm->date_started)->format('H:i:s');
            $time_end = Carbon::parse($adm->date_ended)->format('H:i:s');

            $adm->update([
                'date_started' => $req->value." ".$time_start,
                'date_ended' => $req->value." ".$time_end,
            ]);
        }

        else if($req->name=='gp_code'){
            $g = substr($req->value,0,1);
            $p = substr($req->value,-1);
            $adm->update([
                'gp_code' => $req->value
            ]);

            return array(
                'g' => $g,
                'p' => $p
            );
        }

        else {
            $adm->update([
                $req->name => $req->value
            ]);
        }
    }

    public function destroy(Request $req)
    {
        Admission::find($req->admID)->delete();
        EarlyPregnancy::where('admission_id',$req->admID)->delete();
        Sonographic::where('admission_id',$req->admID)->delete();
        Trimester::where('admission_id',$req->admID)->delete();
    }
}
