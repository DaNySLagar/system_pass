<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Pass;
use App\Models\User;
use App\Models\Time;

use Illuminate\Http\Request;

class PassesIndex extends Component
{
    use WithPagination;
    public $opcion='Todos';
    public $search;

    public $sortBy = 'date'; 
    public $sortDirection = 'desc'; 


    public function render(Request $request)
    {

        $passesQuery = auth()->user()->passes()

                    ->join('users', 'passes.user_id', '=', 'users.id')
                    ->join('times', 'passes.time_id', '=', 'times.id')
                    ->select('passes.*', 'users.name as user_name', 'times.time_permision as time_name')

                    ->where(function ($query) {
                        $query->where('motive', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('times.time_permision', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('date', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('place', 'LIKE', '%' . $this->search . '%');
                    })
                    ->where('passes.user_id', auth()->id())
                                            
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->latest();
        

        if ($this->opcion == 'No_Firmados') {
            $passesQuery->where('estado', 0);
        } elseif ($this->opcion == 'rechazados') {
            $passesQuery->where('estado', 5);
        } elseif ($this->opcion == 'archivados') {
            $passesQuery->where('estado', 4);
        } elseif ($this->opcion == 'Firmados') {
            $passesQuery->whereNotIn('estado', [0, 5, 4]);
        } elseif ($this->opcion == 'Todos') {
            $passesQuery->where('estado', '>=', 0);
        }
        
        $totalPapeletas = $passesQuery->count(); 
        $passes = $passesQuery->paginate(5);
        
        return view('livewire.passes-index', compact('passes','totalPapeletas'));
    

    }

    public function sortBy($column)
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortBy = $column;

    }

    public function updatingSearch(){
        $this->resetPage();
    }
    public function setOpcion($opcion)
        {
            $this->opcion = $opcion;
        }
}
