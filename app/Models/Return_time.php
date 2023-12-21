<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pass;

class Return_time extends Model
{
    use HasFactory;

    protected $fillable = [
        'hour_return',
        'observation',
        'pass_id'
    ];

    public function pass()
    {
        return $this->belongsTo(Pass::class);
    }
}
