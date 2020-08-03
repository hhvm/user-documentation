<?hh // strict

namespace Hack\UserDocumentation\Generics\Introduction\Examples\StackTest;

function useIntStack(
  \Hack\UserDocumentation\Generics\Introduction\Examples\Stack\Stack<int>
    $stInt,
): void {
  require_once("Stack.inc.php");
  $stInt->push(10);
  $stInt->push(20);
  $stInt->push(30);
  echo 'pop => '.$stInt->pop()."\n";
  //  $stInt->push(10.5); // rejected as not being type-safe
}
