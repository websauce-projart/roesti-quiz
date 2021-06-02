<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'answer_label',
        'answer_boolean',
        'answer_label',
        'author_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function rounds() {
        return $this->belongsToMany(Round::class);
    }

    public function useranswers() {
        return $this->hasMany(UserAnswer::class);
    }
}
