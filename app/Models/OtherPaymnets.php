<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPaymnets extends Model
{
    use HasFactory;

    protected $table = 'other_paymnets';
    protected $primaryKey = 'id';
}
