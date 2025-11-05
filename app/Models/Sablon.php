<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sablon extends Model
{
    use HasFactory;
    protected $table = 'sablons';
    protected $guarded = [];
    protected $primaryKey = 'id_sablon';

    protected $fillable = [
        'nama_sablon',
        'ukuran_sablon',
        'gambar_sablon',
        'harga_sablon',
        'id_bahan',
    ];
    protected $casts = [
        'harga_sablon' => 'decimal:2',
    ];
    public function kastemisasis()
    {
        return $this->hasMany(ProductKastemisasi::class, 'id_sablon');
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'id_bahan');
    }
}
