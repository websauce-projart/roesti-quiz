<?php

namespace App\Models;

use App\Models\Round;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
	use HasFactory;

	public $timestamps = false;

	protected $fillable = [
		'title'
	];

	public function questions()
	{
		return $this->belongsToMany(Question::class);
	}

    public function rounds() {
        return $this->hasMany(Round::class);
    }

	/**
	 *	Return 3 random categories
	 * @return array contains 3 random categories
	 **/
	public static function getRandomCategories($round_count, $game_id, $user_id)
	{
		// Define a seed so the player doesn't manipulate category generation
		$faker = \Faker\Factory::create();
		$faker->seed(($user_id + $round_count + $game_id) * $user_id);

		// Get titles from category
		$categories_titles = Category::pluck("title");
		$categories = $faker->randomElements($categories_titles, 3);

		return $categories;
	}
}
