<?php
namespace App\Http\Livewire;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

use Livewire\Component;
use App\Models\time;

use App\Models\Pass;

use App\Models\User;


class PassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('passes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');
        $times = Time::all();

        return view('passes.create', compact('currentDate', 'times'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'motive' => 'required',
            'place' => 'required',
            'time_id' => 'required',
            'date' => 'required',
        ]);

        $request->user()->passes()->create($request->all());

        return redirect()->route('passes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pass $pass)
    {
        if($request->user()->id != $pass->user_id)
        {
            abort(403);
        }

        //return dd(compact('pass'));
        return view('passes.show', compact('pass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Pass $pass)
    {
        if($request->user()->id != $pass->user_id)
        {
            abort(403);
        }

        return view('passes.index', compact('pass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pass $pass)
    {
        $request->validate([
            'motive' => 'required',
            'place' => 'required',
            'time_id' => 'required',
            'date' => 'required',
        ]);

        if($request->user()->id != $pass->user_id)
        {
            abort(403);
        }

        $pass->update($request->all());
        //return redirect()->route('usernocheck.index', $pass);
        route('usernocheck.index', $pass);
        return redirect()->route('passes.index');

    }

    public function destroy(Request $request, Pass $pass)
    {
        $pass->delete();

        if($request->user()->id != $pass->user_id)
        {
            abort(403);
        }
        
        //return redirect()->route('usernocheck.index');
        return redirect()->route('passes.index');
    }

    public function deleteAll(Request $request){
        $ids = $request->ids;
        Pass::whereIn('id', $ids)->delete();
        return response()->json(["success" => "Las Papeletas de Permisos han sido Eliminados!"]);
    }


    public function reporte(Request $request)
    {
        $pdf = PDF::setPaper('a4', 'landscape')->loadview('passes.reporte',[
            'passes' => auth()->user()->passes
        ]);
        return $pdf->stream();
    }

    public function print(Request $request, Pass $pass)
    {
        $userPE = Auth::user();

        $userRRHH = User::whereHas('roles', function ($query) {
            $query->where('name', 'JefeRrHh');
        })->get();
        
        $userJO = User::whereHas('roles', function ($query) {
            $query->where('name', 'JefeOficina');
        })->where('dependence_id', $userPE->dependence_id)->get();
        
        $pdf = PDF::loadView('passes.pdf', [
            'pass' => Pass::find($request->id),
            'userRRHH' => $userRRHH,
            'userJO' => $userJO,
            'userPE' => $userPE->name,
        ]);
        
     
        return $pdf->stream();

    }

    public function firmar(Request $request, Pass $pass)
    {
        $sign = Pass::find($request->id);
        $firm = $sign->estado + 1;
        $sign->estado = $firm;
        $sign->save();

        return redirect()->route('passes.index');
        //return redirect()->route('usernocheck.index');
    }
}
