<?php

namespace App\Http\Controllers;

use App\Models\Pass;

use Illuminate\Http\Request;

class UsercheckController extends Controller
{
    public function index(){

       return view('userchecks.index', [
            'passes' => auth()
                        ->user()
                        ->passes()
                        ->where('estado', 1)
                        ->get(),
       ]);
    }

    public function firmarUser(Request $request, Pass $pass)
    {
        $sign = Pass::find($request->id);
        $firm = $sign->estado + 1;
        $sign->estado = $firm;
        $sign->save();

        return redirect()->route('usercheck.index');
    }

}
