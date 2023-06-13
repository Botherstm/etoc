<?php

namespace App\Http\Controllers;

use App\Models\Lama_uas;
use App\Http\Requests\StoreLama_uasRequest;
use App\Http\Requests\UpdateLama_uasRequest;
use Illuminate\Http\Request;

class LamaUasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('');
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

        Lama_uas::create($validatedData);

        return redirect('/dashboard/uas')->with('success', 'Data waktu ujian Akhir semester berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lama_uas $lama_uas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lama_uas $lama_uas)
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
        Lama_uas::where('id',$id)->update($validateData);
        return redirect('/dashboard/uas')->with('success', 'Waktu ujian Akhir Telah di updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lama_uas $lama_uas)
    {
        //
    }
}
