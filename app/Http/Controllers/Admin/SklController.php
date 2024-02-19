<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PullRiph;
use App\Models\Pengajuan;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;
use Yajra\DataTables\Facades\DataTables;

class SklController extends Controller
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
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Skl  $skl
	 * @return \Illuminate\Http\Response
	 */
	public function show(Skl $skl)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Skl  $skl
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Skl $skl)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Skl  $skl
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Skl $skl)
	{
		//
	}

	public function destroy(Skl $skl)
	{
		//
	}
}
