<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {1, 2, 3};
  echo $s."\n";

  $s2 = Set {'a', 'b', 'c'};
  echo $s2."\n";

  $s3 = Set {};
  echo $s3."\n";
}
