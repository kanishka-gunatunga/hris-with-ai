<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMProjects extends Model
{
    use HasFactory;

    protected $table = 'pm_projects';
    protected $primaryKey = 'id';
}
