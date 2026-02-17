<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherEmployeeDetails extends Model
{
    use HasFactory;

    protected $table = 'other_employee_details';
    protected $primaryKey = 'id';
}
