<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUtsjawabRequest;
use App\Models\Uas;
use Illuminate\Support\Facades\Route;
use App\Models\Uts;
use App\Http\Requests\StoreUtsRequest;
use App\Http\Requests\UpdateUtsRequest;
use App\Models\Lama_uts;;
use App\Models\Post;
use App\Models\Start_uts;
use App\Models\User;
use App\Models\Utsjawab;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UtsController extends Controller
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
                if ($user->uts_completed_at) {
                        $jawaban = Utsjawab::where('user_id',\auth()->user()->id)->get();
                        $hasilJawaban = [];
                        $soal = Utsjawab::where('user_id',\auth()->user()->id)->get();
                        $duplicateUserIds = Utsjawab::select('user_id')
                        ->havingRaw('COUNT(user_id) > 1')
                        ->groupBy('user_id')
                        ->get();
                        foreach ($jawaban  as $item) {
                            $jawabanUser = $item->jawaban; // Data jawaban dalam bentuk JSON
                            $kunciJawaban = $item->kunci; // Data kunci jawaban dalam bentuk JSON
                            $soal = $item->author->name;
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
                                'nama'=>$soal,
                                'id'=>$id,
                                'double'=>$duplicateUserIds,
                            ];
                        }
                    return view('layouts.uts.selesai',[
                        "post" => Post::all(),
                        'hidup'=>$actives,
                    'uas'=>$uas,
                    ],compact('hasilJawaban','jawaban'));
                }



                
        $selesai = Start_uts::where('user_id',\auth()->user()->id)->get()->first();
        $lamaUTS = Lama_uts::latest()->first();
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
                Utsjawab::create($validateData);
                $user = Auth::user();
                $user->uts_completed_at = now();
                $user->save();
                return redirect('/')->with('success', 'Data Ujian Berhasil');
                }
                $user = Auth::user();
                // Cek apakah pengguna telah menyelesaikan ujian
                if ($user->uts_completed_at) {
                    return view('layouts.uts.selesai',[
                        "post" => Post::all(),
                    ]);
                }
            return view('layouts.uts.main',[
            "uts" => Uts::all(),
            "post" => Post::all(),
            "active"=>"Uts",
            'hidup'=>$actives,
            'uas'=>$uas,
            ], compact('endTime','formData'));
            if(\request('author')){
            $author = User::firstWhere('id',request('author'));
            $title = ' by '. $author->name;
            }
        }
        // Tampilkan pesan jika waktu berakhir tidak ditemukan
        return redirect('/uts')->with('error', 'Waktu berakhir tidak ditemukan.');
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
     //
    }
    /**
     * Display the specified resource.
     */
    public function show(Uts $uts)
    {
     //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uts $uts)
    {
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUtsRequest $request, Uts $uts)
    {
     //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uts $uts)
    {
     //
    }
    

}
