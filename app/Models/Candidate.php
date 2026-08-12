<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'voting_schedule_id',
        'org_member_id',
        'candidate_number',
        'name',
        'npm',
        'photo',
        'vision',
        'mission',
    ];

    public function schedule()
    {
        return $this->belongsTo(VotingSchedule::class, 'voting_schedule_id');
    }

    public function orgMember()
    {
        return $this->belongsTo(OrgMember::class, 'org_member_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
