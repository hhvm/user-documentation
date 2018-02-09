<?hh

namespace Hack\UserDocumentation\Callables\SpecialFunctions\Examples\Fun;

function foo() {
  \var_dump(__FUNCTION__);
}

function main() {
  $x = fun(
    '\Hack\UserDocumentation\Callables\SpecialFunctions\Examples\Fun\foo'
  );
  $x();
}

main();
