<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterPenangkar;
use App\Models\PenangkarMitra;
use App\Models\PenangkarRiph;
use App\Models\PullRiph;
use Illuminate\Support\Facades\Auth;

class PenangkarRiphController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	public function mitra($id)
	{
		$module_name = 'Komitmen';
		$page_title = 'Penangkar';
		$page_heading = 'Penangkar Mitra';
		$heading_class = 'fa fa-seedling';

		$commitment = PullRiph::where('npwp', Auth::user()->data_user->npwp_company)
			->findOrFail($id);
		$masterpenangkars = MasterPenangkar::where('npwp', Auth::user()->data_user->npwp_company)
			->get();
		$mitras = $commitment->penangkar_riph;


		if (empty($commitment->status) || $commitment->status == 3 || $commitment->status == 5) {
			$disabled = false; // input di-enable
		} else {
			$disabled = true; // input di-disable
		}

		return view('admin.penangkar.mitra', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitment', 'masterpenangkars', 'mitras', 'commitment', 'disabled'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $id)
	{
		$commitment = PullRiph::where('npwp', Auth::user()->data_user->npwp_company)
			->findOrFail($id);

		$mitra = new PenangkarRiph();
		$mitra = PenangkarRiph::updateOrCreate(
			[
				'npwp' => $commitment->npwp,
				'commitment_id' => $commitment->id,
				'no_ijin' => $commitment->no_ijin,
				'penangkar_id' => $request->input('penangkar_id'),
			],
			[
				'varietas' => $request->input('varietas'),
				'ketersediaan' => $request->input('ketersediaan'),
			]
		);

		$mitra->save();
		return redirect()->route('admin.task.commitment.realisasi', $commitment->id)->with('message', 'Penangkar Mitra berhasil ditambahkan.');
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
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$penangkar = PenangkarRiph::findOrFail($id);
		$penangkar->delete();

		return back()->with('success', "Penangkar Mitra berhasil dihapus.");
	}
}
