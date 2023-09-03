<?php

$investment = 1000;
$interest_rate = .01;
$years = 25;
$future_value = $investment;

for ($i = 1; $i < $years; $i++) {
  $future_value = ($future_value + ($future_value * $interest_rate));
}

echo $future_value. PHP_EOL;

$count = 12;
$item = "flower";
$message = "You test {$item}" ;
echo $message;