<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreHRComplaints extends Model
{
    use HasFactory;

    protected $table = 'core_hr_complaints';
    protected $primaryKey = 'id';
}
