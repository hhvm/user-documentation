<?hh // strict

namespace Hack\UserDocumentation\Types\Generics\Examples\UseStack;

require_once('Stack.inc.php');

function use_int_stack(\Hack\UserDocumentation\Types\Generics\Examples\Stk\Stack<int> $stInt): void {
  $stInt->push(10);
  $stInt->push(20);
  $stInt->push(30);
  echo 'pop => ' . $stInt->pop() . "\n";
}
