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

    public static function isExistingAlready($user, $opponent) {
        $games = $user->games()->get();
        foreach($games as $game) {
            if($opponent->id == $user->getOtherUser($game->id)->id) {
                return true;
            }
        }
        return false;
    }

    public static function getGameFromUsers($user1, $user2) {
        $games = $user1->games()->get();
        foreach($games as $game) {
            if($user2->id == $user1->getOtherUser($game->id)->id) {
                return $game;
            }
        }
        return null;
    }

    public function getLastRound() {
        $round = $this->rounds()->orderBy("created_at", "desc")->first();
        return $round;
    }

    public function getAllRounds() {
        $rounds = $this->rounds()->get();
        return $rounds;
    }

    public function userExistsInGame($user_id) {
        $users = $this->users()->get();
        foreach($users as $user) {
            if($user->id === $user_id) {
                return true;
            }
        }
        return false;
    }
    
}
