<?php

namespace App\Http\Controllers;

use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        if(request()->ajax()) {
            $patients = Patient::select('id','hospital_no','fname','mname','lname','dob','created_at')->get();
            return datatables()->of($patients)
                ->addColumn('full_name', function($row){
                    $mname = $row->mname[0];
                    return "$row->fname $mname. $row->lname";
                })
                ->addColumn('dob', function($row){
                    return date('M d, Y',strtotime($row->dob));
                })
                ->addColumn('age', function($row){
                    return Carbon::parse($row->dob)->diff(Carbon::now())->format('%y');
                })
                ->addColumn('admission_no', function($row){
                    $btn = "<a class='btn btn-success btn-sm' href='javascript:void(0)' onclick='editFunc($row->id)'>Edit</a>";
                    $btn .= " <a class='btn btn-danger btn-sm' href='javascript:void(0)' onclick='deleteFunc($row->id)'>Delete</a>";

                    $adm_no = date('ym',strtotime($row->created_at))."-".str_pad($row->id,3,0, STR_PAD_LEFT);
                    $dropdown = '
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$adm_no.'</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editFunc('.$row->id.')"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteFunc('.$row->id.')"><i class="fa fa-trash"></i> Delete</a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#formModal" data-toggle="modal" id="btnAdmit" data-id="'.$row->id.'"><i class="fa fa-wheelchair"></i> Admit</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-book"></i> History</a>
                                </div>
                            </div>
                        </div>
                    ';
                    return $adm_no;
                })
                ->addColumn('action', function($row){
                    $url = url('/patient/history/'.$row->id);
                    $btn = "<a class='btn btn-primary btn-sm btn-circle' href='#formModal' data-toggle='modal' id='btnAdmit' data-id='$row->id'><i class='fa fa-wheelchair'></i></a>";
                    $btn = " <a class='btn btn-warning btn-sm btn-circle' href='$url'><i class='fa fa-book'></i></a>";
                    $btn .= " <a class='btn btn-success btn-sm btn-circle' href='javascript:void(0)' onclick='editFunc($row->id)'><i class='fa fa-edit'></i></a>";
                    $btn .= " <a class='btn btn-danger btn-sm btn-circle' href='javascript:void(0)' onclick='deleteFunc($row->id)'><i class='fa fa-trash'></i></a>";

                    return $btn;
                })
                ->rawColumns(['age','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('patients');
    }

    public function store(Request $req)
    {
        $id = $req->id;
        $data = array(
            'hospital_no' => $req->hospital_no,
            'fname' => ucfirst($req->fname),
            'mname' => ucfirst($req->mname),
            'lname' => ucfirst($req->lname),
            'dob' => $req->dob
        );

        Patient::updateOrCreate(['id' => $id],$data);
        return Response()->json($data);
    }

    public function update(Request $req)
    {
        $patient = Patient::where('id',$req->id)->first();
        return Response()->json($patient);
    }

    public function destroy(Request $req)
    {
        $patient = Patient::where('id',$req->id)->delete();
        return Response()->json($patient);
    }

    public function updateX(Request $req)
    {
        Patient::find($req->pk)
            ->update([
                $req->name => $req->value
            ]);

        if($req->name=='dob'){
            $age = ConfigController::age($req->value);
            return $age;
        }

        return 'success';
    }
}
