<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name', 'type', 'order'];

    public function members()
    {
        return $this->hasMany(OrgMember::class);
    }
}
