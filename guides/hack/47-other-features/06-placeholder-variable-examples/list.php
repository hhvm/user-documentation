<?hh

namespace Hack\UserDocumentation\Operators\PHV\Examples\Iteration;

function phv_list(): void {
  $v = Vector {1, 2, 3};
  // Don't care about the middle value.
  list($a, $_, $b) = $v;
  var_dump($a);
  var_dump($b);
}

phv_list();
