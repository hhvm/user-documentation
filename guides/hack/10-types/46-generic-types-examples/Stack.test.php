<?hh // strict

namespace HHVM\UserDocumentation\Guides\Hack\Types\GenericTypes\Stack;

function use_int_stack(Stack<int> $stInt): void {
  $stInt->push(10);
  $stInt->push(20);
  $stInt->push(30);
  echo 'pop => '.$stInt->pop()."\n";
}
