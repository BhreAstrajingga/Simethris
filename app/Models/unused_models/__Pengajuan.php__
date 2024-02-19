<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\RandomId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
	use HasFactory;
	use SoftDeletes;
	use Auditable;
	use RandomId;
	use \Awobaz\Compoships\Compoships;


	public $table = 'pengajuans';

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		//main
		'npwp',
		'no_pengajuan',
		'no_ijin',
		'commitment_id',
		'no_doc',
		'status',
		'note',

		//online
		'onlinestatus',
		'onlinenote',
		'onlinedate',
		'baonline',
		'onlinecheck_by',

		//onfarm
		'luas_verif',
		'volume_verif',
		'metode',
		'onfarmstatus',
		'onfarmnote',
		'onfarmdate',
		'baonfarm',
		'onfarmcheck_by',
		'verif_at',
	];
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public static function newPengajuanCount(): int
	{
		return self::whereNull('onlinedate')->count();
	}

	public static function getNewPengajuan()
	{
		return self::whereNull('onlinedate')->get();
	}

	public function NewOnlineRequest(): int
	{
		return self::whereNull('onlinedate')->count();
	}

	public function NewOnFarmRequest(): int
	{
		return self::where('onlinestatus', '2')
			->whereNull('onfarmdate')
			->count();
	}

	public function NewRecomendation(): int
	{
		return self::where('status', '4')
			->count();
	}

	public function commitment()
	{
		return $this->belongsTo(PullRiph::class, 'no_ijin', 'no_ijin');
	}

	public function commitmentcheck()
	{
		return $this->belongsTo(CommitmentCheck::class, 'pengajuan_id', 'id');
	}

	public function datauser()
	{
		return $this->belongsTo(DataUser::class, ['npwp_company'], ['npwp']);
	}

	public function skl()
	{
		return $this->hasOne(Skl::class, 'pengajuan_id', 'id');
	}
}
