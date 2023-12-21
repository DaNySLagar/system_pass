<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Dependence extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name_dependence',
        'belonging_to',
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Dependence::class, 'belonging_to');
    }

    public function children()
    {
        return $this->hasMany(Dependence::class, 'belonging_to');
    }
    
}
