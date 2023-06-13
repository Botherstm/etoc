<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Http\Requests\UpdateMateriRequest;
use Illuminate\Http\Request;


class MateriController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validateData = $request->validate([
        //     'title'=>'required|max:255',
        // ]);
        // Materi::create($validateData);
        // return redirect('/dashboard/post')->with('success', 'Materi Telah di Tambahkan !');
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            // Tambahkan validasi untuk field lainnya di sini
        ]);

        // Buat objek Materi baru dengan data yang diterima dari form
        $materi = new Materi;
        $materi->title = $validatedData['title'];
        // Setel field lainnya sesuai kebutuhan

        // Simpan objek Materi ke database
        $materi->save();

        // Redirect ke halaman yang tepat atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Materi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            // Tambahkan validasi untuk field lainnya di sini
        ]);

        // Cari data Materi berdasarkan ID
        $materi = Materi::findOrFail($id);

        // Update data Materi dengan data baru
        $materi->title = $validatedData['title'];
        // Setel field lainnya sesuai kebutuhan

        $materi->save();

        // Redirect ke halaman yang tepat atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data materi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        //
    }
}
