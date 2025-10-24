<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jasa extends Model
{
    use HasFactory;

    protected $table = 'jasas';
    protected $guarded = [];
    protected $primaryKey = 'id_jasa';
    protected $fillable = [
        'nama_jasa',
        'harga_jasa',
    ];
    protected $casts = [
        'harga_jasa' => 'decimal:2',
    ];
}
