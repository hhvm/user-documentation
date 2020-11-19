<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\Zip;

<<__EntryPoint>>
function nonempty_exception_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};
  $zipped = $s->zip(Vector {'My Favorite', 'My Second Favorite'});
  \var_dump($zipped);
}
