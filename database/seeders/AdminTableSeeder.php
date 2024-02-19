<?php

namespace Database\Seeders;

use App\Models\DataAdministrator;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				'user_id'	=> 3,
				'nama'	=> 'Pejabat',
				'jabatan' => 'Jabatan User ini',
				'nip' => '123456789012345678',
				'status' => 'aktif',
			],
		];

		DataAdministrator::insert($data);
	}
}
