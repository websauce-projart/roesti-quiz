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

	public function game()
	{
		return $this->belongsTo(Game::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function results()
	{
		return $this->hasMany(Result::class);
	}

	public function questions()
	{
		return $this->belongsToMany(Question::class);
	}

	
	public function getQuestions()
	{
		$questions = $this->questions();
		$roundQuestions = $questions->wherePivot("round_id", $this->id)->get();
		return $roundQuestions;
	}

	public function getResult($user_id) {
		return Result::where('round_id', $this->id)->where('user_id', $user_id)->first();
	}

	public function getScore($user_id) {
		$result = $this->getResult($user_id);
		if(is_null($result)) {
			return 'En attente';
		} else {
			return $result->score;
		}
	}

	public function getCategory() {
		return Category::where('id', $this->category_id)->first();
	}
}
