<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\VecColors;

<<__EntryPoint>>
function main(): void {
  $colors = vec[];       // create an empty vec
  \var_dump($colors);

  $colors[] = "red";     // add element 0 with value "red"
  $colors[] = "white";   // add element 1 with value "white"
  $colors[] = "blue";    // add element 2 with value "blue"
  \var_dump($colors);

  $colors[0] = "pink";   // change element 0's value to "pink"
  \var_dump($colors);

  $colors = vec["green", "yellow"]; // create a vec of two elements
  \var_dump($colors);
}
