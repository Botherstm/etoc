<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register',[
            'title'=>'register',
            'active'=>'register',
            "image" => "prodi.png"
        ]);
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'name'=> 'required|max:255',
            'email'=>'required|email:dns|unique:users',
            'username'=>'required','max:255',
            'password'=>'required|min:5|max:255',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['progres']=1;
        User::create($validateData);

        return \redirect('/login')->with('success', 'Registration succsessful,! Please login');
    }
}
