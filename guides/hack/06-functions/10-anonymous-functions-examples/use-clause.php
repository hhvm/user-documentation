<?hh // strict

namespace Hack\UserDocumentation\Functions\Anonymous\Examples\UseClause;

function get_process_1(int $val1): (function (int): int) {
  $val2 = $val1 * 3;
  $af = function (int $p): int use ($val1, $val2) { return $p + $val1 + $val2; };
  return $af;
}

function get_process_2(int $val1): (function (int): int) {
  $val2 = $val1 * 3;
  $af = (int $p): int ==> $p + $val1 + $val2;
  return $af;
}

<<__Entrypoint>>
function main(): void {
  $proc = get_process_1(2);
  $result = $proc(4);
  echo "\$result = $result\n";
  $result = get_process_2(2)(4);
  echo "\$result = $result\n";

  $result = get_process_1(3)(5);
  echo "\$result = $result\n";
  $result = get_process_2(3)(5);
  echo "\$result = $result\n";
}
