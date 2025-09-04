<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Team members count: " . App\Models\TeamMember::count() . PHP_EOL;

foreach(App\Models\TeamMember::all() as $member) {
    echo $member->id . ': ' . $member->name . PHP_EOL;
}
