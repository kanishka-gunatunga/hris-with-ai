<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreHRTravel extends Model
{
    use HasFactory;

    protected $table = 'core_hr_travels';
    protected $primaryKey = 'id';
}
