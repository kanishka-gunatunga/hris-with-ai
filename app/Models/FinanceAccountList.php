<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceAccountList extends Model
{
    use HasFactory;

    protected $table = 'finance_account_list';
    protected $primaryKey = 'id';
}
