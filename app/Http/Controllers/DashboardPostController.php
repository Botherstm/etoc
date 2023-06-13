<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use PDF;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.post.index',[
            'post'=>Post::orderBy('materi_id', 'asc')->get(),
            'materi'=>Materi::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materi = Materi::all();
        return view('dashboard.post.create',[
            'materi'=>$materi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul'=>'required|max:255',
            'isi'=> 'required',
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
        $validateData['user_id']=auth()->user()->id;
        $validateData['pendek']= Str::limit(strip_tags($request->isi,5));
        Post::create($validateData);
        return redirect('/dashboard/post')->with('success', 'Materi Telah di Tambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show',[
            'post'=> $post,
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.post.edit',[
            'post'=> $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules=[
            'judul'=>'required|max:255',
            'isi'=> 'required',
            'pdf'=>'mimes:doc,docx,pdf',
            'waktu'=>'max:255',
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
                Storage::delete($request->oldgambar);
            }
        }
        if($request->file('video')){
            if($request->oldvideo){
                Storage::delete($request->oldvideo);
            }
            $validateData['video'] = $request->file('video')->store('video');
        }

        $validateData['user_id']=auth()->user()->id;
        $validateData['pendek']= Str::limit(strip_tags($request->isi,5));
        Post::where('id',$post->id)->update($validateData);
        return redirect('/dashboard/post')->with('success', 'Data telah di updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->pdf){
                Storage::delete($post->pdf);
            }
        if($post->video){
                Storage::delete($post->video);
        }if($post->gambar){
                Storage::delete($post->gambar);
        }
            // Cek apakah postingan yang dihapus adalah postingan yang sedang diakses oleh pengguna
            // Perbarui progres pengguna menjadi 0 (tidak ada materi yang diakses)

        Post::destroy($post->id);
            $pertama = Post::first();
            Auth::user()->progress = $pertama->id;
            Auth::user()->save();
        return redirect('/dashboard/post')->with('danger', 'materi telah dihapus!');
    }
}

