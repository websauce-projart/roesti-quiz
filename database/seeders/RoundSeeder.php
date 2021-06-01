<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Round::factory()
        ->count(5)
        ->create();
    }
}
