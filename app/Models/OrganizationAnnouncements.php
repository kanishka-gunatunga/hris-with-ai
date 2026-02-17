<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationAnnouncements extends Model
{
    use HasFactory;

    protected $table = 'organization_announcements';
    protected $primaryKey = 'id';
}
