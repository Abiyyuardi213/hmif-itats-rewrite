<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchandiseOrder extends Model
{
    protected $fillable = [
        'transaction_id',
        'merchandise_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'quantity',
        'size',
        'total_price',
        'status',
        'notes',
        'payment_proof',
        'expires_at',
        'paid_at',
        'payment_method',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class);
    }
}
