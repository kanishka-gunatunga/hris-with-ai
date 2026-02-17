<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCourses extends Model
{
    use HasFactory;

    protected $table = 'training_courses';
    protected $primaryKey = 'id';
}
