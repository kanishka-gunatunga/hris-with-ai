<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialLeavesDeduction extends Model
{
    use HasFactory;

    protected $table = 'special_leaves_diduction';
    protected $primaryKey = 'id';
}
