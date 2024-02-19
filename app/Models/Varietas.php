<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Varietas extends Model
{
	use HasFactory, SoftDeletes;

	public $table = 'varietas';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $fillable = [
		'kode_komoditas',
		'nama_komoditas',
		'kode_varietas',
		'nama_varietas',
		'keterangan',
		'datalain',
	];
}
