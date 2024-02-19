<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SklOlder;
use App\Models\DataUser;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OldSklController extends Controller
{
	//digunakan oleh pelaku usaha/importir untuk melihat skl terdahulu sebelum siap riph.
	public function index()
	{
		abort_if(Gate::denies('old_skl_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'SKL';
		$page_title = 'Old SKL';
		$page_heading = 'Daftar SKL Lama';
		$heading_class = 'fa fa-file-certificate';

		$user = Auth::user();
		$datauser = DataUser::where('user_id', $user->id)->first();
		$oldskls = SklOlder::where('npwp', $datauser->npwp_company)->get();
		// dd($datauser);
		return view('admin.oldskl.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'oldskls'));
	}

	public function show($id)
	{
		abort_if(Gate::denies('old_skl_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'SKL';
		$page_title = 'Old SKL';
		$page_heading = 'Data SKL Lama';
		$heading_class = 'fa fa-file-certificate';

		$oldskl = SklOlder::find($id);
		$datauser = DataUser::where('npwp_company', $oldskl->npwp)->first();
		// dd($oldskl);

		return view('admin.oldskl.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'oldskl', 'datauser'));
	}
}
