<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoProduksi extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'foto_produksis';

	protected $fillable = [
		'realisasi_id',
		'filename',
		'url',
	];

	public function datarealisasi()
	{
		return $this->belongsTo(DataRealisasi::class, 'realisasi_id', 'id');
	}
}
