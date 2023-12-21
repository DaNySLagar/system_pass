<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pass;
use App\Models\Return_time;
use Carbon\Carbon;

class ReturnTimeController extends Controller
{


    public function assing_return_time(Request $request, Pass $pass){
        $pase = Pass::find($request->id);
        $id = $pase->id;
        $currentHour = Carbon::now()->format('H:i:s');
        return view('hours.asignarHoraRetorno', compact('currentHour', 'pase'));
    }

    public function return_hour_store(Request $request, Pass $pass){

        Return_time::create($request->all());

        if($request->user == '1'){
            $pass = Pass::find($request->pass_id);
            $pass->update(['estado' => 5]);

            return redirect()->route('bosscheck.index');

        }else if ($request->user == '2'){
            $pass = Pass::find($request->pass_id);
            $pass->update(['estado' => 5]);

            return redirect()->route('rhcheck.index');

        }else{
            $pass = Pass::find($request->pass_id);
            $pass->update(['estado' => 4]);
            return redirect()->route('hours.index');
        }
    }
}
