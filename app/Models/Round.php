<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_game',
        'id_category',
        'id_user_winner'];

    //À changer
    public function game() {
        return $this->belongsTo(Game::class);
    }
    
    public function categories() {
        return $this->hasMany(Categorie::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }

    public function users() {   //pour le winner
        return $this->hasMany(User::class);
    }

    public function questions() {
        return $this->belongsToMany(Question::class);
    }
}
