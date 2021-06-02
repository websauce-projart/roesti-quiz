<?php

namespace Database\Seeders;

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
        $arrayCategories = ['Langues' => 'Description', 
                            'Géographique' => 'Description', 
                            'Sport' => 'Description', 
                            'Histoire' => 'Description', 
                            'Art' => 'Description', 
                            'Gastronomie' => 'Description', 
                            'Média' => 'Description'];

        foreach($arrayCategories as $key => $value ){
            DB::table('categories')->insert([
                'title' => $key
            ]);
        };
    }
}
