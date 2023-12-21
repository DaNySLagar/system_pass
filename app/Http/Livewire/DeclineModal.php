<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pass;

class DeclineModal extends Component
{
    public $open = false;

    public $passId;

    public $passUser;

    public function mount($id, $user)
    {
        $this->passId = $id;
        $this->passUser = $user;

    }

    public function render()
    {
        $pass = Pass::find($this->passId);

        return view('livewire.decline-modal', ['pass' => $pass, 'passUser' => $this->passUser]);
    }
}
