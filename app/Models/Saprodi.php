<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saprodi extends Model
{
	use HasFactory, SoftDeletes, Auditable;

	public $table = 'saprodis';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];



	protected $fillable = [
		'pks_id',
		'npwp',
		'no_ijin',
		'tanggal_saprodi',
		'kategori',
		'jenis',
		'volume',
		'satuan',
		'harga',
		'file',
	];

	public function datauser()
	{
		return $this->belongsTo(DataUser::class, 'npwp', 'npwp_company');
	}

	public function pks()
	{
		return $this->belongsTo(Pks::class);
	}

	public function commitment()
	{
		return $this->belongsTo(PullRiph::class, 'no_ijin', 'no_ijin');
	}
}
