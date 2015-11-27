<?hh

namespace Hack\UserDocumentation\API\Examples\Set\RemoveAll;

$s = Set {'red', 'green', 'blue', 'yellow'};

$s->removeAll(Vector {
  'red',
  'blue',
  'red',
});

var_dump($s);
