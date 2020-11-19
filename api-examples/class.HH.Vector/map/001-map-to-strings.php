<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Map\Strings;

<<__EntryPoint>>
function map_to_strings_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $capitalized = $v->map(fun('strtoupper'));
  \var_dump($capitalized);

  $shortened = $v->map($color ==> \substr($color, 0, 3));
  \var_dump($shortened);
}
