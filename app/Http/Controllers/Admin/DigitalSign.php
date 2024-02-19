<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DigitalSign extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// dd('DIGITAL SIGN');
		$module_name = 'DIGITAL SIGN';
		$page_title = 'Digital Sign';
		$page_heading = 'Tandatangan Digital ';
		$heading_class = 'fal fa-qrcode';

		return view('admin.digitalsign.index', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
	}

	public function saveQrImage(Request $request)
	{
		$imageData = $request->input('imageData');
		$imgPath = 'uploads/qrcode/';
		$filename = 'qr_code.png';

		// Hapus header data gambar (misalnya, "data:image/png;base64,")
		$base64Data = substr($imageData, strpos($imageData, ',') + 1);

		// Konversi base64 ke binary
		$imageBinary = base64_decode($base64Data);

		// Simpan gambar ke direktori publik
		Storage::disk('public')->putFileAs($imgPath, $imageBinary, $filename);

		return response()->json(['filePath' => $imgPath . $filename]);
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
		//
	}
}
