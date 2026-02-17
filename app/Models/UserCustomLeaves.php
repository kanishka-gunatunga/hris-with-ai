<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomLeaves extends Model
{
    use HasFactory;

    protected $table = 'user_custom_leaves';
    protected $primaryKey = 'id';
}
