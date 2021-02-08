<?php

namespace App\Http\Controllers;

use App\UserPriv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function validateLogin(Request $req)
    {
        $remember = true;
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password], $remember)) {
            $id = Auth::id();
            $user = Auth::user();
            $check = UserPriv::where("user_id",$id)
                ->where("syscode","utz")
                ->first();
            if($check){
                Session::put('level',$check->level);
                return redirect()->intended('/');
            }
            return redirect()->back()->with('error', 'failed');
        }
        return redirect()->back()->with('error', 'failed');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/login');
    }
}
