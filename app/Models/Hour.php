<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pass;

class Hour extends Model
{
    use HasFactory;
    protected $fillable = [
        'departure_time',
        'pass_id'
    ];
    public function pass()
    {
        return $this->belongsTo(Pass::class);
    }
}
