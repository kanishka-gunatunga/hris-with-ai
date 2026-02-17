<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceAppraisal extends Model
{
    use HasFactory;

    protected $table = 'performance_appraisal';
    protected $primaryKey = 'id';
}
