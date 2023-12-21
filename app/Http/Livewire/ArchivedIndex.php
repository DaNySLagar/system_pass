<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pass;
use App\Models\Departure_time;
use App\Models\Return_time;

class ArchivedIndex extends Component
{
    use withPagination;
    public $search;
    public $sortBy = 'date'; 
    public $sortDirection = 'desc'; 

    public function render()
    {
        $passes = Pass::whereHas('user', function ($query) {
                
                $query->where('name', 'LIKE' , '%'.$this->search.'%')
                    ->join('dependences', 'users.dependence_id', '=', 'dependences.id')
                    ->orWhere('dependences.name_dependence', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('ncard', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('date', 'LIKE', '%' . $this->search . '%');
            })
            ->join('users', 'passes.user_id', '=', 'users.id')
            ->join('times', 'passes.time_id', '=', 'times.id')
            ->join('dependences', 'users.dependence_id', '=', 'dependences.id')
            ->select('passes.*', 'users.name as user_name', 'times.time_permision as time_name', 'dependences.name_dependence as name_dependence')
            ->orderBy($this->sortBy, $this->sortDirection)
            
            ->where('estado', 4)
            ->latest()
            ->paginate();
        
        $departure = Departure_time::all();
        $return = Return_time::all();
        
        return view('livewire.archived-index', compact('passes', 'departure', 'return'));
    }

    public function sortBy($column){
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortBy = $column;
    }
    
    public function updatingSearch(){
        $this->resetPage();
    }
}
