<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SklV2 extends Model
{
	use HasFactory, SoftDeletes;
	public $table = 'sklv2s';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'published_date',
	];

	protected $fillable = [
		'pengajuan_id',
		'no_skl',
		'published_date',
		'qrcode',
		'nota_attch',
		'publisher',
		'pejabat_id',
	];

	public function pengajuanv2()
	{
		return $this->belongsTo(PengajuanV2::class, 'pengajuan_id', 'id');
	}
}
