<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Round extends Model
{
	use HasFactory;

	protected $fillable = [
		'game_id',
		'category_id'
	];

	//À changer
	public function game()
	{
		return $this->belongsTo(Game::class);
	}

	public function categories()
	{
		return $this->hasMany(Categorie::class);
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
