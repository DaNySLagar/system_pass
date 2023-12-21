<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Time;
use App\Models\Hour;
use App\Models\Departure_time;
use App\Models\Return_time;

class Pass extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motive',
        'place',
        'estado',
        'time_id',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    public function hour()
    {
        return $this->hasOne(Hour::class);
    }

    public function departure_time()
    {
        return $this->hasOne(Departure_time::class);
    }

    public function return_time()
    {
        return $this->hasOne(Return_time::class);
    }
}
