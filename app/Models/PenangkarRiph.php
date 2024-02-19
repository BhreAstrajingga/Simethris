<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class PenangkarRiph extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'penangkar_riph';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $fillable = [
        'penangkar_id',
        'commitment_id',
        'npwp',
        'no_ijin',
        'varietas',
        'ketersediaan',
    ];

    public function commitment()
    {
        return $this->belongsTo(PullRiph::class, 'no_ijin', 'no_ijin');
    }

    public function masterpenangkar()
    {
        return $this->belongsTo(MasterPenangkar::class, 'penangkar_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
