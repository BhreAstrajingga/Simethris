<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterKelompok>
 */
class MasterKelompokFactory extends Factory
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
            'npwp' => '26.823.766.6-421.000',
            'nama_kelompok' => $this->faker->company,
            'nama_pimpinan' => $this->faker->name,
            'hp_pimpinan' => $this->faker->phoneNumber,
            'provinsi_id' => 33,
            'kabupaten_id' => 3301,
            'kecamatan_id' => 330101,
            'kelurahan_id' => 3301010001,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
