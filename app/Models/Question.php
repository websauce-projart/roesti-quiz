<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'correct_answer',
        'id_author'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Categorie::class);
    }

    public function rounds() {
        return $this->belongsToMany(Round::class);
    }

    public function useranswers() {
        return $this->hasMany(UserAnswer::class);
    }
}
