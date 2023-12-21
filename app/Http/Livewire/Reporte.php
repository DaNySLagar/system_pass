<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dependence;
use App\Models\User;
use App\Models\Pass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
class Reporte extends Component
{
    public $open = false;
    public $dependence;
    public $user = '';   // $user se establece como null, el valor null hará que se busquen todos los usuarios
    public $date_inicio;
    public $date_final;
    public $opcion;

    public function mount()
    {
        // Establecer valores predeterminados en el momento de la carga inicial
        $this->date_inicio = Carbon::now()->toDateString();
        $this->date_final = Carbon::now()->toDateString();
        $this->dependence = Dependence::first()->id;
    }

    public function resetearUser()
    {
        $this->user = null;
    }

    public function render(Request $request)
    {
        session([
            'dependence' => $this->dependence,
            'user' => $this->user,
            'date_inicio' => $this->date_inicio,
            'date_final' => $this->date_final,
        ]);


        // Selectionar todos los usuarios de rol jefe de oficina
        if(Auth::user()->hasAnyRole(['JefeRrHh', 'Guardian', 'Administrador'])){

            //dump($this->dependence);

            $users = User::where('dependence_id','=',$this->dependence)->get();
            $dependences = Dependence::all();
            //route('bosscheck.reporte');

            return view('livewire.reporte', compact('dependences','users'));



        }elseif(Auth::user()->hasrole('JefeOficina')){           



                        //$dependence_id = Auth::user()->dependence->id;
                        $dependence = Auth::user()->dependence;

                        // Tomar usuario de la dependenci excluyendo a usuario autenticado (usuario jefe de oficina)
                        $usersOneGroup = $dependence->users->toArray();

                        //dump($usersOneGroup);
                        // Obtiene dependencias hijas
                        $childrenDependences = $dependence->children;
            
                        // Obtener Usuarios jefes de dependencias hijas
                        $usersSecondGroup = $childrenDependences->pluck('users')->flatten()->filter(function ($user) { // Primero extrae todos los usuarios de las oficinas subordinadas y depues toma de esos usuarios solo a los usuario jefe de oficina
                            return $user->hasAnyRole('JefeOficina');
                        })->toArray();
            
                        // Unir primer y segundo grupo de usuarios
                        $users = array_merge($usersOneGroup, $usersSecondGroup);
                        //$passes = $passesQuery->union($passes_sub)->get();
                        $users = json_decode(json_encode($users), false);
                        //dd($allUsersObject);
                        $dependences = Dependence::all();

                        return view('livewire.reporte', compact('dependences','users'));



        }else{

            return view('livewire.reporte');
        }

        

    }

    public function generarReportePdf()
    {
        
        // Guardar los datos en la sesión
        session([
            'dependence' => $this->dependence,
            'user' => $this->user,
            'date_inicio' => $this->date_inicio,
            'date_final' => $this->date_final,
            'opcion' => $this->opcion,
        ]);

        // Redirigir a la ruta 'bosscheck.reporte'
        if(Auth::user()->hasAnyRole(['JefeRrHh', 'Guardian', 'Administrador', 'Empleado', 'JefeOficina']) ){
            //return redirect()->route('bosscheck.reporte');
            return redirect()->route('pdfFormat');
        }

    }

    public function generarReporteExcel(){

        //obtencion de datos
        if(Auth::user()->hasAnyRole('JefeRrHh') || Auth::user()->hasAnyRole('Administrador') || Auth::user()->hasAnyRole('Guardian')){

            $passesAll = Pass::where('estado', 4)
                ->whereBetween('date', [$this->date_inicio, $this->date_final])
                ->when($this->user == NULL, function ($query) {
                    $query->whereHas('user', function ($subQuery) {
                        $subQuery->where('dependence_id', $this->dependence);
                    });
                }, function ($query) {
                    $query->where('user_id', $this->user);
                })->get();

        }elseif (Auth::user()->hasAnyRole('JefeOficina')) {

            $user = Auth::user();
            $dependence = $user->dependence;
            $this->dependence = $user->dependence->id;

            $dependences = $dependence->children;
            $users = $dependences->pluck('users')->flatten()->filter(function ($user) {
                return $user->hasAnyRole('JefeOficina');
            });
            $passes_sub = Pass::whereIn('user_id', $users->pluck('id'))->whereBetween('date', [$this->date_inicio, $this->date_final])->where('estado', 4);

            $passesAll = Pass::where('estado', 4)
            ->whereBetween('date', [$this->date_inicio, $this->date_final])
                ->when($this->user == NULL, function ($query) {
                    $query->whereHas('user', function ($subQuery) {
                        $subQuery->where('dependence_id', $this->dependence);
                    });
                }, function ($query) {
                    $query->where('user_id', $this->user);
                });

            $passesAll = $passesAll->union($passes_sub)->get();
    

        }else{
            $this->user = Auth::user()->id;

            $passesAll = Pass::where('estado', 4)
                ->whereBetween('date', [$this->date_inicio, $this->date_final])
                ->when($this->user == NULL, function ($query) {
                    $query->whereHas('user', function ($subQuery) {
                        $subQuery->where('dependence_id', $this->dependence);
                    });
                }, function ($query) {
                    $query->where('user_id', $this->user);
                })->get();
        }

        $passesAll->load('return_time');
        $opcion = $this->opcion;

        $passesFiltered = $passesAll->filter(function ($pass) use ($opcion) {
            if ($opcion == 1) {
                return $pass->return_time && $pass->return_time->hour_return !== null;
            }elseif ($opcion == 2) {
                return !$pass->return_time || $pass->return_time->hour_return === null;
            }elseif($opcion == NULL){
                return $pass;
            }
        });


        // Guardar los datos en la sesión
        session([
            'dependence' => $this->dependence,
            'user' => $this->user,
            'date_inicio' => $this->date_inicio,
            'date_final' => $this->date_final,
            'opcion' => $this->opcion,
            'passesAll' => $passesFiltered,
        ]);
            
        if($passesFiltered->isEmpty()){
            session()->flash('message', 'No hay datos disponibles para generar el reporte.');
        }else{
            return redirect()->route('excel.exportar');
        }
    }
}
