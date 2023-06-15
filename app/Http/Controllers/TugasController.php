<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Tugas;
use App\Http\Requests\StoreTugasRequest;
use App\Http\Requests\UpdateTugasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('dashboard.tugas.create',[
            'materi'=>Materi::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'soal'=>'required|max:255',
            'materi_id'=> 'required',
            'pdf'=>'mimes:doc,docx,pdf',
            'video'=>'mimes:mp4,ogx,oga,ogv,webm,ogg,mkv',
            'gambar'=>'image|file|max:6024',
        ]);
        if($request->file('pdf')){
            $validateData['pdf'] = $request->file('pdf')->store('pdf');
        }
        if($request->file('gambar')){
            $validateData['gambar'] = $request->file('gambar')->store('gambar');
        }
        if($request->file('video')){
            $validateData['video'] = $request->file('video')->store('video');
        }
        Tugas::create($validateData);
        return redirect('/dashboard/tugas')->with('success', 'Tugas berhasil ditambahkan.');
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
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('dashboard.tugas.edit',[
            'materi'=>Materi::all(),
            'tugas'=>$tugas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tugas $tugas)
    {
        $rules=[
            'soal'=>'required|max:255',
            'materi_id'=> 'required',
            'pdf'=>'mimes:doc,docx,pdf',
            'video'=>'mimes:mp4,ogx,oga,ogv,webm,ogg,mkv',
            'gambar'=>'image|file|max:6024',
        ];
        $validateData = $request->validate($rules);
        if($request->file('pdf')){
            if($request->oldPdf){
                Storage::delete($request->oldPdf);
            }
            $validateData['pdf'] = $request->file('pdf')->store('pdf');
        }
        if($request->file('gambar')){
            $validateData['gambar'] = $request->file('gambar')->store('gambar');
            if($request->oldgambar){
                Storage::delete($request->oldGambar);
            }
        }
        if($request->file('video')){
            if($request->oldvideo){
                Storage::delete($request->oldVideo);
            }
            $validateData['video'] = $request->file('video')->store('video');
        }

        Tugas::where('id',$tugas->id)->update($validateData);
        return redirect('/dashboard/tugas')->with('success', 'Tugas berhasil diperbarui.');
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
        $tugas->gambar_active = !$tugas->gambar_active;
        $tugas->save();

        return response()->json([
            'message' => 'Gambar berhasil diubah.',
        ]);
    }

    public function toggleVideo(Request $request, Tugas $tugas)
    {
        $tugas->video_active = !$tugas->video_active;
        $tugas->save();

        return response()->json([
            'message' => 'Video berhasil diubah.',
        ]);
    }

    public function togglePDF(Request $request, Tugas $tugas)
    {
        $tugas->pdf_active = !$tugas->pdf_active;
        $tugas->save();

        return response()->json([
            'message' => 'PDF berhasil diubah.',
        ]);
    }
    public function toggleText(Tugas $tugas)
    {
        $tugas->text_active = !$tugas->text_active;
        $tugas->save();

        return response()->json([
            'message' => 'Teks berhasil diubah.',
        ]);
    }
}
