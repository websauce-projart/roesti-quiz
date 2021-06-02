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
        'round_id'
    ];

    public function round() {
        return $this->belongsTo(Round::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    //le nommage risque de poser problème, à vérifier
    public function useranswers() {
        return $this->hasMany(UserAnswer::class);
    }
}
