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

        
    /**
     * Return the user to which belongs the question
     *
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
	 * Return the categories that reference to the question
     *
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    /**
	 * Return the rounds that reference the question
     *
     */
    public function rounds() {
        return $this->belongsToMany(Round::class);
    }

    /**
     * Return the user answers that reference the question
     *
     */
    public function useranswers() {
        return $this->hasMany(UserAnswer::class);
    }
    
    /**
     * Return all category titles separated by a comma
     *
     * @return String 
     */
    public function getCategoriesTitles() {
        $categories = $this->getCategories();
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
    
    /**
     * Return all categories that reference the question
     *
     * @return Category
     */
    public function getCategories() {
        return $this->categories()->get();
    }
    
    /**
     * Return the answer (boolean) of the question as a string
     *
     * @return String
     */
    public function getLitteralAnswer() {
        if($this->answer_boolean == 0) {
            return 'Faux: ';
        } else {
            return 'Vrai';
        }
    }
}
