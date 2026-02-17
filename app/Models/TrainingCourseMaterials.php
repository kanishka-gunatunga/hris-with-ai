<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCourseMaterials extends Model
{
    use HasFactory;

    protected $table = 'training_course_materials';
    protected $primaryKey = 'id';
    
     protected $fillable = ['course_id', 'file'];
}
