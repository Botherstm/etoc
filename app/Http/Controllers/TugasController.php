<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Tugas;
use App\Http\Requests\StoreTugasRequest;
use App\Http\Requests\UpdateTugasRequest;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.tugas.index',[
            'materi'=>Materi::all(),
            'tugas'=>Tugas::orderBy('materi_id', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'soal' => 'required|max:255',
            'materi_id' => 'required',
        ]);

        Tugas::create($request->all());

        return back()->with('success', 'Tugas berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Tugas $tugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas $tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tugas $tugas)
    {
         $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);
        $tugas->update($request->all());
        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        $tugas->delete();

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }

    public function toggleGambar(Request $request, Tugas $tugas)
    {
        $tugas->gambar = !$tugas->gambar;
        $tugas->save();

        return response()->json([
            'message' => 'Gambar berhasil diubah.',
        ]);
    }

    public function toggleVideo(Request $request, Tugas $tugas)
    {
        $tugas->video = !$tugas->video;
        $tugas->save();

        return response()->json([
            'message' => 'Video berhasil diubah.',
        ]);
    }

    public function togglePDF(Request $request, Tugas $tugas)
    {
        $tugas->pdf = !$tugas->pdf;
        $tugas->save();

        return response()->json([
            'message' => 'PDF berhasil diubah.',
        ]);
    }
    public function toggleText(Tugas $tugas)
    {
        $tugas->text = !$tugas->text;
        $tugas->save();

        return response()->json([
            'message' => 'Teks berhasil diubah.',
        ]);
    }
}
