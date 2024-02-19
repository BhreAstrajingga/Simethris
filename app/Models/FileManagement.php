<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileManagement extends Model
{
	use HasFactory, SoftDeletes, Auditable;

	public $table = 'file_management';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $fillable = [
		'berkas',
		'nama_berkas',
		'deskripsi',
		'lampiran',
	];
}
