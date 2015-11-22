<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\MapWithKey;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$sentences = $v->mapWithKey(
  ($index, $color) ==> "Color at {$index}: {$color}",
);

echo implode("\n", $sentences)."\n";
