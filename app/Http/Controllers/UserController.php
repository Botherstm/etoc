<?php

namespace App\Http\Controllers;

use App\Models\Start_uts;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function removeUtsCompleteAt($id)
    {
        $user = User::find($id);
        $utsStart = Start_uts::where('user_id', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        if ($utsStart) {
        $utsStart->delete();
        }
        $user->uts_completed_at = null;
        $user->save();
        return redirect()->back()->with('success', 'UTS Complete At field has been removed successfully.');
    }

    public function removeField($id)
    {   
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->uts_complete_at = null;
        $user->save();
        return redirect()->back()->with('success', 'Field value has been removed successfully.');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules=[
            'gambar'=>'image|file|max:10024',
            'name'=>'required|max:255',
            'username'=>'max:255',
        ];
         $validateData = $request->validate($rules);

        if($request->file('gambar')){
            $validateData['gambar'] = $request->file('gambar')->store('gambar');
        }
        $user->save($validateData);
       
        return redirect('/profile')->with('success', 'Data telah di updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/dashboard/mahasiswa')->with('success', 'Akun telah di Hapus!');
    }
}
