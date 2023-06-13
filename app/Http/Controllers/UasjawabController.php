<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreuasjawabRequest;
use App\Http\Requests\UpdateuasjawabRequest;
use App\Models\Start_uas;
use App\Models\Uas;
use App\Models\Uasjawab ;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UasjawabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jawaban = Uasjawab::all();
        $hasilJawaban = [];
        $soal = Uasjawab::where('user_id',\auth()->user()->id)->get();
        $duplicateUserIds =Uasjawab::select('user_id')
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
        return view('dashboard.uasjawab.index',[
        'post'=>Uas::all(),
        ], compact('hasilJawaban','jawaban'));
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
        $validateData = $request->validate([
            'jawaban' => 'array',
            'soal_id' => 'required|array',
            'kunci' => 'required|array'
        ]);
        $validateData['user_id']=auth()->user()->id;
        Uasjawab::create($validateData);
        $userId = Auth::id();
        Start_uas::where('user_id', $userId)->delete();
        $user = Auth()->user();
        $user->uas_completed_at = Carbon::now();
        $user->save();
        return redirect('/uas')->with('success', 'Terimakasih Telah Mengerjakan Ujian Akhir Semester');
    }

    /**
     * Display the specified resource.
     */
    public function show(uasjawab $uasjawab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(uasjawab $uasjawab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateuasjawabRequest $request, uasjawab $uasjawab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(uasjawab $uasjawab)
    {
        //
    }
}
