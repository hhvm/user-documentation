<?hh // strict

namespace Hack\UserDocumentation\Types\Generics\Examples\UseStack;

function use_int_stack(
  \Hack\UserDocumentation\Types\Generics\Examples\Stk\Stack<int> $stInt,
): void {
  require_once('Stack.inc.php');
  $stInt->push(10);
  $stInt->push(20);
  $stInt->push(30);
  echo 'pop => '.$stInt->pop()."\n";
}
