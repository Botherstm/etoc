<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Uas;
use App\Models\Uts;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $active = Uts::first();
        $uass = Uas::first();
        $actives= $active->active;
        $uas= $uass->active;
        $user = Auth::user();

        if (!$user->acc) {
            return view('layouts.belum', [
                'user' => $user,
                'post'=>Post::all(),

            ]);
            }
            else{
                return view('home',[
                'post'=>Post::all(),
                'hidup'=>$actives,
                'uas'=>$uas,
            ]);
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('layouts.post.single',[
            'post'=> Post::all(),
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
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
     //
    }
}
