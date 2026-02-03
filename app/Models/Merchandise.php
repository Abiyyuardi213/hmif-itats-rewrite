<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'category',
        'sizes',
        'is_available',
    ];

    protected $casts = [
        'sizes' => 'array',
        'is_available' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(MerchandiseOrder::class);
    }
}
