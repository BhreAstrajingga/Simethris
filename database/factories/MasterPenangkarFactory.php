<?php

namespace Database\Factories;

use App\Models\MasterPenangkar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterPenangkar>
 */
class MasterPenangkarFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	protected $model = MasterPenangkar::class;

	public function definition()
	{
		$faker = \Faker\Factory::create();

		return [
			'nama_lembaga' => $faker->company,
			'nama_pimpinan' => $faker->name,
			'hp_pimpinan' => $faker->phoneNumber,
			'alamat' => $faker->address,
			'provinsi_id' => '35',
			'kabupaten_id' => '3501',
			'kecamatan_id' => null,
			'kelurahan_id' => null,
			'created_at' => now(),
			'updated_at' => now(),
		];
	}
}
