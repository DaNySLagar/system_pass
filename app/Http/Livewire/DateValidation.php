<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class DateValidation extends Component
{
    public $date;

    public function __construct($date)
    {
        $this->date = $date;
    }
    
    public function render()
    {
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');

        return view('livewire.date-validation', compact('currentDate'));
    }
}