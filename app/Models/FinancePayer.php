<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancePayer extends Model
{
    use HasFactory;

    protected $table = 'finance_payer';
    protected $primaryKey = 'id';
}
