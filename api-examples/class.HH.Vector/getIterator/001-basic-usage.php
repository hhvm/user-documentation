<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\GetIterator;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Get an iterator for the Vector of colors
  $iterator = $v->getIterator();

  // Print each color using the iterator
  while ($iterator->valid()) {
    echo $iterator->current()."\n";
    $iterator->next();
  }
}
