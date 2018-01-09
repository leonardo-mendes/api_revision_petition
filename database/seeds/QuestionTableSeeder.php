<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            ['desc_question' => 'Qual o tipo da petição?'],
            ['desc_question' => 'Foi recebido documentação funcional?'],
            ['desc_question' => 'Cliente de OK no inicio do desenvolvimento?']
        ]);
    }
}
