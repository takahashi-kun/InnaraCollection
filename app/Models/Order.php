<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'delivered_at',
        'subtotal',
        'shipping',
        'total',
        'payment_method',
        'shipping_address',
        'invoice_number'
    ];
    protected $casts = [
        'delivered_at' => 'datetime',
    ];
    protected $dates = [
        'delivered_at',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->invoice_number) {
                $model->invoice_number = 'INV-' . time() . '-' . rand(1000, 9999);
            }
        });
    }
    // public function setStatusPending()
    // {
    //     $this->status = 'pending';
    //     $this->save();
    // }

    // public function setStatusPaid()
    // {
    //     $this->status = 'paid';
    //     $this->save();
    // }

    // public function setStatusCancelled()
    // {
    //     $this->status = 'cancelled';
    //     $this->save();
    // }

    // public function setStatusExpired()
    // {
    //     $this->status = 'expired';
    //     $this->save();
    // }
}
