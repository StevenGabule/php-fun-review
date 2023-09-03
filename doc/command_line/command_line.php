<?php
print_r(arguments($argv));

function arguments($args): array
{
  array_shift($args);
  $endOfOptions = false;

  $ret = [
    'commands' => [],
    'options' => [],
    'flags' => [],
    'arguments' => [],
  ];

  while ($arg = array_shift($args)) {
    // if we have reached end of options, we cast all remaining argvs as arguments
    if ($endOfOptions) {
      $ret['arguments'][] = $arg;
      continue;
    }

    // Is it a command? (prefixed with --)
    if (str_starts_with($arg, '--')) {
      // is it the end of options flag?
      if (!isset ($arg[3])) {
        $endOfOptions = true;; // end of options;
        continue;
      }
      $value = "";
      $com = substr($arg, 2);

      // is it the syntax '--option=argument'?
      if (strpos($com, '='))
        list($com, $value) = preg_split("=", $com, 2);

      // is the option not followed by another option but by arguments
      elseif (!str_starts_with($args[0], '-')) {
        while (!str_starts_with($args[0], '-'))
          $value .= array_shift($args) . ' ';
        $value = rtrim($value, ' ');
      }

      $ret['options'][$com] = !empty($value) ? $value : true;
      continue;
    }

    // Is it a flag or a serial of flags? (prefixed with -)
    if (str_starts_with($arg, '-')) {
      for ($i = 1; isset($arg[$i]); $i++)
        $ret['flags'][] = $arg[$i];
      continue;
    }

    // finally, it is not option, nor flag, nor argument
    $ret['commands'][] = $arg;
    continue;
  }
  if (!count($ret['options']) && !count($ret['flags'])) {
    $ret['arguments'] = array_merge($ret['commands'], $ret['arguments']);
    $ret['commands'] = array();
  }
  return $ret;
}

