<?php

namespace App\Models;

use App\Models\Game;
use App\Models\Eye;
use App\Models\Mouth;
use App\Models\Pose;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
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

	public function eye() {
        return $this->belongsTo(Eye::class);
    }

	public function mouth() {
        return $this->belongsTo(Mouth::class);
    }

	public function pose() {
        return $this->belongsTo(Pose::class);
    }

	/**
	 * Send the email verification notification.
	 *
	 * @return void
	 */
	public function sendEmailVerificationNotification()
	{
		$this->notify(new VerifyEmail); // my notification
	}

	/**
	 * Send the password reset notification.
	 *
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$url = 'https://pingouin.heig-vd.ch/websauce/reset-password?token=' . $token;

		$this->notify(new ResetPassword($url));
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

	// public function getUserScore($gameId)
	// {
	// 	if ($this->isUser1($gameId)) {
	// 		$score = Game::where('id', $gameId)->first()->user1_score;
	// 	} else {
	// 		$score = Game::where('id', $gameId)->first()->user2_score;
	// 	}

	// 	return $score;
	// }

	public function getAllPotentialOpponents() {
		$games = $this->games()->get();
		$opponents = collect();
		foreach($games as $game) {
			$opponent = $this->getOtherUser($game->id);
			$opponents->push($opponent);
		}
		$opponents->push($this);

		$allUsers = User::all()->where('admin', 0);

		$potentialOpponents = $allUsers->diff($opponents);
		return $potentialOpponents;
	}
}
