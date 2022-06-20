<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function postlogin (Request $request){
        // dd($request->all());
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/_ikp');
        }
        return redirect('/login');
    }

    public function index()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
