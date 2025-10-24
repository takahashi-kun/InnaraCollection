<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'produk_id',
        'invoice_number',
        'total_harga',
        'qty',
        'status',
    ];
    protected $casts = [
        'total_harga' => 'decimal:2',
    ];
    protected $model = cart::class;
    public function product()
    {
        return $this->belongsTo(product::class, 'produk_id');
    }
}
