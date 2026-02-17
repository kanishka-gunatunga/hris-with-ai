<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCheckInOutData extends Model
{
    use HasFactory;

    protected $table = 'user_check_in_out_data';
    protected $primaryKey = 'id';
}
