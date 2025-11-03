<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subdistrict extends Model
{
    protected $primaryKey = 'subdistrict_id';
    public $incrementing = true;
    protected $fillable = [
        'city_id', 
        'rajaongkir_subdistrict_id', 
        'name',
    ];

    /**
     * Relasi: Satu Kecamatan dimiliki oleh satu Kota/Kabupaten.
     */
    public function city(): BelongsTo{
        return $this->belongsTo(City::class,'city_id','city_id');
    }

    /**
     * Relasi opsional: Satu Kecamatan dimiliki banyak Alamat User.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(AlamatUser::class);
    }
}
