<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pass;
use App\Models\Departure_time;
use App\Models\Return_time;

class ShowModal extends Component
{
    public $open = false;

    public $passId;

    public function mount($id)
    {
        $this->passId = $id;
    }
    
    public function render()
    {
        //dd($this->passId);

        
        $pass = Pass::find($this->passId);
        $departure = Departure_time::where('pass_id', '=', $this->passId)->get();
        $return = Return_time::where('pass_id', '=', $this->passId)->get();
        
        return view('livewire.show-modal', compact('pass', 'departure', 'return'));
    }
}
