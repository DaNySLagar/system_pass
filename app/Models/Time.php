<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Time extends Model
{
    use HasFactory;

    protected $fillable= [
        'time_permision'
    ];

    public function passes(){

        return $this->hasMany(Pass::class);

    }
}
