<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataAdministrator extends Model
{
	use HasFactory, SoftDeletes, Auditable;
	public $table = 'data_administrators';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $fillable = [
		'user_id',
		'nama',
		'jabatan',
		'nip',
		'sign_img',
		'digital_sign',
		'status',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id', 'user_id');
	}
}
