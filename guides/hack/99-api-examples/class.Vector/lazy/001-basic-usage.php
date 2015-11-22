<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Lazy;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Get a lazy iterable view into the Vector $v
$lazy_iterable = $v->lazy();

// Print each color by consuming $lazy_iterable
foreach ($lazy_iterable as $color) {
  echo $color."\n";
}
