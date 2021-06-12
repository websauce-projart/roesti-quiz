<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EyeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 4; $i++) { 
            DB::table('eyes')->insert([
                'path' => 'https://pingouin.heig-vd.ch/websauce/img/avatar/eyes/assets_avatar_yeux'.$i.'.svg'
            ]);
        }
    }
}
