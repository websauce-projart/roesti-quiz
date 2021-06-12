<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MouthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 4; $i++) { 
            DB::table('mouths')->insert([
                'path' => 'img/avatar/mouths/assets_avatar_bouche'.$i.'.svg'
            ]);
        }
    }
}
