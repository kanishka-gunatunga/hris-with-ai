<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreHRTransfer extends Model
{
    use HasFactory;

    protected $table = 'core_hr_transfer';
    protected $primaryKey = 'id';
}
