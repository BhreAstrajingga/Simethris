<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaMitra;
use App\Models\Commitment;
use App\Models\Commitmentbackdate;
use App\Models\PenangkarMitra;
use App\Models\PengajuanV2;
use App\Models\PksMitra;
use App\Models\User;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealisasiController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$anggotaMitras = AnggotaMitra::with('pksMitra')->get();
		$pksMitras = PksMitra::with(['commitmentbackdate', 'anggotaMitras'])->get();
		$commitmentbackdates = Commitmentbackdate::with('user')->get();

		return response()->json([
			'commitment_backdates' => $commitmentbackdates->map(function ($commitmentbackdate) use ($pksMitras, $anggotaMitras) {
				return [
					'id' => $commitmentbackdate->id,
					'user_id' => $commitmentbackdate->user_id,
					'date' => $commitmentbackdate->updated_at,
					'pks_mitras' => $pksMitras->where('commitmentbackdate_id', $commitmentbackdate->id)->map(function ($pksMitra) use ($anggotaMitras) {
						return [
							'id' => $pksMitra->id,
							'master_kelompok_id' => $pksMitra->master_kelompok_id,
							'commitmentbackdate_id' => $pksMitra->commitmentbackdate_id,
							'anggota_mitras' => $anggotaMitras->where('pks_mitra_id', $pksMitra->id)->map(function ($anggotaMitra) {
								return [
									'id' => $anggotaMitra->id,
									'master_anggota_id' => $anggotaMitra->master_anggota_id,
									'pks_mitra_id' => $anggotaMitra->pks_mitra_id,
									'latitude' => $anggotaMitra->latitude,
									'longitude' => $anggotaMitra->longitude,
									'polygon' => $anggotaMitra->polygon,
									'luas_kira' => $anggotaMitra->luas_kira,
								];
							})
						];
					})
				];
			})
		]);
	}

	public function getRealisasibyYear($periodeTahun)
	{
		$currentUser = Auth::user();
		$users = User::where('id', $currentUser->id)->with(['commitmentbackdate' => function ($query) use ($periodeTahun) {
			$query->where('periodetahun', $periodeTahun);
		}, 'commitmentbackdate.pksmitra.anggotamitras'])->get();

		$results = [];

		foreach ($users as $user) {
			if ($user->commitmentbackdate->count() > 0) {
				$total_luastanam = $user->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('luas_tanam');

				$total_volume = $user->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('volume');

				$total_anggotamitras = $user->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->count();

				$total_import = $user->commitmentbackdate->sum('volume_riph');

				$total_poktan = $user->commitmentbackdate->flatMap->pksmitra->countBy('master_kelompok_id')->count();

				$count_pksmitra = $user->commitmentbackdate->flatMap->pksmitra->count();

				$VerifTanam = PengajuanV2::whereIn('commitmentbackdate_id', $user->commitmentbackdate->pluck('id'))
					->where('status', '6')
					->sum('luas_verif');
				$VerifProduksi = PengajuanV2::whereIn('commitmentbackdate_id', $user->commitmentbackdate->pluck('id'))
					->where('status', '6')
					->sum('volume_verif');

				$onlinestatus = PengajuanV2::whereIn('commitmentbackdate_id', $user->commitmentbackdate->pluck('id'));
				$onfarmstatus = PengajuanV2::whereIn('commitmentbackdate_id', $user->commitmentbackdate->pluck('id'));

				$results[] = [
					'id' => $user->id,
					// 'periode_tahun' => $periodeTahun,
					'total_import' => $total_import,
					'total_luastanam' => $total_luastanam,
					'total_volume' => $total_volume,
					'total_poktan' => $total_poktan,
					'count_pksmitra' => $count_pksmitra,
					'total_anggotamitras' => $total_anggotamitras,
					'VerifTanam' => $VerifTanam,
					'VerifProduksi' => $VerifProduksi,
				];
			}
		}

		return response()->json($results);
	}

	public function getRealisasiAll()
	{
		$user = Auth::user();
		$users = User::where('id', $user->id)
			->with(['commitmentbackdate.pksmitra.anggotamitras'])
			->get();
		$results = [];

		foreach ($users as $u) {
			if ($u->commitmentbackdate) {
				$total_luastanam = $u->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('luas_tanam');

				$total_volume = $u->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('volume');

				$total_anggotamitras = $u->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->count();
				$total_import = $user->commitmentbackdate->sum('volume_riph');

				$total_poktan = $u->commitmentbackdate->flatMap->pksmitra->countBy('master_kelompok_id')->count();

				$count_pksmitra = $u->commitmentbackdate->flatMap->pksmitra->count();

				$VerifTanam = PengajuanV2::whereIn('commitmentbackdate_id', $user->commitmentbackdate->pluck('id'))
					->where('status', '6')
					->sum('luas_verif');
				$VerifProduksi = PengajuanV2::whereIn('commitmentbackdate_id', $user->commitmentbackdate->pluck('id'))
					->where('status', '6')
					->sum('volume_verif');


				$results[] = [
					'id' => $u->id,
					'total_import' => $total_import,
					'total_luastanam' => $total_luastanam,
					'total_volume' => $total_volume,
					'total_poktan' => $total_poktan,
					'count_pksmitra' => $count_pksmitra,
					'total_anggotamitras' => $total_anggotamitras,
					'VerifTanam' => $VerifTanam,
					'VerifProduksi' => $VerifProduksi,
				];
			}
		}

		return response()->json($results);
	}

	public function getAPIVerifiedByYear($periodeTahun)
	{
		$user = Auth::user();
		$commitments = CommitmentBackdate::where('user_id', $user->id)
			->with(['pengajuanV2', 'sklV2'])
			->whereHas('pengajuanV2', function ($query) use ($periodeTahun) {
				$query->where('periodetahun', $periodeTahun);
			})
			->get();

		// Retrieve additional related models
		$pengajuanV2s = [];
		$sklV2s = [];

		foreach ($commitments as $commitment) {
			$pengajuanV2s = array_merge($pengajuanV2s, $commitment->pengajuanV2->toArray());
			$sklV2s[] = $commitment->sklV2 ? $commitment->sklV2->toArray() : null;
		}

		$combinedData = [
			'user' => $user,
			'commitments' => $commitments,
			'pengajuanV2s' => $pengajuanV2s,
			'sklV2s' => $sklV2s,
		];

		// Return the combined data as JSON response
		return response()->json($combinedData);
	}


	public function getAPIVerifiedAll()
	{
		$user = Auth::user();
		$commitments = CommitmentBackdate::where('user_id', $user->id)
			->with(['pengajuanV2', 'sklV2'])
			->get();

		// Retrieve additional related models
		$pengajuanV2s = [];
		$sklV2s = [];

		foreach ($commitments as $commitment) {
			$pengajuanV2s = array_merge($pengajuanV2s, $commitment->pengajuanV2->toArray());
			$sklV2s[] = $commitment->sklV2 ? $commitment->sklV2->toArray() : null;
		}

		$combinedData = [
			'user' => $user,
			'commitments' => $commitments,
			'pengajuanV2s' => $pengajuanV2s,
			'sklV2s' => $sklV2s,
		];

		// Return the combined data as JSON response
		return response()->json($combinedData);
	}

	public function MonitoringDataByYear($periodeTahun)
	{
		$commitments = CommitmentBackdate::where('periodetahun', $periodeTahun)->get();
		$ajucommit = $commitments->filter(function ($commitment) {
			return $commitment->status == '1';
		})->count();


		// dd($ajucommit);
		$total_commit = $commitments->count();

		$total_import = $commitments->sum('volume_riph');

		$total_luastanam = 0;
		$total_volume = 0;
		$luasverif = 0;
		$volumeverif = 0;
		$pengajuanV2s = [];
		$sklV2s = [];
		foreach ($commitments as $commitment) {
			foreach ($commitment->anggotamitras as $anggotamitra) {
				if (!empty($commitment->status)) {
					$total_luastanam += $anggotamitra->luas_tanam;
					$total_volume += $anggotamitra->volume;
				}
			}

			foreach ($commitment->pengajuanV2->where('status', '6') as $pengajuan) {
				$luasverif += $pengajuan->luas_verif;
				$volumeverif += $pengajuan->volume_verif;
			}
			$pengajuanV2s = array_merge($pengajuanV2s, $commitment->pengajuanV2->map(function ($pengajuan) {
				return [
					'no_pengajuan' => $pengajuan->no_pengajuan,
					'commitment' => [
						'user' => [
							'data_user' => [
								'company_name' => $pengajuan->commitmentbackdate->user->data_user->company_name,
							],
						],
					],
					'no_ijin' => $pengajuan->commitmentbackdate->no_ijin,

					'status' => $pengajuan->status,
					'onlinestatus' => $pengajuan->onlinestatus,
					'onfarmstatus' => $pengajuan->onfarmstatus,
				];
			})->toArray());

			$sklV2s[] = $commitment->sklV2 ? $commitment->sklV2->toArray() : null;
		}
		$inverifcount = $commitments->filter(function ($commitment) {
			return $commitment->pengajuanV2->where('onlinestatus', '1')->where('onfarmstatus', '')->count() > 0;
		})->count();

		$verifiedcount = $commitments->filter(function ($commitment) {
			return $commitment->pengajuanV2->where('onfarmstatus', '!=', '')->count() > 0;
		})->count();

		$lunas = $commitments->where('status', 6)->count();

		// Retrieve additional related models

		$data = [
			// 'commitments' => $commitments,
			'total_commit' => $total_commit,
			'ajucommit' => $ajucommit,
			'total_import' => $total_import,
			'total_luastanam' => $total_luastanam,
			'total_volume' => $total_volume,
			'luasverif' => $luasverif,
			'volumeverif' => $volumeverif,
			'pengajuanV2s' => $pengajuanV2s,
			// 'sklV2s' => $sklV2s,
			'inverifcount' => $inverifcount,
			'verifiedcount' => $verifiedcount,
			'lunas' => $lunas,
		];

		return response()->json($data);
	}


	public function MonitoringDataAll()
	{
		$commitments = CommitmentBackdate::all();
		$ajucommit = $commitments->filter(function ($commitment) {
			return $commitment->status == '1';
		})->count();
		// dd($commitments);
		$total_commit = $commitments->count();
		$total_import = $commitments->sum('volume_riph');

		$total_luastanam = 0;
		$total_volume = 0;
		$luasverif = 0;
		$volumeverif = 0;
		$pengajuanV2s = [];
		$sklV2s = [];

		foreach ($commitments as $commitment) {
			foreach ($commitment->anggotamitras as $anggotamitra) {
				$total_luastanam += $anggotamitra->luas_tanam;
				$total_volume += $anggotamitra->volume;

				// Perform additional operations with $luasTanam and $volume if needed
			}

			foreach ($commitment->pengajuanV2->where('status', '6') as $pengajuan) {
				$luasverif += $pengajuan->luas_verif;
				$volumeverif += $pengajuan->volume_verif;
			}
			$pengajuanV2s = array_merge($pengajuanV2s, $commitment->pengajuanV2->map(function ($pengajuan) {
				return [
					'no_pengajuan' => $pengajuan->no_pengajuan,
					'commitment' => [
						'user' => [
							'data_user' => [
								'company_name' => $pengajuan->commitmentbackdate->user->data_user->company_name,
							],
						],
					],
					'no_ijin' => $pengajuan->commitmentbackdate->no_ijin,
					'status' => $pengajuan->status,
					'onlinestatus' => $pengajuan->onlinestatus,
					'onfarmstatus' => $pengajuan->onfarmstatus,
				];
			})->toArray());
			$sklV2s[] = $commitment->sklV2 ? $commitment->sklV2->toArray() : null;
		}
		$inverifcount = $commitments->filter(function ($commitment) {
			return $commitment->pengajuanV2->where('onlinestatus', '1')->where('onfarmstatus', '')->count() > 0;
		})->count();

		$verifiedcount = $commitments->filter(function ($commitment) {
			return $commitment->pengajuanV2->where('onfarmstatus', '!=', '')->count() > 0;
		})->count();

		$lunas = $commitments->where('status', 6)->count();


		$data = [
			'commitments' => $commitments,
			'total_commit' => $total_commit,
			'ajucommit' => $ajucommit,
			'total_import' => $total_import,
			'total_luastanam' => $total_luastanam,
			'total_volume' => $total_volume,
			'luasverif' => $luasverif,
			'volumeverif' => $volumeverif,
			'pengajuanV2s' => $pengajuanV2s,
			// 'sklV2s' => $sklV2s,
			'inverifcount' => $inverifcount,
			'verifiedcount' => $verifiedcount,
			'lunas' => $lunas,
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//

	}
}
