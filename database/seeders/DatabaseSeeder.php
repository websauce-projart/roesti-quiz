<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\GameSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoundSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\GameUserSeeder;
use Database\Seeders\QuestionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GameSeeder::class,
            GameUserSeeder::class,
            CategorySeeder::class,
            QuestionSeeder::class,
            RoundSeeder::class,
            
        ]);
    }
}
