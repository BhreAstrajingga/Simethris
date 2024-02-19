<?php

namespace App\Http\Controllers\Admin;

use App\Models\DaftarPejabat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PejabatController extends Controller
{
	/**
	 * Menampilkan daftar pejabat penandatangan SKL.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Daftar Pejabat';
		$page_title = 'Daftar Pejabat';
		$page_heading = 'Daftar Pejabat';
		$heading_class = 'fa fa-user-tie';

		$pejabats = DaftarPejabat::all();

		return view('admin.pejabats.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pejabats'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Daftar Pejabat';
		$page_title = 'Pejabat';
		$page_heading = 'Tambah Pejabat';
		$heading_class = 'fa fa-user-tie';

		$pejabats = DaftarPejabat::all();

		return view('admin.pejabats.create', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pejabats'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');

		$newpejabat = new DaftarPejabat();
		$newpejabat->nama = $request->input('nama');
		$newpejabat->nip = $request->input('nip');

		// Check if there are any existing rows
		$existingRows = DaftarPejabat::count();

		if ($existingRows == 0) {
			$newpejabat->status = '1'; // Set status to 1 for the first record
		} else {
			$newpejabat->status = '0'; // Set status to 0 for subsequent records
		}

		$newpejabat->save();

		return redirect()->route('admin.pejabats')->with('success', 'Data Pejabat berhasil ditambahkan');
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
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'Pejabat';
		$page_title = 'Ubah Data';
		$page_heading = 'Ubah Data Pejabat';
		$heading_class = 'fa fa-user-tie';

		$pejabat = DaftarPejabat::findOrfail($id);

		return view('admin.pejabats.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pejabat'));
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
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');

		$pejabat = DaftarPejabat::findOrFail($id);
		$pejabat->nama = $request->input('nama');
		$pejabat->nip = $request->input('nip');

		$pejabat->save();

		return redirect()->route('admin.pejabats')->with('success', 'Data Pejabat berhasil diubah');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$pejabat = DaftarPejabat::findOrFail($id);
		$pejabat->delete();
	}

	public function activate($id)
	{
		$pejabat = DaftarPejabat::findOrFail($id);

		// Set the status of all records to 0
		DaftarPejabat::where('status', 1)->update(['status' => 0]);

		// Set the status of the current record to 1
		$pejabat->status = 1;
		$pejabat->save();

		return redirect()->route('admin.pejabats')->with('success', 'Pejabat berhasil diaktifkan');
	}
}
