<?php

namespace App\Http\Controllers;

use App\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $doctors = Doctor::select('*')->get();
            return datatables()->of($doctors)
                ->addColumn('fname', function($row){
                    $r = "<span class='edit' data-name='fname' data-pk='$row->id' data-title='First Name'>$row->fname</span>";
                    return $r;
                })
                ->addColumn('mname', function($row){
                    $r = "<span class='edit' data-name='mname' data-pk='$row->id' data-title='Middle Name'>$row->mname</span>";
                    return $r;
                })
                ->addColumn('lname', function($row){
                    $r = "<span class='edit' data-name='lname' data-pk='$row->id' data-title='Last Name'>$row->lname</span>";
                    return $r;
                })
                ->addColumn('created_at', function($row){
                    $action = Carbon::parse($row->created_at)->format('m/d/Y h:i a');
                    $action .= "<a href='javascript:void(0)' data-id='$row->id' class='btn btn-danger btn-cirlce btn-sm pull-right btn-delete'><i class='fa fa-trash'></i></a>";
                    return $action;
                })
                ->rawColumns(['fname','mname','lname','created_at'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('settings.doctors');
    }

    public function store(Request $req)
    {
        $data = array(
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
        );
        Doctor::create($data);
    }

    public function update(Request $req)
    {
        $doc = Doctor::find($req->pk);
        $doc->update([
            $req->name => $req->value
        ]);
    }

    public function destroy(Request $req)
    {
        Doctor::find($req->id)->delete();
        return $req;
    }
}
