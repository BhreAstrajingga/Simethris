<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commitmentbackdate;
use App\Models\MasterPenangkar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterPenangkarController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module_name = 'Penangkar'; //usually Model Name
		$page_title = 'Penangkar'; //this will be the page title for browser
		$page_heading = 'Master Penangkar'; //this will be the page heading.
		$heading_class = 'fal fa-seedling'; //this will be the leading icon for the page heading
		$npwp = Auth::user()->data_user->npwp_company;
		$masterpenangkars = MasterPenangkar::where('npwp', $npwp)->get(); //this has no relationship with any table, everyone can add or view the data.

		// Trim the alamat field in each record
		foreach ($masterpenangkars as $penangkar) {
			$penangkar->alamat = trim($penangkar->alamat);
		}

		return view('admin.penangkar.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterpenangkars'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		$module_name = 'Master Penangkar'; //usually Model Name
		$page_title = 'Tambah Data'; //this will be the page title for browser
		$page_heading = 'Tambah Data Penangkar'; //this will be the page heading.
		$heading_class = 'fal fa-seedling'; //this will be the leading icon for the page heading

		return view('admin.penangkar.create', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$masterpenangkar = new MasterPenangkar();
		$masterpenangkar->npwp = Auth::user()->data_user->npwp_company;
		$masterpenangkar->nama_lembaga = $request->input('nama_lembaga');
		$masterpenangkar->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkar->hp_pimpinan = $request->input('hp_pimpinan');
		$masterpenangkar->alamat = $request->input('alamat');
		$masterpenangkar->provinsi_id = $request->input('provinsi_id');
		$masterpenangkar->kabupaten_id = $request->input('kabupaten_id');
		$masterpenangkar->kecamatan_id = $request->input('kecamatan_id');
		$masterpenangkar->kelurahan_id = $request->input('kelurahan_id');

		// dd($request->all());
		$masterpenangkar->save();

		return redirect()->route('admin.task.penangkar')->with('success', 'Category saved successfully');
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
		$module_name = 'Master Penangkar'; //usually Model Name
		$page_title = 'Ubah Data'; //this will be the page title for browser
		$page_heading = 'Ubah Data Penangkar'; //this will be the page heading.
		$heading_class = 'fal fa-edit'; //this will be the leading icon for the page heading

		$masterpenangkar = MasterPenangkar::findOrFail($id);

		return view('admin.masterpenangkar.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterpenangkar'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$masterpenangkar = MasterPenangkar::find($id);
		$masterpenangkar->npwp = Auth::user()->data_user->npwp_company;
		$masterpenangkar->nama_lembaga = $request->input('nama_lembaga');
		$masterpenangkar->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkar->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkar->hp_pimpinan = $request->input('hp_pimpinan');
		$masterpenangkar->alamat = $request->input('alamat');
		$masterpenangkar->provinsi_id = $request->input('provinsi_id');
		$masterpenangkar->kabupaten_id = $request->input('kabupaten_id');
		$masterpenangkar->kecamatan_id = $request->input('kecamatan_id');
		$masterpenangkar->kelurahan_id = $request->input('kelurahan_id');
		$masterpenangkar->save();

		return redirect()->route('admin.task.masterpenangkar.index')->with('success', 'Category saved successfully');
	}


	public function destroy($id)
	{
		$masterpenangkars = MasterPenangkar::withTrashed()->findOrFail($id);
		foreach ($masterpenangkars->penangkarmitra as $penangkarmitra) {
			$penangkarmitra->delete();
		}
		$masterpenangkars->delete();

		return redirect()->route('admin.task.masterpenangkar.index')->with('success', 'Data Penangkar deleted successfully');
	}
}
