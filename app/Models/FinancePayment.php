<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancePayment extends Model
{
    use HasFactory;

    protected $table = 'finance_payment';
    protected $primaryKey = 'id';
}
