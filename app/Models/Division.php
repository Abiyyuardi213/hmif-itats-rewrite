<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['name', 'description', 'icon', 'color', 'order'];

    public function members()
    {
        return $this->hasMany(OrgMember::class);
    }
}
