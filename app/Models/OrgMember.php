<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgMember extends Model
{
    protected $fillable = [
        'period_id',
        'name',
        'npm',
        'position_id',
        'division_id',
        'status',
        'image',
        'instagram_url',
        'linkedin_url',
        'order'
    ];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
