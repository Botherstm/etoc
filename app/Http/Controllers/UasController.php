<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Uas;
use App\Http\Requests\StoreuasRequest;
use App\Http\Requests\UpdateuasRequest;
use App\Models\Lama_uas;
use App\Models\Start_uas;
use App\Models\Uasjawab;
use App\Models\User;
use App\Models\Uts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $active = Uts::first();
        $uass = Uas::first();
        $actives= $active->active;
        $uas= $uass->active;
                $user = Auth::user();
                // Cek apakah pengguna telah menyelesaikan ujian
                if ($user->uas_completed_at) {
                    return view('layouts.uas.selesai',[
                        "post" => Post::all(),
                        'hidup'=>$actives,
                        'uas'=>$uas,
                    ]);
                }
        $selesai = Start_uas::where('user_id',\auth()->user()->id)->get()->first();
        $lamaUTS = Lama_uas::latest()->first();
        if ($lamaUTS) {
        // Konversi waktu mulai ke timestamp
        $startTime = Carbon::now()->timestamp;
        // Konversi waktu berakhir ke timestamp
        $endTime = Carbon::parse($selesai->end_time)->timestamp;
        $formData = Session::get('selected_options', []);
        // Periksa apakah waktu selesai UTS sudah tercapai
        if ($endTime <= $startTime) {
            // Jika waktu selesai UTS sudah tercapai, lakukan aksi yang diinginkan (misalnya, simpan data form, dll.)
                $validateData = $request->validate([
                    'jawaban' => 'array',
                    'soal_id' => 'required|array',
                    'kunci' => 'required|array'
                ]);
                $validateData['user_id']=auth()->user()->id;
                Uasjawab::create($validateData);
                $user = Auth::user();
                $user->uas_completed_at = now();
                $user->save();
                return redirect('/uas')->with('success', 'Data Ujian Berhasil Terkirim');
                }

            return view('layouts.uas.main',[
            "uass" => uas::all(),
            "post" => Post::all(),
            "active"=>"Uas",
            'hidup'=>$actives,
            'uas'=>$uas,
            ], compact('endTime','formData'));
            if(\request('author')){
            $author = User::firstWhere('id',request('author'));
            $title = ' by '. $author->name;
            }
        }
        // Tampilkan pesan jika waktu berakhir tidak ditemukan
        return redirect('/')->with('error', 'Waktu berakhir tidak ditemukan.');
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
    public function store(StoreuasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(uas $uas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(uas $uas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateuasRequest $request, uas $uas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(uas $uas)
    {
        //
    }
}
