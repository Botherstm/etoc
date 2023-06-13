<?php

namespace App\Http\Controllers;

use App\Models\Uas;
use App\Models\Uts;
use Illuminate\Http\Request;

class ActiveUasController extends Controller
{
        public function update(Request $request,string $id, )
    {   
        $rules=[
            'active' => 'required',
        ];
        $validateData = $request->validate($rules);
        Uas::where('id',$id)->update($validateData);
        return redirect('/dashboard/uts')->with('success', 'Waktu ujian Telah di updated!');

        
        // $user = Uts::first();
        // $rules=[
        //     'active'=>'required',
        // ];
        // $validateData = $request->validate($rules);
        // dd($validateData);
        // $user->save($validateData);
        
        // return redirect()->back()->with('success', 'Field value has been removed successfully.');
    }

     public function updateuasFirstActive(Request $request)
    {
        $active = $request->input('active');

        $uts = Uas::whereNotNull('active')->where('active', '!=', $active)->first();
        if ($uts) {
            $uts->active = $active;
            $uts->save();
            return redirect()->back()->with('success', 'Status Uts Terlah Berubah');
        } else {
            return redirect()->back()->with('error', 'No record found to update.');
        }
    }
}
