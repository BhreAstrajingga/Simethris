<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommitmentBackdate;
use App\Models\MasterPenangkar;
use App\Models\PenangkarMitra;

class PenangkarMitraController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$penangkarmitra = new PenangkarMitra();

		$penangkarmitra->penangkar_id = $request->input('penangkar_id');
		$penangkarmitra->commitmentbackdate_id = $request->input('commitmentbackdate_id');
		$penangkarmitra->no_ijin = $request->input('no_ijin');
		$penangkarmitra->varietas = $request->input('varietas');
		$penangkarmitra->ketersediaan = $request->input('ketersediaan');

		// dd($penangkarmitra);
		$penangkarmitra->save();
		return redirect()->route('admin.task.commitments.show', $penangkarmitra->commitmentbackdate_id)->with('success', 'Anggota saved successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
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
		//
		$penangkarmitra = PenangkarMitra::find($id);
		$penangkarmitra->penangkar_id = $request->input('penangkar_id');
		$penangkarmitra->commitmentbackdate_id = $request->input('commitmentbackdate_id');
		$penangkarmitra->no_ijin = $request->input('no_ijin');
		$penangkarmitra->varietas = $request->input('varietas');
		$penangkarmitra->ketersediaan = $request->input('ketersediaan');
		// dd($penangkarmitra);
		$penangkarmitra->save();
		return redirect()->route('admin.task.commitments.show', $penangkarmitra->commitmentbackdate_id)->with('success', 'Data Penangkar updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$penangkarmitra = PenangkarMitra::withTrashed()->findOrFail($id);
		// $commitments->childrelatedmodel()->delete(); //delete related object here
		$penangkarmitra->delete();
		return redirect()->route('admin.task.commitments.show', $penangkarmitra->commitmentbackdate_id)->with('success', 'Data Penangkar deleted successfully');
	}
}
