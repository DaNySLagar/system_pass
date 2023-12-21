<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\ValidationException;

use Illuminate\Validation\Rule;

use App\Models\User;

use App\Models\Pass;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'ncard' => ['string', 'unique:users'],
            'charge_id' => ['required'],
            'dependence_id' => ['required'],
            'password' => ['required'],
        ],
        [   
            'name.required' => 'El campo nombre es requerido',
            'name.string' => 'Solo puedes ingresar valores de tipo string',
            'name.max' => 'No puedes superar los 255 caracteres',
            'email.required' => 'El campo correo electrónico es requerido',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida',
            'email.max' => 'No puedes superar los 255 caracteres',
            'email.unique' => 'El correo electrónico ingresado ya está registrado',
            'ncard.string' => 'Solo puedes ingresar valores de tipo string',
            'ncard.unique' => 'El numero de tarjeta ingresado ya está registrado',
            'charge_id.required' => 'El campo cargo es requerido',
            'dependence_id.required' => 'El campo dependencia, es requerido',
            'password.required' => 'El campo password es requerido',
        ]);
        
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'ncard' => $request['ncard'],
            'charge_id' => $request['charge_id'],
            'dependence_id' => $request['dependence_id'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //modificar el rol del usuario
        $user->roles()->sync($request->roles);

        //$user->update(['petition' => 0]);

        return redirect()->route('users.edit',  $user)->with('info', 'Se asigno los roles correctamente');
    }

    public function updatedate(Request $request, User $user){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'ncard' => ['string', Rule::unique('users')->ignore($user->id)],
            'charge_id' => ['required'],
            'dependence_id' => ['required'],
        ],
        [   
            'name.required' => 'El campo nombre es requerido',
            'name.string' => 'Solo puedes ingresar valores de tipo string',
            'name.max' => 'No puedes superar los 255 caracteres',
            'email.required' => 'El campo correo electrónico es requerido',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida',
            'email.max' => 'No puedes superar los 255 caracteres',
            'email.unique' => 'El correo electrónico ingresado ya está registrado',
            'ncard.string' => 'Solo puedes ingresar valores de tipo string',
            'ncard.unique' => 'El numero de tarjeta ingresado ya está registrado',
            'charge_id.required' => 'El campo cargo es requerido',
            'dependence_id.required' => 'El campo dependencia, es requerido',
            'password.required' => 'El campo password es requerido',
        ]);

        $userData = [
            'name' => $request['name'],
            'email' => $request['email'],
            'ncard' => $request['ncard'],
            'charge_id' => $request['charge_id'],
            'dependence_id' => $request['dependence_id'],
        ];

        if (!empty($request['password'])) {
            $userData['password'] = Hash::make($request['password']);
        }
    
        $user->update($userData);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $passCount = Pass::where('user_id', $user->id)->count();
        if ($passCount === 0) {
            User::destroy($user->id);
            //session()->flash('error', 'Usuario eliminado correctamente');
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
        }  else {
            //session()->flash('error', 'No se puede eliminar usuarios con registros asociados');
            return redirect()->route('users.index')->with('error', 'No se puede eliminar usuarios con registros asociados.');
        }



       /* try {

            $passCount = Pass::where('user_id', $user->id)->count();
            dd($passCount);
            if ($passCount === 0) {
                User::destroy($user->id);
            } 
            //User::destroy($user->id);
            //$user->delete();
            //s$user->destroy($user->id);
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            //return redirect()->route('users.index')->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'No se puede eliminar usuarios con registros asociados.');
        }*/


    }
}
