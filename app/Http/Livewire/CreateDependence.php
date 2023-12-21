<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dependence;


class CreateDependence extends Component
{
    public $open = false;
    public function render()
    {
        $dependences = Dependence::all();
        return view('livewire.create-dependence', compact('dependences'));
    }
}
