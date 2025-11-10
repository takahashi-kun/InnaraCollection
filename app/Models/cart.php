<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
use HasFactory;
    
    protected $table = 'carts';
    
    // Properti yang boleh diisi (White-list)
    protected $fillable = [
        'user_id',
        'invoice_number',
        'total_harga', 
        'qty',
        'status',
        'details_json', // Kolom baru untuk detail kustomisasi
    ];
    
    // Casting 'details_json' agar otomatis menjadi array/object PHP saat diambil.
    protected $casts = [
        'total_harga' => 'float', 
        'details_json' => 'array',
    ];
    
    // Relasi User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Accessor untuk mendapatkan nama produk/varian yang mudah dibaca 
     * di tampilan keranjang, diambil dari details_json.
     */
    public function getVariantNameAttribute()
    {
        // Pastikan details_json ada dan berbentuk array
        if (!is_array($this->details_json)) {
            return "Kaos Custom - Detail Tidak Lengkap";
        }
        
        $details = $this->details_json;

        $bahan = $details['bahan']['nama_bahan'] ?? 'N/A';
        $ukuran = $details['ukuran']['ukuran'] ?? 'N/A';
        $warna = $details['warna']['nama_warna'] ?? 'N/A';
        $sablon = $details['sablon']['nama_sablon'] ?? 'N/A';

        // Format nama untuk tampilan keranjang
        return "Kaos Custom | Bahan: {$bahan} | Warna: {$warna} ({$ukuran}) | Sablon: {$sablon}";
    }
}
