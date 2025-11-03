<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $primaryKey = 'city_id';
    public $incrementing = true;
    protected $fillable = [
        'province_id',
        'rajaongkir_city_id',
        'postal_code',
        'name',
    ];
/**
     * Relasi: Satu Kota/Kabupaten dimiliki oleh satu Provinsi.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class,'province_id','province_id');
    }

    /**
     * Relasi: Satu Kota/Kabupaten memiliki banyak Kecamatan.
     */
    public function subdistricts(): HasMany
    {
        return $this->hasMany(Subdistrict::class,'city_id','city_id');
    }
    
    /**
     * Relasi opsional: Satu Kota/Kabupaten dimiliki banyak Alamat User.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(AlamatUser::class);
    }
}
