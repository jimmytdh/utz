<?php

namespace App\Http\Controllers;

use App\Admission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
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
        return $req;
    }
}
