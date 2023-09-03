<?php

//$result = 1e200 * 1e200;
//echo $result . PHP_EOL;
//if (is_infinite($result)) {
//  echo 'Result was out of range';
//} else {
//  echo 'Result is' . $result;
//}

echo abs(200) . PHP_EOL; // 200
echo ceil(200.40) . PHP_EOL; // 201
echo round(200.90) . PHP_EOL;  // 201
echo floor(200.40) . PHP_EOL;  // 200
echo max([3, 4, 1, 29, 4, 3055, 49, 22, 499]) . PHP_EOL; // 3055
echo min([3, 4, 1, 29, 4, 3055, 49, -1, 22, 499]) . PHP_EOL; // 1
echo pow(4, 3) . PHP_EOL; // 64
echo '----------------------------------------------' . PHP_EOL;

$subtotal = 15.99;
$tax_rate = 0.08;
$tax = round($subtotal * $tax_rate, 2);
echo $tax . PHP_EOL; // 1.28
echo sqrt(4) . PHP_EOL; // 2
echo sqrt(9) . PHP_EOL; // 3
echo sqrt(16) . PHP_EOL; // 4

$x1 = 5;  $y1 = 4;
$x2 = 2;  $y2 = 8;
$distance = sqrt(pow($x1 - $x2, 2) + pow($y1 - $y2, 2));
echo $distance . PHP_EOL; // 5

echo '----------------------------------------------' . PHP_EOL;

# GENERATE A RANDOM HTML COLOR
$color = '#';
for($i = 0; $i < 6; $i++) {
  $color .= sprintf("%x", mt_rand(0, 15));
}
echo $color . PHP_EOL;

echo '----------------------------------------------' . PHP_EOL;

function is_leap_year($y): bool
{
  return (date('L', $y) == '1');
}

echo is_leap_year(strtotime('2010-1-1')) . PHP_EOL; // false or blank
echo is_leap_year(strtotime('2012-1-1')) . PHP_EOL; // true or 1

$now = time();
$exp = '04/2024';

// change exp format from mm/yyyy to yyyy-mm
$month = substr($exp, 0, 2);
$year = substr($exp, 3, 4);
$exp = $year . '-'. $month;

// set expiration date and calculate the number of days from current date
$exp = strtotime($exp . 'first day of next month midnight');
$days = floor(($exp - $now) / 86400); // there are 86400 seconds/day
echo "exp: $exp" . PHP_EOL; // exp: 1714521600
echo "days: $days" . PHP_EOL; // days: 250
// display a message
if($days < 0) {
  echo 'Your card expires ' . abs($days) . ' days ago.';
} else if($days > 0){
  echo 'Your card expires in ' . abs($days) . ' days.';
} else {
  echo 'Your card expires in midnight.';
}
echo PHP_EOL; // Your card expires in 250 days.
echo '----------------------------------------------' . PHP_EOL;

$today = time();
$new_year = strtotime('next year Jan 1st', $today);
$time = 86400;
// calculate the days, hours, minutes and seconds
$s = $new_year - $today;
$d = floor($s / $time);
$s -= $d * $time;
$h = floor($s / 3600);
$s -= $h * 3600;
$m = floor($s / 60);
$s -= $m * 60;

// display the countdown
echo "{$days} days {$h}:{$m}:{$s} remaining to the New Year.";
echo PHP_EOL;
echo '----------------------------------------------' . PHP_EOL;

//new DateTime()
