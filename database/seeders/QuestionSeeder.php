<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$questions = [
							['label' => '"Tire-toi une buche" est une expression jurassienne',
							'answer_label' => '',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => '"Se mettre à la chote" signifie "se mettre au courant"',
							'answer_label' => 'Se protéger contre les intempéries',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => '"La cramine" signifie "un froid intense" à Neuchâtel',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => 'A Genève, on dit "un sautier" pour parler d\'un huissier',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => 'Le mot "pive" ne s\'utilise pas en France',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => 'Le mot "feignasse" ne s\'utilise pas en France',
							'answer_label' => 'On l\'utilise aussi en France !',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => 'On dit "huitante" dans toute la Romandie sauf à Genève',
							'answer_label' => 'Les Neuchâtelois aussi disent "quatre-vingt"',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => '"Bobet", "tocson" et "dadet" veulent tous trois dire "stupide"',
							'answer_label' => 'Une tchette veut dire "une petite quantité"',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => '"Brontsée", "peufnée" et "tchette" veulent tous trois dire "grande quantité"',
							'answer_label' => 'Une tchette veut dire "une petite quantité"',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => '"Biquer" signifie "sécher les cours"',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'1',
							]
							],
							['label' => 'Le lac Léman est le plus grand plan d\'eau de Suisse',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'Genève est le canton avec le plus d’habitants en Suisse Romande',
							'answer_label' => 'Vaud est le canton avec plus d’habitants',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
						];

		foreach ($questions as $question) {
			Question::factory()
				->create([
					"label" => $question['label'],
					"answer_label" => $question['answer_label'],
					"answer_boolean" => $question['answer_boolean'],
					"author_id" => $question['author_id'],
				]);
			
			foreach($question['categories'] as $category){
				Question::latest('id')->first()->categories()->attach($category);
			}
			
		};
	}
}
