<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 4; $i++) { 
            DB::table('poses')->insert([
                'path' => '/storage/img/avatar/poses/assets_avatar_pose'.$i.'.png'
            ]);
        }
    }
}
