<?php

namespace Database\Factories;

use App\Models\MasterKelompok;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnggotaKelompok>
 */
class MasterAnggotaFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		$masterkelompok = MasterKelompok::all()->random();
		$masterkelompok_id = $masterkelompok->id;
		return [
			'npwp' => '26.823.766.6-421.000',
			'master_kelompok_id' => $masterkelompok_id,
			'nama_petani' => $this->faker->name(),
			'nik_petani' => $this->faker->numerify('################'),
			'luas_lahan' => $this->faker->randomFloat(2, 0, 10),
			'periode_tanam' => null,
			'created_at' => now(),
			'updated_at' => now(),
		];
	}
}
