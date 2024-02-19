<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Models\DataAdministrator;

class AdminProfileController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module_name = 'Profile';
		$page_title = 'Profile Pengguna';
		$page_heading = 'Profile Pengguna';
		$heading_class = 'fa fa-user-tie';

		$user = Auth::user();
		$data_admin = DataAdministrator::where('user_id', $user->id)->first() ?? new DataAdministrator();
		return view('admin.adminprofile.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'data_admin', 'user'));
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
		$user = Auth::user();
		$data = [
			'nama' => $user->name,
			'nip' => $request->input('nip'),
			'jabatan' => $request->input('jabatan'),
			'digital_sign' => $request->input('digital_sign'),
		];

		$dataadmin = DataAdministrator::updateOrCreate(
			['user_id' => $user->id],
			$data
		);

		if ($request->hasFile('sign_img')) {
			$file = $request->file('sign_img');

			// Validasi ekstensi file
			$allowedExtensions = ['jpg', 'png']; // Ekstensi yang diperbolehkan
			$fileExtension = $file->getClientOriginalExtension();

			if (in_array($fileExtension, $allowedExtensions)) {
				$filename = 'ttd_' . $user->id . '.' . $fileExtension;
				$file->storeAs('uploads/dataadmin/', $filename, 'public');
				$dataadmin->sign_img = $filename;
			} else {
				return redirect()->back()->with('error', 'Berkas yang diunggah harus memiliki ekstensi .jpg atau .png.');
			}
		}

		// dd($dataadmin);
		$dataadmin->save();
		return redirect()->back()->with('success', 'Berhasil menyimpan data Profile Anda.');
	}
}
