<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterAnggota;
use App\Models\MasterKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaPoktanController extends Controller
{
	public function index(Request $request)
	{
		//
	}

	public function addanggota($id)
	{
		$module_name = 'Anggota Poktan';
		$page_title = 'Tambah Anggota';
		$page_heading = 'Tambah Anggota';
		$heading_class = 'fa fa-user-plus';

		//load poktan for current id that has anggota
		$poktan = MasterKelompok::with('masteranggota')->findOrFail($id);

		return view('v2.anggota.create', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'poktan'));
	}

	public function store(Request $request)
	{
		$anggota = new MasterAnggota();
		$anggota->npwp = Auth::user()->data_user->npwp_company;
		$anggota->master_kelompok_id = $request->input('master_kelompok_id');
		$anggota->nama_petani = $request->input('nama_petani');
		$anggota->nik_petani = $request->input('nik_petani');
		$anggota->luas_lahan = $request->input('luas_lahan');

		// dd($request->all());
		$anggota->save();

		return redirect()->route('admin.task.masterpoktan.show', $anggota->master_kelompok_id)->with('success', 'Anggota saved successfully');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
		$module_name = 'Anggota Poktan';
		$page_title = 'Ubah Data';
		$page_heading = 'Ubah Data Anggota';
		$heading_class = 'fa fa-user-edit';

		$anggota = MasterAnggota::findOrFail($id);
		return view('v2.anggota.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'anggota'));
	}

	public function update(Request $request, $id)
	{
		$anggota = MasterAnggota::find($id);
		$anggota->master_kelompok_id = $request->input('master_kelompok_id');
		$anggota->nama_petani = $request->input('nama_petani');
		$anggota->nik_petani = $request->input('nik_petani');
		$anggota->luas_lahan = $request->input('luas_lahan');
		$anggota->save();

		return redirect()->route('admin.task.masterpoktan.show', $anggota->master_kelompok_id)->with('success', 'Data Anggota Updated successfully');
	}

	public function destroy($id)
	{
		$anggota = MasterAnggota::findOrFail($id);
		$anggota->delete();

		return redirect()->route('admin.task.masterpoktan.show', $anggota->master_kelompok_id)->with('success', 'Data Anggota deleted successfully');
	}
}
