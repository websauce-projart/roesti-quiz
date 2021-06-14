<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
	use HasFactory;

	public $timestamps = false;

	protected $fillable = [
		'question_id',
		'result_id',
		'user_answer'
	];

	/**
     * Return the question to which belongs the user answer
     *
     */
	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	/**
     * Return the result to which belongs the user answer
     *
     */
	public function result()
	{
		return $this->belongsTo(Result::class);
	}
}
