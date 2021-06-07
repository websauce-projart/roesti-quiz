<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Round;

class Game extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable =[
        'active_user_id'
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function rounds() {
        return $this->hasMany(Round::class);
    }
    
}
