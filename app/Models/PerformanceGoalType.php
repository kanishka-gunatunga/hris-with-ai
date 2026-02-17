<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceGoalType extends Model
{
    use HasFactory;

    protected $table = 'performance_goal_type';
    protected $primaryKey = 'id';
}
