<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationLocations extends Model
{
    use HasFactory;

    protected $table = 'organization_locations';
    protected $primaryKey = 'id';
}
