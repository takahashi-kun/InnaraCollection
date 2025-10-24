<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warna extends Model
{
    use HasFactory;
    protected $table = 'warnas';
    protected $guarded = [];
    protected $primaryKey = 'id_warna';

    protected $fillable = [
        'nama_warna',
        'kode_hex',
        'harga_warna',
    ];
    protected $casts = [
        'harga_warna' => 'decimal:2',
    ];

    public function kastemisasis()
    {
        return $this->hasMany(ProductKastemisasi::class, 'id_warna');
    }

}
