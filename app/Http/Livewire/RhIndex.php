<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pass;
class RhIndex extends Component
{
    use WithPagination;
    public $opcion='Todos';
    public $search;
    public $sortBy = 'date'; 
    public $sortDirection = 'desc'; 

    public function render()
    {
        $passesQuery = Pass::whereHas('user', function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orwhere('ncard', 'LIKE', '%'.$this->search.'%')
                ->join('dependences', 'users.dependence_id', '=', 'dependences.id')
                ->orwhere('dependences.name_dependence', 'LIKE', '%'.$this->search.'%')
                ->orwhere('date', 'LIKE', '%'.$this->search.'%');
        })
        
        ->join('users', 'passes.user_id', '=', 'users.id')
        ->join('times', 'passes.time_id', '=', 'times.id')
        ->join('dependences', 'users.dependence_id', '=', 'dependences.id')
        ->join('charges', 'users.charge_id', '=', 'charges.id')
        ->select('passes.*', 'users.name as user_name', 'times.time_permision as time_name', 'dependences.name_dependence as name_dependence', 'charges.name_charge as name_charge')

        ->orderBy($this->sortBy, $this->sortDirection)

        ->latest();

        if ($this->opcion == 'No_Firmados') {
            $passesQuery->where('estado', 2);
        } elseif ($this->opcion == 'rechazados') {
            $passesQuery->where('estado', 5);
        } elseif ($this->opcion == 'Firmados') {
            $passesQuery->whereNotIn('estado', [2, 5, 0]);
        } elseif ($this->opcion == 'Todos') {
            $passesQuery->where('estado', '>', 1);
        }

        $passes = $passesQuery->paginate(10);

        return view('livewire.rh-index', compact('passes'));
    }

    public function sortBy($column){
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortBy = $column;
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
