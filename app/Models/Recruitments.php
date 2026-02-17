<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitments extends Model
{
    use HasFactory;

    protected $table = 'recruitments';
    protected $primaryKey = 'id';
}
