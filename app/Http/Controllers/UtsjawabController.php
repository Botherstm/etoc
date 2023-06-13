<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Start_uts;
use App\Models\Utsjawab;
use App\Http\Requests\StoreUtsjawabRequest;
use App\Http\Requests\UpdateUtsjawabRequest;
use App\Models\User;
use App\Models\Uts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UtsjawabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {      
        $jawaban = Utsjawab::all();
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
        return view('dashboard.utsjawab.index',[
        'post'=>Uts::all(),
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
        Utsjawab::create($validateData);
        $userId = Auth::id();
        Start_Uts::where('user_id', $userId)->delete();
        $user = Auth()->user();
        $user->uts_completed_at = Carbon::now();
        $user->save();
        return redirect('/uts')->with('success', 'Terimakasih Telah Mengerjakan UTS');
    }

    /**
     * Display the specified resource.
     */
    public function show(Utsjawab $utsjawab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utsjawab $utsjawab)
    {
        $user = User::find($utsjawab);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->uts_complete_at = null;
        $user->save();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUtsjawabRequest $request, Utsjawab $utsjawab)
    {
     //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utsjawab $utsjawab)
    {
     //
    }
}
