<?php

namespace App\Http\Controllers;

use App\Models\Tugasjawab;
use App\Http\Requests\StoreTugasjawabRequest;
use App\Http\Requests\UpdateTugasjawabRequest;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasjawabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.tugasjawab.index',[
            'materi'=>Materi::all(),
            'tugas'=>Tugasjawab::orderBy('materi_id', 'asc')->get(),
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
        $validateData = $request->validate([
            'text' => '',
            'materi_id'=>'required',
            'pdf' => 'mimes:pdf',
            'gambar'=>'image|file|max:10024',
            'video' => 'mimetypes:video/mp4,video/mpeg,video/quicktime',
        ]);



        $user = Auth::user();
        $postingan = Materi::find($validateData['materi_id']);
        $user->progress = $postingan->id + 1;
        $user->save();
        $validateData['user_id']=auth()->user()->id;
        // Simpan file PDF
        if($request->file('pdf')){
            $validateData['pdf'] = $request->file('pdf')->store('pdf');
        }
        //simpan gambar
        if($request->file('gambar')){
            $validateData['gambar'] = $request->file('gambar')->store('gambar');
        }
        // Simpan video
        if($request->file('video')){
            $validateData['video'] = $request->file('video')->store('video');
        }
        Tugasjawab::create($validateData);
        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tugasjawab $tugasjawab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugasjawab $tugasjawab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTugasjawabRequest $request, Tugasjawab $tugasjawab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugasjawab $tugasjawab)
    {
        if($tugasjawab->pdf){
                Storage::delete($tugasjawab->pdf);
            }
        if($tugasjawab->video){
                Storage::delete($tugasjawab->video);
        }if($tugasjawab->gambar){
                Storage::delete($tugasjawab->gambar);
        }
            // Cek apakah postingan yang dihapus adalah postingan yang sedang diakses oleh pengguna
            // Perbarui progres pengguna menjadi 0 (tidak ada materi yang diakses)

        Tugasjawab::destroy($tugasjawab->id);
        return redirect('/dashboard/tugasjawab')->with('danger', 'Jawaban telah dihapus!');
    }
}