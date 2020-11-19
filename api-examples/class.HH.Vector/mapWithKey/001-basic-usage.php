<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\MapWithKey;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $sentences = $v->mapWithKey(($index, $color) ==> "Color at {$index}: {$color}");

  echo \implode("\n", $sentences)."\n";
}
