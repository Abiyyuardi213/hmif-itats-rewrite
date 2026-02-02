<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgramTeam extends Model
{
    protected $fillable = ['work_program_id', 'member_id', 'role'];

    public function member()
    {
        return $this->belongsTo(OrgMember::class, 'member_id');
    }
}
