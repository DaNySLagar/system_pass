<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Pass;
use App\Models\Time;



class CreateModal extends Component
{
    public $open = false;
    public function render(Request $request, Pass $pass)
    {
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');
        $times = Time::all();

        return view('livewire.create-modal', compact('currentDate','times'));
    }
}
