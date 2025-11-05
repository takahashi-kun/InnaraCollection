<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bahan extends Model
{
    use HasFactory;
    protected $table = 'bahans';
    protected $guarded = [];
    protected $primaryKey = 'id_bahan';

    protected $fillable = [
        'nama_bahan',
        'ketebalan_bahan',
        'harga_bahan',
    ];

    protected $casts = [
        'harga_bahan' => 'decimal:2',
    ];

    public function kastemisasis()
    {
        return $this->hasMany(ProductKastemisasi::class, 'id_bahan');
    }
    public function ukurans()
    {
        return $this->hasMany(Ukuran::class, 'id_bahan'); // 1 Bahan punya banyak Ukuran
    }
    public function sablons()
    {
        return $this->hasMany(Sablon::class, 'id_bahan'); // 1 Bahan punya banyak Sablon
    }
}
