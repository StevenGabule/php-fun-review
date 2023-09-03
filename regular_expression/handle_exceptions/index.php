<?php

/**
 * @param $investment
 * @param $interest_rate
 * @param $years
 * @return float
 * @throws Exception
 */
function calculate_future_value($investment, $interest_rate, $years): float
{
  if ($investment <= 0 || $interest_rate <= 0 || $years <= 0) {
    throw new Exception("Please check your entries for validity.");
  }

  $future_value = $investment;
  for ($i = 1; $i <= $years; $i++) {
    $future_value = ($future_value + ($future_value * $interest_rate * .01));
  }
  return round($future_value, 2);
}

try {
  print calculate_future_value(10000, 0.06, 0) . PHP_EOL;
} catch (Exception $e) {
  throw $e;
//  print "Errors: " . $e->getMessage() . PHP_EOL;
}



