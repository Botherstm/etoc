<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utsjawab;
use Illuminate\Http\Request;

class AccController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.mahasiswa.index',[
            'post'=>User::orderByRaw("is_admin DESC")->get(),
        ]);
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
    public function update(Request $request, User $user, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->acc = $request->acc;
        $user->is_admin = $request->is_admin;

        $user->save();
        return redirect()->back()->with('success', 'Status Akun Telah Diperbaharui');
    }

    public function updateadmin(Request $request, User $user, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->is_admin = $request->is_admin;

        $user->save();
        return redirect()->back()->with('success', 'Status Akun Telah Diperbaharui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect()->back()->with('success', 'Data Telah dihapus');
    }

    public function deleteAllExceptAdmin()
    {
        // Hapus semua pengguna selain admin
        User::where('is_admin','is_super', false)->delete();
        Utsjawab::all()->delete();
        return redirect()->back()->with('success', 'Semua pengguna telah dihapus kecuali admin dan Super Admin.');
    }
}
