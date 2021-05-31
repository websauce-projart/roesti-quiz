<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Game extends Model
{
    use HasFactory;
    
    protected $fillable=['id_user1','id_user2','user1_score','user2_score'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
