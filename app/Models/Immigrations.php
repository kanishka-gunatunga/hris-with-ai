<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immigrations extends Model
{
    use HasFactory;

    protected $table = 'immigrations';
    protected $primaryKey = 'id';
}
