<?hh

namespace Hack\UserDocumentation\Classes\Constants\Examples\AutoColor;

class Automobile {
  const DEFAULT_COLOR = "white";
  // ...
}

<<__EntryPoint>>
function main(): void {
  $col = Automobile::DEFAULT_COLOR;
  echo "\$col = $col\n";
}
