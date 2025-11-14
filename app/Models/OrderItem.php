<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'id_produk', 'nama_produk', 'qty', 'price', 'details_json'];
    protected $casts = ['details_json' => 'array'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'id_produk', 'id_produk');
    }
}
