<?php

namespace App\Models;

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

	/**
	 * Return the games that reference the user
     *
     */
	public function games()
	{
		return $this->belongsToMany(Game::class);
	}

	/**
     * Return the questions that reference the user
     *
     */
	public function questions()
	{
		return $this->hasMany(Question::class);
	}

	/**
     * Return the results that reference the user
     *
     */
	public function results()
	{
		return $this->hasMany(Result::class);
	}

	/**
     * Return the round to which belongs the user
     *
     */
	public function round()
	{
		return $this->belongsTo(Round::class);
	}

	/**
     * Return the eye to which belongs the user
     *
     */
	public function eye()
	{
		return $this->belongsTo(Eye::class);
	}

	/**
     * Return the mouth to which belongs the user
     *
     */
	public function mouth()
	{
		return $this->belongsTo(Mouth::class);
	}

	/**
     * Return the pose to which belongs the user
     *
     */
	public function pose()
	{
		return $this->belongsTo(Pose::class);
	}

	/**
	 * Send the email verification notification.
	 *
	 * @return void
	 */
	public function sendEmailVerificationNotification()
	{
		$this->notify(new VerifyEmail);
	}

	/**
	 * Send the password reset notification.
	 *
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPassword($token));
	}
	
	/**
	 * Return the other user of a specified game
	 *
	 * @param  int $gameId
	 * @return User
	 */
	public function getOtherUser($gameId)
	{
		$users = $this->games()->get()->where('id', $gameId)->first()->users()->get();
		$user1 = $users->get(0);
		$user2 = $users->get(1);

		if ($user1->id == $this->id) {
			return $user2;
		}
		return $user1;
	}
	
	/**
	 * Return all potential opponents of a specified user to create a game with
	 *
	 * @return array of User
	 */
	public function getAllPotentialOpponents()
	{
		$games = $this->games()->get();
		$opponents = collect();
		foreach ($games as $game) {
			$opponent = $this->getOtherUser($game->id);
			$opponents->push($opponent);
		}
		$opponents->push($this);

		$allUsers = User::all()->where('admin', 0);

		$potentialOpponents = $allUsers->diff($opponents);
		return $potentialOpponents;
	}
	
	/**
	 * Return the path of the user's pose
	 *
	 * @return String
	 */
	public function getPosePath()
	{
		return $this->pose()->first()->path;
	}

	/**
	 * Return the path of the user's mouth
	 *
	 * @return String
	 */
	public function getMouthPath()
	{
		return $this->mouth()->first()->path;
	}

	/**
	 * Return the path of the user's eye
	 *
	 * @return String
	 */
	public function getEyePath()
	{
		return $this->eye()->first()->path;
	}
	
	/**
	 * Return the user's score of a specified round
	 *
	 * @param  int $round_id
	 * @return int
	 */
	public function getScore($round_id) {
		$result = $this->results()->where('user_id', $this->id)->where('round_id', $round_id)->first();
		return $result->score;
	}

	
	/**
	 * Return the sum of all of a user's scores
	 *
	 * @return int
	 */
	public function getTotalScore()
	{
		$totalScore = 0;
		$results = $this->results()->get();
		foreach ($results as $result) {
			$totalScore += $result->score;
		}
		return $totalScore;
	}
	
	/**
	 * Return a title according to the user's total score
	 *
	 * @return String
	 */
	public function getTitle() {
		$totalScore = $this->getTotalScore();

		$ranking = [
            '0' => 'Bobet de service',
            '10000' => 'Topio de première',
            '20000' => 'Taguenasset',
            '30000' => 'Frontalier·ère',
            '40000' => 'Apprenti·e romand·e',
            '50000' => 'Thé froid de la Migros',
            '60000' => 'Rösti confirmé',
            '70000' => 'Expert·e romand·e',
            '80000' => 'Champion·ne de Romandie',
            '90000' => 'Roi·Reine des Röstis',
        ];

		foreach($ranking as $condition => $label) {
            if($totalScore >= $condition) {
				$title = $label;
			}
        }

		return $title;
	}
	
	/**
	 * Verify if a user has a result for a specified round
	 *
	 * @param  int $round_id
	 * @return boolean
	 */
	public function hasResult($round_id) {
		return !is_null($this->results()->get()->where('round_id', $round_id)->first());
	}
}
