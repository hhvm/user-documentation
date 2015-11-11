<?hh

namespace Hack\UserDocumentation\Operators\PHV\Examples\Iteration;

function phv_list(): void {
  $v = Vector {1, 2, 3};
  // Don't care about the last two values in the list
  list($a, $_, $_) = $v;
  var_dump($a); // prints 1
}

phv_list();
