<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
    ];
    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function kastemisasis()
    {
        return $this->hasMany(productKastemisasi::class, 'id_produk');
    }

    public function cart(){
        return $this->hasMany(cart::class, 'id_produk');
    }

    public function sablons()
    {
        return $this->hasManyThrough(
            Sablon::class,
            ProductKastemisasi::class,
            'id_product', // Foreign key pada tabel kastemisasi
            'id_sablon', // Foreign key pada tabel sablon
            'id_product', // Local key pada tabel products
            'id_sablon' // Local key pada tabel kastemisasi
        );
    }

    // Method helper untuk mendapatkan gambar sablon
    public function getDefaultSablonImage()
    {
        return $this->kastemisasis()
            ->with('sablon')
            ->first()
            ->sablon
            ->gambar ?? null;
    }
}
