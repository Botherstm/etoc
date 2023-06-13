<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Start_uts;
use App\Http\Requests\StoreStart_utsRequest;
use App\Http\Requests\UpdateStart_utsRequest;
use App\Models\Lama_uts;
use App\Models\Uas;
use App\Models\Uts;
use App\Models\Utsjawab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartUtsController extends Controller
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
            // Cek apakah pengguna telah menyelesaikan ujian
                if ($user->uts_completed_at) {
                    $jawaban = Utsjawab::where('user_id',\auth()->user()->id)->latest()->get();
                    $hasilJawaban = [];;
                    $duplicateUserIds = Utsjawab::select('user_id')
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

                    return view('layouts.uts.selesai',[
                        "post" => Post::all(),
                        'hidup'=>$actives,
                        'uas'=>$uas,
                    ], compact('hasilJawaban','jawaban'));
                }
                
        return view('layouts.uts.mulai',[
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
        $lamaUTS = Lama_uts::latest()->first();
        $currentTime = Carbon::now();
        $updatedTime = $currentTime->addHours($lamaUTS->jam)->addMinutes($lamaUTS->menit);
        $validateData = ([
            'end_time'=>$updatedTime,
        ]);
        $validateData['user_id']=auth()->user()->id;
        
        Start_uts::create($validateData);
        // DB::table('start_uts')->insert($validateData);
        return redirect('/uts')->with('success', 'Selamat Mengerjakan Soal');
    }

    /**
     * Display the specified resource.
     */
    public function show(Start_uts $start_uts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Start_uts $start_uts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStart_utsRequest $request, Start_uts $start_uts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Start_uts $start_uts)
    {
        //
    }
}
