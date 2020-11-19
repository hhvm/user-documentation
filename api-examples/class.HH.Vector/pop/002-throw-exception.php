<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Pop\EmptyException;

<<__EntryPoint>>
function throw_exception_main(): void {
  $v = Vector {};

  $last_element = $v->pop(); // Throws InvalidOperationException
}
