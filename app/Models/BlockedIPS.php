<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedIPS extends Model
{
    use HasFactory;

    protected $table = 'blocked_ips';
    protected $primaryKey = 'id';
}
