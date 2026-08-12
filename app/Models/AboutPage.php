<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'key',
        'title',
        'subtitle',
        'slug',
        'content',
        'image',
        'is_active',
    ];

    public function images()
    {
        return $this->hasMany(AboutPageImage::class);
    }
}
