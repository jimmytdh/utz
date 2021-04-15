<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Doctor;
use App\EarlyPregnancy;
use App\Patient;
use App\Sonographic;
use App\Trimester;
use Carbon\Carbon;
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
            return view('form.sonographic',compact('patient','adm','sono','doctors'));
            return view('print.sonographicFindings',compact('patient','adm','sono','doctors'));
        }else if($admission_type=='trimester'){
            $tri = Trimester::where('admission_id',$admission_id)->first();
            return view('form.trimester',compact('patient','adm','tri','doctors'));
            return view('print.trimester',compact('patient','adm','tri','doctors'));
        }

    }

    public function update($id,$admission_id,$admission_type)
    {
        $row = $_POST;
        $row['date_started'] = Carbon::parse($row['date']." ".$row['date_started'])->format('Y-m-d H:i:s');
        $row['date_ended'] = Carbon::parse($row['date']." ".$row['date_ended'])->format('Y-m-d H:i:s');
        //$row['left_ovary'] = preg_replace( "/\r\n/", "<br />", $row['left_ovary'] );
        //dd($row);
        Admission::find($admission_id)->update($row);

        if($admission_type=='early_pregnancy'){
           EarlyPregnancy::where('admission_id',$admission_id)->first()->update($row);
        }else if($admission_type=='sonographics'){
            Sonographic::where('admission_id',$admission_id)->first()->update($row);
        }else if($admission_type=='trimester'){
            $row['cerebral'] = 'N';
            $row['cranium'] = 'N';
            $row['face'] = 'N';
            $row['spine'] = 'N';
            $row['heart'] = 'N';
            $row['stomach'] = 'N';
            $row['abnormal_wall'] = 'N';
            $row['insertion'] = 'N';
            $row['kidneys'] = 'N';
            $row['bladder'] = 'N';
            $row['upper_extremities'] = 'N';
            $row['lower_extremities'] = 'N';
            $row['atypical_finds'] = 'N';

            if(isset($row['fatal_anatomic'])){
                foreach($row['fatal_anatomic'] as $key){
                    $row[$key] = 'Y';
                }
            }

            Trimester::where('admission_id',$admission_id)->first()->update($row);
        }

        return redirect()->back()->with('success',true);
    }
}
