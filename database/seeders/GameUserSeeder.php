<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('game_user')->insert([
            'user_id' => 1,
            'game_id' => 1
        ]);

        DB::table('game_user')->insert([
            'user_id' => 2,
            'game_id' => 1
        ]);

        DB::table('game_user')->insert([
            'user_id' => 1,
            'game_id' => 2
        ]);

        DB::table('game_user')->insert([
            'user_id' => 3,
            'game_id' => 2
        ]);

        DB::table('game_user')->insert([
            'user_id' => 1,
            'game_id' => 3
        ]);

        DB::table('game_user')->insert([
            'user_id' => 4,
            'game_id' => 3
        ]);
        
    }
}
