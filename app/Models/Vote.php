<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'voting_schedule_id',
        'candidate_id',
        'voter_type',
        'voter_npm',
        'voter_name',
        'voter_email',
        'ip_address',
    ];

    public function schedule()
    {
        return $this->belongsTo(VotingSchedule::class, 'voting_schedule_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
