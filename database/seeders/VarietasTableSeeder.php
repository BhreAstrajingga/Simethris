<?php

namespace Database\Seeders;

use App\Models\Varietas;
use Illuminate\Database\Seeder;

class VarietasTableSeeder extends Seeder
{
    public function run()
    {
        $varietas = [
            [
                'id'    => 1,
                'nama_varietas' => 'Jangkiriah Adro',
            ],
            [
                'id'    => 2,
                'nama_varietas' => 'Lumbu Hijau',
            ],
            [
                'id'    => 3,
                'nama_varietas' => 'Lumbu Kuning',
            ],
            [
                'id'    => 4,
                'nama_varietas' => 'Lumbu Putih',
            ],
            [
                'id'    => 5,
                'nama_varietas' => 'Sangga Sembalun',
            ],
            [
                'id'    => 6,
                'nama_varietas' => 'Tawangmangu Baru',
            ],
        ];

        Varietas::insert($varietas);
    }
}
