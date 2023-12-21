<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

class PetitionIndex extends Component
{
    public function render()
    {
        //$users = User::where('petition', '1')->first();
        $users = User::where('petition', '1')->with(['dependence', 'charge'])->latest()->paginate();

        return view('livewire.petition-index', compact('users'));
    }
}
