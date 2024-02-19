<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Varietas;

class VarietasController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Varietas';
		$page_title = 'Daftar Varietas';
		$page_heading = 'Daftar Varietas';
		$heading_class = 'fa fa-seedling';

		$varieties = Varietas::all();

		return view('admin.varietas.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'varieties'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Varietas';
		$page_title = 'Tambah Varietas';
		$page_heading = 'Tambah Varietas';
		$heading_class = 'fa fa-seedling';

		$varieties = Varietas::all();

		return view('admin.varietas.create', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'varieties'));
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
		$variety = new Varietas();
		$variety->kode_komoditas = $request->input('kode_komoditas');
		$variety->nama_komoditas = $request->input('nama_komoditas');
		$variety->kode_varietas = $request->input('kode_varietas');
		$variety->nama_varietas = $request->input('nama_varietas');

		$variety->save();
		return redirect()->route('admin.varietas')->with('success', 'Data Varietas berhasil ditambahkan');
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

		$module_name = 'Varietas';
		$page_title = 'Ubah Data';
		$page_heading = 'Ubah Data Varietas';
		$heading_class = 'fa fa-user-tie';

		$variety = Varietas::findOrfail($id);

		return view('admin.varietas.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'variety'));
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
		$variety = Varietas::findOrFail($id);
		$variety->kode_komoditas = $request->input('kode_komoditas');
		$variety->nama_komoditas = $request->input('nama_komoditas');
		$variety->kode_varietas = $request->input('kode_varietas');
		$variety->nama_varietas = $request->input('nama_varietas');

		$variety->save();
		return redirect()->route('admin.varietas')->with('success', 'Data Varietas berhasil ditambahkan');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');
		$variety = Varietas::findOrFail($id);
		$variety->delete();
		return redirect()->route('admin.varietas')->with('success', 'Varietas berhasil dihapus');
	}
}
