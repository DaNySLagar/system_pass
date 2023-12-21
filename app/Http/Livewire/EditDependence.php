<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dependence;

class EditDependence extends Component
{
    public $dependence;
    public $open = false;

    public function mount(Dependence $dependence){
        $this->dependence = $dependence;
    }

    public function render(Dependence $dependence)
    {

        return view('livewire.edit-dependence', compact('dependence'));
    }
}

