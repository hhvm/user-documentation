<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\GetIterator;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Get an iterator for the Vector of colors
$iterator = $v->getIterator();

// Print each color using the iterator
while ($iterator->valid()) {
  echo $iterator->current()."\n";
  $iterator->next();
}
