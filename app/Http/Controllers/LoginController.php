<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class LoginController extends Controller
{
    public function index(){
        return view('login.index',[
            'title' => 'login',
            'active'=>'login',
        ]);
    }
    public function authenticate(Request $request){
        $credentials =  $request->validate([
            'email'=>'required|email:dns',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('loginError','Login failed!');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
