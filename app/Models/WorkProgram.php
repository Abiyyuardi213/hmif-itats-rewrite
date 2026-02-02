<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgram extends Model
{
    protected $fillable = [
        'name',
        'division_id',
        'description',
        'status',
        'start_date',
        'end_date',
        'location',
        'head_id',
        'participants_count',
        'budget',
        'team_count'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function head()
    {
        return $this->belongsTo(OrgMember::class, 'head_id');
    }

    public function teams()
    {
        return $this->hasMany(WorkProgramTeam::class);
    }

    public function images()
    {
        return $this->hasMany(WorkProgramImage::class);
    }
}
