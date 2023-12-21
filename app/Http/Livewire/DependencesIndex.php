<?php
namespace App\Http\Livewire;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Dependence;

class DependencesIndex extends Component
{
    use WithPagination;
    public $search;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public function render()
    {
        $dependences = Dependence::where('name_dependence', 'LIKE' , '%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->latest()
            ->paginate(10);
        /*$dependences = Dependence::orderBy($this->sortBy, $this->sortDirection);
        ->latest()
        ->paginate(10);*/
        return view('livewire.dependences-index', compact('dependences'));
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
