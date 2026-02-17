<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMTasks extends Model
{
    use HasFactory;

    protected $table = 'pm_tasks';
    protected $primaryKey = 'id';
}
