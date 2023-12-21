<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $user;
    public $open = false;
    public function mount(User $user){
        $this->user = $user;
    }
    public function render(Request $request, User $user)
    {
        return view('livewire.edit-user', compact('user'));
    }
}
