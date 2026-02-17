<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentTypeHistory extends Model
{
    use HasFactory;

    protected $table = 'employment_type_history';
    protected $primaryKey = 'id';
}
