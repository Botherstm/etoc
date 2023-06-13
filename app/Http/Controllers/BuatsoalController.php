<?php

namespace App\Http\Controllers;

use App\Models\Lama_uts;
use App\Models\LamaUTS;
use App\Models\Uts;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Support\Facades\Storage;

class BuatsoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $active = Uts::first();
        $data = Lama_uts::first();
        return view('dashboard.uts.index',[
            'post'=>Uts::all(),
            'waktu'=>Lama_uts::all(),
            
            // 'post'=>Uts::where('user_id',\auth()->user()->id)->get(),
        ],compact('data','active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.uts.create',[
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
        Uts::create($validateData);


        return redirect('/dashboard/uts')->with('success', 'Soal UTS Telah di Tambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Uts $uts)
    {
        return view('dashboard.uts.show',[
            'post'=> $uts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $uts = Uts::findOrFail($id);
        return view('dashboard.uts.edit', compact('uts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            $validateData['gambar'] = $request->file('gambar')->resize(1, 1)->store('images');
        }

        $validateData = $request->validate($rules);

        $validateData['user_id']=auth()->user()->id;

        $validateData = $request->validate($rules);
        Uts::where('id',$id)->update($validateData);
        
        return redirect('/dashboard/uts')->with('success', 'soal telah di updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uts $uts)
    {
        uts::destroy($uts->id);

        return redirect('/dashboard/uts')->with('danger', 'soal telah dihapus!');
    }
}
