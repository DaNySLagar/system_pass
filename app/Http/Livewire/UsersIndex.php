<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\User;

class UsersIndex extends Component
{
    use WithPagination;

    public $search;
    
    public $sortBy = 'created_at'; 
    public $sortDirection = 'desc'; 

    public function render()
    {

       $users = User::where('name', 'LIKE' , '%'.$this->search.'%')
            ->orwhere('email', 'LIKE', '%'.$this->search.'%')
            ->orwhere('ncard', 'LIKE', '%'.$this->search.'%')
            ->join('dependences', 'users.dependence_id', '=', 'dependences.id')
            ->join('charges', 'users.charge_id', '=', 'charges.id') 
            ->select('users.*', 'dependences.name_dependence as name_dependence', 'charges.name_charge as name_charge') 
            ->orderBy($this->sortBy, $this->sortDirection)
            ->latest()
            ->paginate(10); 


        return view('livewire.users-index', compact('users'));
    }

    public function sortBy($column)
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortBy = $column;

    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
