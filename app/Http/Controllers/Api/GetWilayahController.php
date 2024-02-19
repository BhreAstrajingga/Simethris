<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SimeviTrait;
use Illuminate\Http\Request;
use App\Models\MasterProvinsi;
use App\Models\MasterKabupaten;
use App\Models\MasterKecamatan;
use App\Models\MasterDesa;

class GetWilayahController extends Controller
{
	use SimeviTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getAllProvinsi()
	{
		$provinsis = $this->getAPIProvinsiAll();
		$result = array_map(function ($provinsi) {
			return [
				'provinsi_id' => $provinsi['kd_prop'],
				'nama' => $provinsi['nm_prop'],
			];
		}, $provinsis['data']);

		// dd($result);
		return response()->json($result);
	}


	public function getKabupatenByProvinsi($provinsiId)
	{
		$kabupatens = $this->getAPIKabupatenAll();
		$result = [];

		foreach ($kabupatens['data'] as $kabupaten) {
			if ($kabupaten['kd_prop_id'] == $provinsiId) {
				$result[] = [
					'provinsi_id' => $kabupaten['kd_prop_id'] ?? null,
					'kabupaten_id' => $kabupaten['kd_kab'] ?? null,
					'nama_kab' => $kabupaten['nama_kab'] ?? null,
				];
			}
		}

		return response()->json($result);
	}


	public function getKecamatanByKabupaten($kabupatenId)
	{
		$kecamatans = $this->getAPIKecamatanAll();
		$result = [];

		foreach ($kecamatans['data'] as $kecamatan) {
			if ($kecamatan['kd_kab_id'] == $kabupatenId) {
				$result[] = [
					'kabupaten_id' => $kecamatan['kd_kab_id'],
					'kecamatan_id' => $kecamatan['kd_kec'],
					'nama_kecamatan' => $kecamatan['nm_kec'],
				];
			}
		}
		return response()->json($result);
	}

	public function getDesaBykecamatan($kecamatanId)
	{
		$desas = $this->getAPIDesaKec($kecamatanId);
		$result = [];

		foreach ($desas['data'] as $desa) {
			if ($desa['kd_kec_id'] == $kecamatanId) {
				$result[] = [
					'kecamatan_id' => $desa['kd_kec_id'],
					'kelurahan_id' => $desa['kd_desa'],
					'nama_desa' => $desa['nm_desa'],
				];
			}
		}

		return response()->json($result);
	}
}
