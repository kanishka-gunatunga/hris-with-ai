<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\PMProjects;
use App\Models\PMTasks;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
use App\Models\JobPosts;

echo "Employees: " . User::where('user_role', 3)->count() . PHP_EOL;
echo "HODs: " . User::where('user_role', 5)->count() . PHP_EOL;
echo "HRMs: " . User::where('user_role', 2)->count() . PHP_EOL;
echo "Clients: " . User::where('user_role', 4)->count() . PHP_EOL;
echo "Projects: " . PMProjects::count() . PHP_EOL;
echo "Tasks: " . PMTasks::count() . PHP_EOL;
echo "Departments: " . OrganizationDepartments::count() . PHP_EOL;
echo "Locations: " . OrganizationLocations::count() . PHP_EOL;
echo "Jobs: " . JobPosts::where('status', 'Published')->count() . PHP_EOL;
