<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoTanam extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'foto_tanams';

	protected $fillable = [
		'realisasi_id',
		'filename',
		'url',
	];

	public function datarealisasi()
	{
		return $this->belongsTo(DataRealisasi::class, 'realisasi_id');
	}
}
