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

	public function getQuestions()
	{
		$questions = $this->questions();
		$roundQuestions = $questions->wherePivot("round_id", $this->id)->get();
		return $roundQuestions;
	}

	//À changer
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
}
