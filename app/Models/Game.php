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
    
    /**
	 * Return the users that reference the game
     *
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }
    
    /**
     * Return the rounds that reference this game
     *
     */
    public function rounds() {
        return $this->hasMany(Round::class);
    }
    
    /**
     * Verify if a game already exists between two specified users
     *
     * @param  User $user
     * @param  User $opponent
     * @return boolean
     */
    public static function isExistingAlready($user, $opponent) {
        $games = $user->games()->get();
        foreach($games as $game) {
            if($opponent->id == $user->getOtherUser($game->id)->id) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Return a game with two specified users
     *
     * @param  User $user1
     * @param  User $user2
     * @return Game | null if there is no game
     */
    public static function getGameFromUsers($user1, $user2) {
        $games = $user1->games()->get();
        foreach($games as $game) {
            if($user2->id == $user1->getOtherUser($game->id)->id) {
                return $game;
            }
        }
        return null;
    }
    
    /**
     * Verify if a specific user exists in the game
     *
     * @param  int $user_id
     * @return boolean
     */
    public function userExistsInGame($user_id) {
        $users = $this->users()->get();
        foreach($users as $user) {
            if($user->id === $user_id) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Return the last round of the game
     *
     * @return Round
     */
    public function getLastRound() {
        $round = $this->rounds()->orderBy("created_at", "desc")->first();
        return $round;
    }
    
    /**
     * Return all rounds of the game
     *
     * @return Round
     */
    public function getAllRounds() {
        $rounds = $this->rounds()->get();
        return $rounds;
    }
    
}
