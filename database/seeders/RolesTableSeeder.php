<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
	public function run()
	{
		$roles = [
			[
				'id'    => 1,
				'title' => 'Admin',
			],
			[
				'id'    => 2,
				'title' => 'User',
			],
			[
				'id'    => 3,
				'title' => 'Verifikator',
			],
			[
				'id'    => 4,
				'title' => 'user_v2',
			],
			[
				'id'    => 5,
				'title' => 'Pejabat',
			],
			[
				'id'    => 6,
				'title' => 'API',
			],
		];

		Role::insert($roles);
	}
}
