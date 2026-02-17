<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingTrainers extends Model
{
    use HasFactory;

    protected $table = 'training_trainers';
    protected $primaryKey = 'id';
}
