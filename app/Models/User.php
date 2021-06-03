<?php

namespace App\Models;

use App\Models\Game;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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
		'password'
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

	/**
	 * Hash user password
	 **/
	public function setPasswordAttribute($password)
	{
		$this->attributes["password"] = Hash::make($password);
	}


	public function games()
	{
		return $this->belongsToMany(Game::class);
	}

	public function questions()
	{
		return $this->hasMany(Question::class);
	}

	public function results()
	{
		return $this->hasMany(Result::class);
	}

	public function round()
	{
		return $this->belongsTo(Round::class);
	}

	private function isUser1($gameId)
	{
		$aUser = Game::where('id', $gameId)->first()->users[0];
		$anotherUser = Game::where('id', $gameId)->first()->users[1];

		if ($aUser->id == $this->id) {
			//le user est aUser
			if ($aUser->id < $anotherUser->id) {
				// aUser est user1
				return true;
			} else {
				// aUser est user2
				return false;
			}
		} else {
			//le user est anotherUser
			if ($aUser->id < $anotherUser->id) {
				// aUser est user1
				return false;
			} else {
				// aUser est user2
				return true;
			}
		}
	}


	public function getOtherUser($gameId)
	{
		$user1 = Game::where('id', $gameId)->first()->users[0];
		$user2 = Game::where('id', $gameId)->first()->users[1];

		if ($user1->id == $this->id) {
			return $user2;
		}
		return $user1;
	}

	public function getUserScore($gameId)
	{
		if ($this->isUser1($gameId)) {
			$score = Game::where('id', $gameId)->first()->user1_score;
		} else {
			$score = Game::where('id', $gameId)->first()->user2_score;
		}

		return $score;
	}
}
