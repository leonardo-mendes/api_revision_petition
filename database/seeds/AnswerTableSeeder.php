<?php

use Illuminate\Database\Seeder;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            ['desc_answer' => 'Estimación', 'id_question' => 1, 'next_question' => 2],
            ['desc_answer' => 'DT+CO', 'id_question' => 1, 'next_question' => 2],
            ['desc_answer' => 'CO (desde DT)', 'id_question' => 1, 'next_question' => 2],
            ['desc_answer' => 'Sim', 'id_question' => 2, 'next_question' => 3],
            ['desc_answer' => 'Não', 'id_question' => 2, 'next_question' => 3],
            ['desc_answer' => 'Sim', 'id_question' => 3, 'next_question' => null],
            ['desc_answer' => 'Não', 'id_question' => 3, 'next_question' => null],
            ['desc_answer' => 'Incompleto', 'id_question' => 3, 'next_question' => null]
        ]);
    }
}
