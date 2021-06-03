<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$categories = ['Langues', 'Géographique', 'Sport', 'Histoire', 'Art', 'Gastronomie', 'Média'];

		foreach ($categories as $category) {
			Category::factory()
				->create([
					"title" => $category
				]);
		};
	}
}
