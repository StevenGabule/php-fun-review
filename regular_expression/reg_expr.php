<?php
$pattern = '/Harris/';
$pattern = '/murach/i';
$author = 'Ray Harris';
$editor = 'Joel Murach';

# How to use the preg_match method to search for the pattern
$author_match = preg_match($pattern, $author);
$editor_match = preg_match($pattern, $editor);
print $author_match . PHP_EOL; // 0
print $editor_match . PHP_EOL; // 1

# How to test for errors in a regular expression
if ($author_match == false) print 'Error testing author name.';
else if ($author_match === 0) print 'Author name does not contain Harris.';
else print 'Author name contains Harris.';
print PHP_EOL;

# How to match special characters
# \\, \/, \t, \n, \r, \f, \xhh

# How to match types of characters
# ., \w, \W, \d, \D, \s, \S

# Metacharacters inside a character class
# ^, -

# How to match string positions
# ^, $, \b, \B

# How to group and match sub patterns
# (subpattern), (?:subpattern), |, \n

# How to match a repeating pattern
# {n}, {n,}, {n,m}, ?, +, *

# A pattern to enforce password complexity
$pw_pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{6,}$/';
print preg_match($pw_pattern, 'sup3rsecret') . PHP_EOL; // 0
print preg_match($pw_pattern, 'sup3rse(ret') . PHP_EOL; // 1

$str = 'MBT-3244 MBT-12334';
$pat = '/MBT-[[:digit:]]{4}/';
$count = preg_match_all($pat, $str, $matches);

foreach ($matches[0] as $match) {
  print $match . PHP_EOL; // PRINT MBT-3244 MBT-1233
}

# Two more functions for working with regular expressions
# preg_replace($pattern, $new, $string)
# preg_split($pattern, $string)

# HOW TO USE THE PREG_REPLACE FUNCTION TO REPLACE A PATTERN WITH A STRING
$items = 'MBT-1234 MBS-9492';
$items = preg_replace('/MB[ST]/', 'ITEM', $items);
print $items . PHP_EOL; // ITEM-1234 ITEM-9492

# HOW TO USE THE PREG_SPLIT FUNCTION TO SPLIT A STRING ON A PATTERN
$ITEMS = 'MBT-1234 MBS-5512 MBT-1255, and MBS-0059';
$PATTERN = '/[, ]+(and[ ]*)?/';
$ITEMS = preg_split($PATTERN, $ITEMS);
foreach ($ITEMS as $ITEM) {
  print $ITEM . PHP_EOL; // MBT-1234, MBS-5512, MBT-1255, MBS-0059
}

# Phone numbers in this format: 999-999-9999
# Code: /^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/

# Credit card numbers in this format: 9999-9999-9999-9999
# Code: /^[[:digit:]]{4}(-[[:digit:]]{4}){3}$/

# Zip codes in either of these format: 99999 or 99999-9999
# Code: /^[[:digit:]]{5}(-[[:digit:]]{4})?$/

# Dates in this format: mm/dd/yyyy
# Code: /^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][[:digit:]]|3[01])\/[[:digit:]]{4}$/

# Test a phone number for validity
$phone = '559-555-6624';
$phone_pattern = '/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/';
print preg_match($phone_pattern, $phone) . PHP_EOL; // 1

# Test a date for a valid format, but not for a valid month, day, year
$date = '8/10/209';
$date_pattern = '/^(0?[1-9]|1[0-2])\/'
  . '(0?[1-9]|[12][[:digit:]]|3[01])\/'
  . '[[:digit:]]{4}$/';
print preg_match($date_pattern, $date) . PHP_EOL; // 0

# A function that does complete validate of an email address
function valid_email($email): bool
{
  $parts = explode('@', $email);
  if (count($parts) != 2) return false;
  if (strlen($parts[0]) > 64) return false;
  if (strlen($parts[1]) > 255) return false;

  $atom = '[[:alnum:]_!#$%\'*+\/=?^`{|}~-]+';
  $dotatom = '(\.' . $atom . ')*';
  $address = '(^' . $atom . $dotatom . '$)';

  $char = '([^\\\\"])';
  $esc = '(\\\\[\\\\"])';
  $text = '(' . $char . '|' . $esc . ')+';
  $quoted = '(^"' . $text . '"$)';

  $local_part = '/' . $address . '|' . $quoted . '/';

  $local_match = preg_match($local_part, $parts[0]);
  if ($local_match === false || $local_match != 1) return false;

  $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
  $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
  $top = '\.[[:alnum:]]{2,6}';
  $domain_part = '/^' . $hostnames . $top . '$/';
  $domain_match = preg_match($domain_part, $parts[1]);
  if ($domain_match === false || $domain_match != 1) return false;

  return true;
}

print "soone@gmail.com must be 1: " . valid_email('soone@gmail.com') . PHP_EOL;
print "soone must be 0: " . (valid_email('soone') == false ? 0 : 1) . PHP_EOL;