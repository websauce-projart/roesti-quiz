<?php

namespace App\Models;

use App\Models\Round;
use App\Models\Question;
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

    public function round() {
        return $this->belongsTo(Round::class);
    }
}
