<?hh

namespace Hack\UserDocumentation\Fundamentals\Variables\Examples\LocalVar;

function f(): void {
  $lv = 1;
  echo "\$lv = $lv\n";
  ++$lv;
}

<<__EntryPoint>>
function main(): void {
  for ($i = 1; $i <= 3; ++$i)
    f();
}
