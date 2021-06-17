<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$categories = ['Langues', 'Géographie', 'Sport', 'Histoire', 'Culture', 'Média', 'Gastronomie'];

		foreach ($categories as $category) {
			Category::factory()
				->create([
					"title" => $category
				]);
		};
	}
}
