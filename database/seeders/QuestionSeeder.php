<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayQuestions = [
            'Blablablabal' => 0,
            'onaodn' => 1,
            'HeyHey' => 1,
            'oadoandoa' => 0,
            'oqoqopmpca' => 0,
            'oamdoamo' => 0,
            'nondpqmdpma' => 1,
            'omcomomdowd' => 0,
            'qomdpqmdpm' => 1,
        ];

        foreach($arrayQuestions as $question => $answer ){
            DB::table('questions')->insert([
                'label' => $question,
                'answer' => $answer,
                'created_at' => now(),
                'updated_at' => now(),
                'id_author' => rand(1,2)
            ]);
        };  
    }
}
