<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function questions() {
        return $this->belongsToMany(Question::class);
    }

    public function round() {
        return $this->belongsTo(Round::class);
    }
}
