<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
	/**
	* Создание списка пользователей
	*
	* @return void
	*/
	public function run()
	{
		DB::table('users')->insert([[
                            'name' => 'Администратор',
                            'email' => 'admin@test.loc',
                            'password' => bcrypt('password'),
                            'created_at' => now()
			],[
                            'name' => 'Иван Иванов',
                            'email' => 'ivanov@gmail.com',
                            'password' => bcrypt('ivanov'),
                            'created_at' => now()
			],[
                            'name' => 'Иван Петров',
                            'email' => 'petrovi@gmail.com',
                            'password' => bcrypt('petrovi'),
                            'created_at' => now()
			],[
                            'name' => 'Иван Сидоров',
                            'email' => 'sidorov@gmail.com',
                            'password' => bcrypt('sidorov'),
                            'created_at' => now()
			],[
                            'name' => 'Семён Горбуньков',
                            'email' => 'gorbunkov@gmail.com',
                            'password' => bcrypt('gorbunkov'),
                            'created_at' => now()
			],[
                            'name' => 'Рахат Лукум',
                            'email' => 'lukum@gmail.com',
                            'password' => bcrypt('lukum'),
                            'created_at' => now()
			],[
                            'name' => 'Изольда Маркова',
                            'email' => 'markova@gmail.com',
                            'password' => bcrypt('markova'),
                            'created_at' => now()
			],[
                            'name' => 'Григорий Смирнов',
                            'email' => 'smirnov@gmail.com',
                            'password' => bcrypt('smirnov'),
                            'created_at' => now()
			],[
                            'name' => 'Сергей Мурков',
                            'email' => 'murkov@gmail.com',
                            'password' => bcrypt('murkov'),
                            'created_at' => now()
			],[
                            'name' => 'Крис Петров',
                            'email' => 'petrovc@gmail.com',
                            'password' => bcrypt('petrovc'),
                            'created_at' => now()
			],[
                            'name' => 'Ивания Иванова',
                            'email' => 'ivanova@gmail.com',
                            'password' => bcrypt('ivanova'),
                            'created_at' => now()
			],[
                            'name' => 'Пётр Марков',
                            'email' => 'markov@gmail.com',
                            'password' => bcrypt('markov'),
                            'created_at' => now()
			],[
                            'name' => 'Николай Романов',
                            'email' => 'romanov@gmail.com',
                            'password' => bcrypt('romanov'),
                            'created_at' => now()
			],[
                            'name' => 'Иоанн Осипов',
                            'email' => 'osipov@gmail.com',
                            'password' => bcrypt('osipov'),
                            'created_at' => now()
			],[
                            'name' => 'Наталья Смирнова',
                            'email' => 'smirnova@gmail.com',
                            'password' => bcrypt('smirnova'),
                            'created_at' => now()
			]
		]);
	}
}