<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pass;

class Departure_time extends Model
{
    use HasFactory;

    protected $fillable = [
        'hour_departure',
        'pass_id'
    ];

    public function pass()
    {
        return $this->belongsTo(Pass::class);
    }
}
