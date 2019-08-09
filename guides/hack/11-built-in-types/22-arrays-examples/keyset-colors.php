<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\KeysetColors;

<<__EntryPoint>>
function main(): void {
  $colors = keyset[]; // create an empty keyset
  \var_dump($colors);

  $colors[] = "red"; // add element with key/value "red"
  $colors[] = "white"; // add element with key/value "white"
  $colors[] = "blue"; // add element with key/value "blue"
  \var_dump($colors);

  $colors = keyset[
    "green",
    "yellow",
    "green",
  ]; // create a keyset of two elements
  \var_dump($colors);

  echo "\$colors[\"green\"] = ".$colors["green"]."\n";
}
