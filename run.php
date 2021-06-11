<?php
require_once(__DIR__ . '/vendor/autoload.php');

echo Cn::sum(new Cn(5, 7), new Cn(1, -2)) . PHP_EOL;
echo Cn::substract(new Cn(5, 7), new Cn(1, -2)) . PHP_EOL;
echo Cn::multiply(new Cn(5, 7), new Cn(1, -2)) . PHP_EOL;
echo Cn::divide(new Cn(5, 7), new Cn(1, -2)) . PHP_EOL;
