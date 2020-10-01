<?hh

namespace Hack\UserDocumentation\Statements\Expression\Examples\Useful;

function do_it(): int {
  return 100;
}

function f(): void {
  $i = 10; // $i is assigned the value 10; the result (10) is discarded
  ++$i; // $i is incremented; result (11) is discarded
  $i++; // $i is incremented; result (10) is discarded
  do_it(); // function do_it is called; result (return value) is discarded
}
