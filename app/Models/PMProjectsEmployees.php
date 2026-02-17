<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMProjectsEmployees extends Model
{
    use HasFactory;

    protected $table = 'pm_projects_employees';
    protected $primaryKey = 'id';
}
