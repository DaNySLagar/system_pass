<?php

namespace App\Http\Livewire;
use App\Models\Pass;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dependence;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;

class BossIndex extends Component
{
    use WithPagination;
    public $opcion='Todos';
    public $search;
    public $sortBy = 'date'; 
    public $sortDirection = 'desc'; 


    public function render(Request $request)
    {
        
        $dep = $request->user()->dependence_id;

        //Obtener passes de empleados de oficina
        $passesQuery = Pass::whereHas('user', function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('ncard', 'LIKE', '%' . $this->search . '%')
                ->orWhere('date', 'LIKE', '%' . $this->search . '%');
        // Esocoger pases de usuario pertenecientes a una dependencia especifica
        })->whereHas('user', function ($query) use ($dep){
            $query->where('dependence_id', $dep);
        // Excluir pases del usuario logado actual 
        })->whereNot('user_id', $request->user()->id)
            ->latest();
    

        //obtencion de passes de los jefes de sub oficina

        $dependences = Dependence::where('belonging_to', $dep)->get();
        $users = $dependences->pluck('users')->flatten()->filter(function ($user) {
            return $user->hasAnyRole('JefeOficina');
        });



        if ($this->opcion == 'No_Firmados') {

            $passesQuery->where('estado', 1);
            $passes_sub = Pass::whereIn('user_id', $users->pluck('id'))->where('estado', 1);

        } elseif ($this->opcion == 'rechazados') {

            $passesQuery->where('estado', 5);
            $passes_sub = Pass::whereIn('user_id', $users->pluck('id'))->where('estado', 5);

        } elseif ($this->opcion == 'Firmados') {

            $passesQuery->whereNotIn('estado', [1, 5, 0]);
            $passes_sub = Pass::whereIn('user_id', $users->pluck('id'))->whereNotIn('estado', [1, 5, 0]);

        } elseif ($this->opcion == 'Todos') {

            $passesQuery->where('estado', '>', 0);
            $passes_sub = Pass::whereIn('user_id', $users->pluck('id'));

        }

        $passes = $passesQuery->union($passes_sub)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(5);

        return view('livewire.boss-index', compact('passes'));

    }

    public function updatingSearch(){
        $this->resetPage();
    }
    public function updatingOpcion(){
        $this->resetPage();
    }
    public function setOpcion($opcion)
        {
            $this->opcion = $opcion;
        }
}
