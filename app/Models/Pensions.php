<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pensions extends Model
{
    use HasFactory;

    protected $table = 'pensions';
    protected $primaryKey = 'id';
}
