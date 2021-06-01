<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Game;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Function that authorize a user to have multiple Games
     *
     * @var array
     */

     
    //À changer
    // public function games() {
    //     return $this->hasMany(Game::class);
    // }

    // public function game1() {
    //     return $this->hasMany(Game::class, 'id_user1');
    // }

    // public function game2() {
    //     return $this->hasMany(Game::class, 'id_user2');
    // }

    // public function otherUser() {
    //     if($this->game1->id == $this->id) {
    //         return $this->game1;
    //     }
    //     return $this->game2;
    // }

    public function games() {
        return $this->belongsToMany(Game::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }

    public function round() {
        return $this->belongsTo(Round::class);
    }
}
