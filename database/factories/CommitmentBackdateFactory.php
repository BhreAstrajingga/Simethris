<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommitmentBackdate>
 */
class CommitmentBackdateFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'user_id' => 2,
			'no_ijin' => $this->faker->numerify('####/PP.240/D/0#/2023'),
			'periodetahun' => 2022,
			'tgl_ijin' => $this->faker->date(),
			'tgl_akhir' => $this->faker->date(),
			'no_hs' => '07032090- - Bawang putih, segar atau dingin',
			'volume_riph' => $this->faker->randomFloat(2, 0, 10000),
			'stok_mandiri' => $this->faker->randomFloat(2, 0, 100),
			'organik' => $this->faker->randomFloat(2, 0, 100),
			'npk' => $this->faker->randomFloat(2, 0, 100),
			'dolomit' => $this->faker->randomFloat(2, 0, 100),
			'za' => $this->faker->randomFloat(2, 0, 100),
			'mulsa' => 10.5,
			'poktan_share' => 0.5,
			'importir_share' => 0.5,
			'status' => null,
			'formRiph' => null,
			'formSptjm' => null,
			'logbook' => null,
			'formRt' => null,
			'formRta' => null,
			'formRpo' => null,
			'formLa' => null,
			'skl' => null,
			'created_at' => now(),
			'updated_at' => now(),
		];
	}
}
