<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Mouth extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    /**
     * Return the users that reference this mouth
     *
     */
    public function users()
	{
		return $this->hasMany(User::class);
	}
}
