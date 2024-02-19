<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitmentCheck extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    public $table = 'commitment_checks';

    protected $fillable = [
        'pengajuan_id',
        'no_pengajuan',
        'npwp',
        'no_ijin',
        'formRiph',
        'formSptjm',
        'logbook',
        'formRt',
        'formRta',
        'formRpo',
        'formLa',
        'status',
        'note',
        'verif_at',
        'verif_by',
        'skl',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pullriph()
    {
        return $this->belongsTo(PullRiph::class, 'no_ijin', 'no_ijin');
    }

    public function pks()
    {
        return $this->hasMany(Pks::class, 'no_ijin', 'no_ijin');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'id');
    }

    public function pkscheck()
    {
        return $this->hasMany(PksCheck::class);
    }

    public function anggotacheck()
    {
        return $this->hasMany(AnggotaCheck::class);
    }

    public function skl()
    {
        return $this->hasOne(Skl::class);
    }
}
