<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pose extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    /**
     * Return the users that reference this pose
     *
     */
    public function users()
	{
		return $this->hasMany(User::class);
	}
}
