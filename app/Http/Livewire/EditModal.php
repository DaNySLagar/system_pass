<?php

namespace App\Http\Livewire;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Charge;
use App\Models\Dependence;
use App\Models\User;
use App\Models\Time;

use App\Models\Pass;

class EditModal extends Component
{
    public $pass;
    public $open = false;

    public function mount(Pass $pass){
        $this->pass = $pass;
    }
    public function render(Request $request, Pass $pass)
    {
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');
        $times = Time::all();
        return view('livewire.edit-modal', compact('pass','times','currentDate'));
        // return view('livewire.edit-modal', compact('pass'));
    }



}
