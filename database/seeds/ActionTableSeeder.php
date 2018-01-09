<?php

use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->insert([
            ['desc_action' => 'Receber documentação funcional', 'id_answer' => 1],
            ['desc_action' => 'Receber documentação de layout', 'id_answer' => 1],
            ['desc_action' => 'Receber documentação técnica', 'id_answer' => 3],
        ]);
    }
}
