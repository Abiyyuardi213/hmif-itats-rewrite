<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgMember extends Model
{
    protected $fillable = [
        'name',
        'npm',
        'position_id',
        'division_id',
        'image',
        'instagram_url',
        'linkedin_url',
        'order'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
