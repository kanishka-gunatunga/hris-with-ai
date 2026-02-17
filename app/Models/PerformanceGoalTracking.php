<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceGoalTracking extends Model
{
    use HasFactory;

    protected $table = 'performance_goal_tracking';
    protected $primaryKey = 'id';
}
