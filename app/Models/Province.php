<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $primaryKey = 'province_id';
    public $incrementing = true;
    protected $fillable = [
        'rajaongkir_province_id',
        'name',
    ];
    public function cities(): HasMany
    {
        return $this->hasMany(City::class,'province_id','province_id');
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(AlamatUser::class);
    }
}
