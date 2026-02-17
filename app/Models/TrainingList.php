<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingList extends Model
{
    use HasFactory;

    protected $table = 'training_list';
    protected $primaryKey = 'id';
}
