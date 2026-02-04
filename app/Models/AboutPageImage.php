<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPageImage extends Model
{
    protected $fillable = ['about_page_id', 'image'];

    public function aboutPage()
    {
        return $this->belongsTo(AboutPage::class);
    }
}
