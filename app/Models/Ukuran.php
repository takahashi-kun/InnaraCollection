<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ukuran extends Model
{
    use HasFactory;
    protected $table = 'ukurans';
    protected $guarded = [];
    protected $primaryKey = 'id_ukuran';

    protected $fillable = [
        'ukuran',
        'harga_ukuran'
    ];
    protected $casts = [
        'harga_ukuran' => 'decimal:2',
    ];
    public function kastemisasis()
    {
        return $this->hasMany(ProductKastemisasi::class, 'id_ukuran');
    }
}
