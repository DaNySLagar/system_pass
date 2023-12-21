<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Pass;



class TimeController extends Controller
{

    public function index(Request $request)
    {
        return view('times.index',[
            'times' => Time::latest('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'time_permision' => 'required'
        ]);

        Time::create($request->all());


        return redirect()->route('times.index');
    }

    public function edit(Request $request, Time $time)
    {
        return view('times.edit', compact('time'));
    }

    public function update(Request $request, Time $time)
    {
        $request->validate([
            'time_permision' => 'required',
        ]);

        $time->update($request->all());

        return redirect()->route('times.index', $time);
    }

    public function destroy(Request $request, Time $time)
    {
        $timesCount = Pass::where('time_id', $time->id)->count();
    
        if ($timesCount === 0) {
            $time->delete();
        } else {
            session()->flash('message', 'No puedes eliminar este TIEMPO porque tiene papeletas de salida asociados.');
        }
    
        return redirect()->route('times.index');
    }
}
