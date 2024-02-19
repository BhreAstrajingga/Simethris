<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skl;
use App\Models\SklOlder;
use App\Models\PullRiph;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class UserSklController extends Controller
{
	public function index()
	{
		$module_name = 'SKL';
		$page_title = 'Daftar SKL';
		$page_heading = 'Daftar SKL Terbit';
		$heading_class = 'fa fa-award';

		$user = Auth::user();
		$skls = Skl::where('npwp', $user->data_user->npwp_company)
			->get();

		return view('admin.skluser.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'skls'));
	}

	public function show($id)
	{
		$module_name = 'SKL';
		$page_title = 'Data SKL';
		$page_heading = 'Data SKL Terbit';
		$heading_class = 'fal fa-file-certificate';

		$skl = Skl::find($id);

		return view('admin.verifikasi.skl.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'skl'));
	}

	public function print($id)
	{
		$module_name = 'SKL';
		$page_title = 'Surat Keterangan Lunas';
		$page_heading = 'SKL Diterbitkan';
		$heading_class = 'fa fa-award';

		$skl = Skl::findOrfail($id);
		$pengajuan = Pengajuan::find($skl->pengajuan_id);
		$commitment = PullRiph::where('no_ijin', $skl->no_ijin)->first();
		$pejabat = User::find($skl->approved_by);
		$wajib_tanam = $commitment->volume_riph * 0.05 / 6;
		$luas_verif = $pengajuan->luas_verif;
		$wajib_produksi = $commitment->volume_riph * 0.05;
		$volume_verif = $pengajuan->volume_verif;
		$total_luas = $commitment->lokasi->sum('luas_tanam');
		$total_volume = $commitment->lokasi->sum('volume');
		$data = [
			'Perusahaan' => $commitment->datauser->company_name,
			'No. RIPH' => $commitment->no_ijin,
			'Status' => 'LUNAS',
		];

		// $QrCode = QrCode::size(70)->generate(json_encode($data));
		$QrCode = QrCode::size(70)->generate($data['Perusahaan'] . ', ' . $data['No. RIPH'] . ', ' . $data['Status']);

		return view('admin.verifikasi.skl.skl', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'skl', 'pengajuan', 'commitment', 'pejabat', 'QrCode', 'wajib_tanam', 'wajib_produksi', 'luas_verif', 'volume_verif', 'total_luas', 'total_volume'));
	}

	public function oldindex()
	{
		abort_if(Gate::denies('old_skl_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'SKL';
		$page_title = 'Old SKL';
		$page_heading = 'Daftar SKL Lama';
		$heading_class = 'fa fa-file-certificate';

		$oldskls = SklOlder::all();

		return view('admin.oldskl.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'oldskls'));
	}

	public function showold($id)
	{
		abort_if(Gate::denies('old_skl_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'SKL';
		$page_title = 'Old SKL';
		$page_heading = 'Rekam Data SKL Lama';
		$heading_class = 'fa fa-file-certificate';

		$oldskl = SklOlder::find($id);
		// dd($oldskl);

		return view('admin.oldskl.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'oldskl'));
	}
}
