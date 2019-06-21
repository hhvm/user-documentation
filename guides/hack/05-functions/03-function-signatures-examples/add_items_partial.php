<?hh // partial

function add_items($x, int $y) {
  return $x + $y;
}

function add_items_with_return_type($x, $y): int {
  return $x + $y;
}
