<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingListEmployees extends Model
{
    use HasFactory;

    protected $table = 'training_list_employees';
    protected $primaryKey = 'id';
}
