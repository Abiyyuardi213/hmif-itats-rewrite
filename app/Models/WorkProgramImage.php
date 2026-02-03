<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgramImage extends Model
{
    protected $fillable = ['work_program_id', 'image_path', 'caption'];
}
