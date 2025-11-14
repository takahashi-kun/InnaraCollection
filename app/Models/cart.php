<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
use HasFactory;

    protected $table = 'carts';
    protected $fillable = ['user_id', 'id_produk', 'qty', 'details_json'];
    protected $casts = ['details_json' => 'array'];

    public function product()
    {
        return $this->belongsTo(product::class, 'id_produk', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // helper accessor used in views
    public function getTotalHargaAttribute()
    {
        return $this->details_json['harga_jual'] ?? 0;
    }

    public function getVariantNameAttribute()
    {
        $meta = $this->details_json['meta'] ?? null;
        $productName = $this->product->nama_produk ?? ($this->product->name ?? 'Produk');
        if ($meta) {
            $bahan = $meta['bahan']['nama_bahan'] ?? ($meta['bahan']['nama'] ?? '');
            $ukuran = $meta['ukuran']['ukuran'] ?? ($meta['ukuran']['nama'] ?? '');
            return trim("{$productName} - {$bahan} {$ukuran}");
        }
        return $productName;
    }
}
