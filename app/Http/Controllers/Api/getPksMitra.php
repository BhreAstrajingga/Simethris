<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelompoktani;
use App\Models\PksMitra;
use Illuminate\Http\Request;

class getPksMitra extends Controller
{
	public function getApiPksMitraAll()
	{
		//
		$pksmitras = PksMitra::all();
		$result = [];

		foreach ($pksmitras as $pksmitradata) {
			$result[] = [
				'id' => $pksmitradata->id,
				'tahun' => $pksmitradata->commitmentbackdate->periodetahun  ?? null,
				'no_ijin' => $pksmitradata->commitmentbackdate->no_ijin ?? null,
				'no_perjanjian' => $pksmitradata->no_perjanjian ?? null,

				'kelompoktani' => $pksmitradata->masterkelompok->nama_kelompok ?? null,
				'pimpinan' => $pksmitradata->masterkelompok->nama_pimpinan ?? null,

				'luas_rencana' => $pksmitradata->luas_rencana  ?? null,
				'varietas_tanam' => $pksmitradata->varietas_tanam ?? null,
				'periode_tanam' => $pksmitradata->periode_tanam ?? null,

				'tgl_perjanjian_start' => $pksmitradata->tgl_perjanjian_start ?? null,
				'tgl_perjanjian_end' => $pksmitradata->tgl_perjanjian_end ?? null,

				'provinsi_id' => $pksmitradata->provinsi->provinsi_id ?? null,
				'nama' => $pksmitradata->provinsi->nama ?? null,
				'kabupaten_id' => $pksmitradata->kabupaten->kabupaten_id ?? null,
				'nama_kab' => $pksmitradata->kabupaten->nama_kab ?? null,

				'berkas_pks' => $pksmitradata->berkas_pks ?? null,
				'status' => $pksmitradata->status ?? null,

				'created_at' => $pksmitradata->created_at,
				'updated_at' => $pksmitradata->updated_at,
			];
		}
		return response()->json($result);
	}
}
