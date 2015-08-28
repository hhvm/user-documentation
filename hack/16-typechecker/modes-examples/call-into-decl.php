<?hh // strict

namespace Hack\UserDocumentation\TypeChecker\Modes\Examples\CallIntoDecl;

require __DIR__ . '/decl.php';
// This actually makes the call to calling_into_decl() since we cannot have
// top level functions in strict mode
require __DIR__ . '/main-function.php';

use \Hack\UserDocumentation\TypeChecker\Modes\Examples\Decl as Decl;

function calling_into_decl(): string {
  // If php_func wasn't in decl mode, then we would get an unbound name error.
  // As it is, we can call this function and the typechecker will ensure we are
  // passing in the right number of arguments, but not the types of them.
  return Decl\php_func("a", "b");
}
