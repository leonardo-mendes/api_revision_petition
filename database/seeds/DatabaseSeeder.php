<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(QuestionTableSeeder::class);
        $this->call(AnswerTableSeeder::class);
        $this->call(ActionTableSeeder::class);
    }
}
