<?php

namespace App\Http\Controllers;

use App\User;
use App\UserPriv;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $id = Auth::id();
            $users = User::select('*')->where('id','<>',$id)->get();
            return datatables()->of($users)
                ->addColumn('level', function($row){
                    $check = UserPriv::where('user_id',$row->id)->where('syscode','utz')->first();
                    $class = "text-danger";
                    $level = 'Denied';
                    if($check){
                        $class = 'text-success font-weight-bold';
                        $level = ucfirst($check->level);
                    }
                    return "<a href='#' class='edit $class' data-pk='$row->id' data-type='select' data-name='status' data-title='Select Access'>$level</a>";
                })
                ->rawColumns(['level'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('settings.users');
    }

    public function udpate(Request $req)
    {
        $id = $req->pk;
        if($req->value=='denied'){
            UserPriv::where('user_id',$id)
                ->where('syscode','utz')
                ->delete();
            return 0;
        }

        $data = array(
            'user_id' => $id,
            'syscode' => 'utz'
        );
        UserPriv::updateOrCreate($data,[
            'level' => $req->value
        ]);
        return 0;
    }
}
