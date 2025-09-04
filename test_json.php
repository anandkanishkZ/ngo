<?php

$rawString = '["UNESCO","Local Education Department","Community Leaders"]';
echo "Raw string: " . $rawString . "\n";
echo "String length: " . strlen($rawString) . "\n";
echo "First char: " . ord($rawString[0]) . " (" . $rawString[0] . ")\n";
echo "Last char: " . ord($rawString[-1]) . " (" . $rawString[-1] . ")\n";

echo "\nTrying json_decode:\n";
$decoded = json_decode($rawString, true);
var_dump($decoded);

if ($decoded === null) {
    echo "JSON decode failed. Error: " . json_last_error_msg() . "\n";
    
    // Try to fix common issues
    $cleaned = stripslashes($rawString);
    echo "\nTrying with stripslashes: " . $cleaned . "\n";
    $decoded2 = json_decode($cleaned, true);
    var_dump($decoded2);
}
