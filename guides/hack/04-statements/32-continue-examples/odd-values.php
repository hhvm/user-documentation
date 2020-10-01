<?hh

namespace Hack\UserDocumentation\Statements\Continue\Examples\OddValues;

<<__EntryPoint>>
function main(): void {
  for ($i = 1; $i <= 10; ++$i) {
    if (($i % 2) === 0)
      continue;
    echo "$i is odd\n";
  }
}
