<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		$users = [
			[
				'id'             => 1,
				'name'           => 'Admin',
				'email'          => 'admin@admin.com',
				'password'       => bcrypt('password'),
				'remember_token' => null,
				'username'       => 'admin',
				'roleaccess'     => 1,
			],
			[
				'id'             => 2,
				'name'           => 'Andi Muhammad Idil Fitri, SE, MM',
				'email'          => 'pejabat@admin.com',
				'password'       => bcrypt('password'),
				'remember_token' => null,
				'username'       => 'DirSto2023',
				'roleaccess'     => 1,
			],
			[
				'id'             => 3,
				'name'           => 'Verifikator',
				'email'          => 'verifikator@admin.com',
				'password'       => bcrypt('password'),
				'remember_token' => null,
				'username'       => 'Verifikator1',
				'roleaccess'     => 1,
			],
			[
				'id'             => 4,
				'name'           => 'User1',
				'email'          => 'user@user.com',
				'password'       => bcrypt('password'),
				'remember_token' => null,
				'username'       => 'user1',
				'roleaccess'     => 2,
			],
			[
				'id'             => 5,
				'name'           => 'SIAP RIPH',
				'email'          => 'siapriph@email.com',
				'password'       => bcrypt('siapriphsimethris'),
				'remember_token' => null,
				'username'       => 'siapriph',
				'roleaccess'     => 2,
			],
		];

		User::insert($users);
	}
}
