<?hh

namespace Hack\UserDocumentation\API\Examples\Set\GetIterator;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  // Get an iterator for the Set of colors
  $iterator = $s->getIterator();

  // Print each color using the iterator
  while ($iterator->valid()) {
    echo $iterator->current()."\n";
    $iterator->next();
  }
}
