<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AjuVerifProduksi;
use App\Models\DataRealisasi;
use App\Models\Lokasi;
use App\Models\Pks;
use App\Models\PullRiph;
use Illuminate\Http\Request;

class TestController extends Controller
{
	public function index($id)
	{
		$pengajuan = AjuVerifProduksi::find($id);
		$commitment = PullRiph::where('no_ijin', $pengajuan->no_ijin)->first();
		$pkss = Pks::where('no_ijin', $pengajuan->no_ijin)->get();
		$anggota = Lokasi::where('no_ijin', $pengajuan->no_ijin)->get();

		$lokasiIds = $anggota->pluck('id')->toArray(); // Mengambil ID lokasi

		$dataRealisasis = DataRealisasi::whereIn('lokasi_id', $lokasiIds)->get(); // Menggunakan IN untuk mengambil data realisasi

		$result = [];

		if ($commitment) {
			$commitmentData = [
				'mulai_ijin' => $commitment->tgl_ijin,
				'akhir_ijin' => $commitment->tgl_akhir,
				'PKS' => [],
			];

			foreach ($commitment->pks as $pks) {
				$pksData = [
					'no_perjanjian' => $pks->no_perjanjian,
					'mulai_perjanjian' => $pks->tgl_perjanjian_start,
					'akhir_perjanjian' => $pks->tgl_perjanjian_end,
					'Tanam' => [],
				];

				foreach ($dataRealisasis as $realisasi) {
					if ($realisasi->pks_id === $pks->id) {
						$pksData['Tanam'][] = [
							'nama_lokasi' => $realisasi->nama_lokasi,
							'mulai_tanam' => $realisasi->mulai_tanam,
							'akhir_tanam' => $realisasi->akhir_tanam,
							'mulai_panen' => $realisasi->mulai_panen,
							'akhir_panen' => $realisasi->akhir_panen,
						];
					}
				}

				$commitmentData['PKS'][] = $pksData;
			}

			$result[] = ['Komitmen' => $commitmentData];
		}

		return response()->json($result);
	}
}
