<?hh // strict

namespace Hack\UserDocumentation\Statements\Expression\Examples\Useless;

function f(int $i): void {
  $i;
  -$i;
  123 << $i;
  34.5 * 12.6 + 11.987;
  \sqrt(1.23);
  !true;
}
