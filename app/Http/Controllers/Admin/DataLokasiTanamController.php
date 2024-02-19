<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AjuVerifProduksi;
use App\Models\AjuVerifTanam;
use App\Models\Lokasi;
use App\Models\MasterAnggota;
use App\Models\MasterPoktan;
use App\Models\PullRiph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DataLokasiTanamController extends Controller
{
	public function lokasiTanamByCommitment($id)
	{
		$currentRoute = Route::current()->getName();
		$verifikasi = null; // Initialize the variable

		if ($currentRoute === 'verification.tanam.check' || $currentRoute === 'verification.produksi.check' || 'verification.skl.check') {
			if ($currentRoute === 'verification.tanam.check') {
				$verifikasi = AjuVerifTanam::findOrFail($id);
			} elseif ($currentRoute === 'verification.produksi.check') {
				$verifikasi = AjuVerifProduksi::findOrFail($id);
			}
		}

		// Initialize $query here
		$query = Lokasi::query();

		if ($verifikasi) {
			$query->where('no_ijin', $verifikasi->no_ijin)
				->with('masterkelompok', 'masteranggota')
				->select('id', 'npwp', 'no_ijin', 'poktan_id', 'anggota_id', 'nama_lokasi', 'luas_tanam', 'volume');
		}

		$lokasis = $query->get()->map(function ($lokasi) {
			$poktan = MasterPoktan::where('id', $lokasi->poktan_id)->value('nama_kelompok');
			$anggota = MasterAnggota::where('id', $lokasi->anggota_id)->value('nama_petani');
			$noIjin = str_replace(['/', '.', '-'], '', $lokasi->no_ijin);
			$showRoute = route('verification.tanam.lokasicheck', [
				'noIjin' => $noIjin,
				'anggota_id' => $lokasi->anggota_id
			]);
			return [
				'idPks'			=> $lokasi->id,
				'npwp'			=> $lokasi->npwp,
				'no_ijin'		=> $lokasi->no_ijin,
				'poktan_id'		=> $lokasi->poktan_id,
				'poktan'		=> $poktan,
				'anggota'		=> $anggota,
				'nama_lokasi'	=> $lokasi->nama_lokasi,
				'luas_tanam'	=> $lokasi->luas_tanam,
				'volume'		=> $lokasi->volume,
				'show'			=> $showRoute,
			];
		});

		$data = [
			'lokasis' => $lokasis,
		];
		return response()->json($data);
	}

	public function listLokasi($id)
	{
		$commitment = PullRiph::find($id);
		$verifikasi = AjuVerifTanam::where('no_ijin', $commitment->no_ijin)->first();
		$query = Lokasi::where('no_ijin', $commitment->no_ijin)
			->where('polygon', '!=', null)
			->with('masterkelompok', 'masteranggota')
			->select('id', 'npwp', 'no_ijin', 'poktan_id', 'anggota_id', 'nama_lokasi', 'luas_tanam', 'volume');

		$lokasis = $query->get()->map(function ($lokasi) {
			$poktan = MasterPoktan::where('id', $lokasi->poktan_id)->value('nama_kelompok');
			$anggota = MasterAnggota::where('id', $lokasi->anggota_id)->value('nama_petani');
			$noIjin = str_replace(['/', '.', '-'], '', $lokasi->no_ijin);
			$showRoute = route('verification.lokasitanam.show', [
				'noIjin' => $noIjin,
				'anggota_id' => $lokasi->anggota_id
			]);
			return [
				'idPks'			=> $lokasi->id,
				'npwp'			=> $lokasi->npwp,
				'no_ijin'		=> $lokasi->no_ijin,
				'poktan_id'		=> $lokasi->poktan_id,
				'poktan'		=> $poktan,
				'anggota'		=> $anggota,
				'nama_lokasi'	=> $lokasi->nama_lokasi,
				'luas_tanam'	=> $lokasi->luas_tanam,
				'volume'		=> $lokasi->volume,
				'show'			=> $showRoute,
			];
		});
		$data = [
			'lokasis' => $lokasis,
		];
		return response()->json($data);
	}

	public function listLokasiTanamProduksi($id)
	{

		$commitment = PullRiph::find($id);
		$verifikasi = AjuVerifProduksi::where('no_ijin', $commitment->no_ijin)->first();
		$query = Lokasi::where('no_ijin', $commitment->no_ijin)
			// ->where('polygon', '!=', null)
			->with('masterkelompok', 'masteranggota')
			->select('id', 'npwp', 'no_ijin', 'poktan_id', 'anggota_id', 'nama_lokasi', 'luas_tanam', 'volume');

		$lokasis = $query->get()->map(function ($lokasi) {
			$poktan = MasterPoktan::where('id', $lokasi->poktan_id)->value('nama_kelompok');
			$anggota = MasterAnggota::where('id', $lokasi->anggota_id)->value('nama_petani');
			$noIjin = str_replace(['/', '.', '-'], '', $lokasi->no_ijin);
			$showRoute = route('verification.tanam.lokasicheck', [
				'noIjin' => $noIjin,
				'anggota_id' => $lokasi->anggota_id
			]);
			return [
				'idPks'			=> $lokasi->id,
				'npwp'			=> $lokasi->npwp,
				'no_ijin'		=> $lokasi->no_ijin,
				'poktan_id'		=> $lokasi->poktan_id,
				'poktan'		=> $poktan,
				'anggota'		=> $anggota,
				'nama_lokasi'	=> $lokasi->nama_lokasi,
				'luas_tanam'	=> $lokasi->luas_tanam,
				'volume'		=> $lokasi->volume,
				'show'			=> $showRoute,
			];
		});
		$data = [
			'lokasis' => $lokasis,
		];
		return response()->json($data);
	}
}
