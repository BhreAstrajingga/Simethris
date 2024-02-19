<?php
//untuk menyimpan data-data SKL lama
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SklOlder extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'skl_olds';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_date',
    ];

    protected $fillable = [
        'no_skl',
        'npwp',
        'no_ijin',
        'published_date',
        'qrcode',
        'nota_attch',
        'publisher',
        'pejabat_id',
    ];

    public function datauser()
    {
        return $this->belongsTo(DataUser::class, 'npwp', 'npwp_company');
    }
}
