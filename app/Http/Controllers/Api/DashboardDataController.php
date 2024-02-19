<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PullRiph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\RiphAdmin;

class DashboardDataController extends Controller
{
	public function monitoringDataByYear($periodetahun)
	{
		// Retrieve all data from RiphAdmin based on the selected 'periode'
		$riphData = RiphAdmin::where('periode', $periodetahun)->get();
		$commitments = PullRiph::where('periodetahun', $periodetahun)->get();

		$jumlahImportir = $riphData->sum('jumlah_importir');
		$v_pengajuan_import = $riphData->sum('v_pengajuan_import');
		$v_beban_tanam = $riphData->sum('v_beban_tanam');
		$v_beban_produksi = $riphData->sum('v_beban_produksi');
		$volume_import = $commitments->sum('volume_riph');
		$company = $commitments->count('no_ijin');

		$total_luastanam = 0;
		$total_volume = 0;

		foreach ($commitments as $commitment) {
			foreach ($commitment->lokasi as $lokasi) {
				if (!empty($commitment->status)) {
					$total_luastanam += $lokasi->luas_tanam;
					$total_volume += $lokasi->volume;
				}
			}
		}

		$data = [
			'jumlah_importir'		=> $jumlahImportir,
			'v_pengajuan_import'	=> $v_pengajuan_import,
			'v_beban_tanam'			=> $v_beban_tanam,
			'v_beban_produksi'		=> $v_beban_produksi,
			'company'				=> $company,
			'volume_import'			=> $volume_import,
			'total_luastanam'		=> $total_luastanam,
			'total_volume'			=> $total_volume,
		];
		return response()->json($data);
	}
}
