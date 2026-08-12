<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VotingSchedule extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class)->orderBy('candidate_number');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function isOpen(): bool
    {
        $now = Carbon::now();
        return $this->is_active && $now->between($this->start_time, $this->end_time);
    }

    public function getStatusLabelAttribute(): string
    {
        $now = Carbon::now();

        if (!$this->is_active) {
            return 'Nonaktif';
        }

        if ($now->lt($this->start_time)) {
            return 'Belum Dimulai';
        }

        if ($now->gt($this->end_time)) {
            return 'Selesai';
        }

        return 'Sedang Berlangsung';
    }
}
