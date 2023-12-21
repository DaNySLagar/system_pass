<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dependence;
use App\Models\User;

class DependenceController extends Controller
{
    public function index(Request $request)
    {
        //dd("hola");
        /*return view('dependences.index',[
            'dependences' => Dependence::latest('id')->get(),
        ]);*/
        return view('dependences.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_dependence' => 'required'
        ]);

        Dependence::create($request->all());

        return redirect()->route('dependences.index');
    }

    public function edit(Request $request, Dependence $dependence)
    {
        return view('dependences.edit', compact('dependence'));
    }

    public function update(Request $request, Dependence $dependence)
    {   
        $request->validate([
            'name_dependence' => 'required',
            'belonging_to' => 'required|exists:dependences,id',
        ]);
    
        $userData = [
            'name_dependence' => $request['name_dependence'],
            'belonging_to' => $request['belonging_to'],
        ];
    
        // Actualiza el modelo
        $dependence->update($userData);
    
        return redirect()->route('dependences.index');
    }

    public function destroy(Request $request, Dependence $dependence)
    {
        //dd("metodo para eliminar");
        //dd($dependence);
        $dependenceCount = User::where('dependence_id', $dependence->id)->count();
        $childDependences = $dependence->children->count();
        //dd($childDependences);
        if ($dependenceCount === 0 and $childDependences === 0 ) {
            $dependence->delete();
            session()->flash('success', 'Dependencia eliminada correctamente.');
        } else {
            session()->flash('error', 'No es posible eliminar dependencias con registros asociados.');
        }
    
        return redirect()->route('dependences.index');
    }
}
