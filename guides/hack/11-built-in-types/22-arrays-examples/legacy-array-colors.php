<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\LegAryColors;

<<__EntryPoint>>
function main(): void {
  $colors = array(); // create an empty array
  \var_dump($colors);

  $colors[4] = "black"; // create element 4 with value "black"
  \var_dump($colors);

  $colors[4] = "red"; // replace element 4’s value with "red"
  $colors[8] = "white"; // create element 8 with value "white"
  $colors[-3] = "blue"; // create element -3 with value "blue"
  \var_dump($colors);
}
