<?php

namespace App\Http\Controllers;

use App\Models\Lama_uas;
use App\Models\Uas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuatsoaluasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active = Uas::first();
        $data = Lama_uas::first();
        return view('dashboard.uas.index',[
            'post'=>Uas::all(),
            'waktu'=>Lama_uas::all(),
            
            // 'post'=>Uts::where('user_id',\auth()->user()->id)->get(),
        ],compact('data','active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.uas.create',[
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'soal'=>'required|max:255',
            'kunci'=>'required|max:255',
            'a'=>'required|max:255',
            'b'=>'required|max:255',
            'c'=>'required|max:255',
            'd'=>'required|max:255',
            'waktu'=>'max:255',
            'gambar'=>'image|file|max:6024',
            'video'=>'mimes:mp4,ogx,oga,ogv,webm,ogg,mkv',
            
        ]);
        $validateData['user_id']=auth()->user()->id;
        if($request->file('gambar')){
            $validateData['gambar'] = $request->file('gambar')->store('images');
        }
        if($request->file('video')){
            $validateData['video'] = $request->file('video')->store('video');
        }
        Uas::create($validateData);
        return redirect('/dashboard/uas')->with('success', 'Soal Uas Telah di Tambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(uas $uas)
    {
        return view('dashboard.uas.show',[
            'post'=> $uas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Uas $uas)
    {
        $uas = Uas::findOrFail($id);
        return view('dashboard.uas.edit',[
            'uas'=> $uas,
        ], compact('uas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $rules=[
            'soal'=>'required|max:255',
            'a'=>'required|max:255',
            'b'=>'required|max:255',
            'c'=>'required|max:255',
            'd'=>'required|max:255',
            'kunci'=>'required|max:255',
            'gambar'=>'mimes:mp4,ogx,oga,ogv,webm,ogg,mkv',
        ];
        
        if($request->file('gambar')){
            if($request->oldPdf){
                Storage::delete($request->oldgambar);
            }
            $validateData['gambar'] = $request->file('gambar')->store('images');
        }

        $validateData = $request->validate($rules);

        $validateData['user_id']=auth()->user()->id;

        $validateData = $request->validate($rules);
        Uas::where('id',$id)->update($validateData);
        
        return redirect('/dashboard/uas')->with('success', 'soal Uas telah di updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(uas $uas)
    {
        //
    }
}
