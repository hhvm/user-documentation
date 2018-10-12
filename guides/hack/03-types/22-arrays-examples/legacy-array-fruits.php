<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\LegAryFruits;

<<__Entrypoint>>
function main(): void {
  $fruits = array();        // create an empty array
  \var_dump($fruits);

  $fruits['oranges'] = 22;  // create element 4 with value "black"
  \var_dump($fruits);

  $fruits['oranges'] = 18;  // replace element 4’s value with "red"
  $fruits['apples'] = 15;   // create element 8 with value "white"
  $fruits['pears'] = 12;    // create element -3 with value "blue"
  \var_dump($fruits);
}
