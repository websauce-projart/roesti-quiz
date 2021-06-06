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
        for ($i=1; $i < 6; $i++) { 
            DB::table('eyes')->insert([
                'path' => '/storage/img/avatar/yeux'.$i.'.png'
            ]);
        }
    }
}
