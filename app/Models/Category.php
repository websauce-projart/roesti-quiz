<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description'
    ];

    public function questions() {
        return $this->belongsToMany(Question::class);
    }

    public function rounds() {
        return $this->belongsTo(Round::class);
    }
}
