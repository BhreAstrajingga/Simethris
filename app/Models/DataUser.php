<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataUser extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;
    use \Awobaz\Compoships\Compoships;
    
    public $table = 'data_users';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'mobile_phone',
        'fix_phone',
        'company_name',
        'pic_name',
        'jabatan',
        'npwp_company',
        'nib_company',
        'address_company',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'kodepos',
        'fax',
        'ktp',
        'ktp_image',
        'assignment',
        'avatar',
        'logo',
        'email_company',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pullRiph()
    {
        return $this->hasMany(PullRiph::class, 'npwp', 'npwp_company');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'npwp', 'npwp_company');
    }

    public function oldskl()
    {
        return $this->hasMany(SklOlder::class, 'npwp', 'npwp_company');
    }
}
