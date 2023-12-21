<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pass;
class PassesadminIndex extends Component
{   
    use WithPagination;
    public $search;

    public $sortBy = 'date'; 
    public $sortDirection = 'desc'; 

    public function render()
    {
        $passes = Pass::whereHas('user', function ($query) {
                $query->where('name', 'LIKE' , '%'.$this->search.'%')
                    ->join('times', 'passes.time_id', '=', 'times.id')
                    ->orWhere('times.time_permision', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('date', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('place', 'LIKE', '%' . $this->search . '%');
            })
            ->join('users', 'passes.user_id', '=', 'users.id')
            ->join('times', 'passes.time_id', '=', 'times.id')
            ->select('passes.*', 'users.name as user_name', 'times.time_permision as time_name')
            ->orderBy($this->sortBy, $this->sortDirection)
            
            ->latest()
            ->paginate();
        
        return view('livewire.passesadmin-index', compact('passes'));
    }

    public function sortBy($column){
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortBy = $column;
    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
