<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Charge;
use App\Models\Dependence;


class CreateUser extends Component
{
    public $open = false;
    public function render()
    {
        $dependences = Dependence::all();
        $charges = Charge::all();
        return view('livewire.create-user',compact('dependences','charges'));
    }
}
