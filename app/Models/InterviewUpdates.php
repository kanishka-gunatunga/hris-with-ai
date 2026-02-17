<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewUpdates extends Model
{
    use HasFactory;

    protected $table = 'interview_updates';
    protected $primaryKey = 'id';
}
