<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreHRAwards extends Model
{
    use HasFactory;

    protected $table = 'core_hr_awards';
    protected $primaryKey = 'id';
}
