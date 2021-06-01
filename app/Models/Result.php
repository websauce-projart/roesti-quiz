<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_round'
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
