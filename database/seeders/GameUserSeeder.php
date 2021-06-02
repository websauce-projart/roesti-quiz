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
        // for($i = 0; $i < 20; $i++){
        //     DB::table('game_user')->insert([
        //         'user_id' => User::select('id')->orderByRaw("RAND()")->first()->id,
        //         'game_id' => Game::select('id')->orderByRaw("RAND()")->first()->id,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        DB::table('game_user')->insert([
            'user_id' => 1,
            'game_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('game_user')->insert([
            'user_id' => 2,
            'game_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('game_user')->insert([
            'user_id' => 1,
            'game_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('game_user')->insert([
            'user_id' => 3,
            'game_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('game_user')->insert([
            'user_id' => 1,
            'game_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('game_user')->insert([
            'user_id' => 3,
            'game_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
