<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\GetIterator;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  // Get a KeyedIterator for the Pair
  $iterator = $p->getIterator();

  // Print both keys and values
  while ($iterator->valid()) {
    echo $iterator->key().' => '.$iterator->current()."\n";
    $iterator->next();
  }
}
