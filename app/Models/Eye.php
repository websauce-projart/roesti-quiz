<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eye extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    public function users()
	{
		return $this->hasMany(User::class);
	}
}
