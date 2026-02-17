<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherAdminDetails extends Model
{
    use HasFactory;

    protected $table = 'other_admin_details';
    protected $primaryKey = 'id';
}
