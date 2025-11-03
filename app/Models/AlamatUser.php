<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlamatUser extends Model
{
    protected $table = 'alamat_users';
    
    protected $fillable = [
        'user_id', 
        'nama_alamat', 
        'nama_penerima', 
        'no_tlp', 
        'alamat_lengkap', 
        'province_id', 
        'city_id', 
        'subdistrict_id',
    ];

    /**
     * Relasi: Alamat ini dimiliki oleh satu Provinsi.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class,'province_id','province_id');
    }

    /**
     * Relasi: Alamat ini dimiliki oleh satu Kota/Kabupaten.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id','city_id');
    }

    /**
     * Relasi: Alamat ini dimiliki oleh satu Kecamatan. (Opsional)
     */
    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(Subdistrict::class,'subdistrict_id','subdistrict_id');
    }
}
