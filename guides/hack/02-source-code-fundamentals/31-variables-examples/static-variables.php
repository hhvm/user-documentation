<?hh // strict

namespace Hack\UserDocumentation\Fundamentals\Variables\Examples\StaticVar;

function f(): void {
  static $fs = 1;
  echo "\$fs = $fs\n";
  ++$fs;
}

<<__EntryPoint>>
function main(): void {
  for ($i = 1; $i <= 3; ++$i)
    f();
}
