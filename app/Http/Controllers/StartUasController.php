<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Start_uas;
use App\Http\Requests\StoreStart_uasRequest;
use App\Http\Requests\UpdateStart_uasRequest;
use App\Models\Lama_uas;
use App\Models\Uas;
use App\Models\Uasjawab;
use App\Models\Uts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartUasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user = Auth::user();

        $active = Uts::first();
        $uass = Uas::first();
        $actives= $active->active;
        $uas= $uass->active;
            // Cek apakah pengguna telah menyelesaikan ujian
                if ($user->uas_completed_at) {
                    $jawaban = Uasjawab::where('user_id',\auth()->user()->id)->get();
                    $hasilJawaban = [];;
                    $duplicateUserIds = Uasjawab::select('user_id')
                    ->havingRaw('COUNT(user_id) > 1')
                    ->groupBy('user_id')
                    ->get();
                    foreach ($jawaban  as $item) {
                        $jawabanUser = $item->jawaban; // Data jawaban dalam bentuk JSON
                        $kunciJawaban = $item->kunci; // Data kunci jawaban dalam bentuk JSON
                        $id = $item->author->id;
                        // dd($id);
                        // Membandingkan jawaban user dengan kunci jawaban
                        $jawabanBenar = 0;
                        foreach ($kunciJawaban  as $index => $kunci) {
                            $userjawab = $jawabanUser[$index];
                            if ($jawabanUser[$index] == $kunci) {
                                $jawabanBenar++;
                            }
                        }
                        // Menghitung nilai per soal
                        $nilai = ($jawabanBenar / count($kunciJawaban)) * 100;
                        $nilai = number_format($nilai, 2);
                        // Menyimpan hasil jawaban
                        $hasilJawaban[] = [
                            'jawabanBenar' => $jawabanBenar,
                            'totalSoal' => count($kunciJawaban),
                            'nilai' => $nilai,
                            'id'=>$id,
                            'double'=>$duplicateUserIds,
                        ];
                    }
                    return view('layouts.uas.selesai',[
                        "post" => Post::all(),
                        'hidup'=>$actives,
                        'uas'=>$uas,
                    ],compact('hasilJawaban','jawaban'));
                }
                
        return view('layouts.uas.mulai',[
            "post" => Post::all(),
                'hidup'=>$actives,
                'uas'=>$uas,
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
        $lamaUTS = Lama_uas::latest()->first();
        $currentTime = Carbon::now();
        $updatedTime = $currentTime->addHours($lamaUTS->jam)->addMinutes($lamaUTS->menit);
        $validateData = ([
            'end_time'=>$updatedTime,
        ]);
        $validateData['user_id']=auth()->user()->id;
        
        Start_uas::create($validateData);
        // DB::table('start_uts')->insert($validateData);
        return redirect('/uas')->with('success', 'Selamat Mengerjakan Soal');
    }

    /**
     * Display the specified resource.
     */
    public function show(Start_uas $start_uas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Start_uas $start_uas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStart_uasRequest $request, Start_uas $start_uas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Start_uas $start_uas)
    {
        //
    }
}
