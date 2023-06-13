<?php

namespace App\Http\Controllers;

use App\Models\Lama_uts;
use Illuminate\Http\Request;

class LamaUjianTengahSemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lama_ujian_tengah_semester.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'end_time' => 'required|date',
            'jam' => 'required',
            'menit' => 'required',
        ]);

        Lama_uts::create($validatedData);

        return redirect('/dashboard/uts')->with('success', 'Data waktu ujian tengah semester berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules=[
            'end_time' => 'required|date',
            'jam' => 'required',
            'menit' => 'required',
        ];
        $validateData = $request->validate($rules);
        Lama_uts::where('id',$id)->update($validateData);
        return redirect('/dashboard/uts')->with('success', 'Waktu ujian Telah di updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
