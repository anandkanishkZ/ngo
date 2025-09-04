<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Project;

echo "=== Project Debug Information ===\n\n";

$project = Project::first();
echo "Testing first project: " . $project->title . "\n";

echo "\nChecking if accessor methods exist:\n";
echo "getPartnersAttribute method exists: " . (method_exists($project, 'getPartnersAttribute') ? 'YES' : 'NO') . "\n";

echo "\nTrying direct accessor call:\n";
$rawPartners = $project->getAttributes()['partners'];
$processedPartners = $project->getPartnersAttribute($rawPartners);
echo "Direct accessor result: ";
var_dump($processedPartners);

echo "\nForcing fresh model load:\n";
$freshProject = Project::find($project->id);
$freshPartners = $freshProject->partners;
echo "Fresh partners: ";
var_dump($freshPartners);

echo "\nTrying manual JSON decode:\n";
$raw = $project->getAttributes()['partners'];
$decoded = json_decode($raw, true);
var_dump($decoded);
