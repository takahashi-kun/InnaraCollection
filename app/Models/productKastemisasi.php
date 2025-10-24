<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productKastemisasi extends Model
{
    use HasFactory;

    protected $table = 'product_kastemisasi';
    protected $guarded = [];
    protected $primaryKey = 'id_kastemisasi';
    protected $fillable = [
        'id_produk',
        'id_sablon',
        'id_warna',
        'id_bahan',
        'id_ukuran',
        'total_harga_tambahan',
    ];
    protected $casts = [
        'total_harga_tambahan' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'id_produk');
    }
    public function sablon()
    {
        return $this->belongsTo(Sablon::class, 'id_sablon');
    }
    public function warna()
    {
        return $this->belongsTo(Warna::class, 'id_warna');
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'id_bahan');
    }
    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class, 'id_ukuran');
    }
}
