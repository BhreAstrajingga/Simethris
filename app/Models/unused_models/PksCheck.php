<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PksCheck extends Model
{
	use HasFactory;
	use SoftDeletes;

	public $table = 'pks_checks';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $fillable = [
		'pengajuan_id',
		'commitcheck_id',
		'pks_id',
		'poktan_id',
		'npwp',
		'no_ijin',
		'status',
		'note',
		'verif_at',
		'verif_by',
	];

	public function pks()
	{
		return $this->belongsTo(Pks::class, 'pks_id', 'id');
	}

	public function pengajuan()
	{
		return $this->belongsTo(Pengajuan::class);
	}
	public function commitmentcheck()
	{
		return $this->belongsTo(CommitmentCheck::class);
	}
	public function anggotacheck()
	{
		return $this->hasMany(AnggotaCheck::class);
	}
}
