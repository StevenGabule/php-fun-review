<?php

namespace cart {
  /**
   * @param $cart
   * @param $name
   * @param $cost
   * @param $qty
   * @return void
   */
  function add_item(&$cart, $name, $cost, $qty): void
  {
    $total = $cost * $qty;
    $item = array(
      'name' => $name,
      'cost' => $cost,
      'qty' => $qty,
      'total' => $total,
    );
    $cart[] = $item;
  }

  /**
   * @param $cart
   * @param $key
   * @param $qty
   * @return void
   */
  function update_item(&$cart, $key, $qty): void
  {
    if (isset($cart[$key])) {
      if ($qty <= 0) {
        unset($cart[$key]);
      } else {
        $cart[$key]['qty'] = $qty;
        $total = $cart[$key]['cost'] * $cart[$key]['qty'];
        $cart[$key]['total'] = $total;
      }
    }
  }

  /**
   * @param $cart
   * @return string
   */
  function get_subtotal($cart): string
  {
    $subtotal = 0;
    foreach ($cart as $item) {
      $subtotal += $item['total'];
    }
    return number_format(round($subtotal, 2), 2);
  }


// a function to sort the array by any column
  /**
   * @param $sort_key
   * @return \Closure
   */
  function compare_factory($sort_key): \Closure
  {
    return function ($left, $right) use ($sort_key) {
      if ($left[$sort_key] == $right[$sort_key]) return 0;
      else if ($left[$sort_key] < $right[$sort_key]) return -1;
      else return 1;
    };
  }

  /**
   * @param $sort_key
   * @return void
   */
  function sort($sort_key): void
  {
    $compare_function = compare_factory($sort_key);
    uasort($_SESSION['cart13'], $compare_function);
  }

}