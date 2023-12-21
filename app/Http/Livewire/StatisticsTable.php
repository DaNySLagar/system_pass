<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Pass;
use App\Models\User;
use App\Models\Time;
use App\Models\Dependence;

use Illuminate\Http\Request;

class StatisticsTable extends Component
{

    public $user;
    public $roleNames;
    public $roleName;

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->roles->count() > 0) {
            $this->roleNames = $this->user->roles->pluck('name')->all();
            $this->roleName = $this->roleNames[0];
        }
    }
 
    public function render(Request $request){

        $passes = [];

        //Calculo para la cantidad de papeletas de salia generadas

        $passesQuery = Pass::selectRaw('MONTH(passes.created_at) as month, COUNT(*) as count')
            ->join('users', 'users.id', '=', 'passes.user_id')
            ->whereYear('passes.created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month');

        //calculo de cantida de tiempo perdido

        $passesAll = Pass::join('users', 'users.id', '=', 'passes.user_id')->get();

        //personal frecuente

        $query = Pass::join('users', 'users.id', '=', 'passes.user_id')
            ->join('dependences', 'dependences.id', '=', 'users.dependence_id')
            ->where('estado', '>=', 1)
            ->select('users.name', 'dependences.name_dependence')
            ->selectRaw('COUNT(passes.id) as papeletas_solicitadas')
            ->groupBy('users.name', 'dependences.name_dependence');
        
        //Metodo por usuario
    
        switch ($this->roleName) {
            case 'Empleado':
                $passesQuery->where('user_id', $this->user->id)
                            ->where('estado','>=', 1);
                
                $passesAll = $passesAll->where('user_id', $this->user->id)->where('estado', '>=', 1);

                break;
        
            case 'JefeOficina':
                $passesQuery->where('users.dependence_id', $this->user->dependence_id)
                            ->where('estado','>=', 1);
                
                $passesAll = Pass::whereHas('user', function ($query) {
                                $query->where('dependence_id', $this->user->dependence_id);
                            })->where('estado', '>=', 1)->get();
                
                $query->where('users.dependence_id', $this->user->dependence_id)
                            ->orderByDesc('papeletas_solicitadas')
                            ->limit(5);

                break;
        
            case 'JefeRrHh':
            case 'Administrador':
            case 'Guardian':
                $passesQuery->where('estado', '>=', 1);

                $passesAll = $passesAll->where('estado', '>=', 1);

                $query->orderByDesc('papeletas_solicitadas')
                        ->limit(5);

                break;
        }

        //calculo para el top de personal

        $usersData = $query->get();
        
        //calculo de cantida de tiempo perdido

        $totalTime = 0;
        $sumaTotalMinutos = 0;
        
        foreach ($passesAll as $pass) {
            $time_ = $pass->time->time_permision;

            preg_match('/(\d+) hora/', $time_, $horasMatches);
            preg_match('/(\d+) min/', $time_, $minutosMatches);
            
            $horas = isset($horasMatches[1]) ? intval($horasMatches[1]) : 0;
            $minutos = isset($minutosMatches[1]) ? intval($minutosMatches[1]) : 0;
    
            $sumaTotalMinutos += $horas * 60 + $minutos;
        }
    
        $horasSuma = floor($sumaTotalMinutos / 60);
        $minutosSuma = $sumaTotalMinutos % 60;

        $sumaFormateada = '';

        if ($horasSuma > 0) {
            $sumaFormateada .= $horasSuma . ' hora';
            if ($horasSuma != 1) {
                $sumaFormateada .= 's';
            }
            $sumaFormateada .= ' ';
        }

        if ($minutosSuma > 0) {
            $sumaFormateada .= $minutosSuma . ' min';
            if ($minutosSuma != 1) {
                $sumaFormateada .= 'utos';
            }
        }
    

        //calculo para la cantidad de papeletas
        $passes = $passesQuery->get();


        
        $labels = [];
        $data = [];
        $colors = ['#ADD8E6'];
        
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];


        for ($i = 1; $i < 13; $i++) {
            $month = $meses[$i];
            $count = 0;
        
            foreach ($passes as $pass) {
                if ($pass->month == $i) {
                    $count = $pass->count;
                    break;
                }
            }
            array_push($labels, $month);
            array_push($data, $count);
        }

        
        $datasets = [
            [
                'label' => 'Papeletas de Salida',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];


        
        
        
        return view('livewire.statistics-table', array_merge(
            compact('datasets', 'labels', 'sumaFormateada', 'usersData'),
            ['roleName' => $this->roleName, 'roleNames' => $this->roleNames]
        ));

    }
}
