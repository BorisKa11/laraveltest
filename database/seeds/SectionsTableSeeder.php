<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SectionsTableSeeder extends Seeder
{
    /**
    * Создание списка пользователей
    *
    * @return void
    */
    public function run()
    {
        for ($i = 1; $i < 16; $i++) {
            DB::table('sections')->insert([
                'name' => 'Отдел номер '.$i,
                'description' => 'Описание отдела номер '.$i,
                'logo' => '',
                'created_at' => now()
            ]);
        }
    }
}