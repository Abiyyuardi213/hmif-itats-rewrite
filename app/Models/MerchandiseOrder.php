<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchandiseOrder extends Model
{
    protected $fillable = [
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
    ];

    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class);
    }
}
