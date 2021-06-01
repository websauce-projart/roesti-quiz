<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_question',
        'id_result',
        'user_answer'
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function result() {
        return $this->belongsTo(Result::class);
    }
}
