<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pass;
use App\Models\Departure_time;
use Carbon\Carbon;

class DepartureTimeController extends Controller
{
    public function assign_departure_time(Request $request, Pass $pass){
        $pase = Pass::find($request->id);
        $id = $pase->id;
        $currentHour = Carbon::now()->format('H:i:s');

        Departure_time::Create([
            'hour_departure' => $currentHour,
            'pass_id' => $id
        ]);

        return redirect()->route('hours.index');
    }
}
