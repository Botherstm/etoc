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
    public function update(Request $request, Tugasjawab $tugasjawab)
    {
        $rules=[
            'text'=> 'required',
            'pdf'=>'mimes:doc,docx,pdf',
            'video'=>'mimes:mp4,ogx,oga,ogv,webm,ogg,mkv',
            'gambar'=>'image|file|max:10024',
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
            if($request->oldGambar){
                Storage::delete($request->oldGambar);
            }
        }
        if($request->file('video')){
            if($request->oldVideo){
                Storage::delete($request->oldVideo);
            }
            $validateData['video'] = $request->file('video')->store('video');
        }

        Tugasjawab::where('id',$tugasjawab->id)->update($validateData);

        return redirect()->back()->with('success', 'Jawaban updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tugas = Tugasjawab::findOrFail($id);
        if($tugas->pdf){
            Storage::delete($tugas->pdf);
        }
        if($tugas->video){
                Storage::delete($tugas->video);
        }if($tugas->gambar){
                Storage::delete($tugas->gambar);
        }
        $tugas->delete();
        return redirect('/dashboard/tugasjawab')->with('danger', 'Jawaban telah dihapus!');
    }
}
