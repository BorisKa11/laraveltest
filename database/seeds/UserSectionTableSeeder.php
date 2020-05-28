<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Section;

class UserSectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $section = Section::inRandomOrder()->first();
            $user->sections()->save($section);
        }
    }
}
