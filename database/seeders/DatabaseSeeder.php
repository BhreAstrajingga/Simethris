<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call([
			PermissionsTableSeeder::class,
			RolesTableSeeder::class,
			PermissionRoleTableSeeder::class,
			UsersTableSeeder::class,
			RoleUserTableSeeder::class,
			VarietasTableSeeder::class,
			// AdminTableSeeder::class,
		]);

		// \App\Models\Category::factory(5)->create();
		// \App\Models\Post::factory(30)->create();
	}
}
