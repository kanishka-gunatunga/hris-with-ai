<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreHRTerminations extends Model
{
    use HasFactory;

    protected $table = 'core_hr_terminations';
    protected $primaryKey = 'id';
}
