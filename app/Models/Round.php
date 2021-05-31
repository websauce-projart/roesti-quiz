<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Round extends Model
{
    use HasFactory;

    protected $fillable=['id_user1_game','id_user2_game','id_categories','id_user_winner'];

    public function games() {
        return $this->belongsTo(Game::class);
    }
}
