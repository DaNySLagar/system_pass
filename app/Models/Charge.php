<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_charge'
    ];
    
    public function users()
    {
        return $this->hasmany(User::class);
    }
    
}
