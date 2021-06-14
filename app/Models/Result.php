<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	use HasFactory;

	public $timestamps = false;

	protected $fillable = [
		'user_id',
		'round_id',
		'timestamp_start',
		'timestamp_end',
		'score'
	];

	/**
     * Return the round to which belongs the result
     *
     */
	public function round()
	{
		return $this->belongsTo(Round::class);
	}

	/**
     * Return the user to which belongs the result
     *
     */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
     * Return the user answers that reference the result
     *
     */
	public function useranswers()
	{
		return $this->hasMany(UserAnswer::class);
	}
}
