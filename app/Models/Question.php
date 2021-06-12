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

    public function getCategoriesTitles() {
        $categories = $this->categories()->get();
        $categoriesList = "";
        if($categories->count() == 1) {
            $categoriesList = $categories->first()->title;
        } else {
            foreach($categories as $category) {
                $categoriesList = $categoriesList .", ". $category->title;
            }
            $categoriesList = substr($categoriesList, 2);
        }
        return $categoriesList;
    }

    public function getLitteralAnswer() {
        if($this->answer_boolean == 0) {
            return 'Faux: ';
        } else {
            return 'Vrai';
        }
    }
}
