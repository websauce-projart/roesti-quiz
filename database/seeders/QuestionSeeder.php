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
							'answer_label' => 'Elle vient du Québec et signifie "prends-toi une chaise"',
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
							'answer_label' => '',
							'answer_boolean' => true,
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
							['label' => 'La Chaux-de-Fonds a plus d\'habitants que Fribourg',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'Les habitant·es de Gland sont nommés les "Glandus"',
							'answer_label' => 'Ils se nomment les Glandois·es',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'C\'est à Bulle que le savon a été inventé',
							'answer_label' => 'Sérieusement ?',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'Alain Berset est membre du Conseil fédéral Suisse depuis 2012',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'La Suisse compte plus de 7\'000 lacs',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'Le tunnel ferroviaire du Gothard est le 3e plus long du monde',
							'answer_label' => 'Ben non, c\'est le premier !',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'La Romandie occupe 32% de la Suisse',
							'answer_label' => 'Le présentateur est discalculique, c\'est bien 23%',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'Le plus grand escalier du monde se trouve en Valais',
							'answer_label' => 'Non, c\'est dans le canton de Berne !',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'2',
							]
							],
							['label' => 'Roger Federer est gaucher',
							'answer_label' => 'Il est droitier, revers à une main !',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Ueli Steck a escaladé le Cervin en un temps record',
							'answer_label' => 'Il a escaladé la face nord de l’Eiger ',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Le football est le sport le plus pratiqué en Suisse',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Clint Capela est le joueur d\'équipe le mieux payé de l\'histoire de la Suisse',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => '1 des trois sports traditionnels Suisse est le ski alpin',
							'answer_label' => 'C\'est la lutte suisse, le hornuss et le lancer de la pierre',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Pour la saison 20-21, Karim Zerika a été élu meilleur joueur Suisse de Volleyball',
							'answer_label' => 'Le Genevois Jovan Djokic a obtenu ce titre',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Alex Wilson a couru le 100m sous les 10s à la Chaux-de-Fonds',
							'answer_label' => 'Il a couru à 10.08, le record suisse.',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Roger Federer a gagné plus de Roland Garros que Wawrinka',
							'answer_label' => 'Les deux ont gagnés 1 fois chacun Roland Garros',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Le Comité international olympique se trouve à la Maison olympique, à Lausanne.',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Les Sports Universitaires Lausanne offrent plus de 125 programmes sportifs.',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'3',
							]
							],
							['label' => 'Le terme Röstigraben est apparu pendant la première guerre mondiale',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Le château de Neuchâtel a été construit vers 1010',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'La cocaïne est une invention suisse',
							'answer_label' => 'Non, c\'est le LSD qui a été inventé en Suisse',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'La plus vieille manufacture de montre du monde se trouve dans le Jura',
							'answer_label' => 'Ben non, c\'est à Genève',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Kim Jong-un a fait ses études à Berne',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Le Jura est devenu un Canton Suisse en 1963',
							'answer_label' => 'C\'était en 1979',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Le nom de famille le plus répandu en Valais est Aymon',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Zürich possède le plus grand cadran d\'horloge de tour d\'Europe',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Le Valais a été le dernier canton à rejoindre la Suisse',
							'answer_label' => 'C\'était le canton Jura en 1979',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Zürich était la capitale avant Berne.',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'4',
							]
							],
							['label' => 'Le sculpteur Jean Tinguely est né à Fribourg',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'Le Corbusier est mort à la Chaux-de-Fonds',
							'answer_label' => 'Il nous a quitté en France',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'Le lieu d\'inhumationde de Hans Ruedi Giger se situe à Gruyères',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'On peut aprecevoir une statue de Titeuf à Onex',
							'answer_label' => 'C\'est à Carouge qu\'elle se situe',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'Sylvie Fleury est une célèbre typographe suisse',
							'answer_label' => 'C\'est une artiste contemporaine',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'Félix Valotton est né à Lausanne',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'Phanee de Pool a écrit une chanson sur Le Parfait',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'Arma Jackson est un humoriste lausannois',
							'answer_label' => 'Il vient bien de Lausanne mais il est rappeur ',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'L\'écrivain Friedrich Dürrenmatt est décédé à Neuchâtel',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'La Suisse a gagné l\'Eurovision deux fois',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'5',
							]
							],
							['label' => 'L\'humoriste Thomas Wiesel est né à Genève',
							'answer_label' => 'Il est né à Lausanne',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'La carrière de Yann Marguet a été lancée sur Couleur 3',
							'answer_label' => 'C\'était sur Rouge FM',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'Marina Rollman a été la baby-sitter de l\'enfant de Natalie Portman',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'Rire, c\'est bon pour la santé',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'Le vrai nom d\'Alain Morisod est Alain-Pierre Morand',
							'answer_label' => 'Le vrai nom d\'Alain Morisod est... Alain Morisod',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'La radio Fréquence Banane existe depuis 1983',
							'answer_label' => 'Elle a été créée 10 ans plus tard, en 1993',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'La Radio Télévision Suisse (RTS) compte plus de 3\'000 employé·es',
							'answer_label' => 'Elle en compte environ 1\'500',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => '"Vigousse" est un journal satirique de Suisse romande',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => '"Pardonnez-moi" est l\'émission où Darius Rochebin présente ses excuses',
							'answer_label' => 'Il y reçoit des personnalités du monde de la culture, de la politique ou du sport.',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'TATAKI est une émission de recettes de cuisine japonaise',
							'answer_label' => 'C\'est un média en ligne suisse d\'orientation pop culture',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'6',
							]
							],
							['label' => 'Le rösti est né dans le canton de Berne',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'Le rösti est le meilleur plat au monde',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'L\'ingrédient principal du papet vaudois est le saucisson vaudois',
							'answer_label' => 'C\'est la saucisse aux choux, pardi !',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'Dans le Jura, lors de la Saint-Martin, on mange principalement du boeuf',
							'answer_label' => 'On mange du cochon et on ne jette aucune partie !',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'Le "totché" est un gâteau à la crème salé jurassien',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'A Genève, la longeole est un dessert traditionnel',
							'answer_label' => 'C\'est un saucisse de porc et de fenouil',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'Le "godjon" est un plat traditionnel valaisan',
							'answer_label' => 'Fais un effort, ce mot n\'existe même pas',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'Henniez est une marque suisse',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'Le petit pain au lait est typiquement suisse',
							'answer_label' => '',
							'answer_boolean' => true,
							'author_id' => '1',
							'categories' => [
								'7',
							]
							],
							['label' => 'La fondue n\'a pas été inventée en Suisse',
							'answer_label' => 'Elle vient du Valais !',
							'answer_boolean' => false,
							'author_id' => '1',
							'categories' => [
								'7',
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
