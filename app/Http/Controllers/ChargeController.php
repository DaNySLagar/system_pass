<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Charge;
use App\Models\User;

class ChargeController extends Controller
{
    public function index(Request $request)
    {
        
        return view('charges.index',[
            'charges' => Charge::latest('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_charge' => 'required'
        ]);

        Charge::create($request->all());

        return redirect()->route('charges.index');
    }

    public function edit(Request $request, Charge $charge)
    {
        return view('charges.edit', compact('charge'));
    }

    public function update(Request $request, Charge $charge)
    {
        $request->validate([
            'name_charge' => 'required',
        ]);

        $charge->update($request->all());

        return redirect()->route('charges.index', $charge);
    }


    public function destroy(Request $request, Charge $charge)
    {
        $chargeCount = User::where('charge_id', $charge->id)->count();
    
        if ($chargeCount === 0) {
            $charge->delete();
        } else {
            session()->flash('message', 'No puedes eliminar este CARGO porque tiene usuarios asociados.');
        }
    
        return redirect()->route('charges.index');
    }
}
