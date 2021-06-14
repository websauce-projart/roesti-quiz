<?php

namespace App\Models;

use App\Models\Game;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Round extends Model
{
	use HasFactory;

	protected $fillable = [
		'game_id',
		'category_id'
	];

	/**
     * Return the game to which belongs the round
     *
     */
	public function game()
	{
		return $this->belongsTo(Game::class);
	}

	/**
     * Return the category to which belongs the round
     *
     */
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	/**
     * Return the results that reference the round
     *
     */
	public function results()
	{
		return $this->hasMany(Result::class);
	}

	/**
	 * Return the questions that reference the round
     *
     */
	public function questions()
	{
		return $this->belongsToMany(Question::class);
	}
	
	/**
	 * Return the result of the round for a specified user
	 *
	 * @param  int $user_id
	 * @return Result
	 */
	public function getResult($user_id) {
		return $this->results()->where('user_id', $user_id)->first();
	}
	
	/**
	 * Return the score of a specified user for the result of the round
	 *
	 * @param  int $user_id
	 * @return int | String if user has no result
	 */
	public function getScore($user_id) {
		$result = $this->getResult($user_id);
		if(is_null($result)) {
			return 'En attente';
		} else {
			return $result->score;
		}
	}
	
	/**
	 * Return the category of the round
	 *
	 * @return Category
	 */
	public function getCategory() {
		return $this->category()->first();
	}
}