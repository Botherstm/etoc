<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Uas;
use App\Models\Uts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostmateriController extends Controller
{
    public function index(){

        $user = Auth::user();
        $materiIDs = Materi::pluck('id')->toArray();
        $progress = $user->progress ?? 0;
        $materiTerbuka = array_slice($materiIDs, 0, $progress);
        $materiTersedia = array_slice($materiIDs, $progress, 100);
        $materi = Materi::whereIn('id', $materiTerbuka)->orWhereIn('id', $materiTersedia)->orderBy('id')->get();
        $active = Uts::first();
        $uass = Uas::first();
        $actives= $active->active;
        $uas= $uass->active;
        return view('layouts.materi.index',[
            'hidup'=>$actives,
            'uas'=>$uas,
            // 'materi'=>Materi::all(),
        ], compact('materi', 'progress'));
    }
}
