<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Post;
use App\Models\Tugas;
use App\Models\Tugasjawab;
use App\Models\Uas;
use App\Models\User;
use App\Models\Uts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{ 

    public function index($materi_id)
        {
            // $title = 'home';
            // return view('layouts.post.index', [
            //     "active" => "posts",
            //     "tille" =>"home",
            //     // "post" => Post::all(),
            //     "post" => Post::latest()->filter(\request(['search', 'category']))->paginate(8)->withQueryString(),
            // ]);
                


            //benar
            // $user = Auth::user();
            // $materis=Materi::all();
            // $materiIDs = Post::pluck('id')->toArray();
            // $progress = $user->progress ?? 0;
            // $materiTerbuka = array_slice($materiIDs, 0, $progress);
            // $materiTersedia = array_slice($materiIDs, $progress, 100);
            // $materi = Post::whereIn('id', $materiTerbuka)->orWhereIn('id', $materiTersedia)->orderBy('id')->get();
            //         $active = Uts::first();
            //         $uass = Uas::first();
            //         $actives= $active->active;
            //         $uas= $uass->active;
            // return view('layouts.post.index',[
            //     'hidup'=>$actives,
            //     'uas'=>$uas,
            // ], compact('materi', 'progress'));
            $active = Uts::first();
            $uass = Uas::first();
            $actives= $active->active;
            $uas= $uass->active;
            $user= Auth::user();
            $userId = $user->id;
            $jawaban = Tugasjawab::where('user_id', $userId)->where('materi_id', $materi_id)->first();
            $userCount = Tugasjawab::where('user_id', $userId)->count();
            $tugas = Tugas::where('materi_id', $materi_id)->get();
            $posts = Post::where('materi_id', $materi_id)->get();
            $materi= Post::where('materi_id', $materi_id)->first();
            $gambar = Tugas::where('materi_id', $materi_id)->where('gambar_active', true)->get();
            $video = Tugas::where('materi_id', $materi_id)->where('video_active', true)->get();
            $pdf = Tugas::where('materi_id', $materi_id)->where('pdf_active', true)->get();
            $text = Tugas::where('materi_id', $materi_id)->where('text_active', true)->get();
            return view('layouts.post.index', [
                'post' => $posts,
                'hidup'=>$actives,
                'uas'=>$uas,
                'tugass'=>$tugas,
                'materi'=>$materi,
                'gambar'=>$gambar,
                'video'=>$video,
                'pdf'=>$pdf,
                'text'=>$text,
                'user'=>$userCount,
                'jawaban'=>$jawaban
            ]);
        }
    public function show($id)
    {   
    $user = Auth::user();
    $progress = $user->progress;
    $post = Post::findOrFail($id);
    $posts = Post::where('materi_id', $id)->get();
    
    
    return view('layouts.post.single', compact('post','posts'));
    // Kode untuk mengambil materi dari database berdasarkan ID
        // $materi = Post::findOrFail($id);
        // return view('layouts.post.single',[
        // "title" => "detail",
        // "post" => $post,
        // "active"=>"post",
        // ],compact('materi'));
    }
    public function updateProgress($id)
    {
        $user = Auth::user();
        $postingan = Post::find($id);
        if($user->progress < $postingan->id){
            return back()->with('anda belum mengakses materi sebelumnya');
        }
        else if($user->progress > $postingan->id){
            return redirect()->route('materi.show', ['id' => $postingan->id])
            ->with('postingan', $postingan);
        }
        else{
        if ($user && $postingan) {
            if ($postingan->id === 1 || $user->progress < $postingan->id) {
                $user->progress = $postingan->id + 1;
                $user->save();
            }
        }
                $user->progress = $postingan->id + 1;
                $user->save();

    // Update the list of postingans
    // Redirect to the next materi
        return redirect()->route('materi.show', ['id' => $postingan->id])
            ->with('postingan', $postingan);
        }

    // Redirect to the second materi
    }
}
