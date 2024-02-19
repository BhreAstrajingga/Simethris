<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class MasterPenangkar extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'master_penangkars';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public $fillable = [
		'npwp',
		'nama_lembaga',
		'nama_pimpinan',
		'hp_pimpinan',
		'alamat',
		'provinsi_id',
		'kabupaten_id',
		'kecamatan_id',
		'desa_id',
	];

	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public function penangkarriph()
	{
		return $this->hasMany(PenangkarMitra::class, 'id', 'penangkar_id');
	}

	public function provinsi()
	{
		return $this->belongsTo(MasterProvinsi::class, 'provinsi_id', 'provinsi_id');
	}

	public function kabupaten()
	{
		return $this->belongsTo(MasterKabupaten::class, 'kabupaten_id', 'kabupaten_id');
	}

	public function kecamatan()
	{
		return $this->belongsTo(MasterKecamatan::class, 'kecamatan_id', 'kecamatan_id');
	}

	public function desa()
	{
		return $this->belongsTo(MasterDesa::class, 'kelurahan_id', 'kelurahan_id');
	}
}
